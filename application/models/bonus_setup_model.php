<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bonus_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_total_years()
    {
        $this->db->select('bics.*');
        $this->db->from('budget_bonus_setup bics');
        $this->db->group_by('bics.year');
        $this->db->where('bics.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_bonus_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_bonus_setup bics');
        $this->db->select('bics.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bics.year', 'left');

        $this->db->group_by('bics.year');
        $this->db->where('bics.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bics.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_varieties()
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->select('avi.crop_id');
        $this->db->select('avi.product_type_id');
        $this->db->select('avi.varriety_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);
        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_bonus_variety_id($year, $variety_id)
    {
        $this->db->select('bbs.id');
        $this->db->from('budget_bonus_setup bbs');
        $this->db->where('bbs.year', $year);
        $this->db->where('bbs.variety_id', $variety_id);
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function get_bonus_detail($id)
    {
        $this->db->select('bics.*');
        $this->db->from('budget_bonus_setup bics');
        $this->db->where('bics.year', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_setup_year_existence($year_id, $year)
    {
        $this->db->select('budget_bonus_setup.*');
        $this->db->from('budget_bonus_setup');
        $this->db->where('year', $year);
        $this->db->where('status',$this->config->item('status_active'));
        $result = $this->db->get()->row_array();

        if(is_array($result) && sizeof($result)>0)
        {
            if(strlen($year_id)>1)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

}