<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Minimum_stock_alert_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function check_min_stock_existence()
    {
        $this->db->select('bms.*');
        $this->db->from('budget_min_stock_quantity bms');
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

    public function get_sales_target_detail($customer_id, $year_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');

        $this->db->where('bst.customer_id', $customer_id);
        $this->db->where('bst.year', $year_id);
        $this->db->where('bst.status',$this->config->item('status_active'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'left');
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

    public function get_existing_sales_targets($customer, $year)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->where('bst.year',$year);
        $this->db->where('bst.customer_id',$customer);
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }
}