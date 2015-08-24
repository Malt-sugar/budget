<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Zi_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("zi_sales_target_model");
    }

    public function index($task="add",$id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($id);
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_add_edit($id);
        }
    }

    public function budget_add_edit()
    {
        $user = User_helper::get_user();
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        $data['title']="ZI Sales Target";
        $ajax['page_url']=base_url()."zi_sales_target/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("zi_sales_target/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    /*
    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $data['crop_id'] = $this->input->post('crop');
            $data['type_id'] = $this->input->post('type');

            $data['create_by'] = $user->user_id;
            $data['create_date'] = time();

            $quantityPost = $this->input->post('quantity');
            $existings = $this->customer_sales_target_model->get_existing_sales_targets($data['year'], $data['crop_id'], $data['type_id'], $data['customer_id']);

            foreach($quantityPost as $variety_id=>$quantity)
            {
                $data['variety'] = $variety_id;
                $data['quantity'] = $quantity;
                Query_helper::add('budget_sales_target',$data);
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
            }
            else
            {
                $this->message=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
            }

            $this->budget_add_edit();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $valid=true;
        return $valid;
    }
    */

    public function get_variety_detail()
    {
        $user = User_helper::get_user();
        $year_id = $this->input->post('year_id');
        $user_zone = $user->zone_id;

        $data['year'] = $year_id;
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array("zone_id ='$user_zone'",'del_status =0'));
        $data['varieties'] = $this->zi_sales_target_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("zi_sales_target/variety",$data,true));
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
