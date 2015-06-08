<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_sales_prediction extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_sales_prediction_model");
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
        $data['title'] = "Sales Prediction Pricing Report";
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $ajax['status'] = true;
        $ajax['content'][] = array("id" => "#content", "html" => $this->load->view("report_sales_prediction/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_sales_prediction/index/search/";
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
            $data['prediction_from'] = $this->input->post('prediction_from');
            $data['prediction_to'] = $this->input->post('prediction_to');

            $initials = $this->report_sales_prediction_model->get_initial_prediction_detail($year, $crop_id, $type_id, $variety_id);
            $mgts = $this->report_sales_prediction_model->get_mgt_prediction_detail($year, $crop_id, $type_id, $variety_id);
            $mkts = $this->report_sales_prediction_model->get_mkt_prediction_detail($year, $crop_id, $type_id, $variety_id);
            $finals = $this->report_sales_prediction_model->get_final_prediction_detail($year, $crop_id, $type_id, $variety_id);

            $results = array();
            if(is_array($mgts) && sizeof($initials)==sizeof($mgts))
            {
                foreach($initials as $key => $value)
                {
                    $results[] = array_merge($value, $mgts[$key]);
                }
            }

            if(is_array($mkts) && sizeof($initials)==sizeof($mkts))
            {
                foreach($results as $key => $value)
                {
                    $results[] = array_merge($value, $mkts[$key]);
                }
            }

            if(is_array($finals) && sizeof($initials)==sizeof($finals))
            {
                foreach($results as $key => $value)
                {
                    $results[] = array_merge($value, $finals[$key]);
                }
            }

            if(sizeof($results)>0 && is_array($results))
            {
                $data['predictions'] = $results;
            }
            else
            {
                $data['predictions'] = $initials;
            }

            $ajax['status'] = true;
            $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_sales_prediction/report", $data, true));
            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
        return true;
    }
}
