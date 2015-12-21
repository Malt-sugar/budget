<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_sales_target_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_customers()
    {
        $user = User_helper::get_user();
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.customer_id, bst.year');
        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');
        $this->db->where('bst.status',$this->config->item('status_active'));

        if($user->budget_group > $this->config->item('user_group_marketing'))
        {
            $this->db->where('bst.division_id', $user->division_id);
        }

        if($user->budget_group > $this->config->item('user_group_division'))
        {
            $this->db->where('bst.zone_id', $user->zone_id);
        }

        if($user->budget_group > $this->config->item('user_group_zone'))
        {
            $this->db->where('bst.territory_id', $user->territory_id);
        }

        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_sales_target_info($page=null)
    {
        $user = User_helper::get_user();
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('ati.territory_name');
        $this->db->select('adi.distributor_name');
        $this->db->select('ay.year_name');
        $this->db->select('az.zillanameeng');

        $this->db->join('ait_territory_info ati', 'ati.territory_id = bst.territory_id', 'left');
        $this->db->join('ait_distributor_info adi', 'adi.distributor_id = bst.customer_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'left');
        $this->db->join('ait_zilla az', 'az.zillaid = bst.zilla_id', 'left');

        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');
        $this->db->where('length(bst.customer_id)>2');

        if($user->budget_group > $this->config->item('user_group_marketing'))
        {
            $this->db->where('bst.division_id', $user->division_id);
        }

        if($user->budget_group > $this->config->item('user_group_division'))
        {
            $this->db->where('bst.zone_id', $user->zone_id);
        }

        if($user->budget_group > $this->config->item('user_group_zone'))
        {
            $this->db->where('bst.territory_id', $user->territory_id);
        }

        $this->db->where('bst.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bst.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_sales_target_detail($customer_id, $year_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('avi.varriety_name variety_name');

        $this->db->where('bst.customer_id', $customer_id);
        $this->db->where('bst.year', $year_id);
        $this->db->where('bst.status',$this->config->item('status_active'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bst.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_sales_targets($customer, $year)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->where('bst.year',$year);
        $this->db->where('bst.customer_id',$customer);
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function get_existing_sales_targets_records($customer, $year)
    {
        $this->db->from('budget_sales_target_record bstr');
        $this->db->select('bstr.*');
        $this->db->where('bstr.year',$year);
        $this->db->where('bstr.customer_id',$customer);
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function check_customer_existence($customer_id, $year_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->where('bst.year',$year_id);
        $this->db->where('bst.customer_id',$customer_id);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_prediction_years($year_id)
    {
        $prediction_array = array();
        $prediction_config = $this->config->item('prediction_years');

        $this->db->from('ait_year year');
        $this->db->select('year.year_name');
        $this->db->where('year.year_id',$year_id);
        $result = $this->db->get()->row_array();
        $year = $result['year_name'];

        for($i=0; $i<$prediction_config; $i++)
        {
            $year++;
            $this->db->from('ait_year year');
            $this->db->select('year.year_id');
            $this->db->where('year.year_name',$year);
            $result = $this->db->get()->row_array();
            if(sizeof($result)>0 && strlen($result['year_id'])>1)
            {
                $prediction_array[] = array('year_id'=>$result['year_id'], 'year_name'=>$year);
            }
        }
        return $prediction_array;
    }

    public function prediction_initial_update($year, $customer)
    {
        $data = array('status'=>0);
        $this->db->where('prediction_year', $year);
        $this->db->where('customer_id', $customer);
        $this->db->update('budget_sales_target_prediction',$data);
    }

    public function get_existing_predictions($prediction_year, $customer, $year, $variety_id)
    {
        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('bstp.*');
        $this->db->where('bstp.prediction_year',$prediction_year);
        $this->db->where('bstp.year',$year);
        $this->db->where('bstp.variety_id',$variety_id);
        $this->db->where('bstp.customer_id',$customer);
        $result = $this->db->get()->row_array();

        if(is_array($result) && sizeof($result)>0)
        {
            return $result['id'];
        }
        else
        {
            return null;
        }
    }

    public function get_prediction_quantity($prediction_year, $year, $variety, $customer)
    {
        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('bstp.*');
        $this->db->where('bstp.prediction_year',$prediction_year);
        $this->db->where('bstp.year',$year);
        $this->db->where('bstp.variety_id',$variety);
        $this->db->where('bstp.customer_id',$customer);
        $result = $this->db->get()->row_array();

        if(is_array($result) && sizeof($result)>0)
        {
            return $result['budgeted_quantity'];
        }
        else
        {
            return 0;
        }
    }

}