<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Indirect_cost_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_total_years()
    {
        $this->db->select('bics.*');
        $this->db->from('budget_indirect_cost_setup bics');
        $this->db->group_by('bics.year');
        $this->db->where('bics.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_indirect_cost_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_indirect_cost_setup bics');
        $this->db->select('bics.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bics.year', 'left');

        $this->db->group_by('bics.year');
        $this->db->where('bics.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bics.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_indirect_cost_detail($id)
    {
        $this->db->select('bics.*');
        $this->db->from('budget_indirect_cost_setup bics');
        $this->db->where('bics.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_setup_year_existence($id, $year)
    {
        $this->db->select('budget_indirect_cost_setup.*');
        $this->db->from('budget_indirect_cost_setup');

        $this->db->where('year', $year);
        $this->db->where('id !=', $id);
        $this->db->where('status',$this->config->item('status_active'));

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