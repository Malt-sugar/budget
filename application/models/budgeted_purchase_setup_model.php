<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_total_purchase_years()
    {
        $this->db->select('bps.*');
        $this->db->from('budget_purchase_setup bps');
        $this->db->group_by('bps.year');
        $this->db->where('bps.purchase_type',$this->config->item('purchase_type_budget'));
        $this->db->where('bps.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_purchase_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_purchase_setup bps');
        $this->db->select('bps.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bps.year', 'left');

        $this->db->group_by('bps.year');
        $this->db->where('bps.purchase_type',$this->config->item('purchase_type_budget'));
        $this->db->where('bps.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bps.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_budget_purchase_data($id)
    {
        $this->db->select('bps.*');
        $this->db->from('budget_purchase_setup bps');
        $this->db->where('bps.id', $id);
        $this->db->where('bps.purchase_type', $this->config->item('purchase_type_budget'));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_budget_purchase_year_existence($id, $year)
    {
        $this->db->select('budget_purchase_setup.*');
        $this->db->from('budget_purchase_setup');

        $this->db->where('year', $year);
        $this->db->where('id !=', $id);

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