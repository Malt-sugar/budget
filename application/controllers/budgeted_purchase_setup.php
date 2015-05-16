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
            $this->rnd_list($id);
        }
    }

    public function rnd_add_edit()
    {
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['title']="Budgeted Purchase Setup";
        $data["typeInfo"] = Array();

        $ajax['page_url']=base_url()."budgeted_purchase_setup/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("budgeted_purchase_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
    {
        $id = $this->input->post("type_id");
        $user = User_helper::get_user();

        $data = Array(
            'terget_length'=>$this->input->post('target_length'),
            'terget_weight'=>$this->input->post('target_weight'),
            'terget_yeild'=>$this->input->post('target_yield'),
            'expected_seed_per_gram'=>$this->input->post('expected_seed_per_gram')
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

                Query_helper::update('rnd_crop_type',$data,array("id = ".$id));

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

                $data['crop_id'] = $this->input->post('crop_id');
                $data['type_name'] = $this->input->post('type_name');
                $data['type_code'] = $this->input->post('type_code');
                $data['created_by'] = $user->user_id;
                $data['creation_date'] = time();

                Query_helper::add('rnd_crop_type',$data);

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

            $this->rnd_list();//this is similar like redirect
        }

    }

    private function check_validation()
    {
        $valid=true;
        if(Validation_helper::validate_empty($this->input->post('crop_id')))
        {
            $valid=false;
            $this->message.="Crop Name Cann't Be Empty<br>";
        }

        if(Validation_helper::validate_empty($this->input->post('type_name')))
        {
            $valid=false;
            $this->message.="Type Name Cann't Be Empty<br>";
        }
        elseif($this->create_type_model->check_type_name_existence($this->input->post('type_name'),$this->input->post('crop_id'),$this->input->post('type_id')))
        {
            $valid=false;
            $this->message.="Type Name Exists<br>";
        }

        if(Validation_helper::validate_empty($this->input->post('type_code')))
        {
            $valid=false;
            $this->message.="Type Code Cann't Be Empty<br>";
        }
        elseif($this->create_type_model->check_type_code_existence($this->input->post('type_code'),$this->input->post('crop_id'),$this->input->post('type_id')))
        {
            $valid=false;
            $this->message.="Type Code Exists<br>";
        }



        return $valid;
    }


}
