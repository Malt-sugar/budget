<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Confirmed_quantity_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("confirmed_quantity_setup_model");
    }

    public function index($task="list", $year_id=0)
    {
        if($task=="list")
        {
            $this->budget_list();
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($year_id);
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
        $config = System_helper::pagination_config(base_url() . "confirmed_quantity_setup/index/list/",$this->confirmed_quantity_setup_model->get_total_purchase_years(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['purchases'] = $this->confirmed_quantity_setup_model->get_purchase_year_info($page);
        $data['title']="Confirmed Quantity Setup List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("confirmed_quantity_setup/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."confirmed_quantity_setup/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($year)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();
        $data['varieties'] = $this->budget_common_model->get_ordered_varieties();

        if(strlen($year)>1)
        {
            $data['purchases'] = $this->confirmed_quantity_setup_model->get_purchase_detail($year);
            $data['title'] = "Edit Confirmed Quantity Setup";
            $ajax['page_url']=base_url()."confirmed_quantity_setup/index/edit/";
        }
        else
        {
            $data['purchases'] = array();
            $data['title'] = "Confirmed Quantity Setup";
            $ajax['page_url'] = base_url()."confirmed_quantity_setup/index/add";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("confirmed_quantity_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();
        $year_id = $this->input->post('year_id');

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
            $setup_id = $this->confirmed_quantity_setup_model->get_budget_setup_id();

            if(strlen($year_id)>1)
            {
                // Initial update
                $update_status = array('status'=>0);
                Query_helper::update('budget_purchase_quantity',$update_status,array("year ='$year'"));
                $existing_varieties = $this->confirmed_quantity_setup_model->get_existing_varieties($year);

                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($detail_post as $detailKey=>$details)
                    {
                        if($detailKey==$cropTypeKey)
                        {
                            $data['year'] = $year;
                            $data['purchase_type'] = $this->config->item('purchase_type_budget');
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
                                    $data['modification_date'] = time();
                                    $data['status'] = 1;
                                    Query_helper::update('budget_purchase_quantity', $data, array("year ='$year'", "crop_id ='$crop_id'", "type_id ='$type_id'", "variety_id ='$variety_id'"));
                                }
                                else
                                {
                                    $data['created_by'] = $user->user_id;
                                    $data['creation_date'] = time();
                                    Query_helper::add('budget_purchase_quantity', $data);
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($detail_post as $detailKey=>$details)
                    {
                        if($detailKey==$cropTypeKey)
                        {
                            $data['year'] = $year;
                            $data['purchase_type'] = $this->config->item('purchase_type_budget');
                            $data['setup_id'] = $setup_id;
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($details as $variety_id=>$detail_type)
                            {
                                $data['variety_id'] = $variety_id;
                                $data['created_by'] = $user->user_id;
                                $data['creation_date'] = time();

                                foreach($detail_type as $type=>$amount)
                                {
                                    $data[$type] = $amount;
                                }

                                Query_helper::add('budget_purchase_quantity', $data);
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

        $budget_setup = $this->confirmed_quantity_setup_model->check_budget_setup();

        if(!$budget_setup)
        {
            $valid=false;
            $this->message .= $this->lang->line("LABEL_SETUP_BUDGET").'<br>';
        }

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
            $this->message .= $this->lang->line("SET_PURCHASE_QUANTITY").'<br>';
        }

        if(!$year)
        {
            $valid=false;
            $this->message .= $this->lang->line("SELECT_YEAR").'<br>';
        }

        if(strlen($this->input->post('year_id'))==1)
        {
            $existence = $this->confirmed_quantity_setup_model->check_budget_purchase_existence($year);
            if($existence)
            {
                $valid=false;
                $this->message .= $this->lang->line("BUDGET_PURCHASE_SET_ALREADY").'<br>';
            }
        }

        return $valid;
    }

    public function get_quantity_detail_by_variety()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $variety_id = $this->input->post('variety_id');
        $current_id = $this->input->post('current_id');
        $data['year'] = $this->input->post('year');

        $data['varieties'] = $this->confirmed_quantity_setup_model->get_variety_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("confirmed_quantity_setup/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>"<label class='label label-danger'>".$this->lang->line('NO_VARIETY_EXIST')."</label>","",true);
            $this->jsonReturn($ajax);
        }
    }

    public function check_budget_purchase_this_year()
    {
        $year = $this->input->post('year');

        $existence = $this->confirmed_quantity_setup_model->check_budget_purchase_existence($year);

        if($existence)
        {
            $ajax['status'] = false;
            $ajax['message'] = $this->lang->line("BUDGET_PURCHASE_SET_ALREADY");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $this->jsonReturn($ajax);
        }
    }

}
