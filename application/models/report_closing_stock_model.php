<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_closing_stock_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_closing_stock_info($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_min_stock_quantity bms');
        $this->db->select('bms.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('SUM(ppi.opening_balance) opening_balance');

        if(strlen($crop_id)>1)
        {
            $this->db->where('bms.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bms.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bms.variety_id', $variety_id);
        }

        $this->db->where('ppi.year_id', $year);

        $this->db->join('ait_product_purchase_info ppi', 'ppi.varriety_id = bms.variety_id', 'left');
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bms.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bms.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bms.type_id', 'left');
        $this->db->where('bms.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return $result;
    }

}