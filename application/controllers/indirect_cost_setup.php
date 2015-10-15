<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Indirect_cost_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("indirect_cost_setup_model");
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
        $config = System_helper::pagination_config(base_url() . "indirect_cost_setup/index/list/",$this->indirect_cost_setup_model->get_total_years(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['purchases'] = $this->indirect_cost_setup_model->get_indirect_cost_year_info($page);
        $data['title']="Indirect Cost Setup List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("indirect_cost_setup/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."indirect_cost_setup/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        if($id>0)
        {
            $data['title']="Edit Indirect Cost Setup";
            $data["cost"] = $this->indirect_cost_setup_model->get_indirect_cost_detail($id);
            $ajax['page_url']=base_url()."indirect_cost_setup/index/edit";
        }
        else
        {
            $data['title']="Indirect Cost Setup";
            $data["purchase"] = Array();
            $ajax['page_url']=base_url()."indirect_cost_setup/index/add";
        }

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("indirect_cost_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $id = $this->input->post('setup_id');

        $data = Array(
            'year'=>$this->input->post('year'),
            'ho_and_gen_exp'=>$this->input->post('ho_and_gen_exp'),
            'marketing'=>$this->input->post('marketing'),
            'finance_cost'=>$this->input->post('finance_cost'),
            'target_profit'=>$this->input->post('target_profit'),
            'sales_commission'=>$this->input->post('sales_commission')
        );

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

                $data['modified_by'] = $user->user_id;
                $data['modification_date'] = time();

                Query_helper::update('budget_indirect_cost_setup',$data,array("id = ".$id));

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

                Query_helper::add('budget_indirect_cost_setup',$data);

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

        $year_existence = $this->indirect_cost_setup_model->check_setup_year_existence($id, $year);

        if($year_existence)
        {
            $this->message=$this->lang->line("LABEL_BUDGET_INDIRECT_COST_SET_ALREADY");
            return false;
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('ho_and_gen_exp',$this->lang->line('LABEL_HO_AND_GEN_EXP_PER'),'required');
            $this->form_validation->set_rules('marketing',$this->lang->line('LABEL_MARKETING_PER'),'required');
            $this->form_validation->set_rules('finance_cost',$this->lang->line('LABEL_FINANCE_COST_PER'),'required');
            $this->form_validation->set_rules('target_profit',$this->lang->line('LABEL_TARGET_PROFIT_PER'),'required');
            $this->form_validation->set_rules('sales_commission',$this->lang->line('LABEL_SALES_COMMISSION_PER'),'required');

            if($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                return false;
            }
        }

        return true;
    }
}
