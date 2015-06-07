<?php
class System_helper
{
    public static function pagination_config($base_url, $total_rows, $segment)
    {
        $CI =& get_instance();

        $config["base_url"] = $base_url;
        $config["total_rows"] = $total_rows;
        $config["per_page"] = $CI->config->item('view_per_page');
        $config['num_links'] = $CI->config->item('links_per_page');
        $config['use_page_numbers'] = true;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['uri_segment'] = $segment;
        return $config;
    }

    public static function display_date($date)
    {
        return date('d-M-Y',$date);
    }

    public static function get_time($str)
    {
        $time=strtotime($str);
        if($time===false)
        {
            return 0;
        }
        else
        {
            return $time;
        }
    }

    public static function upload_file($save_dir="images")
    {
        $CI = & get_instance();
        $CI->load->library('upload');
        $config=array();
        $config['upload_path'] = FCPATH.$save_dir;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = $CI->config->item("max_file_size");
        $config['overwrite'] = false;
        $config['remove_spaces'] = true;

        $uploaded_files=array();
        foreach ($_FILES as $key => $value)
        {
            if(strlen($value['name'])>0)
            {
                $CI->upload->initialize($config);
                if (!$CI->upload->do_upload($key))
                {
                    $uploaded_files[$key]=array("status"=>false,"message"=>$value['name'].': '.$CI->upload->display_errors());
                }
                else
                {
                    $uploaded_files[$key]=array("status"=>true,"info"=>$CI->upload->data());
                }
            }
        }

        return $uploaded_files;
    }

    public static function get_pdf($html)
    {
        include(FCPATH."mpdf60/mpdf.php");
        $mpdf=new mPDF();
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);
        $mpdf->Output();
        exit;
    }

    public static function get_zi_approval($customer_id, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.is_approved_by_zi');
        $CI->db->where('bst.customer_id', $customer_id);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $CI->db->group_by('bst.is_approved_by_zi');
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>1)
        {
            return false;
        }
        else
        {
            foreach($results as $result)
            {
                if($result['is_approved_by_zi']==1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }

    public static function get_di_approval($customer_id, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.is_approved_by_di');
        $CI->db->where('bst.customer_id', $customer_id);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $CI->db->group_by('bst.is_approved_by_di');
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>1)
        {
            return false;
        }
        else
        {
            foreach($results as $result)
            {
                if($result['is_approved_by_di']==1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }

    public static function get_hom_approval($customer_id, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('bst.is_approved_by_hom');
        $CI->db->where('bst.customer_id', $customer_id);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $CI->db->group_by('bst.is_approved_by_hom');
        $results = $CI->db->get()->result_array();

        if(sizeof($results)>1)
        {
            return false;
        }
        else
        {
            foreach($results as $result)
            {
                if($result['is_approved_by_hom']==1)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }

    public static function get_prediction_detail($variety_id, $con, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction bsp');
        $CI->db->where('bsp.variety_id', $variety_id);
        $CI->db->where('bsp.prediction_phase', $con);
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();
        if($result)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }

    public static function get_finalisation_info($year, $con)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction_finalise bsp');
        $CI->db->where('bsp.prediction_phase', $con);
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function check_prediction_delete_permission($crop, $type, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction bsp');
        $CI->db->where('bsp.prediction_phase', $CI->config->item('prediction_phase_management'));
        $CI->db->where('bsp.crop_id', $crop);
        $CI->db->where('bsp.type_id', $type);
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->result_array();
        if(sizeof($result)>0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    public static function get_cogs_and_total_cogs($quantity, $price_per_kg, $conversion, $lc, $insurance, $packing, $carriage, $air_freight, $type)
    {
        if($type==1) // cogs
        {
            $initial = $price_per_kg;
        }
        elseif($type==2) // total cogs
        {
            $initial = $price_per_kg*$quantity;
        }

        $cogs = $initial;
        if($conversion>0)
        {
            $cogs = $cogs + $initial*($conversion/100);
        }

        if($lc>0)
        {
            $cogs = $cogs + $initial*($lc/100);
        }

        if($insurance>0)
        {
            $cogs = $cogs + $initial*($insurance/100);
        }

        if($packing>0)
        {
            $cogs = $cogs + $initial*($packing/100);
        }

        if($carriage>0)
        {
            $cogs = $cogs + $initial*($carriage/100);
        }

        if($air_freight>0)
        {
            $cogs = $cogs + $initial*($air_freight/100);
        }

        return round($cogs, 2);
    }

    public static function get_current_year()
    {
        $CI = & get_instance();

        $CI->db->from('ait_year ay');
        $CI->db->select('ay.*');
        $CI->db->where("DATE_FORMAT(start_date,'%Y-%m-%d') <=",date('Y-m-d'));
        $CI->db->where("DATE_FORMAT(end_date,'%Y-%m-%d') >=",date('Y-m-d'));
        $result = $CI->db->get()->row_array();
        return $result['year_id'];
    }

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

        $c_stock=($row_result['Total_HQ_Purchase_Quantity']-(($row_result['Total_Sales_Quantity']+$row_result['Total_Bonus_Quantity']+$row_result['Total_Access_Quantity'])-$row_result['Total_Short_Quantity']));
        return $c_stock;
    }

    public static function get_mrp_of_last_years($variety,$number)
    {
        $CI = & get_instance();
        $years = System_helper::get_last_years($number);

        $CI->db->from('budget_sales_prediction bsp');
        $CI->db->select('bsp.budgeted_mrp');
        $CI->db->where('bsp.prediction_phase', $CI->config->item('prediction_phase_final'));
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where_in("bsp.year", $years);
        $results = $CI->db->get()->result_array();

        $total = 0;
        if($results && sizeof($years)>0)
        {
            foreach($results as $result)
            {
                $total = $total + $result['budgeted_mrp'];
            }

            $avg_mrp = $total/sizeof($years);
            return $avg_mrp;
        }
        else
        {
            return 0;
        }
    }

    public static function get_last_years($number)
    {
        $CI = & get_instance();
        $CI->db->from('ait_year ay');
        $CI->db->select('ay.year_id');
        $CI->db->order_by('year_name', 'DESC');
        $CI->db->limit($number);
        $results = $CI->db->get()->result_array();
        if($results)
        {
            foreach($results as $result)
            {
                $years[] = $result['year_id'];
            }

            return $years;
        }
        else
        {
            $years = array();
            return $years;
        }
    }
}