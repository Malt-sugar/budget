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
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['mrp'] = $pricing['mrp'];

    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_commission_mgt'] = $pricing['sales_commission_mgt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_bonus_mgt'] = $pricing['sales_bonus_mgt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['other_incentive_mgt'] = $pricing['other_incentive_mgt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['target_profit_mgt'] = $pricing['target_profit_mgt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['mrp_mgt'] = $pricing['mrp_mgt'];

    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_commission_mkt'] = $pricing['sales_commission_mkt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_bonus_mkt'] = $pricing['sales_bonus_mkt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['other_incentive_mkt'] = $pricing['other_incentive_mkt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['target_profit_mkt'] = $pricing['target_profit_mkt'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['mrp_mkt'] = $pricing['mrp_mkt'];

    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_commission_final'] = $pricing['sales_commission_final'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sales_bonus_final'] = $pricing['sales_bonus_final'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['other_incentive_final'] = $pricing['other_incentive_final'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['target_profit_final'] = $pricing['target_profit_final'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['mrp_final'] = $pricing['mrp_final'];
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
                    <th><?php echo $this->lang->line("LABEL_QUANTITY"); ?></th>
                    <?php
                    if(empty($comparison_type) || $comparison_type==1)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_SALES_COMMISSION"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==2)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_SALES_BONUS"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==3)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_OTHER_INCENTIVE"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==4)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_NET_PROFIT"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==5)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_NET_SALES_PRICE"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==6)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_TOTAL_NET_PROFIT"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                    <?php
                    if(empty($comparison_type) || $comparison_type==7)
                    {
                    ?>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="4" class="text-center"><?php echo $this->lang->line("LABEL_TOTAL_NET_SALES_PRICE"); ?></td>
                            </tr>
                            <tr>
                                <td width="50"><?php echo $this->lang->line('LABEL_AUTO');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MGT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_MKT');?></td>
                                <td width="50"><?php echo $this->lang->line('LABEL_FINAL');?></td>
                            </tr>
                        </table>
                    </th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($arranged)>0)
                {
                    $crop_name = '';
                    $type_name = '';
                    $variety_name = '';

                    foreach($arranged as $crop_id=>$cropArranged)
                    {
                        foreach ($cropArranged as $type_id => $typeArranged)
                        {
                            foreach ($typeArranged as $variety_id=>$detail)
                            {
                                $monthConfig = $this->config->item('month');
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
                                $net_sales_price_mgt = round($cogs + ($detail['ho_and_gen_exp']/100)*$cogs + ($detail['marketing']/100)*$cogs + ($detail['finance_cost']/100)*$cogs+ ($detail['target_profit_mgt']/100)*$cogs);
                                $net_sales_price_mkt = round($cogs + ($detail['ho_and_gen_exp']/100)*$cogs + ($detail['marketing']/100)*$cogs + ($detail['finance_cost']/100)*$cogs+ ($detail['target_profit_mkt']/100)*$cogs);
                                $net_sales_price_final = round($cogs + ($detail['ho_and_gen_exp']/100)*$cogs + ($detail['marketing']/100)*$cogs + ($detail['finance_cost']/100)*$cogs+ ($detail['target_profit_final']/100)*$cogs);

                                $net_profit =  round(($detail['target_profit']/100)*$cogs);
                                $net_profit_mgt =  round(($detail['target_profit_mgt']/100)*$cogs);
                                $net_profit_mkt =  round(($detail['target_profit_mkt']/100)*$cogs);
                                $net_profit_final =  round(($detail['target_profit_final']/100)*$cogs);
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
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==1)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($detail['sales_commission'])?$detail['sales_commission']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_commission_mgt'])?$detail['sales_commission_mgt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_commission_mkt'])?$detail['sales_commission_mkt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_commission_final'])?$detail['sales_commission_final']:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==2)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($detail['sales_bonus'])?$detail['sales_bonus']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_bonus_mgt'])?$detail['sales_bonus_mgt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_bonus_mkt'])?$detail['sales_bonus_mkt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['sales_bonus_final'])?$detail['sales_bonus_final']:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==3)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($detail['other_incentive'])?$detail['other_incentive']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['other_incentive_mgt'])?$detail['other_incentive_mgt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['other_incentive_mkt'])?$detail['other_incentive_mkt']:0; ?></td>
                                                <td width="50"><?php echo isset($detail['other_incentive_final'])?$detail['other_incentive_final']:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==4)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($net_profit)?$net_profit:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_mgt)?$net_profit_mgt:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_mkt)?$net_profit_mkt:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_final)?$net_profit_final:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==5)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($net_sales_price)?$net_sales_price:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_mgt)?$net_sales_price_mgt:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_mkt)?$net_sales_price_mkt:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_final)?$net_sales_price_final:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==6)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($net_profit)?$net_profit*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_mgt)?$net_profit_mgt*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_mkt)?$net_profit_mkt*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_profit_final)?$net_profit_final*$detail['final_targeted_quantity']:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(empty($comparison_type) || $comparison_type==7)
                                    {
                                    ?>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="50"><?php echo isset($net_sales_price)?$net_sales_price*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_mgt)?$net_sales_price_mgt*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_mkt)?$net_sales_price_mkt*$detail['final_targeted_quantity']:0; ?></td>
                                                <td width="50"><?php echo isset($net_sales_price_final)?$net_sales_price_final*$detail['final_targeted_quantity']:0; ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                                <?php
                            }
                        }
                    }
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
