<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_existing_sales_targets($year, $crop, $type, $customer)
    {
        $user = User_helper::get_user();
        $this->db->select('bst.variety_id');
        $this->db->from('budget_sales_target bst');
        $this->db->where('bst.year',$year);
        $this->db->where('bst.crop_id',$crop);

        $query = $this->db->get();
        return $query->row_array();
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
}