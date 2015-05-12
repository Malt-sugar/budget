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

    public function index($task="list",$id=0)
    {
        if($task=="list")
        {
            $this->rnd_list($id);
        }
        elseif($task=="add" || $task=="edit")
        {
            $this->rnd_add_edit($id);
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

    public function rnd_list($page=0)
    {
//        $config = System_helper::pagination_config(base_url() . "customer_sales_target/index/list/",$this->customer_sales_target_model->get_total_types(),4);
//        $this->pagination->initialize($config);
//        $data["links"] = $this->pagination->create_links();
//
//        if($page>0)
//        {
//            $page=$page-1;
//        }
//
//        $data['typeInfo'] = $this->customer_sales_target_model->get_typeInfo($page);
//        $data['title']="Crop Type List";

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("customer_sales_target/list",'',true));

        if($this->message)
        {
            $ajax['message']=$this->message;
        }

        $ajax['page_url']=base_url()."customer_sales_target/index/list/".($page+1);
        $this->jsonReturn($ajax);
    }

    public function rnd_add_edit($id)
    {
        $user = User_helper::get_user();
        if ($id != 0)
        {
            $data['typeInfo'] = $this->customer_sales_target_model->get_type_row($id);
            $data['title']="Edit Crop Type (".$data['typeInfo']['crop_name'].'/ '.$data['typeInfo']['type_name'].")";
            $ajax['page_url']=base_url()."customer_sales_target/index/edit/".$id;
        }
        else
        {
            $data['divisions'] = Query_helper::get_info('ait_division_info',array('division_id value','division_name text'),array('del_status = 0'));
            $data['zones'] = Query_helper::get_info('ait_zone_info',array('zone_id value','zone_name text'),array('del_status = 0'));
            $data['territories'] = Query_helper::get_info('ait_territory_info',array('territory_id value','territory_name text'),array('del_status = 0'));
            $data['customers'] = Query_helper::get_info('ait_distributor_info',array('distributor_id value','distributor_name text'),array('del_status = 0',"zone_id ='$user->zone_id'","territory_id ='$user->territory_id'"));
            $data['crops'] = Query_helper::get_info('ait_crop_info',array('crop_id value','crop_name text'),array('del_status = 0'));
            $data['types'] = Query_helper::get_info('ait_product_type',array('product_type_id value','product_type text'),array('del_status = 0'));

            $data['title']="Customer/ T. I. Sales target";

            $ajax['page_url']=base_url()."customer_sales_target/index/add";
        }

        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("customer_sales_target/add_edit",$data,true));

        $this->jsonReturn($ajax);
    }

    public function rnd_save()
    {
        $id = $this->input->post("type_id");
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
            if($id>0)
            {
          //      $this->db->trans_start();  //DB Transaction Handle START

//                $data['modified_by'] = $user->user_id;
//                $data['modification_date'] = time();
//
//                Query_helper::update('rnd_crop_type',$data,array("id = ".$id));
//
//                $this->db->trans_complete();   //DB Transaction Handle END
//
//                if ($this->db->trans_status() === TRUE)
//                {
//                    $this->message=$this->lang->line("MSG_UPDATE_SUCCESS");
//                }
//                else
//                {
//                    $this->message=$this->lang->line("MSG_NOT_UPDATED_SUCCESS");
//                }
            }
            else
            {
                $this->db->trans_start();  //DB Transaction Handle START

                $data['division'] = $user->division_id;
                $data['zone'] = $user->zone_id;
                $data['territory'] = $user->territory_id;
                $data['customer'] = $this->input->post('customer');
                $data['year'] = $this->input->post('year');
                $data['crop'] = $this->input->post('crop');
                $data['type'] = $this->input->post('type');

                $data['create_by'] = $user->user_id;
                $data['create_date'] = time();

                $quantityPost = $this->input->post('quantity');

                foreach($quantityPost as $variety_id=>$quantity)
                {
                    $data['variety'] = $variety_id;
                    $data['quantity'] = $quantity;
                    Query_helper::add('budget_sales_target',$data);
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

            }

            $this->rnd_list();//this is similar like redirect
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


}
