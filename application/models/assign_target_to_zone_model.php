<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assign_target_to_zone_model extends CI_Model
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

    public function get_zone_row_id($year, $zone, $variety)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.id');
        $this->db->where('bst.zone_id', $zone);
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
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

    public function get_division_row_id($year, $variety)
    {
        $user = User_helper::get_user();
        $user_div = $user->division_id;
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.id');
        $this->db->where('bst.variety_id', $variety);
        $this->db->where('bst.year', $year);
        $this->db->where('bst.division_id', $user_div);
        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('length(bst.zone_id)<2');
        $this->db->where('bst.status', $this->config->item('status_active'));
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

    public function get_variety_crop_type($variety)
    {
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.crop_id, avi.product_type_id');
        $this->db->where('avi.varriety_id', $variety);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_assignment_type($id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.targeted_quantity');
        $this->db->where('bst.id', $id);
        $result = $this->db->get()->row_array();

        if(isset($result['targeted_quantity']) && $result['targeted_quantity']>0)
        {
            return $result['targeted_quantity'];
        }
        else
        {
            return false;
        }
    }

    public function get_old_notification_id($year, $zone, $variety)
    {
        $user = User_helper::get_user();
        $user_div = $user->division_id;
        $this->db->from('budget_sales_target_notification bstn');
        $this->db->select('bstn.id');

        $this->db->where('bstn.receiving_territory', null);
        $this->db->where('bstn.receiving_division', $user_div);
        $this->db->where('bstn.receiving_zone', $zone);
        $this->db->where('bstn.year', $year);
        $this->db->where('bstn.variety_id', $variety);
        //$this->db->where('bstn.is_action_taken', 0);
        $this->db->where('bstn.direction', $this->config->item('direction_down'));
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

    public function update_notification_table($year, $variety)
    {
        $user = User_helper::get_user();
        $user_div = $user->division_id;

        $data = array('is_action_taken'=>1);

        $this->db->where('receiving_territory', null);
        $this->db->where('receiving_zone', null);
        $this->db->where('receiving_division', $user_div);
        $this->db->where('year', $year);
        $this->db->where('variety_id', $variety);
        $this->db->where('is_action_taken', 0);

        $this->db->update('budget_sales_target_notification',$data);
    }

}