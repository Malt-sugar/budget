<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Sales_target_edit extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("sales_target_edit_model");
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
        $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status = 0'));
        $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0'));
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0'));
        $data['customers'] = Query_helper::get_info('ait_distributor_info',array('distributor_id value','distributor_name text'),array('del_status = 0'));

        $data['varieties'] = $this->sales_target_edit_model->get_variety_info();
        $data['title']="Sales Target Edit";
        $ajax['page_url']=base_url()."sales_target_edit/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("sales_target_edit/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();
        $time = time();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->lang->line('NO_VALID_INPUT');
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $packPost = $this->input->post('pack');

            // Initial Update
            $this->sales_target_edit_model->packing_material_initial_update();

            foreach($packPost as $variety_id=>$detail)
            {
                $data['packing_material'] = 1;
                $data['modified_by'] = $user->user_id;
                $data['modification_date'] = $time;

                if($this->sales_target_edit_model->check_variety_existence($variety_id))
                {
                    Query_helper::update('budget_sales_target_edit',$data,array("variety_id ='$variety_id'"));
                }
                else
                {
                    $variety_data = $this->sales_target_edit_model->get_variety_detail($variety_id);
                    $insert_data['crop_id'] = $variety_data['crop_id'];
                    $insert_data['product_type_id'] = $variety_data['product_type_id'];
                    $insert_data['variety_id'] = $variety_data['varriety_id'];
                    $insert_data['variety_name'] = $variety_data['varriety_name'];
                    $insert_data['packing_material'] = 1;
                    $insert_data['modified_by'] = $user->user_id;
                    $insert_data['modification_date'] = $time;

                    Query_helper::add('budget_sales_target_edit',$insert_data);
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $ajax['status'] = true;
                $ajax['message']=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status'] = true;
                $ajax['message']=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
                $this->jsonReturn($ajax);
            }

            $this->budget_add_edit();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $packPost = $this->input->post('pack');
        $validation = array();

        foreach($packPost as $variety_id=>$detail)
        {
            if($detail==1)
            {
                $validation[] = $detail;
            }
        }

        if(sizeof($validation)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
