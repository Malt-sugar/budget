<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Customer_sales_target extends ROOT_Controller
{
    private  $message;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->load->model("customer_sales_target_model");
    }

    public function index($task="list", $id=0, $customer_id=0, $year_id=0)
    {
        if($task=="list")
        {
            $this->rnd_list($id);
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->rnd_add_edit($customer_id, $year_id);
        }
        elseif($task=="save")
        {
            $this->rnd_save();
        }
        else
        {
            $this->rnd_add_edit($customer_id, $year_id);
        }
    }

    public function rnd_list($page=0)
    {
        $config = System_helper::pagination_config(base_url() . "customer_sales_target/index/list/",$this->customer_sales_target_model->get_total_customers(),4);
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();

        if($page>0)
        {
            $page=$page-1;
        }

        $data['sales_targets'] = $this->customer_sales_target_model->get_sales_target_info($page);
        $data['title']="Customer Sales Target List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("customer_sales_target/list",$data,true));
        if($this->message)
        {
            $ajax['message']=$this->message;
        }
        $ajax['page_url']=base_url()."customer_sales_target/index/list/".($page+1);

        $this->jsonReturn($ajax);
    }

    public function rnd_add_edit($id, $year_id)
    {
        $user = User_helper::get_user();

        $data['years'] = Query_helper::get_info('ait_year',array('year_id value','year_name text'),array('del_status = 0'));
        $data['divisions'] = $this->budget_common_model->get_division_by_access();
        $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0'));
        $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0'));
        $data['customers'] = Query_helper::get_info('ait_distributor_info',array('distributor_id value','distributor_name text'),array('del_status = 0',"zone_id ='$user->zone_id'","territory_id ='$user->territory_id'"));
        $data['crops'] = $this->budget_common_model->get_ordered_crops();
        $data['types'] = $this->budget_common_model->get_ordered_crop_types();

        $data['title'] = "Customer/ T. I. Sales target";
        $ajax['page_url'] = base_url()."customer_sales_target/index/add";

        $ajax['status'] = true;
        $ajax['content'][] = array("id"=>"#content","html"=>$this->load->view("customer_sales_target/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
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

            $year = $this->input->post('year');
            $division = $this->input->post('division');
            $zone = $this->input->post('zone');
            $territory = $this->input->post('territory');
            $customer = $this->input->post('customer');

            $crop_type_Post = $this->input->post('target');
            $quantity_post = $this->input->post('quantity');

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
                            $data['created_by'] = $user->user_id;
                            $data['creation_date'] = time();
                            Query_helper::add('budget_sales_target',$data);
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

            $this->rnd_add_edit();//this is similar like redirect
        }

    }

    private function check_validation()
    {
        $valid=true;

        return $valid;
    }

    public function get_dropDown_variety_by_crop_type()
    {
        $crop_id = $this->input->post('crop_id');
        $type_id = $this->input->post('type_id');
        $year = $this->input->post('year');
        $customer_id = $this->input->post('customer');
        $current_id = $this->input->post('current_id');

        $data['varieties'] = $this->customer_sales_target_model->get_variety_by_crop_type($crop_id, $type_id, $year, $customer_id);

        if(sizeof($data['varieties'])>0)
        {
            $data['serial'] = $current_id;
            $data['title'] = 'Variety List';
            $ajax['status'] = true;
            $ajax['content'][]=array("id"=>'#variety'.$current_id,"html"=>$this->load->view("customer_sales_target/variety_list",$data,true));
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
