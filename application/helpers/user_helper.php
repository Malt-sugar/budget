<?php

class User_helper
{
    public static $logged_user = null;
    function __construct($id)
    {
        $CI = & get_instance();
        $user = $CI->db->get_where('ait_user_login', array('user_id' => $id))->row();
        if ($user)
        {
            foreach ($user as $key => $value)
            {
                $this->$key = $value;
            }
        }
    }

    public static function login($username, $password)
    {
        $CI = & get_instance();
        $user = $CI->db->get_where('ait_user_login', array('user_name' => $username, 'user_pass' => md5(md5($password))))->row();
        if ($user)
        {
            $CI->session->set_userdata("user_id", $user->user_id);
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public static function get_user()
    {
        $CI = & get_instance();
        if (User_helper::$logged_user) {
            return User_helper::$logged_user;
        }
        else
        {
            if($CI->session->userdata("user_id")!="")
            {
                User_helper::$logged_user = new User_helper($CI->session->userdata('user_id'));
                return User_helper::$logged_user;
            }
            else
            {
                return null;
            }
        }
    }

    public static function check_edit_permission($created_by)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $logged_user_level = $user->budget_group;

        $CI->db->from('ait_user_login aul');
        $CI->db->select('aul.budget_group');
        $CI->db->where('aul.user_id', "$created_by");
        $result = $CI->db->get()->row_array();

        if($logged_user_level > $result['budget_group'])
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_edit_permission_after_discard($discard, $discarded_by)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $logged_user_level = $user->budget_group;

        $CI->db->from('ait_user_login aul');
        $CI->db->select('aul.budget_group');
        $CI->db->where('aul.user_id', "$discarded_by");
        $result = $CI->db->get()->row_array();

        if($discard==1 && $logged_user_level > $result['budget_group'])
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function check_edit_permission_after_approval($zi_approval, $di_approval, $hom_approval)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $logged_user_level = $user->budget_group;

        if($zi_approval==1 && $di_approval==0 && $hom_approval==0 && $logged_user_level <= $CI->config->item('user_group_zone'))
        {
            return true;
        }
        elseif($zi_approval==1 && $di_approval==1 && $hom_approval==0 &&  $logged_user_level <= $CI->config->item('user_group_division'))
        {
            return true;
        }
        elseif($zi_approval==1 && $di_approval==1 && $hom_approval==1 && $logged_user_level <= $CI->config->item('user_group_marketing'))
        {
            return true;
        }
        elseif($zi_approval==0 && $di_approval==0 && $hom_approval==1 && $logged_user_level <= $CI->config->item('user_group_marketing'))
        {
            return true;
        }
        elseif($zi_approval==0 && $di_approval==1 && $hom_approval==1 && $logged_user_level <= $CI->config->item('user_group_marketing'))
        {
            return true;
        }
        elseif($zi_approval==1 && $di_approval==0 && $hom_approval==1 && $logged_user_level <= $CI->config->item('user_group_marketing'))
        {
            return true;
        }
        elseif($zi_approval==0 && $di_approval==1 && $hom_approval==0 && $logged_user_level < $CI->config->item('user_group_division'))
        {
            return true;
        }
        elseif($zi_approval==0 && $di_approval==0 && $hom_approval==0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}