<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Assign_target_to_territory extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("assign_target_to_territory_model");
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
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0', 'zone_id = "'.$user_zone.'"'));
        $data['title']="Assign Target To Territory";
        $ajax['page_url']=base_url()."assign_target_to_territory/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("assign_target_to_territory/add_edit",$data,true));

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

            foreach($varietyPost as $territory=>$varietyDetail)
            {
                $data['territory_id'] = $territory;
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
                            $row_id = $this->assign_target_to_territory_model->get_territory_row_id($year, $territory, $variety);

                            $old_target = $this->assign_target_to_territory_model->get_assignment_type($row_id);

                            if($old_target>0 && $data['targeted_quantity'] != $old_target)
                            {
                                $notificationData['is_action_taken'] = 0;
                                $notificationData['assignment_type'] = $this->config->item('assign_type_old');
                            }
                            else
                            {
                                $notificationData['is_action_taken'] = 1;
                                $notificationData['assignment_type'] = $this->config->item('assign_type_new');
                            }

                            if(isset($row_id) && $row_id>0)
                            {
                                Query_helper::update('budget_sales_target',$data,array("id ='$row_id'"));
                                // Update Notification Action Taken Field
                                $this->assign_target_to_territory_model->update_notification_table($year, $variety);
                            }

                            $varietyInfo = $this->assign_target_to_territory_model->get_variety_crop_type($variety);
                            $notificationData['year'] = $year;
                            $notificationData['variety_id'] = $variety;
                            $notificationData['crop_id'] = $varietyInfo['crop_id'];
                            $notificationData['type_id'] = $varietyInfo['product_type_id'];
                            $notificationData['sending_division'] = $user->division_id;
                            $notificationData['sending_zone'] = $user->zone_id;
                            $notificationData['receiving_division'] = $user->division_id;
                            $notificationData['receiving_zone'] = $user->zone_id;
                            $notificationData['receiving_territory'] = $territory;
                            $notificationData['created_by'] = $user->user_id;
                            $notificationData['creation_date'] = time();

                            $old_notification_id = $this->assign_target_to_territory_model->get_old_notification_id($year, $territory, $variety);

                            if(isset($old_notification_id) && $old_notification_id>0)
                            {
                                //unset($notificationData['assignment_type']);
                                Query_helper::update('budget_sales_target_notification',$notificationData,array("id ='$old_notification_id'"));
                            }
                            else
                            {
                                $notificationData['is_action_taken'] = 0;
                                Query_helper::add('budget_sales_target_notification', $notificationData);
                            }
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
                    $id = $this->assign_target_to_territory_model->get_zone_row_id($year, $detailVariety);
                    if(isset($id) && $id>0)
                    {
                        Query_helper::update('budget_sales_target',$detailData,array("id ='$id'"));
                    }
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if($this->db->trans_status() === TRUE)
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

            $this->budget_add_edit(); //this is similar like redirect
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
        $user_zone = $user->zone_id;
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $year_id = $this->input->post('year');

        $data['year'] = $year_id;
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0', 'zone_id = "'.$user_zone.'"'));
        $data['varieties'] = $this->assign_target_to_territory_model->get_variety_info($crop_id, $type_id);

        if(strlen($year_id)>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>$this->load->view("assign_target_to_territory/variety",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#load_variety',"html"=>"","",true);
            $this->jsonReturn($ajax);
        }
    }

    public function get_dropDown_type_by_crop()
    {
        $crop_id = $this->input->post('crop_id');
        $types = $this->budget_common_model->get_type_by_crop($crop_id);

        $data = array();
        if(is_array($types) && sizeof($types)>0)
        {
            foreach($types as $type)
            {
                $data[] = array('value'=>$type['product_type_id'], 'text'=>$type['product_type']);
            }
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>'#type_select',"html"=>$this->load->view("dropdown",array('drop_down_options'=>$data),true));
        $this->jsonReturn($ajax);
    }
}
