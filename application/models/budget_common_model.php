<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Budget_common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_territory_by_zone($zone_id)
    {
        $this->db->select('*');
        $this->db->from('ait_territory_info');
        $this->db->where('zone_id',$zone_id);

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function get_customer_by_territory($zone_id, $territory_id)
    {
        $this->db->select('*');
        $this->db->from('ait_distributor_info');
        $this->db->where('zone_id',$zone_id);
        $this->db->where('territory_id',$territory_id);

        $result = $this->db->get()->result_array();
        return $result;
    }
}