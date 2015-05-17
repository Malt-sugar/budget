<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Sales_prediction_setup extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("sales_prediction_setup_model");
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

        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        $data['title']="Sales Prediction Setup";
        $ajax['page_url']=base_url()."sales_prediction_setup/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("sales_prediction_setup/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
    {
//        print_r($this->input->post());
//        exit;

        $user = User_helper::get_user();
        $data = Array();
        $year = $this->input->post('year');
        $crop_type_Post = $this->input->post('target');
        $detail_post = $this->input->post('detail');

        foreach($crop_type_Post as $cropTypeKey=>$crop_type)
        {
            foreach($detail_post as $profitKey=>$details)
            {
                if($profitKey==$cropTypeKey)
                {
                    $data['year'] = $year;
                    $data['crop_id'] = $crop_type['crop'];
                    $data['type_id'] = $crop_type['type'];

                    foreach($details as $variety_id=>$detail_type)
                    {
                        $data['variety_id'] = $variety_id;

                        foreach($detail_type as $type=>$amount)
                        {
                            $data[$type] = $amount;
                        }

                        print_r($data);
                    }
                }
            }
        }

        exit;

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START



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
        if(Validation_helper::validate_empty($this->input->post('year')))
        {
            $valid=false;
            $this->message.="Year Cann't Be Empty<br>";
        }

        if(Validation_helper::validate_empty($this->input->post('customer')))
        {
            $valid=false;
            $this->message.="Customer Name Cann't Be Empty<br>";
        }

        if(Validation_helper::validate_empty($this->input->post('crop')))
        {
            $valid=false;
            $this->message.="Crop Cann't Be Empty<br>";
        }

        if(Validation_helper::validate_empty($this->input->post('type')))
        {
            $valid=false;
            $this->message.="Type Cann't Be Empty<br>";
        }

        return $valid;
    }


    public function get_dropDown_variety_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->sales_prediction_setup_model->get_variety_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial']=$current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("sales_prediction_setup/variety_list",$data,true));
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
