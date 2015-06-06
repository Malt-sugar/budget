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


    public function get_zone_by_access()
    {
        $division_id = $this->input->post('division_id');
        $zones = $this->budget_common_model->get_zone_by_access($division_id);

        foreach($zones as $zone)
        {
            $data[] = array('value'=>$zone['zone_id'], 'text'=>$zone['zone_name']);
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#zone","html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }

    public function get_territory_by_access()
    {
        $zone_id = $this->input->post('zone_id');

        $territories = $this->budget_common_model->get_territory_by_access($zone_id);

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

    public function get_dropDown_type_by_crop()
    {
        $crop_id = $this->input->post('crop_id');
        $current_id = $this->input->post('current_id');

        $types = $this->budget_common_model->get_type_by_crop($crop_id);

        foreach($types as $type)
        {
            $data[] = array('value'=>$type['product_type_id'], 'text'=>$type['product_type']);
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>'#type'.$current_id,"html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }

    public function get_variety_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');

        $varieties = $this->budget_common_model->get_variety_by_crop_type($crop_id, $type_id);

        foreach($varieties as $variety)
        {
            $data[] = array('value'=>$variety['varriety_id'], 'text'=>$variety['varriety_name']);
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>'#variety',"html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }

}
