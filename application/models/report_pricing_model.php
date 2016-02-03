<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_pricing_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_pricing_info($year, $report_type, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_pricing bsp');
        $this->db->select('bsp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bpq.pi_value');
        $this->db->select('bprin.final_targeted_quantity');
        $this->db->select('bics.ho_and_gen_exp, bics.marketing, bics.finance_cost, bics.target_profit');
        $this->db->select('bbs.sales_commission, bbs.sales_bonus, bbs.other_incentive');
        $this->db->select('bdc.usd_conversion_rate, bdc.lc_exp, bdc.insurance_exp, bdc.packing_material, bdc.carriage_inwards, bdc.air_freight_and_docs, bdc.cnf, bdc.bank_other_charges, bdc.ait, bdc.miscellaneous');
        $this->db->where('bsp.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }

        $this->db->where('bsp.pricing_type', $report_type);

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bsp.year', 'LEFT');
        $this->db->join('budget_direct_cost bdc', 'bdc.year = bsp.year', 'LEFT');
        $this->db->join('budget_indirect_cost_setup bics', 'bics.year = bsp.year', 'LEFT');
        $this->db->join('budget_purchase_quantity bpq', 'bpq.year = bsp.year AND bpq.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_principal_quantity bprin', 'bprin.year = bsp.year AND bprin.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_bonus_setup bbs', 'bbs.year = bsp.year AND bbs.variety_id = bsp.variety_id', 'LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_purchase_comparison_info($year, $report_type, $comparison_type, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_pricing bsp');
        $this->db->select('bsp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bpq.pi_value');
        $this->db->select('bprin.final_targeted_quantity');
        $this->db->select('bics.ho_and_gen_exp, bics.marketing, bics.finance_cost, bics.target_profit');
        $this->db->select('bbs.sales_commission, bbs.sales_bonus, bbs.other_incentive');
        $this->db->select('bdc.usd_conversion_rate, bdc.lc_exp, bdc.insurance_exp, bdc.packing_material, bdc.carriage_inwards, bdc.air_freight_and_docs, bdc.cnf, bdc.bank_other_charges, bdc.ait, bdc.miscellaneous');

        $this->db->select('(SELECT sales_commission FROM budget_sales_pricing WHERE pricing_type=2 AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_commission_mgt');
        $this->db->select('(SELECT sales_bonus FROM budget_sales_pricing WHERE pricing_type=2  AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_bonus_mgt');
        $this->db->select('(SELECT other_incentive FROM budget_sales_pricing WHERE pricing_type=2  AND year="'.$year.'" AND variety_id=bsp.variety_id) as other_incentive_mgt');
        $this->db->select('(SELECT target_profit FROM budget_sales_pricing WHERE pricing_type=2  AND year="'.$year.'" AND variety_id=bsp.variety_id) as target_profit_mgt');
        $this->db->select('(SELECT mrp FROM budget_sales_pricing WHERE pricing_type=2  AND year="'.$year.'" AND variety_id=bsp.variety_id) as mrp_mgt');

        $this->db->select('(SELECT sales_commission FROM budget_sales_pricing WHERE pricing_type=3  AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_commission_mkt');
        $this->db->select('(SELECT sales_bonus FROM budget_sales_pricing WHERE pricing_type=3  AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_bonus_mkt');
        $this->db->select('(SELECT other_incentive FROM budget_sales_pricing WHERE pricing_type=3  AND year="'.$year.'" AND variety_id=bsp.variety_id) as other_incentive_mkt');
        $this->db->select('(SELECT target_profit FROM budget_sales_pricing WHERE pricing_type=3  AND year="'.$year.'" AND variety_id=bsp.variety_id) as target_profit_mkt');
        $this->db->select('(SELECT mrp FROM budget_sales_pricing WHERE pricing_type=3  AND year="'.$year.'" AND variety_id=bsp.variety_id) as mrp_mkt');

        $this->db->select('(SELECT sales_commission FROM budget_sales_pricing WHERE pricing_type=4  AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_commission_final');
        $this->db->select('(SELECT sales_bonus FROM budget_sales_pricing WHERE pricing_type=4  AND year="'.$year.'" AND variety_id=bsp.variety_id) as sales_bonus_final');
        $this->db->select('(SELECT other_incentive FROM budget_sales_pricing WHERE pricing_type=4  AND year="'.$year.'" AND variety_id=bsp.variety_id) as other_incentive_final');
        $this->db->select('(SELECT target_profit FROM budget_sales_pricing WHERE pricing_type=4  AND year="'.$year.'" AND variety_id=bsp.variety_id) as target_profit_final');
        $this->db->select('(SELECT mrp FROM budget_sales_pricing WHERE pricing_type=4  AND year="'.$year.'" AND variety_id=bsp.variety_id) as mrp_final');

        $this->db->where('bsp.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }

        $this->db->where('bsp.pricing_type', 1);

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bsp.year', 'LEFT');
        $this->db->join('budget_direct_cost bdc', 'bdc.year = bsp.year', 'LEFT');
        $this->db->join('budget_indirect_cost_setup bics', 'bics.year = bsp.year', 'LEFT');
        $this->db->join('budget_purchase_quantity bpq', 'bpq.year = bsp.year AND bpq.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_principal_quantity bprin', 'bprin.year = bsp.year AND bprin.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_bonus_setup bbs', 'bbs.year = bsp.year AND bbs.variety_id = bsp.variety_id', 'LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_budget_actual_comparison_info($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchases bp');
        $this->db->select('bp.crop_id, bp.type_id, bp.variety_id, bp.purchase_quantity quantity, bp.pi_value');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bps.year, bps.usd_conversion_rate, bps.lc_exp, bps.insurance_exp, bps.packing_material, bps.carriage_inwards, bps.docs air_freight_and_docs, bps.cnf, bps.bank_other_charges, bps.ait, bps.miscellaneous, bps.sticker_cost');
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

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bp.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bp.type_id', 'LEFT');
        $this->db->join('budget_purchase_setup bps', 'bps.id = bp.setup_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bps.year', 'LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_budgeted_data_for_comparison($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_purchase_months bpm');
        $this->db->select('bpm.year, bpm.crop_id, bpm.type_id, bpm.variety_id');
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

    public function get_cogs_expenses($year, $cogs)
    {
        $this->db->from('budget_indirect_cost_setup bics');
        $this->db->select('bics.*');
        $this->db->where('bics.year', $year);
        $result = $this->db->get()->row_array();

        $ho_and_gen_exp = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $marketing = isset($result['marketing'])?$result['marketing']:0;
        $finance_cost = isset($result['finance_cost'])?$result['finance_cost']:0;

        $expenses = $cogs + ($ho_and_gen_exp/100)*$cogs + ($marketing/100)*$cogs + ($finance_cost/100)*$cogs;
        return $expenses;
    }

    public function get_final_net_sales_price($year, $variety_id)
    {
        $this->db->from('budget_sales_pricing bsp');
        $this->db->select('bsp.mrp, bsp.year, bsp.variety_id, bsp.pricing_type');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.variety_id', $variety_id);
        $this->db->where('bsp.pricing_type', $this->config->item('pricing_type_final'));
        $result = $this->db->get()->row_array();

        $mrp = isset($result['mrp'])?$result['mrp']:0;

        $this->db->from('budget_bonus_setup bbs');
        $this->db->select('bbs.*');
        $this->db->where('bbs.year', $year);
        $this->db->where('bbs.variety_id', $variety_id);
        $result = $this->db->get()->row_array();
        $sales_commission = isset($result['sales_commission'])?$result['sales_commission']:0;
        $sales_bonus = isset($result['sales_bonus'])?$result['sales_bonus']:0;
        $other_incentive = isset($result['other_incentive'])?$result['other_incentive']:0;

        $final_net_sales_price = $mrp - ($sales_commission/100)*$mrp - ($sales_bonus/100)*$mrp - ($other_incentive/100)*$mrp;
        return $final_net_sales_price;
    }

    public function get_final_prediction_info($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_pricing bsp');
        $this->db->select('bsp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bpq.pi_value');
        $this->db->select('bprin.final_targeted_quantity');
        $this->db->select('bics.ho_and_gen_exp, bics.marketing, bics.finance_cost, bics.target_profit');
        $this->db->select('bbs.sales_commission, bbs.sales_bonus, bbs.other_incentive');
        $this->db->select('bdc.usd_conversion_rate, bdc.lc_exp, bdc.insurance_exp, bdc.packing_material, bdc.carriage_inwards, bdc.air_freight_and_docs, bdc.cnf, bdc.bank_other_charges, bdc.ait, bdc.miscellaneous');
        $this->db->where('bsp.status',$this->config->item('status_active'));

        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }
        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }

        $this->db->where('bsp.pricing_type', $this->config->item('pricing_type_final'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bsp.year', 'LEFT');
        $this->db->join('budget_direct_cost bdc', 'bdc.year = bsp.year', 'LEFT');
        $this->db->join('budget_indirect_cost_setup bics', 'bics.year = bsp.year', 'LEFT');
        $this->db->join('budget_purchase_quantity bpq', 'bpq.year = bsp.year AND bpq.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_principal_quantity bprin', 'bprin.year = bsp.year AND bprin.variety_id = bsp.variety_id', 'LEFT');
        $this->db->join('budget_bonus_setup bbs', 'bbs.year = bsp.year AND bbs.variety_id = bsp.variety_id', 'LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_prediction_year_quantity($year, $variety)
    {
        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('SUM(bstp.budgeted_quantity) total');
        $this->db->where('bstp.year', $year);
        $this->db->where('bstp.variety_id', $variety);
        $this->db->where('LENGTH(bstp.division_id)<', 2);
        $result = $this->db->get()->row_array();
        $budgeted_quantity = isset($result['total'])?$result['total']:0;
        return $budgeted_quantity;
    }

}