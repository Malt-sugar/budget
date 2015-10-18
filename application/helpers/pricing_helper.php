<?php
class Pricing_helper
{

    public static function get_pricing_automated_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = $result['ho_and_gen_exp'];
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;

        // Principal Quantity
        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.principal_quantity');
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $sales_result = $CI->db->get()->row_array();
        $data['principal_quantity'] = isset($sales_result['principal_quantity'])?$sales_result['principal_quantity']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $data['pi_value'] = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        return $data;
    }

    public static function get_pricing_automated_existing_info($year, $variety)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_automated'));
        $result = $CI->db->get()->row_array();
        return $result;
    }

    public static function get_pricing_marketing_existing_info($year, $variety)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_marketing'));
        $result = $CI->db->get()->row_array();
        return $result;
    }

    public static function get_pricing_initial_existing_info($year, $variety)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        return $result;
    }

    public static function get_pricing_marketing_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = $result['ho_and_gen_exp'];
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;

        // MRP BY MGT

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        $data['mrp_by_mgt'] = isset($result['mrp'])?$result['mrp']:0;

        return $data;
    }

}