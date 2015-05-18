<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_sales_target_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    public function get_existing_sales_targets($year, $crop, $type, $customer)
    {
        $user = User_helper::get_user();
        $this->db->select('bst.variety_id');
        $this->db->from('budget_sales_target bst');
        $this->db->where('bst.year',$year);
        $this->db->where('bst.crop_id',$crop);

        $query = $this->db->get();
        return $query->row_array();
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