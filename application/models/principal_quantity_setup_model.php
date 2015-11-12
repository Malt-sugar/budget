<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal_quantity_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_variety_info()
    {
        $this->db->select('avi.varriety_id, avi.varriety_name');
        $this->db->select('aci.crop_name, aci.order_crop');
        $this->db->select('apt.product_type, apt.order_type');
        $this->db->select('avi.crop_id, avi.product_type_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function check_principal_quantity_existence($year, $variety)
    {
        $this->db->from('budget_principal_quantity bpq');
        $this->db->select('bpq.*');

        $this->db->where('bpq.variety_id', $variety);
        $this->db->where('bpq.year', $year);

        $this->db->where('bpq.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_principal_quantity_id($year, $variety)
    {
        $this->db->from('budget_principal_quantity bpq');
        $this->db->select('bpq.id');
        $this->db->where('bpq.variety_id', $variety);
        $this->db->where('bpq.year', $year);

        $this->db->where('bpq.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function get_existing_principal_quantity($year, $variety)
    {
        $this->db->from('budget_principal_quantity bpq');
        $this->db->select('bpq.*');
        $this->db->where('bpq.variety_id', $variety);
        $this->db->where('bpq.year', $year);

        $this->db->where('bpq.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_varieties_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->select('avi.crop_id');
        $this->db->select('avi.product_type_id');
        $this->db->select('avi.varriety_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);

        if(isset($crop_id) && strlen($crop_id)>1)
        {
            $this->db->where('avi.crop_id', $crop_id);
        }

        if(isset($type_id) && strlen($type_id)>1)
        {
            $this->db->where('avi.product_type_id', $type_id);
        }

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_budget_min_stock_quantity($crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_min_stock_quantity bms');
        $this->db->select('bms.min_stock_quantity');
        $this->db->where('bms.crop_id', $crop_id);
        $this->db->where('bms.type_id', $type_id);
        $this->db->where('bms.variety_id', $variety_id);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['min_stock_quantity'];
        }
        else
        {
            return null;
        }
    }
}