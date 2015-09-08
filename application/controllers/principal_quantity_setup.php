<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Principal_quantity_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("principal_quantity_setup_model");
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

        $data['title']="HOM Sales Target";
        $ajax['page_url']=base_url()."principal_quantity_setup/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("principal_quantity_setup/add_edit",$data,true));

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

            $year = $this->input->post('year');
            $varietyPost = $this->input->post('variety');
            $data['year'] = $year;

            foreach($varietyPost as $crop_id=>$varietyDetail)
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

                        $data['created_by'] = $user->user_id;
                        $data['creation_date'] = $time;

                        if($data['required_quantity']>0)
                        {
                            if($this->hom_sales_target_model->check_country_variety_existence($year, $variety_id))
                            {
                                $id = $this->hom_sales_target_model->get_country_variety_id($year, $variety_id);
                                Query_helper::update('budget_sales_target',$data,array("id ='$id'"));
                            }
                            else
                            {
                                Query_helper::add('budget_sales_target',$data);
                            }
                        }
                    }
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
        $varietyPost = $this->input->post('variety');
        $validation = array();

        foreach($varietyPost as $varietyDetail)
        {
            foreach($varietyDetail as $varietyInfo)
            {
                foreach($varietyInfo as $detail)
                {
                    foreach($detail as $key=>$value)
                    {
                        $data[$key] = $value;
                    }

                    if($data['required_quantity']>0)
                    {
                        $validation[] = $data['required_quantity'];
                    }
                }
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

    public function get_variety_detail()
    {
        $user = User_helper::get_user();
        $year_id = $this->input->post('year_id');

        $data['year'] = $year_id;
        $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status =0'));
        $data['varieties'] = $this->hom_sales_target_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("principal_quantity_setup/variety",$data,true));
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
