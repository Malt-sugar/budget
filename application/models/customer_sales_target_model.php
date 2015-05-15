<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_sales_target_model extends CI_Model
{

    public function __construct() {
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



}