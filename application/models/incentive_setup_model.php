<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Incentive_setup_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function get_total_incentive_setups()
    {
        $this->db->select('bis.*');
        $this->db->from('budget_incentive_setup bis');
        $this->db->where('bis.status',$this->config->item('status_active'));
        $result = $this->db->get()->result_array();
        return sizeof($result);
    }

    public function get_setup_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_incentive_setup bis');
        $this->db->select('bis.*');

        $this->db->select('ay.year_name');
        $this->db->join('ait_year ay', 'ay.year_id = bis.year', 'left');

        $this->db->group_by('bis.year');
        $this->db->where('bis.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bis.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_incentive_data($id)
    {
        $this->db->select('bis.*');
        $this->db->from('budget_incentive_setup bis');
        $this->db->where('bis.id', $id);
        $result = $this->db->get()->row_array();

        if($result)
        {
            $this->db->select('bid.setup_id, bid.lower_limit, bid.upper_limit, bid.achievement');
            $this->db->from('budget_incentive_detail bid');
            $this->db->where('bid.setup_id', $id);
            $this->db->where('bid.status', $this->config->item('status_active'));
            $query = $this->db->get();
            $detail_result = $query->result_array();
            if($detail_result && sizeof($detail_result)>0)
            {
                $result['detail'] = $detail_result;
            }
            else
            {
                $result['detail'] = array();
            }
        }
        return $result;
    }

    public function initial_update_incentive_detail($id)
    {
        $this->db->where('setup_id', $id);
        $this->db->delete('budget_incentive_detail');
    }

    public function check_budget_purchase_year_existence($id, $year)
    {
        $this->db->select('budget_direct_cost.*');
        $this->db->from('budget_direct_cost');

        $this->db->where('year', $year);
        $this->db->where('id !=', $id);

        $this->db->where('purchase_type',$this->config->item('purchase_type_budget'));
        $result = $this->db->get()->row_array();
        if(is_array($result) && sizeof($result)>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}