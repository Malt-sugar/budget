<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_purchase_years()
    {
        $this->db->select('bp.*');
        $this->db->from('budget_purchase bp');
        $this->db->group_by('bp.year');
        $this->db->where('bp.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_purchase_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_purchase bp');
        $this->db->select('bp.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bp.year', 'left');

        $this->db->group_by('bp.year');
        $this->db->where('bp.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bp.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_budget_purchase_existence()
    {
        $this->db->select('bp.*');
        $this->db->from('budget_purchase bp');
        $this->db->where('bp.purchase_type',$this->config->item('purchase_type_budget'));
        $results = $this->db->get()->result_array();
        if($results)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_purchase_detail($year)
    {
        $this->db->from('budget_purchase bp');
        $this->db->select('bp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bp.year', $year);
        $this->db->where('bp.status',$this->config->item('status_active'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_varieties($year)
    {
        $this->db->from('budget_purchase bp');
        $this->db->select('bp.*');
        $this->db->where('bp.year', $year);
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function get_budget_setup_id()
    {
        $this->db->select('bps.id');
        $this->db->from('budget_purchase_setup bps');
        $this->db->where('bps.purchase_type',$this->config->item('purchase_type_budget'));
        $result = $this->db->get()->row_array();
        return $result['id'];
    }
}