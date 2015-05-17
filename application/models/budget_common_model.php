<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budget_common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_division_by_access()
    {
        $user = User_helper::get_user();
        $this->db->select('*');
        $this->db->from('ait_division_info');

        if($user->budget_group > $this->config->item('user_group_marketing'))
        {
            $this->db->where('division_id', $user->division_id);
        }

        $results = $this->db->get()->result_array();

        foreach($results as $result)
        {
            $divisions[]= array('value'=>$result['division_id'], 'text'=>$result['division_name']);
        }
        return $divisions;
    }

    public function get_zone_by_access($division_id)
    {
        $user = User_helper::get_user();
        $this->db->select('*');
        $this->db->from('ait_zone_info');

        if($user->budget_group > $this->config->item('user_group_division'))
        {
            $this->db->where('zone_id', $user->zone_id);
        }

        $this->db->where('division_id', $division_id);
        return $results = $this->db->get()->result_array();
    }

    public function get_territory_by_access($zone_id)
    {
        $user = User_helper::get_user();
        $this->db->select('*');
        $this->db->from('ait_territory_info');
        $this->db->where('zone_id',$zone_id);

        if($user->budget_group > $this->config->item('user_group_zone'))
        {
            $this->db->where('territory_id', $user->territory_id);
        }

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_customer_by_territory($zone_id, $territory_id)
    {
        $this->db->select('*');
        $this->db->from('ait_distributor_info');
        $this->db->where('zone_id',$zone_id);
        $this->db->where('territory_id',$territory_id);

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_type_by_crop($crop_id)
    {
        $this->db->select('*');
        $this->db->from('ait_product_type');
        $this->db->where('crop_id',$crop_id);

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_variety_by_crop_type($crop_id, $type_id, $year, $customer_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();

        if(is_array($results) && sizeof($results)>0)
        {
            foreach($results as &$result)
            {
                $this->db->from('budget_sales_target bst');
                $this->db->select('bst.quantity, bst.is_approved_by_zi');
                $this->db->where('bst.created_by',$user->user_id);
                $this->db->where('bst.year',$year);
                $this->db->where('bst.customer_id',$customer_id);
                $this->db->where('bst.variety_id', $result['varriety_id']);
                $this->db->where('bst.crop_id', $result['crop_id']);
                $this->db->where('bst.type_id', $result['product_type_id']);
                $sales = $this->db->get()->row_array();

                if($sales)
                {
                    $result['quantity'] = $sales['quantity'];
                    $result['is_approved_by_zi'] = $sales['is_approved_by_zi'];
                }
            }
        }

        return $results;
    }

    public function get_ordered_crops()
    {
        $this->db->select('aci.crop_id value, aci.crop_name text');
        $this->db->from('ait_crop_info aci');
        $this->db->order_by('aci.order_crop');
        $this->db->where('aci.del_status', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_ordered_crop_types()
    {
        $this->db->select('apt.product_type_id value, apt.product_type text');
        $this->db->from('ait_product_type apt');
        $this->db->order_by('apt.order_crop');
        $this->db->where('apt.del_status', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }
}