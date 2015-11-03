<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Bonus_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("bonus_setup_model");
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
        $config = System_helper::pagination_config(base_url() . "bonus_setup/index/list/",$this->bonus_setup_model->get_total_years(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['setups'] = $this->bonus_setup_model->get_bonus_year_info($page);
        $data['title']="Bonus Setup List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("bonus_setup/list",$data,true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."bonus_setup/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($id)
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));

        if(strlen($id)>1)
        {
            $data['year_id'] = $id;
            $data['varieties'] = $this->bonus_setup_model->get_varieties();
            $data['title'] = "Edit Bonus Setup";
            $ajax['page_url'] = base_url()."bonus_setup";
        }
        else
        {
            $data['year_id'] = 0;
            $data['varieties'] = $this->bonus_setup_model->get_varieties();
            $data['title'] = "Bonus Setup";
            $ajax['page_url'] = base_url()."bonus_setup";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("bonus_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $year_id = $this->input->post('year_id');
        $bonusPost = $this->input->post('bonus');
        $year = $this->input->post('year');
        $data = array();
        $data['year'] = $year;

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($bonusPost as $crop_id=>$varietyDetail)
            {
                $data['crop_id'] = $crop_id;
                foreach($varietyDetail as $type_id=>$varietyInfo)
                {
                    $data['type_id'] = $type_id;
                    foreach($varietyInfo as $variety_id=>$detail)
                    {
                        $data['variety_id'] = $variety_id;
                        foreach($detail as $key=>$value)
                        {
                            $data[$key] = $value;
                        }

                        if(strlen($year_id)>1)
                        {
                            $data['modified_by'] = $user->user_id;
                            $data['modification_date'] = time();
                            $update_id = $this->bonus_setup_model->get_bonus_variety_id($year, $variety_id);
                            Query_helper::update('budget_bonus_setup',$data,array("id ='$update_id'"));
                        }
                        else
                        {
                            $data['created_by'] = $user->user_id;
                            $data['creation_date'] = time();
                            Query_helper::add('budget_bonus_setup',$data);
                        }
                    }
                }
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

            $this->budget_list();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $year_id = $this->input->post('year_id');
        $year = $this->input->post('year');

        $year_existence = $this->bonus_setup_model->check_setup_year_existence($year_id, $year);

        if($year_existence)
        {
            $this->message=$this->lang->line("LABEL_BONUS_SETUP_DONE_ALREADY");
            return false;
        }

        return true;
    }

    public function get_variety_detail()
    {
        $year = $this->input->post('year');
        $data['year'] = $year;
        $data['varieties'] = $this->bonus_setup_model->get_varieties();

        if(isset($data['year']) && sizeof($data['varieties'])>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("bonus_setup/variety",$data,true));
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
