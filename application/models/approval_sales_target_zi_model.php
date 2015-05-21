<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Approval_sales_target_zi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_customers()
    {
        $user = User_helper::get_user();
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.customer_id, bst.year');
        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');

        $this->db->where('bst.is_approved_by_zi', 0);
        $this->db->where('bst.is_approved_by_di', 0);
        $this->db->where('bst.is_approved_by_hom', 0);

        $this->db->where('bst.status',$this->config->item('status_active'));

        if($user->budget_group > $this->config->item('user_group_marketing'))
        {
            $this->db->where('bst.division_id', $user->division_id);
        }

        if($user->budget_group > $this->config->item('user_group_division'))
        {
            $this->db->where('bst.zone_id', $user->zone_id);
        }

        if($user->budget_group > $this->config->item('user_group_zone'))
        {
            $this->db->where('bst.territory_id', $user->territory_id);
        }

        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_sales_target_info($page=null)
    {
        $user = User_helper::get_user();
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('ati.territory_name');
        $this->db->select('adi.distributor_name');
        $this->db->select('ay.year_name');

        $this->db->where('bst.is_approved_by_zi', 0);
        $this->db->where('bst.is_approved_by_di', 0);
        $this->db->where('bst.is_approved_by_hom', 0);

        $this->db->join('ait_territory_info ati', 'ati.territory_id = bst.territory_id', 'left');
        $this->db->join('ait_distributor_info adi', 'adi.distributor_id = bst.customer_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'left');

        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');

        if($user->budget_group > $this->config->item('user_group_marketing'))
        {
            $this->db->where('bst.division_id', $user->division_id);
        }

        if($user->budget_group > $this->config->item('user_group_division'))
        {
            $this->db->where('bst.zone_id', $user->zone_id);
        }

        if($user->budget_group > $this->config->item('user_group_zone'))
        {
            $this->db->where('bst.territory_id', $user->territory_id);
        }

        $this->db->where('bst.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bst.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sales_target_detail($customer_id, $year_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');

        $this->db->where('bst.customer_id', $customer_id);
        $this->db->where('bst.year', $year_id);
        $this->db->where('bst.status',$this->config->item('status_active'));

        $this->db->where('bst.is_approved_by_zi', 0);
        $this->db->where('bst.is_approved_by_di', 0);
        $this->db->where('bst.is_approved_by_hom', 0);

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_sales_targets($customer, $year)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->where('bst.year',$year);
        $this->db->where('bst.customer_id',$customer);
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }
}