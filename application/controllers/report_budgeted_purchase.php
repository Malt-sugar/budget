<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_budgeted_purchase extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_budgeted_purchase_model");
    }

    public function index($task="search",$id=0)
    {
        if($task=="search")
        {
            $this->budget_search();
        }
        elseif($task=="report")
        {
            $this->budget_report();
        }
        else
        {
            $this->budget_search();
        }
    }

    private function budget_search()
    {
        $data['title'] = "Budgeted Purchase Report";
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $ajax['status'] = true;
        $ajax['content'][] = array("id" => "#content", "html" => $this->load->view("report_budgeted_purchase/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_budgeted_purchase/index/search/";
        $this->jsonReturn($ajax);
    }

    private function budget_report()
    {
        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $year = $this->input->post('year');
            $crop_id = $this->input->post('crop_id');
            $type_id = $this->input->post('type_id');
            $variety_id = $this->input->post('variety_id');

            $data['purchases'] = $this->report_budgeted_purchase_model->get_budgeted_purchase_info($year, $crop_id, $type_id, $variety_id);
            $ajax['status'] = true;
            $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_budgeted_purchase/report", $data, true));
            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
//        $user = User_helper::get_user();
//        $this->load->library('form_validation');
//
//        if($user->budget_group == $this->config->item('user_group_division'))
//        {
//            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
//            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
//
//            if($this->form_validation->run() == FALSE)
//            {
//                $this->message=validation_errors();
//                return false;
//            }
//        }
//        elseif($user->budget_group == $this->config->item('user_group_zone'))
//        {
//            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
//            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
//            $this->form_validation->set_rules('zone',$this->lang->line('ZONE'),'required');
//
//            if($this->form_validation->run() == FALSE)
//            {
//                $this->message=validation_errors();
//                return false;
//            }
//        }
//        elseif($user->budget_group == $this->config->item('user_group_territory'))
//        {
//            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
//            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
//            $this->form_validation->set_rules('zone',$this->lang->line('ZONE'),'required');
//            $this->form_validation->set_rules('territory',$this->lang->line('TERRITORY'),'required');
//
//            if($this->form_validation->run() == FALSE)
//            {
//                $this->message=validation_errors();
//                return false;
//            }
//        }

        return true;
    }
}
