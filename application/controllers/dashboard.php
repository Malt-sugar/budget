<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Dashboard extends ROOT_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("dashboard_model");
    }

    public function get_sub_menu()
    {
        $module_id=$this->input->post("menu_id");
        $data['tasks']=$this->dashboard_model->get_tasks($module_id);

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#sub-menu","html"=>$this->load->view("sub_menu",$data,true));

        $this->jsonReturn($ajax);

    }

}
