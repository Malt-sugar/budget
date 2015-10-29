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

    public function get_variety_sales_target_info($type, $year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity, bst.bottom_up_remarks');

        $this->db->where('bst.crop_id', $crop_id);
        $this->db->where('bst.type_id', $type_id);
        $this->db->where('bst.variety_id', $variety_id);
        $this->db->where('bst.year', $year);

        if($type == 1)
        {
            $this->db->where('length(bst.customer_id)<2');
            $this->db->where('length(bst.territory_id)<2');
            $this->db->where('length(bst.zone_id)<2');
            $this->db->where('length(bst.division_id)>2');
        }
        elseif($type == 2)
        {
            $this->db->where('length(bst.customer_id)<2');
            $this->db->where('length(bst.territory_id)<2');
            $this->db->where('length(bst.zone_id)>2');
            $this->db->where('length(bst.division_id)>2');
        }
        elseif($type == 3)
        {
            $this->db->where('length(bst.customer_id)<2');
            $this->db->where('length(bst.territory_id)>2');
            $this->db->where('length(bst.zone_id)>2');
            $this->db->where('length(bst.division_id)>2');
        }
        elseif($type == 4)
        {
            $this->db->where('length(bst.customer_id)>2');
            $this->db->where('length(bst.territory_id)>2');
            $this->db->where('length(bst.zone_id)>2');
            $this->db->where('length(bst.division_id)>2');
        }

        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result;
    }
}