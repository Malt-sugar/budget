<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_prediction_mkt_model extends CI_Model
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

        $this->db->join('budget_sales_prediction_finalise spf', 'spf.year = bsp.year AND spf.prediction_phase = bsp.prediction_phase', 'inner');
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

        $this->db->join('budget_sales_prediction_finalise spf', 'spf.year = bsp.year AND spf.prediction_phase = bsp.prediction_phase', 'inner');
        $this->db->limit($limit,$start);
        $this->db->order_by("bsp.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_prediction_detail($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');

        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bsp.year', $year);

        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));
        $this->db->where('bsp.status',$this->config->item('status_active'));

        $where = '(bsp.targeted_profit > 0 or bsp.sales_commission > 0 or bsp.sales_bonus > 0 or bsp.other_incentive > 0)';
        $this->db->where($where);

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->select('bsp.sales_commission, bsp.sales_bonus, bsp.other_incentive');
        $this->db->select('bsps.targeted_profit targeted_profit');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_management'));

        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $this->db->join('budget_sales_prediction bsp','bsp.crop_id = avi.crop_id AND bsp.type_id = avi.product_type_id AND bsp.variety_id = avi.varriety_id','LEFT');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_varieties($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase',$this->config->item('prediction_phase_marketing'));
        $results = $this->db->get()->result_array();

        if(is_array($results) && sizeof($results)>0)
        {
            foreach($results as $result)
            {
                $varieties[] = $result['variety_id'];
            }
        }
        else
        {
            $varieties = array();
        }

        return $varieties;
    }

    public function check_sales_prediction_mkt_existence($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_marketing'));
        $result = $this->db->get()->result_array();

        if(sizeof($result)>0)
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
        $result = $this->db->get()->result_array();

        if(sizeof($result)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_prediction_mkt_existence($year)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->where('bsp.year', $year);
        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_marketing'));
        $result = $this->db->get()->result_array();

        if(sizeof($result)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}