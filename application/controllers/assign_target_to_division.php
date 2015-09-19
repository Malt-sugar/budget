<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Assign_target_to_division extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("assign_target_to_division_model");
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
        $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status = 0'));
        $data['varieties'] = $this->assign_target_to_division_model->get_variety_info();

        $data['title']="Assign Target To Division";
        $ajax['page_url']=base_url()."assign_target_to_division/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("assign_target_to_division/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $varietyPost = $this->input->post('variety');
        $varietyDetailPost = $this->input->post('detail');
        $data = array();
        $detailData = array();
        $notificationData = array();
        $notificationData['direction'] = $this->config->item('direction_down');
        $year = $this->input->post('year');

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            foreach($varietyPost as $division=>$varietyDetail)
            {
                $data['division_id'] = $division;
                foreach($varietyDetail as $variety=>$detail)
                {
                    $data['variety_id'] = $variety;

                    if(isset($detail) && is_array($detail) && sizeof($detail)>0)
                    {
                        foreach($detail as $key=>$val)
                        {
                            $data[$key] = $val;
                        }

                        if($data['targeted_quantity']>0)
                        {
                            $row_id = $this->assign_target_to_division->get_division_row_id($year, $division, $variety);
                            if(isset($row_id) && $row_id>0)
                            {
                                Query_helper::update('budget_sales_target',$data,array("id ='$row_id'"));
                            }

                            $varietyInfo = $this->assign_target_to_division->get_variety_crop_type($variety);
                            $notificationData['variety_id'] = $variety;
                            $notificationData['crop_id'] = $varietyInfo['crop_id'];
                            $notificationData['product_type_id'] = $varietyInfo['type_id'];
                            $notificationData['receiving_division'] = $division;
                            $notificationData['created_by'] = $user->user_id;
                            $notificationData['creation_date'] = time();

                            Query_helper::add('budget_sales_target_notification', $notificationData);
                        }
                    }
                }
            }

            foreach($varietyDetailPost as $detailVariety=>$varietyDetail)
            {
                $detailData['variety_id'] = $detailVariety;
                foreach($varietyDetail as $detailKey=>$detailVal)
                {
                    $detailData[$detailKey] = $detailVal;
                }

                if($detailData['targeted_quantity']>0)
                {
                    $id = $this->assign_target_to_division->get_country_row_id($year, $detailVariety);
                    if(isset($id) && $id>0)
                    {
                        Query_helper::update('budget_sales_target',$detailData,array("id ='$id'"));
                    }
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $ajax['status']=false;
                $ajax['message']=$this->lang->line("MSG_CREATE_SUCCESS");
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=false;
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
        $year_id = $this->input->post('year_id');

        $data['year'] = $year_id;
        $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status = 0'));
        $data['varieties'] = $this->assign_target_to_division_model->get_variety_info();

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("assign_target_to_division/variety",$data,true));
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
