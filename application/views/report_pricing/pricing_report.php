<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($pricingData);
//echo "</pre>";


$arranged = array();
foreach($pricingData as $pricing)
{
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['crop_name'] = $pricing['crop_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['type_name'] = $pricing['type_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['variety_name'] = $pricing['variety_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['pi_value'] = $pricing['pi_value'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['mrp'] = $pricing['mrp'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['final_targeted_quantity'] = $pricing['final_targeted_quantity'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['usd_conversion_rate'] = $pricing['usd_conversion_rate'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['lc_exp'] = $pricing['lc_exp'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['insurance_exp'] = $pricing['insurance_exp'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['packing_material'] = $pricing['packing_material'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['carriage_inwards'] = $pricing['carriage_inwards'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['air_freight_and_docs'] = $pricing['air_freight_and_docs'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['cnf'] = $pricing['cnf'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['bank_other_charges'] = $pricing['bank_other_charges'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['ait'] = $pricing['ait'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['miscellaneous'] = $pricing['miscellaneous'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['ho_and_gen_exp'] = $pricing['ho_and_gen_exp'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['marketing'] = $pricing['marketing'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['finance_cost'] = $pricing['finance_cost'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_commission'] = $pricing['sales_commission'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_bonus'] = $pricing['sales_bonus'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['other_incentive'] = $pricing['other_incentive'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['target_profit'] = $pricing['target_profit'];
}

//echo "<pre>";
//print_r($arranged);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="row show-grid hidden-print">
        <a class="btn btn-primary btn-rect pull-right external" style="margin-right: 10px;" onclick="print_rpt()"><?php echo $this->lang->line("BUTTON_PRINT"); ?></a>
    </div>
</div>

<div class="row show-grid" id="PrintArea">
    <div>&nbsp;</div>
    <div class="row">
        <div class="col-lg-12"><?php $this->load->view('print_header');?></div>
    </div>

    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" style="overflow-x: auto">
            <thead class="hidden-print">
                <tr>
                    <th><?php echo $this->lang->line("LABEL_CROP"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_TYPE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_VARIETY"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_FINAL_BUDGETED_QTY"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_COGS"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_HO_EXP"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_MARKETING"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_FINANCE_COST"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_NET_SALES_PRICE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_COMMISSION"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_BONUS"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_INCENTIVE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_NET_PROFIT"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_MRP"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_TOTAL_NET_PROFIT"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_TOTAL_SALES_PRICE"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($arranged)>0)
                {
                    $crop_name = '';
                    $type_name = '';
                    $variety_name = '';

                    $sum_final_quantity = 0;
                    $sum_ho_and_gen_exp = 0;
                    $sum_marketing = 0;
                    $sum_finance_cost = 0;
                    $sum_total_net_profit = 0;
                    $sum_total_net_sales = 0;

                    foreach($arranged as $crop_id=>$cropArranged)
                    {
                        foreach ($cropArranged as $type_id => $typeArranged)
                        {
                            foreach ($typeArranged as $variety_id=>$detail)
                            {
                                $packing_and_sticker = $this->report_pricing_model->get_packing_and_sticker_cost($variety_id);

                                if(isset($packing_and_sticker['packing_status']) && $packing_and_sticker['packing_status']==1)
                                {
                                    $packing_material_cost = $packing_and_sticker['packing_material_cost'];
                                }
                                else
                                {
                                    $packing_material_cost = 0;
                                }

                                if(isset($packing_and_sticker['sticker_status']) && $packing_and_sticker['sticker_status']==1)
                                {
                                    $sticker_cost = $packing_and_sticker['sticker_cost'];
                                }
                                else
                                {
                                    $sticker_cost = 0;
                                }

                                $pi_value = $detail['pi_value']*$detail['usd_conversion_rate'];
                                $cogs = $pi_value + ($pi_value/100)*$detail['lc_exp'] + ($pi_value/100)*$detail['insurance_exp'] + ($pi_value/100)*$detail['carriage_inwards'] + ($pi_value/100)*$detail['air_freight_and_docs'] + ($pi_value/100)*$detail['cnf'] + ($pi_value/100)*$detail['bank_other_charges'] + $packing_material_cost + $sticker_cost;
                                $net_sales_price = round($cogs + ($detail['ho_and_gen_exp']/100)*$cogs + ($detail['marketing']/100)*$cogs + ($detail['finance_cost']/100)*$cogs+ ($detail['target_profit']/100)*$cogs);
                                $budgeted_mrp = $net_sales_price + ($detail['sales_commission']/100)*$net_sales_price + ($detail['sales_bonus']/100)*$net_sales_price + ($detail['other_incentive']/100)*$net_sales_price;
                                ?>
                                <tr>
                                    <td>
                                        <?php
                                        if($crop_name == '')
                                        {
                                            echo $detail['crop_name'];
                                            $crop_name = $detail['crop_name'];
                                        }
                                        elseif($crop_name == $detail['crop_name'])
                                        {
                                            echo "&nbsp;";
                                        }
                                        else
                                        {
                                            echo $detail['crop_name'];
                                            $crop_name = $detail['crop_name'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($type_name == '')
                                        {
                                            echo $detail['type_name'];
                                            $type_name = $detail['type_name'];
                                        }
                                        elseif($type_name == $detail['type_name'])
                                        {
                                            echo "&nbsp;";
                                        }
                                        else
                                        {
                                            echo $detail['type_name'];
                                            $type_name = $detail['type_name'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if($variety_name == '')
                                        {
                                            echo $detail['variety_name'];
                                            $variety_name = $detail['variety_name'];
                                        }
                                        elseif($variety_name == $detail['variety_name'])
                                        {
                                            echo "&nbsp;";
                                        }
                                        else
                                        {
                                            echo $detail['variety_name'];
                                            $variety_name = $detail['variety_name'];
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $detail['final_targeted_quantity']; ?></td>
                                    <td><?php echo round($cogs);?></td>
                                    <td><?php echo round(($detail['ho_and_gen_exp']/100)*$pi_value);?></td>
                                    <td><?php echo round(($detail['marketing']/100)*$pi_value);?></td>
                                    <td><?php echo round(($detail['finance_cost']/100)*$pi_value);?></td>
                                    <td><?php echo round($net_sales_price);?></td>
                                    <td><?php echo round($detail['sales_commission']);?></td>
                                    <td><?php echo round($detail['sales_bonus']);?></td>
                                    <td><?php echo round($detail['other_incentive']);?></td>
                                    <td><?php echo round(($detail['target_profit']/100)*$cogs);?></td>
                                    <td><?php echo round($budgeted_mrp);?></td>
                                    <td><?php echo round(($detail['target_profit']/100)*$cogs*$detail['final_targeted_quantity']);?></td>
                                    <td><?php echo round($net_sales_price*$detail['final_targeted_quantity']);?></td>
                                </tr>
                                <?php
                                $sum_final_quantity+=$detail['final_targeted_quantity'];
                                $sum_ho_and_gen_exp+=round(($detail['ho_and_gen_exp']/100)*$pi_value);
                                $sum_marketing+=round(($detail['marketing']/100)*$pi_value);
                                $sum_finance_cost+=round(($detail['finance_cost']/100)*$pi_value);
                                $sum_total_net_profit+=round(($detail['target_profit']/100)*$cogs*$detail['final_targeted_quantity']);
                                $sum_total_net_sales+=round($net_sales_price*$detail['final_targeted_quantity']);
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="vertical-align: middle;" class="text-center"><label class="label label-danger"><?php echo $this->lang->line('LABEL_TOTAL')?></label></td>
                        <td><?php echo $sum_final_quantity;?></td>
                        <td></td>
                        <td><?php echo $sum_ho_and_gen_exp;?></td>
                        <td><?php echo $sum_marketing;?></td>
                        <td><?php echo $sum_finance_cost;?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $sum_total_net_profit;?></td>
                        <td><?php echo $sum_total_net_sales;?></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="150" class="text-center alert-danger">
                            <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="col-lg-12">
            <?php $this->load->view('print_footer');?>
        </div>
    </div>
</div>
