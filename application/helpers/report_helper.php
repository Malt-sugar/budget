<?php
class Report_helper
{
    public static function get_actual_sales_qty($year, $zone, $territory, $customer, $variety)
    {
        $CI = & get_instance();
        $user = User_helper::get_user();

        $CI->db->from('ait_product_purchase_order_invoice appo');
        $CI->db->select('appo.*');
        $CI->db->select('SUM(appo.approved_quantity) as actual_sales_quantity');
        $CI->db->where('appo.year_id', $year);

        if(strlen($zone)>1)
        {
            $CI->db->where('appo.zone_id', $zone);
        }
        if(strlen($territory)>1)
        {
            $CI->db->where('appo.territory_id', $territory);
        }
        if(strlen($customer)>1)
        {
            $CI->db->where('appo.distributor_id', $customer);
        }

        $CI->db->where('appo.varriety_id', $variety);
        $CI->db->where('appo.status !=', 'In-Active');
        $CI->db->where('appo.del_status', 0);
        $results = $CI->db->get()->row_array();
        //echo $CI->db->last_query();

        if($results)
        {
            return $results['actual_sales_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_division_zones($division)
    {
        $CI = & get_instance();
        $CI->db->from('ait_zone_info azi');
        $CI->db->select('azi.*');
        $CI->db->group_by('azi.zone_id');
        $CI->db->where('azi.division_id', $division);
        $results = $CI->db->get()->result_array();

        $zones=",";
        foreach($results as $result)
        {
            $zones.='"'.$result['zone_id'].'",';
        }

        return trim($zones,",");
    }

}