<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_sales_quantity_target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sales_quantity_target_info($year, $from_month, $to_month, $division, $zone, $territory, $district, $customer, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bstm.month selling_month');
        $this->db->select('bpq.final_targeted_quantity final_target');
        $this->db->select('bsp.mrp unit_price_per_kg');
        $this->db->select('SUM(bst.budgeted_quantity) target_from_customer');
        $this->db->where('bst.status',$this->config->item('status_active'));

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
        if($district>0)
        {
            $this->db->where('bst.zilla_id', $district);
        }
        if(strlen($customer)>1)
        {
            $this->db->where('bst.customer_id', $customer);
        }
        if(strlen($from_month)>0 && strlen($to_month)>0)
        {
            $this->db->where('bstm.month >=', $from_month);
            $this->db->where('bstm.month <=', $to_month);
        }

        $this->db->where('bsp.pricing_type', $this->config->item('pricing_type_final'));
        $this->db->where('length(bstm.territory_id)>2');

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bst.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bst.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'LEFT');
        $this->db->join('budget_sales_target_monthwise bstm', 'bstm.sales_target_id = bst.id', 'INNER');
        $this->db->join('budget_principal_quantity bpq', 'bpq.variety_id = bst.variety_id AND bpq.year = bst.year', 'LEFT');
        $this->db->join('budget_sales_pricing bsp', 'bsp.variety_id = bst.variety_id AND bsp.year = bst.year', 'LEFT');
        $results = $this->db->get()->result_array();

        foreach($results as $key=>&$result)
        {
            if(!($result['target_from_customer']>0))
            {
                unset($results[$key]);
            }
        }
        return array_values($results);
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