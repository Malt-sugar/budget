<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_target_edit_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_sales_target_info($type, $year, $crop_id, $type_id, $variety_id, $division, $zone, $territory, $customer)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity, bst.bottom_up_remarks');

        $this->db->where('bst.crop_id', $crop_id);
        $this->db->where('bst.type_id', $type_id);
        $this->db->where('bst.variety_id', $variety_id);
        $this->db->where('bst.year', $year);

        if($type == 1)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('length(territory_id)<2');
            $this->db->where('length(zone_id)<2');
            $this->db->where('division_id', $division);
        }
        elseif($type == 2)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('length(territory_id)<2');
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }
        elseif($type == 3)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('territory_id', $territory);
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }
        elseif($type == 4)
        {
            $this->db->where('customer_id', $customer);
            $this->db->where('territory_id', $territory);
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }

        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function update_sales_target($edit_type, $year, $division, $zone, $territory, $customer, $crop_id, $type_id, $variety_id, $budgeted_quantity, $bottom_up_remarks)
    {
        $this->db->where('crop_id', $crop_id);
        $this->db->where('type_id', $type_id);
        $this->db->where('variety_id', $variety_id);
        $this->db->where('year', $year);

        if($edit_type == 1)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('length(territory_id)<2');
            $this->db->where('length(zone_id)<2');
            $this->db->where('division_id', $division);
        }
        elseif($edit_type == 2)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('length(territory_id)<2');
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }
        elseif($edit_type == 3)
        {
            $this->db->where('length(customer_id)<2');
            $this->db->where('territory_id', $territory);
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }
        elseif($edit_type == 4)
        {
            $this->db->where('customer_id', $customer);
            $this->db->where('territory_id', $territory);
            $this->db->where('zone_id', $zone);
            $this->db->where('division_id', $division);
        }

        //$this->db->where('status', $this->config->item('status_active'));

        $update_data = array('budgeted_quantity'=>$budgeted_quantity, 'bottom_up_remarks'=>$bottom_up_remarks);
        $this->db->update('budget_sales_target', $update_data);
    }
}