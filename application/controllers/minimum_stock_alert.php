<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Minimum_stock_alert extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("minimum_stock_alert_model");
    }

    public function index($task="add",$id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->rnd_add_edit($id);
        }
        elseif($task=="save")
        {
            $this->rnd_save();
        }
        else
        {
            $this->rnd_add_edit($id);
        }
    }

    public function rnd_add_edit()
    {
        $user = User_helper::get_user();

        $data['crops'] = Query_helper::get_info('ait_crop_info',array('crop_id value','crop_name text'),array('del_status = 0'));
        $data['types'] = Query_helper::get_info('ait_product_type',array('product_type_id value','product_type text'),array('del_status = 0'));

        $data['title']="Minimum Stock Quantity";
        $ajax['page_url']=base_url()."minimum_stock_alert/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("minimum_stock_alert/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
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

            $this->rnd_add_edit();//this is similar like redirect
        }

    }

    private function check_validation()
    {
        $valid=true;
        return $valid;
    }

    public function get_variety_for_min_stock_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->minimum_stock_alert_model->get_variety_for_min_stock_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("minimum_stock_alert/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>"","",true);
            $this->jsonReturn($ajax);
        }
    }

}
