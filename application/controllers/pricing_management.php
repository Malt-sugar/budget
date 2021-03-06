<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Pricing_management extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("pricing_management_model");
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
            $data['quantity_setups'] = $this->pricing_management_model->get_confirmed_quantity_detail($id);
            $data['title'] = "Edit Pricing Management";
            $ajax['page_url']=base_url()."pricing_management/index/edit/";
        }
        else
        {
            $data['quantity_setups'] = array();
            $data['title'] = "Pricing management";
            $ajax['page_url'] = base_url()."pricing_management/index/add";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("pricing_management/add_edit",$data,true));
        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = array();
        $time = time();
        $year = $this->input->post('year');
        $data['year'] = $year;
        $pricingPost = $this->input->post('pricing');
        $data['pricing_type'] = $this->config->item('pricing_type_initial');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($pricingPost as $crop_id=>$typeVarietyPost)
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

                        if($data['mrp']>0)
                        {
                            $edit_id = $this->pricing_management_model->check_sales_pricing_existence($year, $crop_id, $type_id, $variety_id);

                            if($edit_id>0)
                            {
                                $data['modified_by'] = $user->user_id;
                                $data['modification_date'] = $time;
                                $data['status'] = 1;
                                Query_helper::update('budget_sales_pricing',$data,array("id ='$edit_id'"));
                            }
                            else
                            {
                                $data['created_by'] = $user->user_id;
                                $data['creation_date'] = $time;
                                Query_helper::add('budget_sales_pricing', $data);
                            }
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
        return $valid;
    }

    public function get_quantity_detail_by_variety()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $data['year'] = $this->input->post('year');

        $data['varieties'] = $this->pricing_management_model->get_varieties_by_crop_type($crop_id, $type_id);

        if(isset($data['year']) && sizeof($data['varieties'])>0)
        {
            $data['title'] = 'Pricing management';
            $ajax['status'] = true;
            $ajax['content'][] = array("id"=>'#variety_quantity',"html"=>$this->load->view("pricing_management/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['message'] = $this->lang->line("SALES_TARGET_NOT_SET");
            $this->jsonReturn($ajax);
        }
    }

//    public function check_budget_purchase_this_year()
//    {
//        $year = $this->input->post('year');
//        $existence = $this->pricing_management_model->check_quantity_year_existence($year);
//
//        if($existence)
//        {
//            $ajax['status'] = false;
//            $ajax['message'] = $this->lang->line("BUDGET_PURCHASE_SET_ALREADY");
//            $this->jsonReturn($ajax);
//        }
//        else
//        {
//            $ajax['status'] = true;
//            $this->jsonReturn($ajax);
//        }
//    }

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
