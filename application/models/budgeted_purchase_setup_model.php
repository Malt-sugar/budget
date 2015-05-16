<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budgeted_purchase_setup_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_typeInfo($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('rnd_crop_type rct');
        $this->db->select('rct.*');
        $this->db->select('rc.crop_name crop_name');

        $this->db->join('rnd_crop rc', 'rc.id = rct.crop_id', 'left');

        $this->db->where('rct.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("rct.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_total_types()
    {
        $this->db->select('rnd_crop_type.*');
        $this->db->from('rnd_crop_type');

        $this->db->where('status',$this->config->item('status_active'));
        return $this->db->count_all_results();
    }

    public function get_type_row($id)
    {
        $this->db->select('rct.*');
        $this->db->from('rnd_crop_type rct');
        $this->db->select('rc.crop_name crop_name');

        $this->db->join('rnd_crop rc', 'rc.id = rct.crop_id', 'left');
        $this->db->where('rct.id',$id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_type_name_existence($type, $crop_id, $id)
    {
        $this->db->select('rnd_crop_type.*');
        $this->db->from('rnd_crop_type');
        $this->db->where('crop_id',$crop_id);
        $this->db->where('type_name',$type);
        $this->db->where('id !=',$id);

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

    public function check_type_code_existence($type_code, $crop_id, $id)
    {
        $this->db->select('rnd_crop_type.*');
        $this->db->from('rnd_crop_type');
        $this->db->where('crop_id',$crop_id);
        $this->db->where('type_code',$type_code);
        $this->db->where('id !=',$id);

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