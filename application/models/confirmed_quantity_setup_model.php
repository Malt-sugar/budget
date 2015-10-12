<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Confirmed_quantity_setup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_total_purchase_years()
    {
        $this->db->select('bp.*');
        $this->db->from('budget_purchase_quantity bp');
        $this->db->group_by('bp.year');
        $this->db->where('bp.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_purchase_year_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_purchase_quantity bp');
        $this->db->select('bp.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bp.year', 'left');

        $this->db->group_by('bp.year');
        $this->db->where('bp.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bp.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_quantity_year_existence($year)
    {
        $this->db->select('bp.*');
        $this->db->from('budget_purchase_quantity bp');
        $this->db->where('bp.year', $year);
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

    public function get_confirmed_quantity_detail($year)
    {
        $this->db->from('budget_purchase_quantity bp');
        $this->db->select('bp.*');
        $this->db->select('avi.varriety_name variety_name');
        $this->db->where('bp.year', $year);
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

    public function check_budget_purchase_year_existence($year)
    {
        $this->db->from('budget_purchase_quantity bp');
        $this->db->select('bp.*');
        $this->db->where('bp.year', $year);
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

    public function get_budgeted_sales_quantity($year, $crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.budgeted_quantity');

        $this->db->where('bst.crop_id', $crop_id);
        $this->db->where('bst.type_id', $type_id);
        $this->db->where('bst.variety_id', $variety_id);
        $this->db->where('bst.year', $year);

        $this->db->where('length(bst.customer_id)<2');
        $this->db->where('length(bst.territory_id)<2');
        $this->db->where('length(bst.zone_id)<2');
        $this->db->where('length(bst.division_id)<2');

        $this->db->where('bst.status', $this->config->item('status_active'));
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['budgeted_quantity'];
        }
        else
        {
            return null;
        }
    }

    public function get_budget_min_stock_quantity($crop_id, $type_id, $variety_id)
    {
        $this->db->from('budget_min_stock_quantity bms');
        $this->db->select('bms.min_stock_quantity');
        $this->db->where('bms.crop_id', $crop_id);
        $this->db->where('bms.type_id', $type_id);
        $this->db->where('bms.variety_id', $variety_id);
        $result = $this->db->get()->row_array();

        if($result)
        {
            return $result['min_stock_quantity'];
        }
        else
        {
            return null;
        }
    }

    public function get_variety_info($variety_id)
    {
        $this->db->select('avi.varriety_name');
        $this->db->select('aci.crop_name');
        $this->db->select('apt.product_type');
        $this->db->from('ait_varriety_info avi');
        $this->db->select('avi.*');

        $this->db->where('avi.type', 0);
        $this->db->where('avi.varriety_id', $variety_id);
        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function check_confirmed_quantity_existence($year, $crop, $type, $variety)
    {
        $this->db->from('budget_purchase_quantity bpq');
        $this->db->select('bpq.*');
        $this->db->where('bpq.year', $year);
        $this->db->where('bpq.crop_id', $crop);
        $this->db->where('bpq.type_id', $type);
        $this->db->where('bpq.variety_id', $variety);
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

    public function confirmed_quantity_initial_update($year)
    {
        $data = array('status'=>0);
        $this->db->where('year',$year);

        $this->db->update('budget_purchase_quantity',$data);
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

        $this->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $this->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $this->db->where('avi.status', 'Active');
        $results = $this->db->get()->result_array();
        return $results;
    }

    public function get_existing_month_edit_id($year, $variety_id, $month)
    {
        $this->db->from('budget_purchase_months bpm');
        $this->db->select('bpm.id');
        $this->db->where('bpm.year', $year);
        $this->db->where('bpm.month', $month);
        $this->db->where('bpm.variety_id', $variety_id);
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

    public function budget_month_initial_update($year)
    {
        $data = array('status'=>0);
        $this->db->where('year',$year);

        $this->db->update('budget_purchase_months',$data);
    }
}