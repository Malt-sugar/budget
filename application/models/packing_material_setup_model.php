<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Packing_material_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_variety_info()
    {
        $user = User_helper::get_user();
        $this->db->select('avi.varriety_id, avi.varriety_name');
        $this->db->select('aci.crop_name, aci.order_crop');
        $this->db->select('apt.product_type, apt.order_type');
        $this->db->select('avi.crop_id, avi.product_type_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");
        $this->db->join("budget_packing_material_setup bpms","bpms.variety_id = avi.varriety_id","LEFT");

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function packing_material_initial_update()
    {
        $data = array('packing_material'=>0);
        $this->db->update('budget_packing_material_setup',$data);
    }

    public function check_variety_existence($variety)
    {
        $this->db->from('budget_packing_material_setup bpms');
        $this->db->select('bpms.*');
        $this->db->where('bpms.variety_id', $variety);
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

    public function get_variety_detail($variety)
    {
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.*');
        $this->db->where('avi.varriety_id', $variety);
        $result = $this->db->get()->row_array();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
}