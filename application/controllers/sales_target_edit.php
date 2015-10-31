<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Sales_target_edit extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("sales_target_edit_model");
    }

    public function index($task="add", $id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit();
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_add_edit();
        }
    }

    public function budget_add_edit()
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status = 0'));
        $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0'));
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0'));
        $data['customers'] = Query_helper::get_info('ait_distributor_info',array('distributor_id value','distributor_name text'),array('del_status = 0'));

        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        $data['stocks'] = array();
        $data['title'] = "Sales Target Edit";
        $ajax['page_url'] = base_url()."sales_target_edit/index/add";

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("sales_target_edit/add_edit",$data,true));
        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $quantity_post = $this->input->post('quantity');
        $edit_type = $this->input->post('edit_type');
        $year = $this->input->post('year');
        $division = $this->input->post('division');
        $zone = $this->input->post('zone');
        $territory = $this->input->post('territory');
        $customer = $this->input->post('customer');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($quantity_post as $quantity)
            {
                $this->sales_target_edit_model->update_sales_target($edit_type, $year, $division, $zone, $territory, $customer, $quantity['crop'], $quantity['type'], $quantity['variety'], $quantity['budgeted_quantity'], $quantity['bottom_up_remarks']);
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $ajax['status'] = true;
                $ajax['message']=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status'] = true;
                $ajax['message']=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
                $this->jsonReturn($ajax);
            }

            $this->budget_add_edit();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $valid=true;

        return $valid;
    }

    public function get_sales_target_edit_detail()
    {
        $year = $this->input->post('year');
        $edit_type = $this->input->post('edit_type');
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $variety_id = $this->input->post('variety_id');
        $current_id = $this->input->post('current_id');

        $data['details'] = $this->sales_target_edit_model->get_variety_sales_target_info($edit_type, $year, $crop_id, $type_id, $variety_id);
        $data['crop_id'] = $crop_id;
        $data['type_id'] = $type_id;
        $data['variety_id'] = $variety_id;
        $data['serial'] = $current_id;

        if(sizeof($data['details'])>0 && $edit_type>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Sales Target Edit';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity'.$current_id,"html"=>$this->load->view("sales_target_edit/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity'.$current_id,"html"=>"<label class='label label-danger'>".$this->lang->line('NOT_BUDGETED')."</label>","",true);
            $this->jsonReturn($ajax);
        }
    }

}
