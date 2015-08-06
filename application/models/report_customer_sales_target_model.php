<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_customer_sales_target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sales_target_info($year, $division, $zone, $territory, $customer, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->where('bst.status',$this->config->item('status_active'));
        $this->db->group_by('bst.variety_id');

        $this->db->order_by('bst.crop_id');
        $this->db->order_by('bst.type_id');
        $this->db->order_by('bst.variety_id');

        //$this->db->where('bst.quantity >', 0);
        $this->db->where('bst.is_approved_by_hom', 1);

        if(strlen($year)>1)
        {
            $this->db->where('bst.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bst.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bst.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bst.variety_id', $variety_id);
        }
        if(strlen($division)>1)
        {
            $this->db->where('bst.division_id', $division);
        }
        if(strlen($zone)>1)
        {
            $this->db->where('bst.zone_id', $zone);
        }
        if(strlen($territory)>1)
        {
            $this->db->where('bst.territory_id', $territory);
        }
        if(strlen($customer)>1)
        {
            $this->db->where('bst.customer_id', $customer);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bst.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bst.type_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'left');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_customers($division, $zone, $territory, $customer)
    {
        $user = User_helper::get_user();

        if(strlen($zone)>1)
        {
            $this->db->where('adi.zone_id', $zone);
        }
        elseif($user->budget_group==$this->config->item('user_group_zone'))
        {
            $this->db->where('adi.zone_id', $user->zone_id);
        }
        else
        {
            if(strlen($division)>1)
            {
                $user_division = $division;
                $div_user_zones = $this->get_division_user_zones($user_division);

                $this->db->where("adi.zone_id IN(".$div_user_zones.")");
            }
            elseif($user->budget_group==$this->config->item('user_group_division'))
            {
                $user_division = $user->division_id;
                $div_user_zones = $this->get_division_user_zones($user_division);

                $this->db->where("adi.zone_id IN(".$div_user_zones.")");
            }
        }

        if(strlen($territory)>1)
        {
            $this->db->where('adi.territory_id', $territory);
        }
        elseif($user->budget_group==$this->config->item('user_group_territory'))
        {
            $this->db->where('adi.territory_id', $user->territory_id);
        }

        if(strlen($customer)>1)
        {
            $this->db->where('adi.distributor_id', $customer);
        }

        $this->db->from('ait_distributor_info adi');
        $this->db->select('adi.distributor_id, adi.distributor_name');
        $this->db->where('adi.status', 'Active');
        $customers = $this->db->get()->result_array();
        return $customers;
    }

    public function get_division_user_zones($user_division)
    {
        $this->db->from('ait_zone_info azi');
        $this->db->select('azi.*');
        $this->db->group_by('azi.zone_id');
        $this->db->where('azi.division_id', $user_division);
        $results = $this->db->get()->result_array();

        $zones=",";
        foreach($results as $result)
        {
            $zones.='"'.$result['zone_id'].'",';
        }

        return trim($zones,",");
    }

}