<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Budgeted_purchase_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("budgeted_purchase_setup_model");
    }

    public function index($task="add",$id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->rnd_add_edit();
        }
        elseif($task=="save")
        {
            $this->rnd_save();
        }
        else
        {
            $this->rnd_add_edit();
        }
    }

    public function rnd_add_edit()
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        $existence = $this->budgeted_purchase_setup_model->check_budget_purchase_setup();

        if($existence)
        {
            $data['title']="Edit Budgeted Purchase Setup";
            $data["purchase"] = $this->budgeted_purchase_setup_model->get_budget_purchase_data();

            $ajax['page_url']=base_url()."budgeted_purchase_setup/index/edit";
        }
        else
        {
            $data['title']="Budgeted Purchase Setup";
            $data["purchase"] = Array();

            $ajax['page_url']=base_url()."budgeted_purchase_setup/index/add";
        }

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("budgeted_purchase_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
    {
        $user = User_helper::get_user();

        $data = Array(
            'purchase_type'=>$this->config->item('purchase_type_budget'),
            'usd_conversion_rate'=>$this->input->post('usd_conversion_rate'),
            'lc_exp'=>$this->input->post('lc_exp'),
            'insurance_exp'=>$this->input->post('insurance_exp'),
            'packing_material'=>$this->input->post('packing_material'),
            'carriage_inwards'=>$this->input->post('carriage_inwards'),
            'air_freight_and_docs'=>$this->input->post('air_freight_and_docs')
        );

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $existence = $this->budgeted_purchase_setup_model->check_budget_purchase_setup();
            if($existence)
            {
                $this->db->trans_start();  //DB Transaction Handle START

                $data['modified_by'] = $user->user_id;
                $data['modification_date'] = time();

                Query_helper::update('budget_purchase_setup',$data,array("purchase_type = ".$this->config->item('purchase_type_budget')));

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

                Query_helper::add('budget_purchase_setup',$data);

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

            $this->rnd_add_edit();//this is similar like redirect
        }

    }

    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usd_conversion_rate',$this->lang->line('LABEL_USD_CONVERSION_RATE'),'required');
        $this->form_validation->set_rules('lc_exp',$this->lang->line('LABEL_LC_EXP'),'required');
        $this->form_validation->set_rules('insurance_exp',$this->lang->line('LABEL_INSURANCE_EXP'),'required');
        $this->form_validation->set_rules('packing_material',$this->lang->line('LABEL_PACKING_MATERIAL'),'required');
        $this->form_validation->set_rules('carriage_inwards',$this->lang->line('LABEL_CARRIAGE_INWARDS'),'required');
        $this->form_validation->set_rules('air_freight_and_docs',$this->lang->line('LABEL_AIR_FREIGHT_AND_DOCS'),'required');

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }


}
