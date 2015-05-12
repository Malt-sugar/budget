<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Budget_common extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("budget_common_model");
    }

    public function get_dropDown_territory_by_zone()
    {
        $zone_id = $this->input->post('zone_id');
        $territories = $this->budget_common_model->get_territory_by_zone($zone_id);

        foreach($territories as $territory)
        {
            $data[] = array('value'=>$territory['territory_id'], 'text'=>$territory['territory_name']);
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#territory","html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }

    public function get_dropDown_customer_by_territory()
    {
        $zone_id = $this->input->post('zone_id');
        $territory_id = $this->input->post('territory_id');

        $customers = $this->budget_common_model->get_customer_by_territory($zone_id, $territory_id);

        foreach($customers as $customer)
        {
            $data[] = array('value'=>$customer['distributor_id'], 'text'=>$customer['distributor_name']);
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#customer","html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }
}
