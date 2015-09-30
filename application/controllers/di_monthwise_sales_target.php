<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Di_monthwise_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("di_monthwise_sales_target_model");
    }

    public function index($task="add",$id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($id);
        }
        else
        {
            $this->budget_add_edit($id);
        }
    }

    public function budget_add_edit()
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0', "division_id = '$user_division'"));

        $data['title']="DI Monthwise Sales Target";
        $ajax['page_url']=base_url()."di_monthwise_sales_target/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("di_monthwise_sales_target/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function get_variety_detail()
    {
        $user = User_helper::get_user();
        $year_id = $this->input->post('year_id');
        $type = $this->input->post('type');
        $zone = $this->input->post('zone');
        $data['year'] = $year_id;
        $data['type'] = $type;
        $data['zone'] = $zone;
        $data['varieties'] = $this->di_monthwise_sales_target_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("di_monthwise_sales_target/variety",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>"","",true);
            $this->jsonReturn($ajax);
        }
    }

}
