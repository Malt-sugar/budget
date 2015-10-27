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
            $CI->db->group_by('bstn.receiving_division');
        }
        elseif($user_group==$CI->config->item('user_group_zone'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', $user_zone);
            $CI->db->group_by('bstn.receiving_zone');
        }
        elseif($user_group==$CI->config->item('user_group_territory'))
        {
            $CI->db->where('length(bstn.receiving_territory)>2');
            $CI->db->where('length(bstn.receiving_zone)>2');
            $CI->db->where('length(bstn.receiving_division)>2');
            $CI->db->where('bstn.receiving_territory', $user_territory);
            $CI->db->group_by('bstn.receiving_territory');
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
            $CI->db->group_by('bstn.receiving_division');
        }
        elseif($user_group==$CI->config->item('user_group_zone'))
        {
            $CI->db->where('bstn.receiving_territory', null);
            $CI->db->where('bstn.receiving_zone', $user_zone);
            $CI->db->group_by('bstn.receiving_zone');
        }
        elseif($user_group==$CI->config->item('user_group_territory'))
        {
            $CI->db->where('length(bstn.receiving_territory)>2');
            $CI->db->where('length(bstn.receiving_zone)>2');
            $CI->db->where('length(bstn.receiving_division)>2');
            $CI->db->where('bstn.receiving_territory', $user_territory);
            $CI->db->group_by('bstn.receiving_territory');
        }

        $CI->db->from('budget_sales_target_notification bstn');
        $CI->db->select('bstn.*');
        $CI->db->where('bstn.is_action_taken', 0);
        $CI->db->where('bstn.status', $CI->config->item('status_active'));
        $results = $CI->db->get()->result_array();
        return $results;
    }

    public static function get_notification_text($notification)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();
        $user_division = $user->division_id;
        $user_zone = $user->zone_id;
        $user_territory = $user->territory_id;
        $user_group = $user->budget_group;
        $return_array = array();

        $id = $notification['id'];
        $year = $notification['year'];
        $crop_id = $notification['crop_id'];
        $type_id = $notification['type_id'];
        $variety_id = $notification['variety_id'];
        $sending_division = $notification['sending_division'];
        $sending_zone = $notification['sending_zone'];
        $sending_territory = $notification['sending_territory'];
        $receiving_division = $notification['receiving_division'];
        $receiving_zone = $notification['receiving_zone'];
        $receiving_territory = $notification['receiving_territory'];
        $direction = $notification['direction'];
        $is_read = $notification['is_read'];
        $assignment_type = $notification['assignment_type'];

        if($direction == $CI->config->item('direction_up'))
        {
            if($user_group == $CI->config->item('user_group_marketing'))
            {
                if(isset($sending_division) && !isset($sending_zone) && !isset($sending_territory))
                {
                    $return_array['text'] = 'Division: '. Notification_helper::get_division_name($sending_division).' Sales target Set!';
                    $return_array['link'] = base_url().'hom_sales_target/index/add';
                }
            }
            elseif($user_group == $CI->config->item('user_group_division'))
            {
                if(isset($sending_division) && isset($sending_zone) && !isset($sending_territory) && $receiving_division == $user_division)
                {
                    $return_array['text'] = 'Zone: ' . Notification_helper::get_zone_name($sending_zone).' Sales target Set!';
                    $return_array['link'] = base_url().'di_sales_target/index/add';
                }
            }
            elseif($user_group == $CI->config->item('user_group_zone'))
            {
                if(isset($sending_division) && isset($sending_zone) && isset($sending_territory) && $receiving_zone == $user_zone)
                {
                    $return_array['text'] = 'Territory: ' . Notification_helper::get_territory_name($sending_territory).' Sales target Set!';
                    $return_array['link'] = base_url().'zi_sales_target/index/add';
                }
            }
        }
        elseif($direction == $CI->config->item('direction_down'))
        {
            if($user_group == $CI->config->item('user_group_division'))
            {
                if(!isset($sending_division) && !isset($sending_zone) && !isset($sending_territory) && $receiving_division == $user_division)
                {
                    if($assignment_type == $CI->config->item('assign_type_new'))
                    {
                        $return_array['text'] = 'Target Assigned For Your Division. Please Distribute!';
                        $return_array['link'] = base_url().'assign_target_to_division/index/add';
                    }
                    elseif($assignment_type == $CI->config->item('assign_type_old'))
                    {
                        $return_array['text'] = 'Target Reassigned For Your Division. Please Distribute Again!';
                        $return_array['link'] = base_url().'assign_target_to_division/index/add';
                    }
                }
            }
            elseif($user_group == $CI->config->item('user_group_zone'))
            {
                if(isset($sending_division) && !isset($sending_zone) && !isset($sending_territory) && $receiving_zone == $user_zone)
                {
                    if($assignment_type == $CI->config->item('assign_type_new'))
                    {
                        $return_array['text'] = 'Target Assigned For Your Zone. Please Distribute!';
                        $return_array['link'] = base_url().'assign_target_to_zone/index/add';
                    }
                    elseif($assignment_type == $CI->config->item('assign_type_old'))
                    {
                        $return_array['text'] = 'Target Reassigned For Your Zone. Please Distribute Again!';
                        $return_array['link'] = base_url().'assign_target_to_zone/index/add';
                    }
                }
            }
            elseif($user_group == $CI->config->item('user_group_territory'))
            {
                if(isset($sending_division) && isset($sending_zone) && !isset($sending_territory) && $receiving_territory == $user_territory)
                {
                    if($assignment_type == $CI->config->item('assign_type_new'))
                    {
                        $return_array['text'] = 'Target Assigned For Your Territory.';
                        $return_array['link'] = '';
                    }
                    elseif($assignment_type == $CI->config->item('assign_type_old'))
                    {
                        $return_array['text'] = 'Target Reassigned For Your Territory.';
                        $return_array['link'] = '';
                    }
                }
            }
        }

        return $return_array;
    }

    public static function get_division_name($division_id)
    {
        $CI = & get_instance();
        $CI->db->from('ait_division_info adi');
        $CI->db->select('adi.division_name');
        $CI->db->where('adi.division_id', $division_id);
        $result = $CI->db->get()->row_array();
        return $result['division_name'];
    }

    public static function get_zone_name($zone_id)
    {
        $CI = & get_instance();
        $CI->db->from('ait_zone_info azi');
        $CI->db->select('azi.zone_name');
        $CI->db->where('azi.zone_id', $zone_id);
        $result = $CI->db->get()->row_array();
        return $result['zone_name'];
    }

    public static function get_territory_name($territory_id)
    {
        $CI = & get_instance();
        $CI->db->from('ait_territory_info ati');
        $CI->db->select('ati.territory_name');
        $CI->db->where('ati.territory_id', $territory_id);
        $result = $CI->db->get()->row_array();
        return $result['territory_name'];
    }

}