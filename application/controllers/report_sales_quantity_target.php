<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_sales_quantity_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_sales_quantity_target_model");
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
        $data['title'] = "Sales Quantity Target Budget Report";
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['divisions'] = $this->budget_common_model->get_division_by_access();

        $ajax['status'] = true;
        $ajax['content'][] = array("id" =>"#content", "html" => $this->load->view("report_sales_quantity_target/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_sales_quantity_target/index/search/";
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
            $data['year'] = $this->input->post('year');
            $data['from_month'] = $this->input->post('from_month');
            $data['to_month'] = $this->input->post('to_month');
            $data['crop_id'] = $this->input->post('crop_id');
            $data['type_id'] = $this->input->post('type_id');
            $data['variety_id'] = $this->input->post('variety_id');
            $data['division'] = $this->input->post('division');
            $data['zone'] = $this->input->post('zone');
            $data['territory'] = $this->input->post('territory');
            $data['district'] = $this->input->post('district');
            $data['customer'] = $this->input->post('customer');

            if(strlen($data['division'])<2 && strlen($data['zone'])<2 && strlen($data['territory'])<2 && empty($data['district']) && strlen($data['customer'])<2)
            {
                $data['selection_type'] = 0;
            }
            elseif(strlen($data['division'])>2 && strlen($data['zone'])<2 && strlen($data['territory'])<2 && empty($data['district']) && strlen($data['customer'])<2)
            {
                $data['selection_type'] = 1;
            }
            elseif(strlen($data['division'])>2 && strlen($data['zone'])>2 && strlen($data['territory'])<2 && empty($data['district']) && strlen($data['customer'])<2)
            {
                $data['selection_type'] = 2;
            }
            elseif(strlen($data['division'])>2 && strlen($data['zone'])>2 && strlen($data['territory'])>2 && empty($data['district']) && strlen($data['customer'])<2)
            {
                $data['selection_type'] = 3;
            }
            elseif(strlen($data['division'])>2 && strlen($data['zone'])>2 && strlen($data['territory'])>2 && !empty($data['district']) && strlen($data['customer'])<2)
            {
                $data['selection_type'] = 4;
            }
            elseif(strlen($data['division'])>2 && strlen($data['zone'])>2 && strlen($data['territory'])>2 && !empty($data['district']) && strlen($data['customer'])>2)
            {
                $data['selection_type'] = 5;
            }

            if($user->budget_group==$this->config->item('user_group_division') && strlen($data['division'])<2)
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line('LABEL_SELECT_DIVISION');
                $this->jsonReturn($ajax);
            }
            elseif($user->budget_group==$this->config->item('user_group_zone') && strlen($data['zone'])<2)
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line('LABEL_SELECT_ZONE');
                $this->jsonReturn($ajax);
            }
            elseif($user->budget_group==$this->config->item('user_group_territory') && strlen($data['territory'])<2)
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line('LABEL_SELECT_TERRITORY');
                $this->jsonReturn($ajax);
            }
            else
            {
                $data['title'] = "Sales Quantity Target Budget Report";
                $data['targets'] = $this->report_sales_quantity_target_model->get_sales_quantity_target_info($data['selection_type'], $data['year'], $data['from_month'], $data['to_month'], $data['division'], $data['zone'], $data['territory'], $data['district'], $data['customer'], $data['crop_id'], $data['type_id'], $data['variety_id']);
                $ajax['status'] = true;
                $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_sales_quantity_target/report", $data, true));
                $this->jsonReturn($ajax);
            }
        }
    }

    private function check_validation()
    {
        return true;
    }

    public function get_budgeted_detail_info()
    {
        $detail = array();
        $sl = $this->input->post('sl');
        $data['data_type'] = $this->input->post('data_type');
        $selection_type = $this->input->post('selection_type');
        $year = $this->input->post('year');
        $variety = $this->input->post('variety');
        $division_id = $this->input->post('division');
        $zone_id = $this->input->post('zone');
        $territory_id = $this->input->post('territory');
        $district_id = $this->input->post('district');
        $customer_id = $this->input->post('customer');

        if($selection_type==0)
        {
            $divisions = $this->budget_common_model->get_division_by_access();
            foreach($divisions as $division)
            {
                $quantity = $this->report_sales_quantity_target_model->get_detail_budgeted_data($data['data_type'], $selection_type, $division['value'], $year, $variety);
                $detail[] = array('location_id'=>$division['value'], 'location_name'=>$division['text'], 'budgeted'=>$quantity);
            }
        }
        elseif($selection_type==1)
        {
            $zones = $this->budget_common_model->get_zone_by_access($division_id);
            foreach($zones as $zone)
            {
                $quantity = $this->report_sales_quantity_target_model->get_detail_budgeted_data($data['data_type'], $selection_type, $zone['zone_id'], $year, $variety);
                $detail[] = array('location_id'=>$zone['zone_id'], 'location_name'=>$zone['zone_name'], 'budgeted'=>$quantity);
            }
        }
        elseif($selection_type==2)
        {
            $territories = $this->budget_common_model->get_territory_by_access($zone_id);
            foreach($territories as $territory)
            {
                $quantity = $this->report_sales_quantity_target_model->get_detail_budgeted_data($data['data_type'], $selection_type, $territory['territory_id'], $year, $variety);
                $detail[] = array('location_id'=>$territory['territory_id'], 'location_name'=>$territory['territory_name'], 'budgeted'=>$quantity);
            }
        }
        elseif($selection_type==3)
        {
            $districts = $this->budget_common_model->get_district_by_territory($zone_id, $territory_id);
            foreach($districts as $district)
            {
                $quantity = $this->report_sales_quantity_target_model->get_detail_budgeted_data($data['data_type'], $selection_type, $district['zilla_id'], $year, $variety);
                $detail[] = array('location_id'=>$district['zilla_id'], 'location_name'=>$district['zilla_name'], 'budgeted'=>$quantity);
            }
        }
        elseif($selection_type==4)
        {
            $customers = $this->budget_common_model->get_customer_by_district($territory_id, $district_id);
            foreach($customers as $customer)
            {
                $quantity = $this->report_sales_quantity_target_model->get_detail_budgeted_data($data['data_type'], $selection_type, $customer['distributor_id'], $year, $variety);
                $detail[] = array('location_id'=>$customer['distributor_id'], 'location_name'=>$customer['distributor_name'], 'budgeted'=>$quantity);
            }
        }
        //print_r($detail);

        $data['detail'] = $detail;
        $ajax['status'] = true;

        if($data['data_type']==1)
        {
            $ajax['content'][] = array("id" => "#totalBudgeted".$sl, "html" => $this->load->view("report_sales_quantity_target/show_detail", $data, true));
        }
        elseif($data['data_type']==2)
        {
            $ajax['content'][] = array("id" => "#totalTargeted".$sl, "html" => $this->load->view("report_sales_quantity_target/show_detail", $data, true));
        }

        $this->jsonReturn($ajax);
    }
}
