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

    public function load_view($view_name,$data=null,$display=false)
    {
        $file=BASEPATH.'/'.$view_name.'.php';
        $view='/'.$view_name;

        if (file_exists($file))
        {
            $view='/'.$view_name;

        }

        return $this->load->view($view,$data,$display);
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

    public function dashboard_page($module_id,$message="")
    {
        $ajax['status']=true;
        $this->load->model("root_model");
        $data['modules']=$this->root_model->get_modules();
        if($module_id)
        {
            $this->load->model("dashboard_model");
            $data['tasks']=$this->dashboard_model->get_tasks($module_id);
        }
        else
        {
            $data['tasks']=array();
        }
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
