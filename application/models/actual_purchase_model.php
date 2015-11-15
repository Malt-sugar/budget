<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actual_purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_purchases()
    {
        $this->db->select('bp.*');
        $this->db->from('budget_purchase_setup bp');

        $this->db->where('bp.purchase_type',$this->config->item('purchase_type_actual'));
        $this->db->where('bp.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_purchase_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_purchase_setup bp');
        $this->db->select('bp.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bp.year', 'left');

        $this->db->where('bp.purchase_type',$this->config->item('purchase_type_actual'));
        $this->db->where('bp.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bp.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_consignment_no_existence($year, $month_of_purchase, $consignment_no, $edit_id)
    {
        $this->db->select('bps.*');
        $this->db->from('budget_purchase_setup bps');
        $this->db->where('bps.year', $year);
        $this->db->where('bps.month_of_purchase', $month_of_purchase);
        $this->db->where('bps.consignment_no', $consignment_no);

        if($edit_id>0)
        {
            $this->db->where('bps.id !=', $edit_id);
        }

        $results = $this->db->get()->row_array();

        if($results)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_purchase_setup($edit_id)
    {
        $this->db->from('budget_purchase_setup bps');
        $this->db->select('bps.*');
        $this->db->where('bps.id', $edit_id);
        $this->db->where('bps.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_purchase_detail($edit_id)
    {
        $this->db->from('budget_purchases bp');
        $this->db->select('bp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bp.setup_id', $edit_id);
        $this->db->where('bp.status', $this->config->item('status_active'));
        $this->db->join('ait_varriety_info avi', 'avi.varriety_id = bp.variety_id', 'left');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_variety_by_crop_type($crop_id, $type_id)
    {
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $this->db->order_by('avi.order_variety');
        $this->db->where('avi.type', 0);
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_varieties($year)
    {
        $this->db->from('budget_purchase_quantity bp');
        $this->db->select('bp.*');
        $this->db->where('bp.year', $year);
        $this->db->where('bp.purchase_type',$this->config->item('purchase_type_budget'));
        $results = $this->db->get()->result_array();

        foreach($results as $result)
        {
            $varieties[] = $result['variety_id'];
        }

        return $varieties;
    }

    public function get_budget_setup_id()
    {
        $this->db->select('bdc.id');
        $this->db->from('budget_direct_cost bdc');

        $this->db->where('bdc.purchase_type',$this->config->item('purchase_type_budget'));
        $result = $this->db->get()->row_array();
        return $result['id'];
    }

    public function check_budget_setup()
    {
        $this->db->select('bdc.id');
        $this->db->from('budget_direct_cost bdc');
        $this->db->where('bdc.purchase_type',$this->config->item('purchase_type_budget'));
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

    public function get_variety_info($variety_id)
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->from('ait_varriety_info avi');

        $this->db->where('avi.type', 0);
        $this->db->where('avi.varriety_id', $variety_id);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function get_existing_purchase_and_id($edit_id, $variety_id)
    {
        $this->db->from('budget_purchases bp');
        $this->db->select('bp.id');

        $this->db->where('bp.setup_id', $edit_id);
        $this->db->where('bp.variety_id', $variety_id);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['id'];
        }
        else
        {
            return false;
        }
    }

    public function actual_purchase_initial_update($edit_id)
    {
        $data = array('status'=>0);
        $this->db->where('setup_id',$edit_id);
        $this->db->update('budget_purchases',$data);
    }

    public function get_direct_costs($year)
    {
        $this->db->from('budget_direct_cost bdc');
        $this->db->select('bdc.*');
        $this->db->where('bdc.year', $year);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public function get_final_target($year, $variety)
    {
        $this->db->from('budget_principal_quantity bpq');
        $this->db->select('bpq.actual_purchase');
        $this->db->where('bpq.year', $year);
        $this->db->where('bpq.variety_id', $variety);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['actual_purchase'];
        }
        else
        {
            return 0;
        }
    }
}