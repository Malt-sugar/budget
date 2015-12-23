<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Di_sales_target_prediction extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("di_sales_target_prediction_model");
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
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();
        $data['varieties'] = $this->budget_common_model->get_ordered_varieties();

        $data['title']="DI Sales Target Prediction";
        $ajax['page_url']=base_url()."di_sales_target_prediction/index/add";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("di_sales_target_prediction/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        if(!$this->check_validation())
        {
            $ajax['status'] = false;
            $ajax['message'] = $this->lang->line("NO_VALID_INPUT");
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $prediction_data = array();
            $prediction_post = $this->input->post('prediction');
            foreach($prediction_post as $crop_id=>$predictionTypeVariety)
            {
                foreach($predictionTypeVariety as $type_id=>$predictionVariety)
                {
                    foreach($predictionVariety as $variety_id=>$YearDetail)
                    {
                        foreach($YearDetail as $year=>$quantity)
                        {
                            $prediction_data['year'] = $year;
                            $prediction_data['prediction_year'] = $this->input->post('year');
                            $prediction_data['division_id'] = $user_division;
                            $prediction_data['crop_id'] = $crop_id;
                            $prediction_data['type_id'] = $type_id;
                            $prediction_data['variety_id'] = $variety_id;
                            $prediction_data['budgeted_quantity'] = $quantity;

                            if($quantity>0)
                            {
                                $prediction_existing_id = $this->di_sales_target_prediction_model->get_di_sales_target_existence($year, $this->input->post('year'), $variety_id);
                                if(isset($prediction_existing_id) && $prediction_existing_id>0)
                                {
                                    $prediction_data['modified_by'] = $user->user_id;
                                    $prediction_data['modification_date'] = time();
                                    Query_helper::update('budget_sales_target_prediction',$prediction_data,array('id ='.$prediction_existing_id));
                                }
                                else
                                {
                                    $prediction_data['created_by'] = $user->user_id;
                                    $prediction_data['creation_date'] = time();
                                    Query_helper::add('budget_sales_target_prediction',$prediction_data);
                                }
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
        return true;
    }

    public function get_variety_detail()
    {
        $user = User_helper::get_user();
        $year = $this->input->post('year');
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $user_zone = $user->zone_id;
        $data['prediction_years'] = $this->di_sales_target_prediction_model->get_prediction_years($year);

        $data['year'] = $year;
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array("zone_id ='$user_zone'",'del_status =0'));
        $data['varieties'] = $this->di_sales_target_prediction_model->get_varieties_by_crop_type($crop_id, $type_id);

        if(isset($data['year']) && sizeof($data['varieties'])>0)
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity',"html"=>$this->load->view("di_sales_target_prediction/variety",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety_quantity',"html"=>"","",true);
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
