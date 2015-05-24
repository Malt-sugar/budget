<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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

    public function get_purchase_detail()
    {
        $this->db->from('budget_purchase bp');
        $this->db->select('bp.*');
        $this->db->select('avi.varriety_name variety_name');

        $this->db->where('bp.status',$this->config->item('status_active'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_minimum_stocks()
    {
        $this->db->from('budget_min_stock_quantity bms');
        $this->db->select('bms.*');
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }
}