<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_setup_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_budget_purchase_data()
    {
        $this->db->select('bps.*');
        $this->db->from('budget_purchase_setup bps');
        $this->db->where('bps.purchase_type',$this->config->item('purchase_type_budget'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_budget_purchase_setup()
    {
        $this->db->select('budget_purchase_setup.*');
        $this->db->from('budget_purchase_setup');
        $this->db->where('purchase_type',$this->config->item('purchase_type_budget'));
        $result = $this->db->get()->row_array();
        if(is_array($result) && sizeof($result)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}