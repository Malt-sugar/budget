<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_customer_sales_target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_budgeted_purchase_info($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchase bp');
        $this->db->select('bp.*');
        $this->db->select('bst.quantity hom_target_quantity');
        $this->db->select('bps.usd_conversion_rate, bps.lc_exp, bps.insurance_exp, bps.packing_material, bps.carriage_inwards, bps.air_freight_and_docs');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->where('bp.purchase_type', $this->config->item('purchase_type_budget'));
        $this->db->where('bp.status',$this->config->item('status_active'));

        $this->db->where('bp.purchase_quantity >',0);
        $this->db->where('bst.quantity >',0);

        $this->db->where('bst.is_approved_by_zi', 1);
        $this->db->where('bst.is_approved_by_di', 1);
        $this->db->where('bst.is_approved_by_hom', 1);

        if(strlen($year)>1)
        {
            $this->db->where('bp.year', $year);
            $this->db->where('bst.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bp.variety_id', $variety_id);
        }

        $this->db->join('budget_sales_target bst', 'bst.year = bp.year AND bst.variety_id = bp.variety_id', 'left');
        $this->db->join('budget_purchase_setup bps', 'bps.purchase_type = bp.purchase_type', 'left');
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bp.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bp.type_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bp.year', 'left');
        $this->db->where('bps.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_customers()
    {
        $user = User_helper::get_user();

        $this->db->from('ait_distributor_info adi');
        $this->db->select('adi.*');

        if($user->budget_group==$this->config->item('user_group_division'))
        {
            $user_division = $user->division_id;
            $div_user_zones = $this->get_division_user_zones($user_division);
            $this->db->where_in('adi.zone_id', $div_user_zones);
        }
        elseif($user->budget_group==$this->config->item('user_group_zone'))
        {
            $this->db->where('adi.zone_id', $user->zone_id);
        }
        elseif($user->budget_group==$this->config->item('user_group_territory'))
        {
            $this->db->where('adi.territory_id', $user->territory_id);
        }
    }

    public function get_division_user_zones($user_division)
    {
        $this->db->from('ait_zone_info azi');
        $this->db->select('azi.*');
        $this->db->where('azi.division_id', $user_division);
        $results = $this->db->get()->result_array();

        foreach($results as $result)
        {
            $zones[] = $result['zone_id'];
        }

        return $zones;
    }

}