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

        $data['setups'] = $this->confirmed_quantity_setup_model->get_purchase_year_info($page);
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
            $data['year'] = $year;
            $data['quantity_setups'] = $this->confirmed_quantity_setup_model->get_confirmed_quantity_detail($year);
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

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            if(strlen($this->input->post('year_id'))>1)
            {
                $this->confirmed_quantity_setup_model->confirmed_quantity_initial_update($year); // initial update
            }

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

        $quantityPost = $this->input->post('quantity');
        $year = $this->input->post('year');
        $year_id = $this->input->post('year_id');

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

        if(strlen($year_id)==1)
        {
            $existence = $this->confirmed_quantity_setup_model->check_quantity_year_existence($year);
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

        $data['budgeted_sales_quantity'] = $this->confirmed_quantity_setup_model->get_budgeted_sales_quantity($data['year'], $crop_id, $type_id, $variety_id);
        $data['min_stock_quantity'] = $this->confirmed_quantity_setup_model->get_budget_min_stock_quantity($crop_id, $type_id, $variety_id);
        $data['current_stock'] = Purchase_helper::get_current_stock($crop_id, $type_id, $variety_id);
        $data['variety_info'] = $this->confirmed_quantity_setup_model->get_variety_info($variety_id);
        $data['crop_id'] = $crop_id;
        $data['type_id'] = $type_id;
        $data['variety_id'] = $variety_id;

        if(isset($data['year']) && $data['budgeted_sales_quantity']>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Confirmed Quantity';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity'.$current_id,"html"=>$this->load->view("confirmed_quantity_setup/variety_list",$data,true));
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
