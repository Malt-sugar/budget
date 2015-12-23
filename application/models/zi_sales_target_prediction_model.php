<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Zi_sales_target_prediction_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_variety_info()
    {
        $user = User_helper::get_user();
        $this->db->select('avi.varriety_id, avi.varriety_name');
        $this->db->select('aci.crop_name, aci.order_crop');
        $this->db->select('apt.product_type, apt.order_type');
        $this->db->select('avi.crop_id, avi.product_type_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_varieties_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->select('avi.crop_id');
        $this->db->select('avi.product_type_id');
        $this->db->select('avi.varriety_id');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);

        if(isset($crop_id) && strlen($crop_id)>1)
        {
            $this->db->where('avi.crop_id', $crop_id);
        }

        if(isset($type_id) && strlen($type_id)>1)
        {
            $this->db->where('avi.product_type_id', $type_id);
        }

        $this->db->order_by('aci.order_crop');
        $this->db->order_by('apt.order_type');
        $this->db->order_by('avi.order_variety');

        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
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

    public function get_zone_sales_prediction($year, $variety)
    {
        $user = User_helper::get_user();
        $user_zone = $user->zone_id;

        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('SUM(bstp.budgeted_quantity) total_quantity');
        $this->db->where('bstp.year',$year);
        $this->db->where('bstp.variety_id',$variety);
        $this->db->where('bstp.zone_id', $user_zone);
        $this->db->where('length(bstp.territory_id)>2');
        $this->db->where('length(bstp.customer_id)<2');
        $result = $this->db->get()->row_array();

        if(sizeof($result)>0 && $result['total_quantity']>0)
        {
            return $result['total_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public function get_zi_sales_target_existence($year, $prediction_year, $variety)
    {
        $user = User_helper::get_user();
        $user_zone = $user->zone_id;
        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('bstp.*');
        $this->db->where('bstp.year',$year);
        $this->db->where('bstp.prediction_year',$prediction_year);
        $this->db->where('bstp.variety_id',$variety);
        $this->db->where('bstp.zone_id', $user_zone);
        $this->db->where('length(bstp.territory_id)<2');
        $this->db->where('length(bstp.customer_id)<2');
        $result = $this->db->get()->row_array();

        if(is_array($result) && sizeof($result)>0)
        {
            return $result['id'];
        }
        else
        {
            return false;
        }
    }

    public function get_existing_prediction($year, $prediction_year, $variety)
    {
        $user = User_helper::get_user();
        $user_zone = $user->zone_id;
        $this->db->from('budget_sales_target_prediction bstp');
        $this->db->select('bstp.*');
        $this->db->where('bstp.year',$year);
        $this->db->where('bstp.prediction_year',$prediction_year);
        $this->db->where('bstp.variety_id',$variety);
        $this->db->where('bstp.zone_id', $user_zone);
        $this->db->where('length(bstp.territory_id)<2');
        $this->db->where('length(bstp.customer_id)<2');
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