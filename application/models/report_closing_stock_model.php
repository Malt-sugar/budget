<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_closing_stock_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_closing_stock_info($crop_id, $type_id, $variety_id)
    {
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.*');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('bmsq.min_stock_quantity min_stock_quantity');

        if(strlen($crop_id)>1)
        {
            $this->db->where('avi.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('avi.product_type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('avi.varriety_id', $variety_id);
        }

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('ati.order_type');
        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $this->db->where('avi.status', 'Active');

        $this->db->join('budget_min_stock_quantity bmsq', 'bmsq.variety_id = avi.varriety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = avi.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = avi.product_type_id', 'left');
        $result = $this->db->get()->result_array();
        //echo $this->db->last_query();
        return $result;
    }

}