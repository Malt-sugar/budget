<?php
class Purchase_helper
{

    public static function get_current_stock($crop_id, $type_id, $variety_id)
    {
        $CI = & get_instance();
        $year = System_helper::get_current_year();

        $sql="SELECT
            (
            SELECT SUM(ppi.quantity) FROM ait_product_purchase_info AS ppi
            WHERE
            ppi.year_id=pi.year_id AND
            ppi.crop_id=pi.crop_id AND
            ppi.product_type_id = pi.product_type_id AND
            ppi.varriety_id = pi.varriety_id
            ) AS Total_HQ_Purchase_Quantity,
            (
            SELECT SUM(ppoi.approved_quantity) FROM ait_product_purchase_order_invoice AS ppoi
            WHERE
            ppoi.year_id=pi.year_id AND
            ppoi.crop_id=pi.crop_id AND
            ppoi.product_type_id = pi.product_type_id AND
            ppoi.varriety_id = pi.varriety_id
            ) AS Total_Sales_Quantity,
            (
            SELECT SUM(ppob.quantity) FROM ait_product_purchase_order_bonus AS ppob
            WHERE
            ppob.year_id=pi.year_id AND
            ppob.crop_id=pi.crop_id AND
            ppob.product_type_id = pi.product_type_id AND
            ppob.varriety_id = pi.varriety_id
            ) AS Total_Bonus_Quantity,
            (
            SELECT SUM(pind.damage_quantity) FROM ait_product_inventory AS pind
            WHERE
            pind.year_id=pi.year_id AND
            pind.crop_id=pi.crop_id AND
            pind.product_type_id = pi.product_type_id AND
            pind.varriety_id = pi.varriety_id
            ) AS Total_Short_Quantity,
            (
            SELECT SUM(pina.access_quantity) FROM ait_product_inventory AS pina
            WHERE
            pina.year_id=pi.year_id AND
            pina.crop_id=pi.crop_id AND
            pina.product_type_id = pi.product_type_id AND
            pina.varriety_id = pi.varriety_id
            ) AS Total_Access_Quantity
            FROM
            ait_product_info AS pi
            LEFT JOIN ait_crop_info ON ait_crop_info.crop_id = pi.crop_id
            LEFT JOIN ait_product_type ON ait_product_type.product_type_id = pi.product_type_id
            LEFT JOIN ait_varriety_info ON ait_varriety_info.varriety_id = pi.varriety_id
            WHERE
            pi.del_status=0
            AND pi.crop_id='".$crop_id."'
            AND pi.product_type_id='".$type_id."'
            AND pi.varriety_id='".$variety_id."'
            AND pi.year_id='".$year."'
            GROUP BY
            pi.year_id, pi.warehouse_id, pi.crop_id, pi.product_type_id, pi.varriety_id
            ORDER BY
            ait_crop_info.order_crop,
            ait_product_type.order_type,
            ait_varriety_info.order_variety";

        $row_result = $CI->db->query($sql)->row_array();

        if($row_result)
        {
            $c_stock=($row_result['Total_HQ_Purchase_Quantity']-(($row_result['Total_Sales_Quantity']+$row_result['Total_Bonus_Quantity']+$row_result['Total_Access_Quantity'])-$row_result['Total_Short_Quantity']));
        }

        if(isset($c_stock))
        {
            return $c_stock;
        }
        else
        {
            return 0;
        }
    }

    public static function get_variety_detail($variety)
    {
        $CI = & get_instance();

        $CI->db->select('avi.varriety_name');
        $CI->db->select('aci.crop_name');
        $CI->db->select('apt.product_type');
        $CI->db->from('ait_varriety_info avi');

        $CI->db->where('avi.type', 0);
        $CI->db->where('avi.varriety_id', $variety);
        $CI->db->join("ait_crop_info aci","aci.crop_id = avi.crop_id","LEFT");
        $CI->db->join("ait_product_type apt","apt.product_type_id = avi.product_type_id","LEFT");

        $CI->db->where('avi.status', 'Active');
        $result = $CI->db->get()->row_array();
        return $result;
    }

    public static function get_budget_min_stock_quantity($crop_id, $type_id, $variety_id)
    {
        $CI = & get_instance();

        $CI->db->from('budget_min_stock_quantity bms');
        $CI->db->select('bms.min_stock_quantity');
        $CI->db->where('bms.crop_id', $crop_id);
        $CI->db->where('bms.type_id', $type_id);
        $CI->db->where('bms.variety_id', $variety_id);
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['min_stock_quantity'];
        }
        else
        {
            return null;
        }
    }

    public static function get_budgeted_sales_quantity($year, $crop_id, $type_id, $variety_id)
    {
        $CI = & get_instance();
        
        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.budgeted_quantity');

        $CI->db->where('bst.crop_id', $crop_id);
        $CI->db->where('bst.type_id', $type_id);
        $CI->db->where('bst.variety_id', $variety_id);
        $CI->db->where('bst.year', $year);

        $CI->db->where('length(bst.customer_id)<2');
        $CI->db->where('length(bst.territory_id)<2');
        $CI->db->where('length(bst.zone_id)<2');
        $CI->db->where('length(bst.division_id)<2');

        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['budgeted_quantity'];
        }
        else
        {
            return null;
        }
    }

}