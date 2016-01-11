<?php
class Pricing_helper
{

    public static function get_pricing_automated_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        // Targeted Quantity
        $CI->db->from('budget_principal_quantity bpq');
        $CI->db->select('bpq.final_targeted_quantity');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $sales_result = $CI->db->get()->row_array();
        $data['targeted_quantity'] = isset($sales_result['final_targeted_quantity'])?$sales_result['final_targeted_quantity']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $pi_value = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        // packing and sticker data
        $CI->db->from('budget_packing_material_setup bpm');
        $CI->db->select('bpm.*');
        $CI->db->where('bpm.variety_id', $variety);
        $packing_result = $CI->db->get()->row_array();
        if(isset($packing_result['packing_material_cost']) && $packing_result['packing_status']==1)
        {
            $packing_material_cost = $packing_result['packing_material_cost'];
        }
        else
        {
            $packing_material_cost = 0;
        }
        if(isset($packing_result['sticker_cost']) && $packing_result['sticker_status']==1)
        {
            $sticker_cost = $packing_result['sticker_cost'];
        }
        else
        {
            $sticker_cost = 0;
        }

        // COGS
        $CI->db->from('budget_direct_cost bdc');
        $CI->db->select('bdc.*');
        $CI->db->where('bdc.year', $year);
        $result = $CI->db->get()->row_array();
        $usd_conversion_rate = isset($result['usd_conversion_rate'])?$result['usd_conversion_rate']:0;
        $lc_exp = isset($result['lc_exp'])?$result['lc_exp']:0;
        $insurance_exp = isset($result['insurance_exp'])?$result['insurance_exp']:0;
        $carriage_inwards = isset($result['carriage_inwards'])?$result['carriage_inwards']:0;
        $air_freight_and_docs = isset($result['air_freight_and_docs'])?$result['air_freight_and_docs']:0;
        $cnf = isset($result['cnf'])?$result['cnf']:0;
        $bank_other_charges = isset($result['bank_other_charges'])?$result['bank_other_charges']:0;

        $pi_value = $pi_value*$usd_conversion_rate;
        $data['pi_value'] = $pi_value;
        $data['cogs'] = $pi_value + ($pi_value/100)*$lc_exp + ($pi_value/100)*$insurance_exp + ($pi_value/100)*$carriage_inwards + ($pi_value/100)*$air_freight_and_docs + ($pi_value/100)*$cnf + ($pi_value/100)*$bank_other_charges + $packing_material_cost + $sticker_cost;

        // Indirect Costs
        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;

        // VarietyWise Bonus Setup
        $CI->db->from('budget_bonus_setup bbs');
        $CI->db->select('bbs.*');
        $CI->db->where('bbs.year', $year);
        $CI->db->where('bbs.variety_id', $variety);
        $result = $CI->db->get()->row_array();
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;
        $data['sales_bonus'] = isset($result['sales_bonus'])?$result['sales_bonus']:0;
        $data['other_incentive'] = isset($result['other_incentive'])?$result['other_incentive']:0;

        return $data;
    }

    public static function get_opening_balance($variety)
    {
        $CI = & get_instance();
        $year = System_helper::get_current_year();

        $CI->db->from('ait_product_purchase_info ppi');
        $CI->db->select('SUM(ppi.opening_balance) opening_balance');
        $CI->db->where('ppi.year_id', $year);
        $CI->db->where('ppi.varriety_id', $variety);
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['opening_balance'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_pricing_management_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_automated'));
        $result = $CI->db->get()->row_array();
        $data['automated_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        $last_year = Pricing_helper::get_last_year($year);

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $last_year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        $data['last_year_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;

        // Targeted Quantity
        $CI->db->from('budget_principal_quantity bpq');
        $CI->db->select('bpq.final_targeted_quantity');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $sales_result = $CI->db->get()->row_array();
        $data['targeted_quantity'] = isset($sales_result['final_targeted_quantity'])?$sales_result['final_targeted_quantity']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $pi_value = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        // VarietyWise Bonus Setup
        $CI->db->from('budget_bonus_setup bbs');
        $CI->db->select('bbs.*');
        $CI->db->where('bbs.year', $year);
        $CI->db->where('bbs.variety_id', $variety);
        $result = $CI->db->get()->row_array();
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;
        $data['sales_bonus'] = isset($result['sales_bonus'])?$result['sales_bonus']:0;
        $data['other_incentive'] = isset($result['other_incentive'])?$result['other_incentive']:0;

        // packing and sticker data
        $CI->db->from('budget_packing_material_setup bpm');
        $CI->db->select('bpm.*');
        $CI->db->where('bpm.variety_id', $variety);
        $packing_result = $CI->db->get()->row_array();
        if(isset($packing_result['packing_material_cost']) && $packing_result['packing_status']==1)
        {
            $packing_material_cost = $packing_result['packing_material_cost'];
        }
        else
        {
            $packing_material_cost = 0;
        }
        if(isset($packing_result['sticker_cost']) && $packing_result['sticker_status']==1)
        {
            $sticker_cost = $packing_result['sticker_cost'];
        }
        else
        {
            $sticker_cost = 0;
        }

        // Budgeted COGS
        $CI->db->from('budget_direct_cost bdc');
        $CI->db->select('bdc.*');
        $CI->db->where('bdc.year', $year);
        $CI->db->where('bdc.status', $CI->config->item('status_active'));
        $direct_cost = $CI->db->get()->row_array();

        $usd_conversion_rate = isset($direct_cost['usd_conversion_rate'])?$direct_cost['usd_conversion_rate']:0;
        $lc_exp = isset($direct_cost['lc_exp'])?$direct_cost['lc_exp']:0;
        $insurance_exp = isset($direct_cost['insurance_exp'])?$direct_cost['insurance_exp']:0;
        $carriage_inwards = isset($direct_cost['carriage_inwards'])?$direct_cost['carriage_inwards']:0;
        $air_freight_and_docs = isset($direct_cost['air_freight_and_docs'])?$direct_cost['air_freight_and_docs']:0;
        $cnf = isset($direct_cost['cnf'])?$direct_cost['cnf']:0;
        $bank_other_charges = isset($direct_cost['bank_other_charges'])?$direct_cost['bank_other_charges']:0;
        $pi_value = $pi_value*$usd_conversion_rate;

        $data['cogs'] = $pi_value + ($pi_value/100)*$lc_exp + ($pi_value/100)*$insurance_exp + ($pi_value/100)*$carriage_inwards + ($pi_value/100)*$air_freight_and_docs + ($pi_value/100)*$cnf + ($pi_value/100)*$bank_other_charges + $packing_material_cost + $sticker_cost;
        return $data;
    }

    public static function get_pricing_marketing_detail_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        // LAST YEAR MRP
        $last_year = Pricing_helper::get_last_year($year);

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $last_year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_marketing'));
        $result = $CI->db->get()->row_array();
        $data['last_year_mrp'] = isset($result['mrp'])?$result['mrp']:0;


        // MGT INITIAL MRP
        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        $data['management_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        // Indirect Cost
        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;

        // Targeted Quantity
        $CI->db->from('budget_principal_quantity bpq');
        $CI->db->select('bpq.final_targeted_quantity');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $sales_result = $CI->db->get()->row_array();
        $data['targeted_quantity'] = isset($sales_result['final_targeted_quantity'])?$sales_result['final_targeted_quantity']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $pi_value = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        // packing and sticker data
        $CI->db->from('budget_packing_material_setup bpm');
        $CI->db->select('bpm.*');
        $CI->db->where('bpm.variety_id', $variety);
        $packing_result = $CI->db->get()->row_array();
        if(isset($packing_result['packing_material_cost']) && $packing_result['packing_status']==1)
        {
            $packing_material_cost = $packing_result['packing_material_cost'];
        }
        else
        {
            $packing_material_cost = 0;
        }
        if(isset($packing_result['sticker_cost']) && $packing_result['sticker_status']==1)
        {
            $sticker_cost = $packing_result['sticker_cost'];
        }
        else
        {
            $sticker_cost = 0;
        }

        // Budgeted COGS
        $CI->db->from('budget_direct_cost bdc');
        $CI->db->select('bdc.*');
        $CI->db->where('bdc.year', $year);
        $CI->db->where('bdc.status', $CI->config->item('status_active'));
        $direct_cost = $CI->db->get()->row_array();

        $usd_conversion_rate = isset($direct_cost['usd_conversion_rate'])?$direct_cost['usd_conversion_rate']:0;
        $lc_exp = isset($direct_cost['lc_exp'])?$direct_cost['lc_exp']:0;
        $insurance_exp = isset($direct_cost['insurance_exp'])?$direct_cost['insurance_exp']:0;
        $carriage_inwards = isset($direct_cost['carriage_inwards'])?$direct_cost['carriage_inwards']:0;
        $air_freight_and_docs = isset($direct_cost['air_freight_and_docs'])?$direct_cost['air_freight_and_docs']:0;
        $cnf = isset($direct_cost['cnf'])?$direct_cost['cnf']:0;
        $bank_other_charges = isset($direct_cost['bank_other_charges'])?$direct_cost['bank_other_charges']:0;
        $pi_value = $pi_value*$usd_conversion_rate;

        $data['cogs'] = $pi_value + ($pi_value/100)*$lc_exp + ($pi_value/100)*$insurance_exp + ($pi_value/100)*$carriage_inwards + ($pi_value/100)*$air_freight_and_docs + ($pi_value/100)*$cnf + ($pi_value/100)*$bank_other_charges + $packing_material_cost + $sticker_cost;
        return $data;
    }

    public static function get_pricing_final_info($year, $variety)
    {
        $CI = & get_instance();
        $data = array();

        // Automated MRP
        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_automated'));
        $result = $CI->db->get()->row_array();
        $data['automated_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        // MGT INITIAL MRP
        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        $data['management_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        // MGT MKT
        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_marketing'));
        $result = $CI->db->get()->row_array();
        $data['marketing_mrp'] = isset($result['mrp'])?$result['mrp']:0;
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;
        $data['sales_bonus'] = isset($result['sales_bonus'])?$result['sales_bonus']:0;
        $data['other_incentive'] = isset($result['other_incentive'])?$result['other_incentive']:0;

        // LAST YEAR MRP (Final)
        $last_year = Pricing_helper::get_last_year($year);

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $last_year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_final'));
        $result = $CI->db->get()->row_array();
        $data['last_year_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        // Indirect Cost
        $CI->db->from('budget_indirect_cost_setup bics');
        $CI->db->select('bics.*');
        $CI->db->where('bics.year', $year);
        $result = $CI->db->get()->row_array();
        $data['ho_and_gen_exp'] = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;

        // Targeted Quantity
        $CI->db->from('budget_principal_quantity bpq');
        $CI->db->select('bpq.final_targeted_quantity');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $sales_result = $CI->db->get()->row_array();
        $data['targeted_quantity'] = isset($sales_result['final_targeted_quantity'])?$sales_result['final_targeted_quantity']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $pi_value = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        // packing and sticker data
        $CI->db->from('budget_packing_material_setup bpm');
        $CI->db->select('bpm.*');
        $CI->db->where('bpm.variety_id', $variety);
        $packing_result = $CI->db->get()->row_array();
        if(isset($packing_result['packing_material_cost']) && $packing_result['packing_status']==1)
        {
            $packing_material_cost = $packing_result['packing_material_cost'];
        }
        else
        {
            $packing_material_cost = 0;
        }
        if(isset($packing_result['sticker_cost']) && $packing_result['sticker_status']==1)
        {
            $sticker_cost = $packing_result['sticker_cost'];
        }
        else
        {
            $sticker_cost = 0;
        }

        // Budgeted COGS
        $CI->db->from('budget_direct_cost bdc');
        $CI->db->select('bdc.*');

        $CI->db->where('bdc.year', $year);
        $CI->db->where('bdc.status', $CI->config->item('status_active'));
        $direct_cost = $CI->db->get()->row_array();

        $usd_conversion_rate = isset($direct_cost['usd_conversion_rate'])?$direct_cost['usd_conversion_rate']:0;
        $lc_exp = isset($direct_cost['lc_exp'])?$direct_cost['lc_exp']:0;
        $insurance_exp = isset($direct_cost['insurance_exp'])?$direct_cost['insurance_exp']:0;
        $carriage_inwards = isset($direct_cost['carriage_inwards'])?$direct_cost['carriage_inwards']:0;
        $air_freight_and_docs = isset($direct_cost['air_freight_and_docs'])?$direct_cost['air_freight_and_docs']:0;
        $cnf = isset($direct_cost['cnf'])?$direct_cost['cnf']:0;
        $bank_other_charges = isset($direct_cost['bank_other_charges'])?$direct_cost['bank_other_charges']:0;
        $pi_value = $pi_value*$usd_conversion_rate;

        $data['cogs'] = $pi_value + ($pi_value/100)*$lc_exp + ($pi_value/100)*$insurance_exp + ($pi_value/100)*$carriage_inwards + ($pi_value/100)*$air_freight_and_docs + ($pi_value/100)*$cnf + ($pi_value/100)*$bank_other_charges + $packing_material_cost + $sticker_cost;
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

    public static function get_pricing_final_existing_info($year, $variety)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_final'));
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
        $data['ho_and_gen_exp'] = isset($result['ho_and_gen_exp'])?$result['ho_and_gen_exp']:0;
        $data['marketing'] = isset($result['marketing'])?$result['marketing']:0;
        $data['finance_cost'] = isset($result['finance_cost'])?$result['finance_cost']:0;
        $data['target_profit'] = isset($result['target_profit'])?$result['target_profit']:0;

        // MRP BY MGT

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.*');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_initial'));
        $result = $CI->db->get()->row_array();
        $data['mrp_by_mgt'] = isset($result['mrp'])?$result['mrp']:0;
        $data['sales_commission'] = isset($result['sales_commission'])?$result['sales_commission']:0;
        $data['sales_bonus'] = isset($result['sales_bonus'])?$result['sales_bonus']:0;
        $data['other_incentive'] = isset($result['other_incentive'])?$result['other_incentive']:0;

        // Last Year MRP
        $last_year = Pricing_helper::get_last_year($year);

        $CI->db->from('budget_sales_pricing bsp');
        $CI->db->select('bsp.mrp');
        $CI->db->where('bsp.year', $last_year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.pricing_type', $CI->config->item('pricing_type_marketing'));
        $result = $CI->db->get()->row_array();
        $data['last_year_mrp'] = isset($result['mrp'])?$result['mrp']:0;

        // Budgeted PI or COGS
        $CI->db->from('budget_purchase_quantity bpq');
        $CI->db->select('bpq.pi_value');
        $CI->db->where('bpq.variety_id', $variety);
        $CI->db->where('bpq.year', $year);
        $CI->db->where('bpq.status', $CI->config->item('status_active'));
        $budget_purchase_result = $CI->db->get()->row_array();
        $pi_value = isset($budget_purchase_result['pi_value'])?$budget_purchase_result['pi_value']:0;

        // packing and sticker data
        $CI->db->from('budget_packing_material_setup bpm');
        $CI->db->select('bpm.*');
        $CI->db->where('bpm.variety_id', $variety);
        $packing_result = $CI->db->get()->row_array();
        if(isset($packing_result['packing_material_cost']) && $packing_result['packing_status']==1)
        {
            $packing_material_cost = $packing_result['packing_material_cost'];
        }
        else
        {
            $packing_material_cost = 0;
        }
        if(isset($packing_result['sticker_cost']) && $packing_result['sticker_status']==1)
        {
            $sticker_cost = $packing_result['sticker_cost'];
        }
        else
        {
            $sticker_cost = 0;
        }

        // Budgeted COGS
        $CI->db->from('budget_direct_cost bdc');
        $CI->db->select('bdc.*');
        $CI->db->where('bdc.year', $year);
        $CI->db->where('bdc.status', $CI->config->item('status_active'));
        $direct_cost = $CI->db->get()->row_array();
        $usd_conversion_rate = isset($direct_cost['usd_conversion_rate'])?$direct_cost['usd_conversion_rate']:0;
        $lc_exp = isset($direct_cost['lc_exp'])?$direct_cost['lc_exp']:0;
        $insurance_exp = isset($direct_cost['insurance_exp'])?$direct_cost['insurance_exp']:0;
        $carriage_inwards = isset($direct_cost['carriage_inwards'])?$direct_cost['carriage_inwards']:0;
        $air_freight_and_docs = isset($direct_cost['air_freight_and_docs'])?$direct_cost['air_freight_and_docs']:0;
        $cnf = isset($direct_cost['cnf'])?$direct_cost['cnf']:0;
        $bank_other_charges = isset($direct_cost['bank_other_charges'])?$direct_cost['bank_other_charges']:0;
        $pi_value = $pi_value*$usd_conversion_rate;
        $data['cogs'] = $pi_value + ($pi_value/100)*$lc_exp + ($pi_value/100)*$insurance_exp + ($pi_value/100)*$carriage_inwards + ($pi_value/100)*$air_freight_and_docs + ($pi_value/100)*$cnf + ($pi_value/100)*$bank_other_charges + $packing_material_cost + $sticker_cost;
        return $data;
    }

    public static function get_last_year($year)
    {
        $CI = & get_instance();
        $CI->db->from('ait_year');
        $CI->db->select('year_name');
        $CI->db->where('year_id', $year);
        $result = $CI->db->get()->row_array();
        $this_year_name = $result['year_name'];
        $last_year_name = $this_year_name - 1; // 2015 - 1 = 2014 (No increment ID in the year table)

        $CI->db->from('ait_year');
        $CI->db->select('year_id');
        $CI->db->where('year_name', $last_year_name);
        $result = $CI->db->get()->row_array();
        return $result['year_id'];
    }

    public static function get_bonus_detail_info($year, $variety_id)
    {
        $CI = & get_instance();
        $CI->db->select('bbs.*');
        $CI->db->from('budget_bonus_setup bbs');
        $CI->db->where('bbs.year', $year);
        $CI->db->where('bbs.variety_id', $variety_id);
        $result = $CI->db->get()->row_array();
        return $result;
    }

}