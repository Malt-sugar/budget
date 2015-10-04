<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Direct_cost_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("direct_cost_setup_model");
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
        $config = System_helper::pagination_config(base_url() . "direct_cost_setup/index/list/",$this->direct_cost_setup_model->get_total_purchase_years(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['purchases'] = $this->direct_cost_setup_model->get_purchase_year_info($page);
        $data['title']="Direct Cost Setup List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("direct_cost_setup/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."direct_cost_setup/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        if($id>0)
        {
            $data['title']="Edit Direct Cost Setup";
            $data["purchase"] = $this->direct_cost_setup_model->get_budget_purchase_data($id);
            $ajax['page_url']=base_url()."direct_cost_setup/index/edit";
        }
        else
        {
            $data['title']="Direct Cost Setup";
            $data["purchase"] = Array();
            $ajax['page_url']=base_url()."direct_cost_setup/index/add";
        }

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("direct_cost_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $id = $this->input->post('setup_id');

        $data = Array(
            'year'=>$this->input->post('year'),
            'purchase_type'=>$this->config->item('purchase_type_budget'),
            'usd_conversion_rate'=>$this->input->post('usd_conversion_rate'),
            'lc_exp'=>$this->input->post('lc_exp'),
            'insurance_exp'=>$this->input->post('insurance_exp'),
            'packing_material'=>$this->input->post('packing_material'),
            'carriage_inwards'=>$this->input->post('carriage_inwards'),
            'air_freight_and_docs'=>$this->input->post('air_freight_and_docs'),
            'cnf'=>$this->input->post('cnf')
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

                Query_helper::update('budget_direct_cost',$data,array("id = ".$id));

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

                Query_helper::add('budget_direct_cost',$data);

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

        $year_existence = $this->direct_cost_setup_model->check_budget_purchase_year_existence($id, $year);

        if($year_existence)
        {
            $this->message=$this->lang->line("LABEL_BUDGET_DIRECT_COST_SET_ALREADY");
            return false;
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('usd_conversion_rate',$this->lang->line('LABEL_USD_CONVERSION_RATE'),'required');
            $this->form_validation->set_rules('lc_exp',$this->lang->line('LABEL_LC_EXP'),'required');
            $this->form_validation->set_rules('insurance_exp',$this->lang->line('LABEL_INSURANCE_EXP'),'required');
            $this->form_validation->set_rules('packing_material',$this->lang->line('LABEL_PACKING_MATERIAL'),'required');
            $this->form_validation->set_rules('carriage_inwards',$this->lang->line('LABEL_CARRIAGE_INWARDS'),'required');
            $this->form_validation->set_rules('air_freight_and_docs',$this->lang->line('LABEL_AIR_FREIGHT_AND_DOCS'),'required');
            $this->form_validation->set_rules('cnf',$this->lang->line('LABEL_CNF'),'required');

            if($this->form_validation->run() == FALSE)
            {
                $this->message=validation_errors();
                return false;
            }
        }

        return true;
    }
}
