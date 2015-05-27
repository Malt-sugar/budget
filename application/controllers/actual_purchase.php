<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Actual_purchase extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("actual_purchase_model");
    }

    public function index($task="list", $year_id=0, $setup_id=0)
    {
        if($task=="list")
        {
            $this->budget_list();
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($year_id, $setup_id);
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_list();
        }
    }

    public function budget_list($page=0)
    {
        $config = System_helper::pagination_config(base_url() . "actual_purchase/index/list/",$this->actual_purchase_model->get_total_purchase_years(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['purchases'] = $this->actual_purchase_model->get_purchase_year_info($page);
        $data['title']="Actual Purchase List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("actual_purchase/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."actual_purchase/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($year, $setup_id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        if(strlen($year)>1 && $setup_id>0)
        {
            $data['purchases'] = $this->actual_purchase_model->get_purchase_detail($year, $setup_id);
            $data['setups'] = $this->actual_purchase_model->get_purchase_setup($year, $setup_id);
            $data['title'] = "Edit Actual Purchase";
            $ajax['page_url']=base_url()."actual_purchase/index/edit/";
        }
        else
        {
            $data['purchases'] = array();
            $data['setups'] = array();
            $data['title'] = "Actual Purchase";
            $ajax['page_url'] = base_url()."actual_purchase/index/add";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("actual_purchase/add_edit",$data,true));
        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();
        $setup_data = Array();
        $time = time();

        $year_id = $this->input->post('year_id');
        $setup_id = $this->input->post('setup_id');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $crop_type_Post = $this->input->post('purchase');
            $detail_post = $this->input->post('detail');
            $year = $this->input->post('year');

            $setup_data['year'] = $year;
            $setup_data['purchase_type'] = $this->config->item('purchase_type_actual');
            $setup_data['usd_conversion_rate'] = $this->input->post('usd_conversion_rate');
            $setup_data['lc_exp'] = $this->input->post('lc_exp');
            $setup_data['insurance_exp'] = $this->input->post('insurance_exp');
            $setup_data['packing_material'] = $this->input->post('packing_material');
            $setup_data['carriage_inwards'] = $this->input->post('carriage_inwards');
            $setup_data['air_freight_and_docs'] = $this->input->post('air_freight_and_docs');

            if(strlen($year_id)>1 && $setup_id>0)
            {
                // Update setup table
                $setup_data['modified_by'] = $user->user_id;
                $setup_data['modification_date'] = $time;
                Query_helper::update('budget_purchase_setup', $setup_data, array("id ='$setup_id'"));

                // Initial update purchase table
                $update_status = array('status'=>0);
                Query_helper::update('budget_purchase',$update_status,array("year ='$year'", "setup_id ='$setup_id'"));
                $existing_varieties = $this->actual_purchase_model->get_existing_varieties($year, $setup_id);

                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($detail_post as $detailKey=>$details)
                    {
                        if($detailKey==$cropTypeKey)
                        {
                            $data['year'] = $year;
                            $data['purchase_type'] = $this->config->item('purchase_type_actual');
                            $data['setup_id'] = $setup_id;
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($details as $variety_id=>$detail_type)
                            {
                                $data['variety_id'] = $variety_id;

                                foreach($detail_type as $type=>$amount)
                                {
                                    $data[$type] = $amount;
                                }

                                if(in_array($variety_id, $existing_varieties))
                                {
                                    $crop_id = $data['crop_id'];
                                    $type_id = $data['type_id'];

                                    $data['modified_by'] = $user->user_id;
                                    $data['modification_date'] = $time;
                                    $data['status'] = 1;
                                    Query_helper::update('budget_purchase', $data, array("year ='$year'", "setup_id ='$setup_id'", "crop_id ='$crop_id'", "type_id ='$type_id'", "variety_id ='$variety_id'"));
                                }
                                else
                                {
                                    $data['created_by'] = $user->user_id;
                                    $data['creation_date'] = $time;
                                    Query_helper::add('budget_purchase', $data);
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                // Setup table new insert.
                $setup_data['created_by'] = $user->user_id;
                $setup_data['creation_date'] = $time;
                $setup_row_id = Query_helper::add('budget_purchase_setup', $setup_data); // getting setup table id.

                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($detail_post as $detailKey=>$details)
                    {
                        if($detailKey==$cropTypeKey)
                        {
                            $data['year'] = $year;
                            $data['purchase_type'] = $this->config->item('purchase_type_actual');
                            $data['setup_id'] = $setup_row_id;
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($details as $variety_id=>$detail_type)
                            {
                                $data['variety_id'] = $variety_id;
                                $data['created_by'] = $user->user_id;
                                $data['creation_date'] = $time;

                                foreach($detail_type as $type=>$amount)
                                {
                                    $data[$type] = $amount;
                                }

                                Query_helper::add('budget_purchase', $data);
                            }
                        }
                    }
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
            }
            else
            {
                $this->message=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
            }

            $this->budget_list();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $valid=true;
        $crop_type_Post = $this->input->post('purchase');
        $detail_post = $this->input->post('detail');

        $year = $this->input->post('year');
        $usd_conversion_rate = $this->input->post('usd_conversion_rate');
        $lc_exp = $this->input->post('lc_exp');
        $insurance_exp = $this->input->post('insurance_exp');
        $packing_material = $this->input->post('packing_material');
        $carriage_inwards = $this->input->post('carriage_inwards');
        $air_freight_and_docs = $this->input->post('air_freight_and_docs');

        $budget_setup = $this->actual_purchase_model->check_budget_setup();

        if(!$budget_setup)
        {
            $valid=false;
            $this->message .= $this->lang->line("LABEL_SETUP_BUDGET").'<br>';
        }

        if(!$year)
        {
            $valid=false;
            $this->message .= $this->lang->line("SELECT_YEAR").'<br>';
        }

//        if(!$usd_conversion_rate)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_USD_CONVERSION_RATE").'<br>';
//        }
//
//        if(!$lc_exp)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_LC_EXP").'<br>';
//        }
//
//        if(!$insurance_exp)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_INSURANCE_EXP").'<br>';
//        }
//
//        if(!$packing_material)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_PACKING_MATERIAL").'<br>';
//        }
//
//        if(!$carriage_inwards)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_CARRIAGE_INWARDS").'<br>';
//        }
//
//        if(!$air_freight_and_docs)
//        {
//            $valid=false;
//            $this->message .= $this->lang->line("LABEL_INPUT_AIR_FREIGHT_AND_DOCS").'<br>';
//        }

        if(is_array($crop_type_Post) && sizeof($crop_type_Post)>0)
        {
            foreach($crop_type_Post as $crop_type)
            {
                $crop_type_array[] = array('crop'=>$crop_type['crop'], 'type'=>$crop_type['type']);
            }

            $new_arr = array_unique($crop_type_array, SORT_REGULAR);

            if($crop_type_array != $new_arr)
            {
                $valid=false;
                $this->message .= $this->lang->line("DUPLICATE_CROP_TYPE").'<br>';
            }
        }

        if(!$crop_type_Post || !$detail_post)
        {
            $valid=false;
            $this->message .= $this->lang->line("LABEL_SET_ACTUAL_PURCHASE_QUANTITY").'<br>';
        }

        return $valid;
    }

    public function get_varieties_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->actual_purchase_model->get_variety_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("actual_purchase/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>"<label class='label label-danger'>".$this->lang->line('NO_VARIETY_EXIST')."</label>","",true);
            $this->jsonReturn($ajax);
        }
    }

}
