<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Home extends ROOT_Controller
{
	public function index()
	{
		$this->login();
	}

    public function login($module_id=0)
    {
        $user=User_helper::get_user();

        if($user)
        {
            $this->dashboard_page($module_id);
        }
        else
        {
            if($this->input->post())
            {
                if(User_helper::login($this->input->post("username"),$this->input->post("password")))
                {
                    $this->dashboard_page($module_id,$this->lang->line("MSG_LOGIN_SUCCESS"));
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['message']=$this->lang->line("MSG_USERNAME_PASSWORD_INVALID");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $this->login_page();
            }
        }
    }

    public function logout()
    {
        $this->session->set_userdata("user_id", "");
        $this->login_page($this->lang->line("MSG_LOGOUT_SUCCESS"));
    }
    public function sidebar()
    {
        $user=User_helper::get_user();
        $ajax['status']=true;

        if($user)
        {

            $ajax['content'][]=array("id"=>"#user_info","html"=>$this->load->view("user_info","",true));
            $ajax['content'][]=array("id"=>"#right_side","html"=>$this->load->view("dashboard_right","",true));
        }
        else
        {

            $ajax['content'][]=array("id"=>"#right_side","html"=>$this->load->view("login_right","",true));
            $ajax['content'][]=array("id"=>"#user_info","html"=>"");
        }
        $this->jsonReturn($ajax);
    }

}
