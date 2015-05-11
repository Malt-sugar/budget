<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class ROOT_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            $user=User_helper::get_user();
            if(!$user)
            {
                if($this->router->class!="home")
                {
                    $this->login_page("Time out");
                }
            }
        }
        else
        {
            echo $this->load->view("main",'',true);
            die();
        }
    }
    public function jsonReturn($array)
    {
        header('Content-type: application/json');
        echo json_encode($array);
        exit();
    }
    public function login_page($message="")
    {
        $ajax['status']=true;
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("login","",true));
        $ajax['content'][]=array("id"=>"#right_side","html"=>$this->load->view("login_right","",true));
        $ajax['content'][]=array("id"=>"#user_info","html"=>"");
        if($message)
        {
            $ajax['message']=$message;
        }
        $ajax['page_url']=base_url()."home/login";
        $this->jsonReturn($ajax);
    }
    public function dashboard_page($message="")
    {
        $ajax['status']=true;
        $this->load->model("root_model");
        $data['modules']=$this->root_model->get_modules();
        $ajax['content'][]=array("id"=>"#content","html"=>$this->load->view("dashboard",$data,true));
        $ajax['content'][]=array("id"=>"#user_info","html"=>$this->load->view("user_info","",true));
        $ajax['content'][]=array("id"=>"#right_side","html"=>$this->load->view("dashboard_right","",true));
        if($message)
        {
            $ajax['message']=$message;
        }
        $ajax['page_url']=base_url()."home";
        $this->jsonReturn($ajax);
    }
}
