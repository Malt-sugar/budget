<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pricing_marketing_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_info($variety_id)
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.*');

        $this->db->where('avi.type', 0);
        $this->db->where('avi.varriety_id', $variety_id);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function check_sales_pricing_existence($year, $crop, $type, $variety)
    {
        $this->db->from('budget_sales_pricing bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.crop_id', $crop);
        $this->db->where('bsp.type_id', $type);
        $this->db->where('bsp.variety_id', $variety);
        $this->db->where('bsp.pricing_type', $this->config->item('pricing_type_marketing'));
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['id'];
        }
        else
        {
            return false;
        }
    }

//    public function confirmed_quantity_initial_update($year)
//    {
//        $data = array('status'=>0);
//        $this->db->where('year',$year);
//
//        $this->db->update('budget_purchase_quantity',$data);
//    }

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

}