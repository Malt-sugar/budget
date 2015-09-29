<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zi_monthwise_sales_target_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_variety_info()
    {
        $user = User_helper::get_user();
        $this->db->select('avi.varriety_id, avi.varriety_name');
        $this->db->select('avi.crop_id, avi.product_type_id');

        $this->db->select('aci.crop_name, aci.order_crop');
        $this->db->select('apt.product_type, apt.order_type');
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

    public function check_territory_variety_existence($year, $variety)
    {
        $user = User_helper::get_user();
        $user_territory = $user->territory_id;

        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity budgeted_quantity');
        $this->db->where('bst.territory_id', $user_territory);
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
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

    public function get_territory_variety_id($year, $variety)
    {
        $user = User_helper::get_user();
        $user_territory = $user->territory_id;

        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.id');
        $this->db->where('bst.territory_id', $user_territory);
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function get_variety_detail($variety)
    {
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.*');
        $this->db->where('avi.varriety_id', $variety);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function check_monthwise_target_existence($year, $month, $variety_id)
    {
        $this->db->from('budget_sales_target_monthwise bstm');
        $this->db->select('bstm.id');
        $this->db->where('bstm.year', $year);
        $this->db->where('bstm.month', $month);
        $this->db->where('bstm.variety_id', $variety_id);
        //$this->db->where('bst.status', $this->config->item('status_active'));
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

    public function monthwise_target_initial_update($year, $month, $variety_id)
    {
        $data = array('status'=>0);
        $this->db->where('year',$year);
        $this->db->where('month',$month);
        $this->db->where('variety_id',$variety_id);

        $this->db->update('budget_sales_target_monthwise',$data);
    }
}