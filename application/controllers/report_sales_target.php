<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Report_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("report_sales_target_model");
    }

    public function index($task="search",$id=0)
    {
        if($task=="search")
        {
            $this->rnd_search();
        }
        elseif($task=="report")
        {
            $this->rnd_report();
        }
        else
        {
            $this->rnd_search();
        }
    }

    private function rnd_search()
    {
        $data['title'] = "Sales Target Quantity Report";

        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['divisions'] = $this->budget_common_model->get_division_by_access();

        $ajax['status'] = true;
        $ajax['content'][] = array("id" => "#content", "html" => $this->load->view("report_sales_target/search", $data, true));

        if($this->message)
        {
            $ajax['message'] = $this->message;
        }

        $ajax['page_url'] = base_url()."report_sales_target/index/search/";
        $this->jsonReturn($ajax);
    }

    private function rnd_report()
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
            $division = $this->input->post('division');
            $zone = $this->input->post('zone');
            $territory = $this->input->post('territory');
            $customer = $this->input->post('customer');

            $data['targets'] = $this->report_sales_target_model->get_sales_target_info($year, $division, $zone, $territory, $customer);
            $ajax['status'] = true;
            $ajax['content'][] = array("id" => "#report_list", "html" => $this->load->view("report_sales_target/report", $data, true));
            $this->jsonReturn($ajax);
        }
    }

    private function check_validation()
    {
        $user = User_helper::get_user();
        $this->load->library('form_validation');

        if($user->budget_group == $this->config->item('user_group_division'))
        {
            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');

            if($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                return false;
            }
        }
        elseif($user->budget_group == $this->config->item('user_group_zone'))
        {
            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
            $this->form_validation->set_rules('zone',$this->lang->line('ZONE'),'required');

            if($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                return false;
            }
        }
        elseif($user->budget_group == $this->config->item('user_group_territory'))
        {
            $this->form_validation->set_rules('year',$this->lang->line('YEAR'),'required');
            $this->form_validation->set_rules('division',$this->lang->line('DIVISION'),'required');
            $this->form_validation->set_rules('zone',$this->lang->line('ZONE'),'required');
            $this->form_validation->set_rules('territory',$this->lang->line('TERRITORY'),'required');

            if($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                return false;
            }
        }

        return true;
    }
}
