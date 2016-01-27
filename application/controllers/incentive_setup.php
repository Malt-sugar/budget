<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Incentive_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("incentive_setup_model");
    }

    public function index($task="list",$id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($id);
        }
        elseif($task=="list")
        {
            $this->budget_list();
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_list();
        }
    }

    public function budget_list($page=0)
    {
        $config = System_helper::pagination_config(base_url() . "incentive_setup/index/list/",$this->incentive_setup_model->get_total_incentive_setups(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['setups'] = $this->incentive_setup_model->get_setup_info($page);
        $data['title']="Incentive Setup List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("incentive_setup/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."incentive_setup/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        if($id>0)
        {
            $data['title']="Edit Incentive Setup";
            $data["details"] = $this->incentive_setup_model->get_incentive_data($id);
            $ajax['page_url']=base_url()."incentive_setup/index/edit";
        }
        else
        {
            $data['title']="Incentive Setup";
            $data["purchase"] = Array();
            $ajax['page_url']=base_url()."incentive_setup/index/add";
        }

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("incentive_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $id = $this->input->post('setup_id');

        $data = array();
        $detail_data = array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            if($id>0)
            {
                $this->db->trans_start();  //DB Transaction Handle START

                $data['year'] = $this->input->post('year');
                $data['from_month'] = $this->input->post('from_month');
                $data['to_month'] = $this->input->post('to_month');
                $data['total'] = $this->input->post('total');
                $data['modified_by'] = $user->user_id;
                $data['modification_date'] = time();
                Query_helper::update('budget_incentive_setup',$data,array("id = ".$id));

                // Incentive detail table operation
                $lower_limit_post = $this->input->post('lower_limit');
                $upper_limit_post = $this->input->post('upper_limit');
                $achievement_post = $this->input->post('achievement');

                // initial update
                $this->incentive_setup_model->initial_update_incentive_detail($id);

                for($i=0; $i<sizeof($lower_limit_post); $i++)
                {
                    $detail_data['setup_id'] = $id;
                    $detail_data['lower_limit'] = $lower_limit_post[$i];
                    $detail_data['upper_limit'] = $upper_limit_post[$i];
                    $detail_data['achievement'] = $achievement_post[$i];
                    $detail_data['created_by'] = $user->user_id;
                    $detail_data['creation_date'] = time();
                    Query_helper::add('budget_incentive_detail',$detail_data);
                }

                $this->db->trans_complete();   //DB Transaction Handle END

                if ($this->db->trans_status() === TRUE)
                {
                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
                }
                else
                {
                    $this->message=$this->lang->line("MSG_NOT_UPDATED_SUCCESS");
                }
            }
            else
            {
                $this->db->trans_start();  //DB Transaction Handle START

                $data['created_by'] = $user->user_id;
                $data['creation_date'] = time();

                $data['year'] = $this->input->post('year');
                $data['from_month'] = $this->input->post('from_month');
                $data['to_month'] = $this->input->post('to_month');
                $data['total'] = $this->input->post('total');
                $data['created_by'] = $user->user_id;
                $data['creation_date'] = time();
                $setup_id = Query_helper::add('budget_incentive_setup',$data);

                // Incentive detail table operation
                $lower_limit_post = $this->input->post('lower_limit');
                $upper_limit_post = $this->input->post('upper_limit');
                $achievement_post = $this->input->post('achievement');

                for($i=0; $i<sizeof($lower_limit_post); $i++)
                {
                    $detail_data['setup_id'] = $setup_id;
                    $detail_data['lower_limit'] = $lower_limit_post[$i];
                    $detail_data['upper_limit'] = $upper_limit_post[$i];
                    $detail_data['achievement'] = $achievement_post[$i];
                    $detail_data['created_by'] = $user->user_id;
                    $detail_data['creation_date'] = time();
                    Query_helper::add('budget_incentive_detail',$detail_data);
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
            }

            $this->budget_list();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $id = $this->input->post('setup_id');
        $year = $this->input->post('year');

        return true;
    }
}
