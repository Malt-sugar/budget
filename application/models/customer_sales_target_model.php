<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_sales_target_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_cropInfo($page=0)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('rnd_crop rc');
        $this->db->select('rc.*');

        $this->db->where('rc.status != ',$this->config->item('status_delete'));
        $this->db->limit($limit,$start);
        $this->db->order_by("rc.ordering","ASC");
        $this->db->order_by("rc.id","ASC");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_total_crops()
    {
        $this->db->select('rnd_crop.*');
        $this->db->from('rnd_crop');

        $this->db->where('status != ',$this->config->item('status_delete'));
        return $this->db->count_all_results();
    }

    public function get_crop_info($id)
    {
        $this->db->select('*');
        $this->db->from('rnd_crop');
        $this->db->where('id',$id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_crop_name_existence($crop_name)
    {
        $this->db->select('rnd_crop.id');
        $this->db->from('rnd_crop');
        $this->db->where('crop_name',$crop_name);

        $result = $this->db->count_all_results();

        if($result>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function check_crop_code_existence($crop_code)
    {
        $this->db->select('id');
        $this->db->from('rnd_crop');
        $this->db->where('crop_code',$crop_code);

        $result = $this->db->count_all_results();

        if($result>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}