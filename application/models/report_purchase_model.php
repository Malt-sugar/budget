<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_budget_purchase_info($year, $from_month, $to_month, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchase_months bpm');
        $this->db->select('bpm.year, bpm.crop_id, bpm.type_id, bpm.variety_id, bpm.month, bpm.quantity');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bpq.confirmed_quantity final_quantity');
        $this->db->select('bpq.pi_value pi_value');
        $this->db->select('bdc.usd_conversion_rate, bdc.lc_exp, bdc.insurance_exp, bdc.packing_material, bdc.carriage_inwards, bdc.air_freight_and_docs, bdc.cnf, bdc.bank_other_charges, bdc.ait, bdc.miscellaneous');
        $this->db->where('bpm.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bpm.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bpm.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bpm.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bpm.variety_id', $variety_id);
        }
        if(strlen($from_month)>0 && strlen($to_month)>0)
        {
            $this->db->where('bpm.month >=', $from_month);
            $this->db->where('bpm.month <=', $to_month);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bpm.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bpm.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bpm.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bpm.year', 'LEFT');
        $this->db->join('budget_direct_cost bdc', 'bdc.year = bpm.year', 'LEFT');
        $this->db->join('budget_purchase_quantity bpq', 'bpq.year = bpm.year AND bpq.variety_id = bpm.variety_id', 'LEFT');
        $results = $this->db->get()->result_array();

        return $results;
    }

    public function get_actual_purchase_info($year, $from_month, $to_month, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchases bp');
        $this->db->select('bp.crop_id, bp.type_id, bp.variety_id, bp.purchase_quantity quantity, bp.pi_value');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bps.month_of_purchase month, bps.year, bps.usd_conversion_rate, bps.lc_exp, bps.insurance_exp, bps.packing_material, bps.carriage_inwards, bps.docs air_freight_and_docs, bps.cnf, bps.bank_other_charges, bps.ait, bps.miscellaneous, bps.sticker_cost');
        $this->db->select('(SELECT SUM(pi_value) FROM budget_purchases WHERE budget_purchases.setup_id=bps.id) as pi_sum');
        $this->db->where('bp.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bps.year', $year);
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
        if(strlen($from_month)>0 && strlen($to_month)>0)
        {
            $this->db->where('bps.month_of_purchase >=', $from_month);
            $this->db->where('bps.month_of_purchase <=', $to_month);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bp.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bp.type_id', 'LEFT');
        $this->db->join('budget_purchase_setup bps', 'bps.id = bp.setup_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bps.year', 'LEFT');
        $results = $this->db->get()->result_array();

        return $results;
    }

    public function get_budgeted_data_for_comparison($year, $month, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchase_months bpm');
        $this->db->select('bpm.year, bpm.crop_id, bpm.type_id, bpm.variety_id, bpm.month, bpm.quantity');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bpq.confirmed_quantity final_quantity');
        $this->db->select('bpq.pi_value pi_value');
        $this->db->select('bdc.usd_conversion_rate, bdc.lc_exp, bdc.insurance_exp, bdc.packing_material, bdc.carriage_inwards, bdc.air_freight_and_docs, bdc.cnf, bdc.bank_other_charges, bdc.ait, bdc.miscellaneous');
        $this->db->where('bpm.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bpm.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bpm.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bpm.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bpm.variety_id', $variety_id);
        }
        if(strlen($month)>0)
        {
            $this->db->where('bpm.month', $month);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bpm.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bpm.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bpm.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bpm.year', 'LEFT');
        $this->db->join('budget_direct_cost bdc', 'bdc.year = bpm.year', 'LEFT');
        $this->db->join('budget_purchase_quantity bpq', 'bpq.year = bpm.year AND bpq.variety_id = bpm.variety_id', 'LEFT');
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_packing_and_sticker_cost($variety_id)
    {
        $this->db->from('budget_packing_material_setup bpm');
        $this->db->select('bpm.*');
        $this->db->where('bpm.variety_id', $variety_id);
        $result = $this->db->get()->row_array();
        return $result;
    }

}