<?php
class Notification_helper
{

    public static function get_all_notifications()
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_division = $user->division_id;
        $user_zone = $user->zone_id;
        $user_territory = $user->territory_id;
        $user_group = $user->budget_group;

        if($user_group==$CI->config->item('user_group_marketing'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', null);
            $CI->db->where('bstn.receiving_division', null);
        }
        elseif($user_group==$CI->config->item('user_group_division'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', null);
            $CI->db->where('bstn.receiving_division', $user_division);
        }
        elseif($user_group==$CI->config->item('user_group_zone'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', $user_zone);
        }
        elseif($user_group==$CI->config->item('user_group_territory'))
        {
            $CI->db->where('length(bstn.receiving_territory)>2');
            $CI->db->where('length(bstn.receiving_zone)>2');
            $CI->db->where('length(bstn.receiving_division)>2');
            $CI->db->where('bstn.receiving_territory', $user_territory);
        }

        $CI->db->from('budget_sales_target_notification bstn');
        $CI->db->select('bstn.*');
        $CI->db->where('bstn.is_action_taken', 0);
        $CI->db->where('bstn.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();

        if($results)
        {
            return sizeof($results);
        }
        else
        {
            return false;
        }
    }

    public static function get_all_notification_detail()
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_division = $user->division_id;
        $user_zone = $user->zone_id;
        $user_territory = $user->territory_id;
        $user_group = $user->budget_group;

        if($user_group==$CI->config->item('user_group_marketing'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', null);
            $CI->db->where('bstn.receiving_division', null);
        }
        elseif($user_group==$CI->config->item('user_group_division'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', null);
            $CI->db->where('bstn.receiving_division', $user_division);
        }
        elseif($user_group==$CI->config->item('user_group_zone'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', $user_zone);
        }
        elseif($user_group==$CI->config->item('user_group_territory'))
        {
            $CI->db->where('length(bstn.receiving_territory)>2');
            $CI->db->where('length(bstn.receiving_zone)>2');
            $CI->db->where('length(bstn.receiving_division)>2');
            $CI->db->where('bstn.receiving_territory', $user_territory);
        }

        $CI->db->from('budget_sales_target_notification bstn');
        $CI->db->select('bstn.*');
        $CI->db->where('bstn.is_action_taken', 0);
        $CI->db->where('bstn.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();
        return $results;
    }

}