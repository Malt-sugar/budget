<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Minimum_stock_alert extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("minimum_stock_alert_model");
    }

    public function index($task="add", $id=0)
    {
        if($task=="add" || $task=="edit")
        {
            $this->budget_add_edit();
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_add_edit();
        }
    }

    public function budget_add_edit()
    {
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        $stock_existence = $this->minimum_stock_alert_model->check_min_stock_existence();

        if($stock_existence)
        {
            $data['stocks'] = $this->minimum_stock_alert_model->get_minimum_stock_detail();
            $data['title'] = "Edit Minimum Stock Alert";
            $ajax['page_url']=base_url()."minimum_stock_alert/index/edit/";
        }
        else
        {
            $data['stocks'] = array();
            $data['title'] = "Minimum Stock Alert";
            $ajax['page_url'] = base_url()."minimum_stock_alert/index/add";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("minimum_stock_alert/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();

        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $this->db->trans_start();  //DB Transaction Handle START

            $crop_type_Post = $this->input->post('stock');
            $quantity_post = $this->input->post('quantity');

            $stock_existence = $this->minimum_stock_alert_model->check_min_stock_existence();

            if($stock_existence)
            {
                // Initial update
                $update_status = array('status'=>0);
                Query_helper::update('budget_min_stock_quantity',$update_status,array());
                $existing_varieties = $this->minimum_stock_alert_model->get_existing_minimum_stocks();

                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($quantity_post as $quantityKey=>$quantity)
                    {
                        if($quantityKey==$cropTypeKey)
                        {
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($quantity as $variety_id=>$amount)
                            {
                                $data['variety_id'] = $variety_id;
                                $data['min_stock_quantity'] = $amount;

                                if(in_array($variety_id, $existing_varieties))
                                {
                                    $data['modified_by'] = $user->user_id;
                                    $data['modification_date'] = time();
                                    $data['status'] = 1;
                                    $crop_id = $data['crop_id'];
                                    $type_id = $data['type_id'];
                                    Query_helper::update('budget_min_stock_quantity',$data,array("crop_id ='$crop_id'", "type_id ='$type_id'", "variety_id ='$variety_id'"));
                                }
                                else
                                {
                                    $data['created_by'] = $user->user_id;
                                    $data['creation_date'] = time();
                                    Query_helper::add('budget_min_stock_quantity',$data);
                                }
                            }
                        }
                    }
                }
            }
            else
            {
                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($quantity_post as $quantityKey=>$quantity)
                    {
                        if($quantityKey==$cropTypeKey)
                        {
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($quantity as $variety_id=>$amount)
                            {
                                $data['variety_id'] = $variety_id;
                                $data['min_stock_quantity'] = $amount;
                                $data['created_by'] = $user->user_id;
                                $data['creation_date'] = time();
                                Query_helper::add('budget_min_stock_quantity',$data);
                            }
                        }
                    }
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END

            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_CREATE_SUCCESS");
            }
            else
            {
                $this->message=$this->lang->line("MSG_NOT_SAVED_SUCCESS");
            }

            $this->budget_add_edit();//this is similar like redirect
        }

    }

    private function check_validation()
    {
        $valid=true;

        $crop_type_Post = $this->input->post('stock');

        if(is_array($crop_type_Post) && sizeof($crop_type_Post)>0)
        {
            foreach($crop_type_Post as $crop_type)
            {
                $crop_type_array[] = array('crop'=>$crop_type['crop'], 'type'=>$crop_type['type']);
            }

            $new_arr = array_unique($crop_type_array, SORT_REGULAR);

            if($crop_type_array != $new_arr)
            {
                $valid=false;
                $this->message .= $this->lang->line("DUPLICATE_CROP_TYPE").'<br>';
            }
        }

        $quantity_post = $this->input->post('quantity');

        if(!$crop_type_Post || !$quantity_post)
        {
            $valid=false;
            $this->message .= $this->lang->line("SET_MIN_STOCK").'<br>';
        }

        return $valid;
    }

    public function get_varieties_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->minimum_stock_alert_model->get_variety_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("minimum_stock_alert/variety_list",$data,true));
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>"<label class='label label-danger'>".$this->lang->line('NO_VARIETY_EXIST')."</label>","",true);
            $this->jsonReturn($ajax);
        }
    }

}
