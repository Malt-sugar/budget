<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Zi_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("zi_sales_target_model");
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

        $data['title']="ZI Sales Target";
        $ajax['page_url']=base_url()."zi_sales_target/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("zi_sales_target/add_edit",$data,true));

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
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $year = $this->input->post('year');
            $varietyPost = $this->input->post('variety');
            $data['year'] = $year;
            $data['division_id'] = $user->division_id;
            $data['zone_id'] = $user->zone_id;

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
                            if($this->zi_sales_target_model->check_zone_variety_existence($year, $variety_id))
                            {
                                $id = $this->zi_sales_target_model->get_zone_variety_id($year, $variety_id);
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
        $valid=true;
        return $valid;
    }

    public function get_variety_detail()
    {
        $user = User_helper::get_user();
        $year_id = $this->input->post('year_id');
        $user_zone = $user->zone_id;

        $data['year'] = $year_id;
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array("zone_id ='$user_zone'",'del_status =0'));
        $data['varieties'] = $this->zi_sales_target_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("zi_sales_target/variety",$data,true));
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
