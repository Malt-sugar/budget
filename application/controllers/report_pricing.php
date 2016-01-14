<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_pricing extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_pricing_model");
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
        $data['title'] = "Pricing Report";
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();

        $ajax['status'] = true;
        $ajax['content'][] = array("id" =>"#content", "html" => $this->load->view("report_pricing/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_pricing/index/search/";
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
            $report_type = $this->input->post('report_type');
            $comparison_type = $this->input->post('comparison_type');
            $crop_id = $this->input->post('crop_id');
            $type_id = $this->input->post('type_id');
            $variety_id = $this->input->post('variety_id');
            $data['report_type'] = $report_type;
            $data['year'] = $year;

            if($report_type==1 || $report_type==2 || $report_type==3 || $report_type==4)
            {
                if($report_type==1)
                {
                    $title = "Automated Pricing Report";
                }
                elseif($report_type==2)
                {
                    $title = "Management Pricing Report";
                }
                elseif($report_type==3)
                {
                    $title = "Marketing Pricing Report";
                }
                elseif($report_type==4)
                {
                    $title = "Final Pricing Report";
                }

                $data['title'] = $title;
                $data['pricingData'] = $this->report_pricing_model->get_pricing_info($year, $report_type, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_pricing/pricing_report", $data, true));
            }
            elseif($report_type==5)
            {
                if($comparison_type==1)
                {
                    $title = 'Sales Commission Comparison Report';
                }
                elseif($comparison_type==2)
                {
                    $title = 'Sales Bonus Comparison Report';
                }
                elseif($comparison_type==3)
                {
                    $title = 'Incentive Comparison Report';
                }
                elseif($comparison_type==4)
                {
                    $title = 'Net Profit Comparison Report';
                }
                elseif($comparison_type==5)
                {
                    $title = 'Net Sales Comparison Report';
                }
                elseif($comparison_type==6)
                {
                    $title = 'Total Net Profit Comparison Report';
                }
                elseif($comparison_type==7)
                {
                    $title = 'Total Net Sales Comparison Report';
                }
                else
                {
                    $title = 'Comparison Report';
                }

                $data['comparison_type'] = $comparison_type;
                $data['title'] = $title;
                $data['pricingData'] = $this->report_pricing_model->get_purchase_comparison_info($year, $report_type, $comparison_type, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_pricing/comparison_report", $data, true));
            }
            elseif($report_type==6)
            {
                $data['title'] = 'Budget vs. Actual Comparison Report';
                $data['pricingData'] = $this->report_pricing_model->get_budget_actual_comparison_info($year, $crop_id, $type_id, $variety_id);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_pricing/budget_vs_actual_comparison_report", $data, true));
            }

            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
        return true;
    }
}
