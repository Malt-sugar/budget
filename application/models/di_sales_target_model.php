<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Di_sales_target_model extends CI_Model
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

    public function check_division_variety_existence($year, $variety)
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity budgeted_quantity');
        $this->db->where('bst.division_id', $user_division);
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('length(bst.zone_id)<2');
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

    public function get_division_variety_id($year, $variety)
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.id');
        $this->db->where('bst.division_id', $user_division);
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('length(bst.zone_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function check_notification_existence($year)
    {
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        $this->db->from('budget_sales_target_notification bstn');
        $this->db->select('bstn.id');
        $this->db->where('bstn.receiving_division', $user_division);
        $this->db->where('bstn.receiving_zone', null);
        $this->db->where('bstn.year', $year);
        $this->db->where('bstn.direction', $this->config->item('direction_up'));
        $this->db->where('bstn.is_action_taken', 0);
        $this->db->where('bstn.status', $this->config->item('status_active'));
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

    public function check_notification_existence_for_hom($year)
    {
        $this->db->from('budget_sales_target_notification bstn');
        $this->db->select('bstn.id');
        $this->db->where('bstn.receiving_division', null);
        $this->db->where('bstn.receiving_zone', null);
        $this->db->where('bstn.year', $year);
        $this->db->where('bstn.direction', $this->config->item('direction_up'));
        $this->db->where('bstn.is_action_taken', 0);
        $this->db->where('bstn.status', $this->config->item('status_active'));
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

    public function check_di_budgeting_time_existence($year)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity budgeted_quantity');
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('length(bst.zone_id)<2');
        $this->db->where('length(bst.division_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->result_array();

        if(sizeof($result)>0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}