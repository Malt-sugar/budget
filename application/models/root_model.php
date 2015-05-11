<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Root_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_modules()
    {
        $user=User_helper::get_user();
        $this->db->select('module.id,module.name,module.icon');
        $this->db->select('COUNT(module.id) subcount');
        $this->db->from('budget_user_group_role bugr');
        $this->db->join('budget_task bt','bt.id = bugr.task_id','INNER');
        $this->db->join('budget_task module','module.id = bt.parent','INNER');
        $this->db->where('bugr.user_group_id',$user->budget_group);
        $this->db->where('bugr.view',1);
        $this->db->group_by('module.id');
        $this->db->order_by('module.ordering','ASC');
        $result=$this->db->get()->result_array();
        return $result;
    }

}