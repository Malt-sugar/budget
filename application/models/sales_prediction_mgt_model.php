<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_prediction_mgt_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_prediction_years()
    {
        $this->db->select('bsp.*');
        $this->db->from('budget_sales_prediction bsp');
        $this->db->group_by('bsp.year');
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_prediction_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bsp.year', 'left');

        $this->db->group_by('bsp.year');
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bsp.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_budget_purchase_existence()
    {
        $this->db->select('bsp.*');
        $this->db->from('budget_sales_prediction bsp');
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $results = $this->db->get()->result_array();
        if($results)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_prediction_detail($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->select('bspp.targeted_profit');

        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bsp.year', $year);
        $this->db->where('bspp.year', $year);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $this->db->where('bspp.prediction_phase',$this->config->item('prediction_phase_initial'));

        $this->db->join('budget_sales_prediction bspp','bsp.crop_id = bspp.crop_id AND bsp.type_id = bspp.type_id AND bsp.variety_id = bspp.variety_id','LEFT');
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->select('bsp.targeted_profit, bsp.sales_commission, bsp.sales_bonus, bsp.other_incentive');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));

        $this->db->join('budget_sales_prediction bsp','bsp.crop_id = avi.crop_id AND bsp.type_id = avi.product_type_id AND bsp.variety_id = avi.varriety_id','LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_varieties($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function check_sales_prediction_mgt_existence($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_management'));
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

    public function check_sales_prediction_setup_existence($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_initial'));
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
}