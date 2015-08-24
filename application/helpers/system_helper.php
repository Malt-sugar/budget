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
        $cogs = 0;

        if($lc>0)
        {
            $cogs =  $price_per_kg*($lc/100);
        }
        if($insurance>0)
        {
            $cogs = $cogs + $price_per_kg*($insurance/100);
        }
        if($packing>0)
        {
            $cogs = $cogs + $price_per_kg*($packing/100);
        }
        if($carriage>0)
        {
            $cogs = $cogs + $price_per_kg*($carriage/100);
        }


        if($air_freight>0)
        {
            $cogs = $cogs + $price_per_kg*($air_freight/100);
        }

        $revised_cogs = $cogs + $price_per_kg;

        if($type==1)
        {
            $final_cogs = $revised_cogs;
        }
        else
        {
            $final_cogs = $revised_cogs*$quantity;
        }

        return round($final_cogs, 2);
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

    public static function calculate_net_profit($year, $variety, $mrp, $sales_commission, $sales_bonus, $other_incentive)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction_setup sps');
        $CI->db->select('sps.*');
        $CI->db->where('sps.year', $year);
        $prediction_setup = $CI->db->get()->row_array();

        $ho_and_general_exp = $prediction_setup['ho_and_general_exp'];
        $marketing = $prediction_setup['marketing'];
        $finance_cost = $prediction_setup['finance_cost'];

        $CI->db->from('budget_purchase bp');
        $CI->db->select('bp.*');
        $CI->db->where('bp.year', $year);
        $CI->db->where('bp.variety_id', $variety);
        $purchase = $CI->db->get()->row_array();

        if(isset($purchase['price_per_kg']))
        {
            $price_per_kg = $purchase['price_per_kg'];
        }
        else
        {
            $price_per_kg = 0;
        }

        $CI->db->from('budget_purchase_setup bps');
        $CI->db->select('bps.*');
        $CI->db->where('bps.purchase_type', $CI->config->item('purchase_type_budget'));
        $purchase_setup = $CI->db->get()->row_array();

        $lc_exp = $purchase_setup['lc_exp'];
        $insurance_exp = $purchase_setup['insurance_exp'];
        $packing_material = $purchase_setup['packing_material'];
        $carriage_inwards = $purchase_setup['carriage_inwards'];
        $air_freight_and_docs = $purchase_setup['air_freight_and_docs'];

        $cogs = 0;

        if($lc_exp>0)
        {
            $cogs =  $price_per_kg*($lc_exp/100);
        }
        if($insurance_exp>0)
        {
            $cogs = $cogs + $price_per_kg*($insurance_exp/100);
        }
        if($packing_material>0)
        {
            $cogs = $cogs + $price_per_kg*($packing_material/100);
        }
        if($carriage_inwards>0)
        {
            $cogs = $cogs + $price_per_kg*($carriage_inwards/100);
        }


        if($air_freight_and_docs>0)
        {
            $cogs = $cogs + $price_per_kg*($air_freight_and_docs/100);
        }

        $revised_cogs = $cogs + $price_per_kg;

        if($ho_and_general_exp>0)
        {
            $pricing_expenses = $revised_cogs*($ho_and_general_exp/100);
        }
        if($marketing>0)
        {
            $pricing_expenses = $pricing_expenses + $revised_cogs*($marketing/100);
        }
        if($finance_cost>0)
        {
            $pricing_expenses = $pricing_expenses + $cogs*($finance_cost/100);
        }

        $final_cogs = $pricing_expenses + $revised_cogs;


        if($sales_commission>0)
        {
            $bonus_exp = $mrp*($sales_commission/100);
        }
        if($sales_bonus>0)
        {
            $bonus_exp = $bonus_exp + $mrp*($sales_bonus/100);
        }
        if($other_incentive>0)
        {
            $bonus_exp = $bonus_exp + $mrp*($other_incentive/100);
        }

        if(isset($bonus_exp) && $bonus_exp>0)
        {
            $net_profit = $mrp - $bonus_exp - $final_cogs;
        }
        else
        {
            $net_profit = $mrp - $final_cogs;
        }

        return round($net_profit, 2);
    }

    public static function calculate_net_profit_percentage($year, $variety, $mrp, $sales_commission, $sales_bonus, $other_incentive)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction_setup sps');
        $CI->db->select('sps.*');
        $CI->db->where('sps.year', $year);
        $prediction_setup = $CI->db->get()->row_array();

        $ho_and_general_exp = $prediction_setup['ho_and_general_exp'];
        $marketing = $prediction_setup['marketing'];
        $finance_cost = $prediction_setup['finance_cost'];

        $CI->db->from('budget_purchase bp');
        $CI->db->select('bp.*');
        $CI->db->where('bp.year', $year);
        $CI->db->where('bp.variety_id', $variety);
        $purchase = $CI->db->get()->row_array();

        if(isset($purchase['price_per_kg']))
        {
            $price_per_kg = $purchase['price_per_kg'];
        }
        else
        {
            $price_per_kg = 0;
        }

        $CI->db->from('budget_purchase_setup bps');
        $CI->db->select('bps.*');
        $CI->db->where('bps.purchase_type', $CI->config->item('purchase_type_budget'));
        $purchase_setup = $CI->db->get()->row_array();

        $lc_exp = $purchase_setup['lc_exp'];
        $insurance_exp = $purchase_setup['insurance_exp'];
        $packing_material = $purchase_setup['packing_material'];
        $carriage_inwards = $purchase_setup['carriage_inwards'];
        $air_freight_and_docs = $purchase_setup['air_freight_and_docs'];

        $cogs = 0;

        if($lc_exp>0)
        {
            $cogs =  $price_per_kg*($lc_exp/100);
        }
        if($insurance_exp>0)
        {
            $cogs = $cogs + $price_per_kg*($insurance_exp/100);
        }
        if($packing_material>0)
        {
            $cogs = $cogs + $price_per_kg*($packing_material/100);
        }
        if($carriage_inwards>0)
        {
            $cogs = $cogs + $price_per_kg*($carriage_inwards/100);
        }


        if($air_freight_and_docs>0)
        {
            $cogs = $cogs + $price_per_kg*($air_freight_and_docs/100);
        }

        $revised_cogs = $cogs + $price_per_kg;

        if($ho_and_general_exp>0)
        {
            $pricing_expenses = $revised_cogs*($ho_and_general_exp/100);
        }
        if($marketing>0)
        {
            $pricing_expenses = $pricing_expenses + $revised_cogs*($marketing/100);
        }
        if($finance_cost>0)
        {
            $pricing_expenses = $pricing_expenses + $cogs*($finance_cost/100);
        }

        $final_cogs = $pricing_expenses + $revised_cogs;

        if($sales_commission>0)
        {
            $bonus_exp = $mrp*($sales_commission/100);
        }
        if($sales_bonus>0)
        {
            $bonus_exp = $bonus_exp + $mrp*($sales_bonus/100);
        }
        if($other_incentive>0)
        {
            $bonus_exp = $bonus_exp + $mrp*($other_incentive/100);
        }

        if(isset($bonus_exp) && $bonus_exp>0)
        {
            $net_profit = $mrp - $bonus_exp - $final_cogs;
        }
        else
        {
            $net_profit = $mrp - $final_cogs;
        }

        if($final_cogs>0)
        {
            $percentage = ($net_profit*100)/ $final_cogs;
        }
        else
        {
            $percentage = 0;
        }

        return round($percentage, 2);
    }

    public static function get_total_sales_target_of_variety($variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.quantity) total_quantity');
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_actual_total_sales($variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('ait_product_purchase_order_invoice ppoi');
        $CI->db->select('SUM(ppoi.approved_quantity) total_approved_quantity');
        $CI->db->where('ppoi.year_id', $year);
        $CI->db->where('ppoi.varriety_id', $variety);
        $result = $CI->db->get()->row_array();

        if(isset($result['total_approved_quantity']) && $result['total_approved_quantity']>0)
        {
            return $result['total_approved_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_price_per_kg_for_hom($variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_prediction bsp');
        $CI->db->select('bsp.budgeted_mrp budgeted_mrp');
        $CI->db->where('bsp.year', $year);
        $CI->db->where('bsp.variety_id', $variety);
        $CI->db->where('bsp.prediction_phase', $CI->config->item('prediction_phase_final'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['budgeted_mrp'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_finalised_sales_target($variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.quantity) finalised_quantity');
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.is_approved_by_hom', 1);
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['finalised_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_actual_sales_quantity($year, $variety, $customer)
    {
        $CI = & get_instance();

        $CI->db->from('ait_product_purchase_order_invoice ppoi');
        $CI->db->select('SUM(ppoi.approved_quantity) approved_quantity');
        $CI->db->where('ppoi.year_id', $year);
        $CI->db->where('ppoi.varriety_id', $variety);
        $CI->db->where('ppoi.distributor_id', $customer);
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['approved_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_opening_balance($variety)
    {
        $CI = & get_instance();
        $year = System_helper::get_current_year();

        $CI->db->from('ait_product_purchase_info ppi');
        $CI->db->select('SUM(ppi.opening_balance) opening_balance');
        $CI->db->where('ppi.year_id', $year);
        $CI->db->where('ppi.varriety_id', $variety);
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['opening_balance'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_sales_target_record_data($year, $variety, $customer)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target_record bstr');
        $CI->db->select('bstr.quantity_ti, bstr.quantity_zi, bstr.quantity_di, bstr.quantity_hom');
        $CI->db->where('bstr.year', $year);
        $CI->db->where('bstr.variety_id', $variety);
        $CI->db->where('bstr.customer_id', $customer);
        $result = $CI->db->get()->row_array();

        return $result;
    }

    public static function get_budget_purchase_quantity($year, $variety)
    {
        $CI = & get_instance();

        $CI->db->from('budget_purchase bp');
        $CI->db->select('bp.purchase_quantity');
        $CI->db->where('bp.year', $year);
        $CI->db->where('bp.variety_id', $variety);
        $CI->db->where('bp.purchase_type', $CI->lang->line('purchase_type_budget'));
        $result = $CI->db->get()->row_array();
        if($result)
        {
            return $result['purchase_quantity'];
        }
        else
        {
            return 0;
        }
    }

    public static function get_total_sales_target_of_customer($variety, $customer)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.required_quantity) total_quantity');
        $CI->db->where('bst.customer_id', $customer);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_division($div_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.required_quantity) total_quantity');
        $CI->db->where('bst.division_id', $div_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_zone($zone_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.required_quantity) total_quantity');
        $CI->db->where('bst.zone_id', $zone_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_customer($customer_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.required_quantity) total_quantity');
        $CI->db->where('bst.customer_id', $customer_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }

    public static function get_total_target_territory($territory_id, $variety, $year)
    {
        $CI = & get_instance();

        $CI->db->from('budget_sales_target bst');
        $CI->db->select('SUM(bst.required_quantity) total_quantity');
        $CI->db->where('bst.territory_id', $territory_id);
        $CI->db->where('bst.variety_id', $variety);
        $CI->db->where('bst.year', $year);
        $CI->db->where('bst.status', $CI->config->item('status_active'));
        $result = $CI->db->get()->row_array();

        if($result)
        {
            return $result['total_quantity'];
        }
        else
        {
            return false;
        }
    }
}