<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_purchase extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_purchase_model");
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
        $data['title'] = "Purchase Report";
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();

        $ajax['status'] = true;
        $ajax['content'][] = array("id" =>"#content", "html" => $this->load->view("report_purchase/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_purchase/index/search/";
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
            $user = User_helper::get_user();
            $year = $this->input->post('year');
            $from_month = $this->input->post('from_month');
            $to_month = $this->input->post('to_month');
            $report_type = $this->input->post('report_type');
            $crop_id = $this->input->post('crop_id');
            $type_id = $this->input->post('type_id');
            $variety_id = $this->input->post('variety_id');
            $data['report_type'] = $report_type;

            if($report_type==1)
            {
                $data['title'] = "Budget Purchase Report";
                $data['purchases'] = $this->report_purchase_model->get_budget_purchase_info($year, $from_month, $to_month, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_purchase/budget_report", $data, true));
            }
            elseif($report_type==2)
            {
                $data['title'] = "Actual Purchase Report";
                $data['purchases'] = $this->report_purchase_model->get_actual_purchase_info($year, $from_month, $to_month, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_purchase/actual_report", $data, true));
            }
            elseif($report_type==3)
            {
                $data['title'] = "Budget Vs. Actual Purchase Report";
                $data['purchases'] = $this->report_purchase_model->get_actual_purchase_info($year, $from_month, $to_month, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_purchase/comparison_report", $data, true));
            }

            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
        return true;
    }
}
