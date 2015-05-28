<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_prediction_setup_model extends CI_Model
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
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));
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
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));
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
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));
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
        $this->db->select('bsps.ho_and_general_exp, bsps.marketing, bsps.finance_cost');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));
        $this->db->where('bsp.status',$this->config->item('status_active'));

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $this->db->join('budget_sales_prediction_setup bsps', 'bsps.year = bsp.year', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_varieties($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_initial'));
        $results = $this->db->get()->result_array();
        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function get_prediction_setup_id($year)
    {
        $this->db->select('bsps.id');
        $this->db->from('budget_sales_prediction_setup bsps');
        $this->db->where('bsps.year',$year);
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function check_budget_setup()
    {
        $this->db->select('bps.id');
        $this->db->from('budget_purchase_setup bps');
        $this->db->where('bps.purchase_type',$this->config->item('purchase_type_budget'));
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

    public function check_sales_prediction_existence($year)
    {
        $this->db->from('budget_sales_prediction_setup bsps');
        $this->db->select('bsps.*');
        $this->db->where('bsps.year', $year);
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