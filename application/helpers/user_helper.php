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

        $CI->db->from('ait_user_login bst');
        $CI->db->select('bst.budget_group');
        $CI->db->where('user_id', "$created_by");
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
}