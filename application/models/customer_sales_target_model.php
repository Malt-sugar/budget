<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_sales_target_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_total_customers()
    {
        $user = User_helper::get_user();
        $this->db->from('budget_sales_target bst');

        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');

        $this->db->where('bst.status',$this->config->item('status_active'));

        $count = $this->db->count_all_results();
        //echo $this->db->last_query();
        return $count;
    }

    public function get_sales_target_info($page=null)
    {
        $limit=$this->config->item('view_per_page');
        $start=$page*$limit;
        $this->db->from('budget_sales_target bst');
        $this->db->select('bst.*');
        $this->db->select('ati.territory_name');
        $this->db->select('adi.distributor_name');
        $this->db->select('ay.year_name');

        $this->db->join('ait_territory_info ati', 'ati.territory_id = bst.territory_id', 'left');
        $this->db->join('ait_distributor_info adi', 'adi.distributor_id = bst.customer_id', 'left');
        $this->db->join('ait_year ay', 'ay.year_id = bst.year', 'left');

        $this->db->group_by('bst.customer_id');
        $this->db->group_by('bst.year');

        $this->db->where('bst.status',$this->config->item('status_active'));
        $this->db->limit($limit,$start);
        $this->db->order_by("bst.id","DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_variety_by_crop_type($crop_id, $type_id, $year, $customer_id)
    {
        $user = User_helper::get_user();
        $this->db->select('avi.*');
        $this->db->from('ait_varriety_info avi');
        $this->db->where('avi.crop_id',$crop_id);
        $this->db->where('avi.product_type_id',$type_id);
        $results = $this->db->get()->result_array();

        if(is_array($results) && sizeof($results)>0)
        {
            foreach($results as &$result)
            {
                $this->db->from('budget_sales_target bst');
                $this->db->select('bst.quantity, bst.is_approved_by_zi');
                $this->db->where('bst.created_by',$user->user_id);
                $this->db->where('bst.year',$year);
                $this->db->where('bst.customer_id',$customer_id);
                $this->db->where('bst.variety_id', $result['varriety_id']);
                $this->db->where('bst.crop_id', $result['crop_id']);
                $this->db->where('bst.type_id', $result['product_type_id']);
                $sales = $this->db->get()->row_array();

                if($sales)
                {
                    $result['quantity'] = $sales['quantity'];
                    $result['is_approved_by_zi'] = $sales['is_approved_by_zi'];
                }
            }
        }

        return $results;
    }

}