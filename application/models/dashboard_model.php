<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tasks($module_id)
    {
        $user=User_helper::get_user();
        $this->db->select('bt.id,bt.name,bt.controller,bt.icon');
        $this->db->from("budget_task bt");
        $this->db->join('budget_user_group_role bugr','bt.id = bugr.task_id','INNER');
        $this->db->where("bt.parent",$module_id);
        $this->db->where("bugr.view",1);
        $this->db->where("bugr.user_group_id",$user->budget_group);
        $this->db->order_by('bt.ordering');
        $result=$this->db->get()->result_array();
        return $result;
    }

}