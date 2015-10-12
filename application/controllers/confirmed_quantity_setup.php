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

    public function index($task="list", $id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($id);
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_add_edit($id);
        }
    }

    public function budget_add_edit($id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();
        $data['varieties'] = $this->budget_common_model->get_ordered_varieties();

        if(strlen($id)>1)
        {
            $data['quantity_setups'] = $this->confirmed_quantity_setup_model->get_confirmed_quantity_detail($id);
            $data['title'] = "Edit Confirmed Quantity Setup";
            $ajax['page_url']=base_url()."confirmed_quantity_setup/index/edit/";
        }
        else
        {
            $data['quantity_setups'] = array();
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
        $data = array();
        $time = time();
        $year = $this->input->post('year');
        $data['year'] = $year;
        $quantityPost = $this->input->post('quantity');

        $month_setup_post = $this->input->post('month_setup');
        $setup_data = array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $this->confirmed_quantity_setup_model->confirmed_quantity_initial_update($year); // initial update

            foreach($quantityPost as $crop_id=>$typeVarietyPost)
            {
                $data['crop_id'] = $crop_id;
                foreach($typeVarietyPost as $type_id=>$varietyPost)
                {
                    $data['type_id'] = $type_id;
                    foreach($varietyPost as $variety_id=>$detailPost)
                    {
                        $data['variety_id'] = $variety_id;
                        foreach($detailPost as $detailKey=>$val)
                        {
                            $data[$detailKey] = $val;
                        }

                        if($data['confirmed_quantity']>0 && $data['pi_value']>0)
                        {
                            $edit_id = $this->confirmed_quantity_setup_model->check_confirmed_quantity_existence($year, $crop_id, $type_id, $variety_id);

                            if($edit_id>0)
                            {
                                $data['modified_by'] = $user->user_id;
                                $data['modification_date'] = $time;
                                $data['status'] = 1;
                                Query_helper::update('budget_purchase_quantity',$data,array("id ='$edit_id'"));
                            }
                            else
                            {
                                $data['created_by'] = $user->user_id;
                                $data['creation_date'] = $time;
                                Query_helper::add('budget_purchase_quantity', $data);
                            }
                        }
                    }
                }
            }

            // MONTH WISE PURCHASE SETUP EXECUTION //

            $this->confirmed_quantity_setup_model->budget_month_initial_update($year); // initial update

            foreach($month_setup_post as $variety_id=>$month_setup_detail)
            {
                $new_arr = array();
                $setup_data = array();
                $monthArray = array();
                $quantityArray = array();
                $setup_data['year'] = $this->input->post('year');
                $variety_info = $this->confirmed_quantity_setup_model->get_variety_info($variety_id);
                $setup_data['crop_id'] = $variety_info['crop_id'];
                $setup_data['type_id'] = $variety_info['product_type_id'];
                $setup_data['variety_id'] = $variety_id;

                foreach($month_setup_detail as $item=>$detail)
                {
                    if($item=='month')
                    {
                        foreach($detail as $month)
                        {
                            $monthArray[] = $month;
                        }
                    }

                    if($item=='quantity')
                    {
                        foreach($detail as $quantity)
                        {
                            $quantityArray[] = $quantity;
                        }
                    }

                    if(isset($monthArray) && isset($quantityArray))
                    {
                        foreach($monthArray as $mk=>$month)
                        {
                            if(isset($quantityArray[$mk]))
                            {
                                $new_arr[] = array(
                                    'month'=>$month,
                                    'quantity'=>$quantityArray[$mk]
                                );
                            }
                        }
                    }
                }

                foreach($new_arr as $arrayOne)
                {
                    foreach($arrayOne as $index=>$val)
                    {
                        $setup_data[$index] = $val;
                    }

                    if($setup_data['month']>0 && $setup_data['quantity']>0)
                    {
                        $existing_month_edit_id = $this->confirmed_quantity_setup_model->get_existing_month_edit_id($year, $variety_id, $setup_data['month']);

                        if($existing_month_edit_id>0)
                        {
                            $setup_data['modified_by'] = $user->user_id;
                            $setup_data['modification_date'] = $time;
                            $setup_data['status'] = 1;
                            Query_helper::update('budget_purchase_months',$setup_data,array("id ='$existing_month_edit_id'"));
                        }
                        else
                        {
                            $setup_data['created_by'] = $user->user_id;
                            $setup_data['creation_date'] = $time;
                            Query_helper::add('budget_purchase_months', $setup_data);
                        }
                    }
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if($this->db->trans_status() === TRUE)
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
                $this->jsonReturn($ajax);
            }

            $this->budget_add_edit(0);//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $valid=true;

        $quantityPost = $this->input->post('quantity');
        $year = $this->input->post('year');

        foreach($quantityPost as $crop_id=>$typeVarietyPost)
        {
            foreach($typeVarietyPost as $type_id=>$varietyPost)
            {
                foreach($varietyPost as $variety_id=>$detailPost)
                {
                    $variety_array[] = $variety_id;
                }
            }
        }

        $new_arr = array_unique($variety_array, SORT_REGULAR);

        if($variety_array != $new_arr)
        {
            $valid=false;
            $this->message .= $this->lang->line("DUPLICATE_CROP_TYPE").'<br>';
        }

        if(is_array($variety_array) && sizeof($variety_array)>0)
        {
            $new_arr = array_unique($variety_array, SORT_REGULAR);

            if($variety_array != $new_arr)
            {
                $valid=false;
                $this->message .= $this->lang->line("DUPLICATE_CROP_TYPE").'<br>';
            }
        }
        else
        {
            $valid=false;
            $this->message .= $this->lang->line("NO_VALID_ENTRY").'<br>';
        }

        if(!$year)
        {
            $valid=false;
            $this->message .= $this->lang->line("SELECT_YEAR").'<br>';
        }

//        if(strlen($year_id)==1)
//        {
//            $existence = $this->confirmed_quantity_setup_model->check_quantity_year_existence($year);
//            if($existence)
//            {
//                $valid=false;
//                $this->message .= $this->lang->line("BUDGET_PURCHASE_SET_ALREADY").'<br>';
//            }
//        }

        return $valid;
    }

    public function get_quantity_detail_by_variety()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $data['year'] = $this->input->post('year');

        $data['varieties'] = $this->confirmed_quantity_setup_model->get_varieties_by_crop_type($crop_id, $type_id);

        if(isset($data['year']) && sizeof($data['varieties'])>0)
        {
            $data['title'] = 'Confirmed Quantity';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity',"html"=>$this->load->view("confirmed_quantity_setup/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['message'] = $this->lang->line("SALES_TARGET_NOT_SET");
            $this->jsonReturn($ajax);
        }
    }

    public function check_budget_purchase_this_year()
    {
        $year = $this->input->post('year');
        $existence = $this->confirmed_quantity_setup_model->check_quantity_year_existence($year);

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

    public function get_dropDown_type_by_crop()
    {
        $crop_id = $this->input->post('crop_id');
        $types = $this->budget_common_model->get_type_by_crop($crop_id);

        $data = array();
        if(is_array($types) && sizeof($types)>0)
        {
            foreach($types as $type)
            {
                $data[] = array('value'=>$type['product_type_id'], 'text'=>$type['product_type']);
            }
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>'#type_select',"html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }

}
