<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Zi_monthwise_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("zi_monthwise_sales_target_model");
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
        $user_zone = $user->zone_id;
        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0', "zone_id = '$user_zone'"));

        $data['title']="ZI Monthwise Sales Target";
        $ajax['page_url']=base_url()."zi_monthwise_sales_target/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("zi_monthwise_sales_target/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;
        $user_zone = $user->zone_id;
        $user_territory = $user->territory_id;
        $data = array();
        $time = time();
        $varietyPost = $this->input->post('variety');
        $salesPost = $this->input->post('sales_id');
        $year = $this->input->post('year');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->lang->line("NO_VALID_INPUT");
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($varietyPost as $variety_id=>$monthWise)
            {
                $data['year'] = $year;
                $data['variety_id'] = $variety_id;
                $variety_info = $this->zi_monthwise_sales_target_model->get_variety_detail($variety_id);
                $data['crop_id'] = $variety_info['crop_id'];
                $data['type_id'] = $variety_info['product_type_id'];
                $data['division_id'] = $user_division;
                $data['zone_id'] = $user_zone;
                $data['territory_id'] = $user_territory;

                foreach($monthWise as $month=>$targets)
                {
                    $data['month'] = $month;
                    foreach($targets as $attribute=>$target)
                    {
                        $data[$attribute] = $target;
                    }

                    foreach($salesPost as $salesVariety=>$sales_id)
                    {
                        if($salesVariety == $variety_id)
                        {
                            $data['sales_target_id'] = $sales_id;
                        }
                    }

                    // Initial Update
                    $this->zi_monthwise_sales_target_model->monthwise_target_initial_update($year, $month, $variety_id);

                    if($data['target']>0)
                    {
                        $existing_id = $this->zi_monthwise_sales_target_model->check_monthwise_target_existence($year, $month, $variety_id);
                        if(isset($existing_id) && $existing_id>0)
                        {
                            $data['modified_by'] = $user->user_id;
                            $data['modification_date'] = $time;
                            $data['status'] = 1;
                            Query_helper::update('budget_sales_target_monthwise',$data,array("id ='$existing_id'"));
                        }
                        else
                        {
                            $data['created_by'] = $user->user_id;
                            $data['creation_date'] = $time;
                            Query_helper::add('budget_sales_target_monthwise',$data);
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

            $this->budget_add_edit();   //this is similar like redirect
        }
    }

    private function check_validation()
    {
        $varietyPost = $this->input->post('variety');
        $validation = array();

        foreach($varietyPost as $variety_id=>$monthWise)
        {
            foreach($monthWise as $month=>$targets)
            {
                foreach($targets as $attribute=>$target)
                {
                    $data[$attribute] = $target;
                }

                if($data['target']>0)
                {
                    $validation[] = $data['target'];
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
        $type = $this->input->post('type');
        $territory = $this->input->post('territory');
        $data['year'] = $year_id;
        $data['type'] = $type;
        $data['territory'] = $territory;
        $data['varieties'] = $this->zi_monthwise_sales_target_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("zi_monthwise_sales_target/variety",$data,true));
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
