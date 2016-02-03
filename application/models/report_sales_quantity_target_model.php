<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_sales_quantity_target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sales_quantity_target_info($selection_type, $year, $from_month, $to_month, $division, $zone, $territory, $district, $customer, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->select('ay.year_name year_name');
        $this->db->select('bstm.month selling_month');
        $this->db->select('bsp.mrp unit_price_per_kg');

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

        if(strlen($from_month)>1 && strlen($to_month)>1)
        {
            $this->db->where('bstm.month >=', $from_month);
            $this->db->where('bstm.month <=', $to_month);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'LEFT');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bst.crop_id', 'LEFT');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bst.type_id', 'LEFT');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'LEFT');
        $this->db->join('budget_sales_target_monthwise bstm', 'bstm.sales_target_id = bst.id AND LENGTH(bstm.territory_id)>2', 'LEFT');
        $this->db->join('budget_principal_quantity bpq', 'bpq.variety_id = bst.variety_id AND bpq.year = bst.year', 'LEFT');
        $this->db->join('budget_sales_pricing bsp', 'bsp.variety_id = bst.variety_id AND bsp.year = bst.year AND bsp.pricing_type="'.$this->config->item('pricing_type_final').'"', 'LEFT');

        $this->db->group_by('bst.crop_id');
        $this->db->group_by('bst.type_id');
        $this->db->group_by('bst.variety_id');

        $results = $this->db->get()->result_array();

        foreach($results as &$result)
        {
            $this->db->from('budget_sales_target');
            $this->db->select('SUM(budgeted_quantity) total_budgeted');
            $this->db->select('SUM(targeted_quantity) total_targeted');

            if($selection_type==5)
            {
                if(isset($division) && strlen($division)>1)
                {
                    $this->db->where('division_id', $division);
                }
                if(isset($zone) && strlen($zone)>1)
                {
                    $this->db->where('zone_id', $zone);
                }
                if(isset($territory) && strlen($territory)>1)
                {
                    $this->db->where('territory_id', $territory);
                }
                if(isset($district) && $district>0)
                {
                    $this->db->where('zilla_id', $district);
                }
                if(isset($customer) && strlen($customer)>1)
                {
                    $this->db->where('customer_id', $customer);
                }
            }
            elseif($selection_type==4)
            {
                if(isset($division) && strlen($division)>1)
                {
                    $this->db->where('division_id', $division);
                }
                if(isset($zone) && strlen($zone)>1)
                {
                    $this->db->where('zone_id', $zone);
                }
                if(isset($territory) && strlen($territory)>1)
                {
                    $this->db->where('territory_id', $territory);
                }
                if(isset($district) && $district>0)
                {
                    $this->db->where('zilla_id', $district);
                    $this->db->where('LENGTH(customer_id)<', 2);
                }
            }
            elseif($selection_type==3)
            {
                if(isset($division) && strlen($division)>1)
                {
                    $this->db->where('division_id', $division);
                }
                if(isset($zone) && strlen($zone)>1)
                {
                    $this->db->where('zone_id', $zone);
                }
                if(isset($territory) && strlen($territory)>1)
                {
                    $this->db->where('territory_id', $territory);
                    $this->db->where('zilla_id', null);
                }
            }
            elseif($selection_type==2)
            {
                if(isset($division) && strlen($division)>1)
                {
                    $this->db->where('division_id', $division);
                }
                if(isset($zone) && strlen($zone)>1)
                {
                    $this->db->where('zone_id', $zone);
                    $this->db->where('LENGTH(territory_id)<', 2);
                }
            }
            elseif($selection_type==1)
            {
                if(isset($division) && strlen($division)>1)
                {
                    $this->db->where('division_id', $division);
                    $this->db->where('LENGTH(zone_id)<', 2);
                }
            }
            elseif($selection_type==0)
            {
                $this->db->where('LENGTH(division_id)<', 2);
            }

            if(isset($result['year']) && strlen($result['year'])>1)
            {
                $this->db->where('year', $result['year']);
            }
            if(isset($result['crop_id']) && strlen($result['crop_id'])>1)
            {
                $this->db->where('crop_id', $result['crop_id']);
            }
            if(isset($result['type_id']) && strlen($result['type_id'])>1)
            {
                $this->db->where('type_id', $result['type_id']);
            }
            if(isset($result['variety_id']) && strlen($result['variety_id'])>1)
            {
                $this->db->where('variety_id', $result['variety_id']);
            }

            $this->db->where('status',$this->config->item('status_active'));
            $sub_result = $this->db->get()->row_array();

            $result['total_budgeted'] = isset($sub_result['total_budgeted'])?$sub_result['total_budgeted']:0;
            $result['total_targeted'] = isset($sub_result['total_targeted'])?$sub_result['total_targeted']:0;
        }

        return $results;
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

    public function get_detail_budgeted_data($data_type, $selection_type, $location, $year, $variety)
    {
        $this->db->from('budget_sales_target');
        if($data_type==1)
        {
            $this->db->select('SUM(budgeted_quantity) total_budgeted');
        }
        elseif($data_type==2)
        {
            $this->db->select('SUM(targeted_quantity) total_targeted');
        }

        if(strlen($year)>1)
        {
            $this->db->where('year', $year);
        }

        $this->db->where('variety_id', $variety);

        if($selection_type==0)
        {
            $this->db->where('division_id', $location);
            $this->db->where('LENGTH(zone_id)<', 2);
        }
        elseif($selection_type==1)
        {
            $this->db->where('zone_id', $location);
            $this->db->where('LENGTH(territory_id)<', 2);
        }
        elseif($selection_type==2)
        {
            $this->db->where('territory_id', $location);
            $this->db->where('zilla_id', null);
        }
        elseif($selection_type==3)
        {
            $this->db->where('zilla_id', $location);
            $this->db->where('LENGTH(customer_id)<', 2);
        }
        elseif($selection_type==4)
        {
            $this->db->where('customer_id', $location);
        }

        $result = $this->db->get()->row_array();
//        echo $this->db->last_query();
        if($data_type==1)
        {
            $total_quantity = isset($result['total_budgeted'])?$result['total_budgeted']:0;
        }
        elseif($data_type==2)
        {
            $total_quantity = isset($result['total_targeted'])?$result['total_targeted']:0;
        }
        return $total_quantity;
    }

}