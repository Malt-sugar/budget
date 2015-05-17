<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Achievement_bonus_setup_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_variety_for_min_stock_by_crop_type($crop_id, $type_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();
        return $results;
    }

}