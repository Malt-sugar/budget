<?php
class Sales_target_helper
{

    public static function get_total_sales_target_of_customer($variety, $customer)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.budgeted_quantity) total_quantity');
        $CI->db->where('bst.customer_id', $customer);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_division($div_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.targeted_quantity');
        $CI->db->select('bst.budgeted_quantity total_quantity');
        $CI->db->where('bst.division_id', $div_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_zone($zone_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.targeted_quantity');
        $CI->db->select('bst.budgeted_quantity total_quantity');
        $CI->db->where('bst.zone_id', $zone_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_territory($territory_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.targeted_quantity');
        $CI->db->select('bst.budgeted_quantity total_quantity');
        $CI->db->where('bst.territory_id', $territory_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function get_required_zone_variety_detail($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_zone = $user->zone_id;

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity, bst.bottom_up_remarks, bst.targeted_quantity, bst.top_down_remarks');
        $CI->db->where('bst.zone_id', $user_zone);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function get_required_country_variety_detail($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity, bst.bottom_up_remarks');

        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function get_required_country_variety_detail_principal($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.*');

        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function get_required_division_variety_detail($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity, bst.bottom_up_remarks, bst.targeted_quantity, bst.top_down_remarks');
        $CI->db->where('bst.division_id', $user_division);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function get_total_target_customer($customer_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.budgeted_quantity) total_quantity');
        $CI->db->where('bst.customer_id', $customer_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }



    public static function get_required_territory_variety_detail($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_territory = $user->territory_id;

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity, bst.bottom_up_remarks');
        $CI->db->where('bst.territory_id', $user_territory);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    public static function check_ti_edit_target_permission($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_zone = $user->zone_id;

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity');
        $CI->db->where('bst.zone_id', $user_zone);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function check_zi_edit_target_permission($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_division = $user->division_id;

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity');

        $CI->db->where('bst.division_id', $user_division);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);

        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function check_di_edit_target_permission($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity');

        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);

        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function get_budgeted_sales_target($year, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity');

        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);

        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['budgeted_quantity'];
        }
        else
        {
            return null;
        }
    }
    
    public static function get_di_varieties_for_redistribution($year)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_div = $user->division_id;
        $CI->db->from('budget_sales_target_notification bstn');
        $CI->db->select('bstn.variety_id');

        $CI->db->where('bstn.receiving_territory', null);
        $CI->db->where('bstn.receiving_zone', null);
        $CI->db->where('bstn.receiving_division', $user_div);

        $CI->db->where('bstn.year', $year);
        $CI->db->where('bstn.is_action_taken', 0);
        $CI->db->where('bstn.assignment_type', $CI->config->item('assign_type_old'));
        $CI->db->where('bstn.direction', $CI->config->item('direction_down'));
        $CI->db->where('bstn.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if($results)
        {
            foreach($results as $result)
            {
                $new_array[] = $result['variety_id'];
            }
            return $new_array;
        }
        else
        {
            return false;
        }
    }

    public static function get_zi_varieties_for_redistribution($year)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_div = $user->division_id;
        $user_zone = $user->zone_id;
        $CI->db->from('budget_sales_target_notification bstn');
        $CI->db->select('bstn.variety_id');

        $CI->db->where('bstn.receiving_territory', null);
        $CI->db->where('bstn.receiving_zone', $user_zone);
        $CI->db->where('bstn.receiving_division', $user_div);

        $CI->db->where('bstn.year', $year);
        $CI->db->where('bstn.is_action_taken', 0);
        $CI->db->where('bstn.assignment_type', $CI->config->item('assign_type_old'));
        $CI->db->where('bstn.direction', $CI->config->item('direction_down'));
        $CI->db->where('bstn.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if($results)
        {
            foreach($results as $result)
            {
                $new_array[] = $result['variety_id'];
            }
            return $new_array;
        }
        else
        {
            return false;
        }
    }
}