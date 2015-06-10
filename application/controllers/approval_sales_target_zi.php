<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Approval_sales_target_zi extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("approval_sales_target_zi_model");
    }

    public function index($task="list", $id=0, $customer_id=0, $year_id=0)
    {
        if($task=="list")
        {
            $this->budget_list($id);
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->budget_add_edit($customer_id, $year_id);
        }
        elseif($task=="save")
        {
            $this->budget_save();
        }
        else
        {
            $this->budget_add_edit($customer_id, $year_id);
        }
    }

    public function budget_list($page=0)
    {
        $config = System_helper::pagination_config(base_url() . "approval_sales_target_zi/index/list/",$this->approval_sales_target_zi_model->get_total_customers(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['sales_targets'] = $this->approval_sales_target_zi_model->get_sales_target_info($page);
        $data['title']="ZI Sales Target Approval";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("approval_sales_target_zi/list",$data,true));
        if($this->message)
        {
            $ajax['message']=$this->message;
        }
        $ajax['page_url']=base_url()."approval_sales_target_zi/index/list/".($page+1);

        $this->jsonReturn($ajax);
    }

    public function budget_add_edit($customer_id, $year_id)
    {
        $user = User_helper::get_user();

        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['divisions'] = $this->budget_common_model->get_division_by_access();
        $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0'));
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0'));
        $data['customers'] = Query_helper::get_info('ait_distributor_info',array('distributor_id value','distributor_name text'),array('del_status = 0'));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        if(strlen($customer_id)>1 && strlen($year_id)>1)
        {
            $data['targets'] = $this->approval_sales_target_zi_model->get_sales_target_detail($customer_id, $year_id);
            $data['title'] = "ZI Sales Target Approval";
            $ajax['page_url']=base_url()."approval_sales_target_zi/index/edit/".$customer_id.'/'.$year_id;
        }
        else
        {
            $data['targets'] = array();
            $data['title'] = "Sales Target Approval";
            $ajax['page_url'] = base_url()."approval_sales_target_zi/index/add";
        }

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("approval_sales_target_zi/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function budget_save()
    {
        $user = User_helper::get_user();
        $data = Array();
        $record_data = array();

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
            $division = $this->input->post('division');
            $zone = $this->input->post('zone');
            $territory = $this->input->post('territory');
            $customer = $this->input->post('customer');

            $crop_type_Post = $this->input->post('target');
            $quantity_post = $this->input->post('quantity');

            if(strlen($this->input->post('customer_id'))>1 && strlen($this->input->post('year_id'))>1)
            {
                $customer_id = $this->input->post('customer_id');
                $year_id = $this->input->post('year_id');

                // Initial record update Record Data
                $record_status = array('status'=>0);
                Query_helper::update('budget_sales_target_record',$record_status,array("customer_id ='$customer_id'", "year ='$year_id'"));
                $existing_record_varieties = $this->approval_sales_target_zi_model->get_existing_sales_targets_records($this->input->post('customer_id'), $this->input->post('year_id'));

                // Initial update
                $update_status = array('status'=>0);
                Query_helper::update('budget_sales_target',$update_status,array("customer_id ='$customer_id'", "year ='$year_id'"));
                $existing_varieties = $this->approval_sales_target_zi_model->get_existing_sales_targets($this->input->post('customer_id'), $this->input->post('year_id'));

                foreach($crop_type_Post as $cropTypeKey=>$crop_type)
                {
                    foreach($quantity_post as $quantityKey=>$quantity)
                    {
                        if($quantityKey==$cropTypeKey)
                        {
                            $data['year'] = $year;
                            $data['division_id'] = $division;
                            $data['zone_id'] = $zone;
                            $data['territory_id'] = $territory;
                            $data['customer_id'] = $customer;
                            $data['crop_id'] = $crop_type['crop'];
                            $data['type_id'] = $crop_type['type'];

                            foreach($quantity as $variety_id=>$amount)
                            {
                                $data['variety_id'] = $variety_id;
                                $data['quantity'] = $amount;

                                // Start Record data
                                if($user->budget_group==$this->config->item('user_group_territory'))
                                {
                                    $record_data['quantity_ti'] = $amount;
                                }
                                else
                                {
                                    unset($record_data['quantity_ti']);
                                }

                                if($user->budget_group==$this->config->item('user_group_zone'))
                                {
                                    $record_data['quantity_zi'] = $amount;
                                }
                                else
                                {
                                    unset($record_data['quantity_zi']);
                                }

                                if($user->budget_group==$this->config->item('user_group_division'))
                                {
                                    $record_data['quantity_di'] = $amount;
                                }
                                else
                                {
                                    unset($record_data['quantity_di']);
                                }

                                if($user->budget_group==$this->config->item('user_group_marketing'))
                                {
                                    $record_data['quantity_hom'] = $amount;
                                }
                                else
                                {
                                    unset($record_data['quantity_hom']);
                                }

                                if(in_array($variety_id, $existing_record_varieties))
                                {
                                    $record_data['status'] = 1;
                                    $record_data['modified_by'] = $user->user_id;
                                    $record_data['modification_date'] = time();
                                    $crop_id = $data['crop_id'];
                                    $type_id = $data['type_id'];
                                    Query_helper::update('budget_sales_target_record',$record_data,array("customer_id ='$customer_id'", "year ='$year'", "crop_id ='$crop_id'", "type_id ='$type_id'", "variety_id ='$variety_id'"));
                                }
                                else
                                {
                                    $record_data['division_id'] = $division;
                                    $record_data['zone_id'] = $zone;
                                    $record_data['territory_id'] = $territory;
                                    $record_data['customer_id'] = $customer;
                                    $record_data['year'] = $year;
                                    $record_data['crop_id'] = $crop_type['crop'];
                                    $record_data['type_id'] = $crop_type['type'];
                                    $record_data['variety_id'] = $variety_id;

                                    $record_data['created_by'] = $user->user_id;
                                    $record_data['creation_date'] = time();

                                    Query_helper::add('budget_sales_target_record',$record_data);
                                }

                                // End Record data

                                if(in_array($variety_id, $existing_varieties))
                                {
                                    $existing_quantity = $this->budget_common_model->get_existing_quantity($year, $customer, $data['crop_id'], $data['type_id'], $variety_id);

                                    if($existing_quantity != $amount)
                                    {
                                        if($user->budget_group==$this->config->item('user_group_territory'))
                                        {
                                            $data['is_approved_by_zi'] = 0;
                                            $data['is_approved_by_di'] = 0;
                                            $data['is_approved_by_hom'] = 0;
                                        }
                                        elseif($user->budget_group==$this->config->item('user_group_zone'))
                                        {
                                            $data['is_approved_by_zi'] = 1;
                                            $data['is_approved_by_di'] = 0;
                                            $data['is_approved_by_hom'] = 0;
                                        }
                                        elseif($user->budget_group==$this->config->item('user_group_division'))
                                        {
                                            $data['is_approved_by_zi'] = 1;
                                            $data['is_approved_by_di'] = 1;
                                            $data['is_approved_by_hom'] = 0;
                                        }
                                        elseif($user->budget_group==$this->config->item('user_group_marketing'))
                                        {
                                            $data['is_approved_by_zi'] = 1;
                                            $data['is_approved_by_di'] = 1;
                                            $data['is_approved_by_hom'] = 1;
                                        }
                                    }
                                    else
                                    {
                                        unset($data['is_approved_by_zi']);
                                        unset($data['is_approved_by_di']);
                                        unset($data['is_approved_by_hom']);
                                    }

                                    if($amount==0 && $existing_quantity>0)
                                    {
                                        $data['discard'] = 1;
                                        $data['discarded_by'] = $user->user_id;
                                    }
                                    else
                                    {
                                        unset($data['discard']);
                                        unset($data['discarded_by']);
                                    }

                                    $data['modified_by'] = $user->user_id;
                                    $data['modification_date'] = time();
                                    $data['status'] = 1;
                                    $data['is_approved_by_zi'] = 1; // ZI Approval

                                    $crop_id = $data['crop_id'];
                                    $type_id = $data['type_id'];
                                    Query_helper::update('budget_sales_target',$data,array("customer_id ='$customer_id'", "year ='$year'", "crop_id ='$crop_id'", "type_id ='$type_id'", "variety_id ='$variety_id'"));
                                }
                                else
                                {
                                    $data['status'] = 1;
                                    $data['is_approved_by_zi'] = 1; // ZI Approval

                                    $data['created_by'] = $user->user_id;
                                    $data['creation_date'] = time();
                                    Query_helper::add('budget_sales_target',$data);
                                }
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

            $this->budget_list();//this is similar like redirect
        }
    }

    private function check_validation()
    {
        $valid=true;

        $crop_type_Post = $this->input->post('target');
        $quantity_post = $this->input->post('quantity');

        if(!$crop_type_Post || !$quantity_post)
        {
            $valid=false;
            $this->message .= $this->lang->line("SET_TARGET").'<br>';
        }

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

        return $valid;
    }

    public function get_varieties_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->approval_sales_target_zi_model->get_variety_by_crop_type($crop_id, $type_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("approval_sales_target/variety_list",$data,true));
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
