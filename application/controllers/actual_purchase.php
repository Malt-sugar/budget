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

    public function index($task="list", $edit_id=0)
    {
        if($task=="list")
        {
            $this->budget_list();
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($edit_id);
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
        $config = System_helper::pagination_config(base_url() . "actual_purchase/index/list/",$this->actual_purchase_model->get_total_purchases(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['setups'] = $this->actual_purchase_model->get_purchase_info($page);
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

    public function budget_add_edit($edit_id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();
        $data['varieties'] = $this->budget_common_model->get_ordered_varieties();

        if($edit_id>0)
        {
            $data['edit_id'] = $edit_id;
            $data['setup'] = $this->actual_purchase_model->get_purchase_setup($edit_id);
            $data['purchases'] = $this->actual_purchase_model->get_purchase_detail($edit_id);
            $data['title'] = "Edit Actual Purchase";
            $ajax['page_url']=base_url()."actual_purchase/index/edit/";
        }
        else
        {
            $data['edit_id'] = 0;
            $data['setup'] = array();
            $data['purchases'] = array();
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
        $data = array();
        $setup_data = array();
        $time = time();
        $year = $this->input->post('year');
        $edit_id = $this->input->post('edit_id');
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

            $setup_data['year'] = $year;
            $setup_data['month_of_purchase'] = $this->input->post('month_of_purchase');
            $setup_data['consignment_no'] = $this->input->post('consignment_no');
            $setup_data['purchase_type'] = $this->config->item('purchase_type_actual');
            $setup_data['usd_conversion_rate'] = $this->input->post('usd_conversion_rate');
            $setup_data['lc_exp'] = $this->input->post('lc_exp');
            $setup_data['insurance_exp'] = $this->input->post('insurance_exp');
            $setup_data['packing_material'] = $this->input->post('packing_material');
            $setup_data['carriage_inwards'] = $this->input->post('carriage_inwards');
            $setup_data['docs'] = $this->input->post('docs');
            $setup_data['cnf'] = $this->input->post('cnf');

            if($edit_id>0)
            {
                $setup_data['modified_by'] = $user->user_id;
                $setup_data['modification_date'] = $time;
                Query_helper::update('budget_purchase_setup', $setup_data, array("id ='$edit_id'"));
                $setup_id = $edit_id;
            }
            else
            {
                $setup_data['created_by'] = $user->user_id;
                $setup_data['creation_date'] = $time;
                $setup_id = Query_helper::add('budget_purchase_setup', $setup_data);
            }

            if($edit_id>0)
            {
                $this->actual_purchase_model->actual_purchase_initial_update($edit_id); // Initial update
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

                        $purchase_edit_id = $this->actual_purchase_model->get_existing_purchase_and_id($edit_id, $variety_id);

                        if(isset($purchase_edit_id) && $purchase_edit_id>0)
                        {
                            $data['modified_by'] = $user->user_id;
                            $data['modification_date'] = $time;
                            $data['status'] = 1;
                            Query_helper::update('budget_purchases', $data, array("id ='$purchase_edit_id'"));
                        }
                        else
                        {
                            $data['setup_id'] = $setup_id;
                            $data['created_by'] = $user->user_id;
                            $data['creation_date'] = $time;
                            Query_helper::add('budget_purchases', $data);
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
        $year = $this->input->post('year');
        $month_of_purchase = $this->input->post('month_of_purchase');
        $consignment_no = $this->input->post('consignment_no');
        $edit_id = $this->input->post('edit_id');

        $existence = $this->actual_purchase_model->check_consignment_no_existence($year, $month_of_purchase, $consignment_no, $edit_id);

        if($existence)
        {
            $this->message = $this->lang->line("CONSIGNMENT_NO_CANNOT_BE_DUPLICATE");
            return false;
        }
        else
        {
            return true;
        }
    }

    public function get_purchase_detail_by_variety()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $variety_id = $this->input->post('variety_id');
        $current_id = $this->input->post('current_id');
        $data['year'] = $this->input->post('year');

        $data['variety_info'] = $this->actual_purchase_model->get_variety_info($variety_id);
        $data['crop_id'] = $crop_id;
        $data['type_id'] = $type_id;
        $data['variety_id'] = $variety_id;

        if(isset($data['year']))
        {
            $data['serial'] = $current_id;
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity'.$current_id,"html"=>$this->load->view("actual_purchase/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['message'] = $this->lang->line("SALES_TARGET_NOT_SET");
            $this->jsonReturn($ajax);
        }
    }

    public function get_direct_cost_this_year()
    {
        $year = $this->input->post('year');

        if(isset($year) && strlen($year)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#direct_cost_div',"html"=>$this->load->view("actual_purchase/direct_cost","",true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['message'] = $this->lang->line("DIRECT_COSTS_NOT_SET");
            $this->jsonReturn($ajax);
        }
    }

    public function check_consignment_no()
    {
        $year = $this->input->post('year');
        $month_of_purchase = $this->input->post('month_of_purchase');
        $consignment_no = $this->input->post('consignment_no');
        $edit_id = $this->input->post('edit_id');

        $existence = $this->actual_purchase_model->check_consignment_no_existence($year, $month_of_purchase, $consignment_no, $edit_id);

        if($existence)
        {
            $ajax['status'] = false;
            $ajax['message'] = $this->lang->line("CONSIGNMENT_NO_CANNOT_BE_DUPLICATE");
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $this->jsonReturn($ajax);
        }
    }

}
