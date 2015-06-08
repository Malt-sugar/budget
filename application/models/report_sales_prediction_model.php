<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_sales_prediction_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_initial_prediction_detail($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->select('aci.crop_name crop_name');
        $this->db->select('ati.product_type type_name');
        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_initial'));
        $this->db->select('bsps.ho_and_general_exp ho_and_general_exp');
        $this->db->select('bsps.marketing marketing');
        $this->db->select('bsps.finance_cost finance_cost');

        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }
        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }

        $this->db->join('budget_sales_prediction_setup bsps', 'bsps.year = bsp.year', 'left');
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'left');
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $initial_result = $this->db->get()->result_array();
        return $initial_result;
    }

    public function get_mgt_prediction_detail($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.sales_commission mgt_sales_commission');
        $this->db->select('bsp.sales_bonus mgt_sales_bonus');
        $this->db->select('bsp.other_incentive mgt_other_incentive');
        $this->db->select('bsp.budgeted_mrp mgt_budgeted_mrp');

        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_management'));

        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }
        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'left');
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $initial_result = $this->db->get()->result_array();
        return $initial_result;
    }

    public function get_mkt_prediction_detail($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.sales_commission mkt_sales_commission');
        $this->db->select('bsp.sales_bonus mkt_sales_bonus');
        $this->db->select('bsp.other_incentive mkt_other_incentive');
        $this->db->select('bsp.budgeted_mrp mkt_budgeted_mrp');

        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_marketing'));

        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }
        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'left');
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $initial_result = $this->db->get()->result_array();
        return $initial_result;
    }

    public function get_final_prediction_detail($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_prediction bsp');
        $this->db->select('bsp.sales_commission final_sales_commission');
        $this->db->select('bsp.sales_bonus final_sales_bonus');
        $this->db->select('bsp.other_incentive final_other_incentive');
        $this->db->select('bsp.budgeted_mrp final_budgeted_mrp');

        $this->db->where('bsp.prediction_phase', $this->config->item('prediction_phase_final'));

        if(strlen($crop_id)>1)
        {
            $this->db->where('bsp.crop_id', $crop_id);
        }
        if(strlen($type_id)>1)
        {
            $this->db->where('bsp.type_id', $type_id);
        }
        if(strlen($variety_id)>1)
        {
            $this->db->where('bsp.variety_id', $variety_id);
        }
        if(strlen($year)>1)
        {
            $this->db->where('bsp.year', $year);
        }

        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bsp.variety_id', 'left');
        $this->db->join('ait_crop_info aci', 'aci.crop_id = bsp.crop_id', 'left');
        $this->db->join('ait_product_type ati', 'ati.product_type_id = bsp.type_id', 'left');
        $this->db->where('bsp.status',$this->config->item('status_active'));
        $initial_result = $this->db->get()->result_array();
        return $initial_result;
    }

}