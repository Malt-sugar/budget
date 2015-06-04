<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_sales_target_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_sales_target_info($year, $division, $zone, $territory, $customer)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('adi.distributor_name distributor_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');

        if(strlen($year)>1)
        {
            $this->db->where('bst.year', $year);
        }
        if(strlen($division)>1)
        {
            $this->db->where('bst.division_id', $division);
        }
        if(strlen($zone)>1)
        {
            $this->db->where('bst.zone_id', $zone);
        }
        if(strlen($territory)>1)
        {
            $this->db->where('bst.territory_id', $territory);
        }
        if(strlen($customer)>1)
        {
            $this->db->where('bst.customer_id', $customer);
        }

        $this->db->join('ait_distributor_info adi', 'adi.distributor_id = bst.customer_id', 'left');
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bst.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bst.type_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'left');
        $this->db->where('bst.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return $result;
    }

}