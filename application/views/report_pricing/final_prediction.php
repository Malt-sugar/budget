<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($pricingData);
//echo "</pre>";
$prediction_years = System_helper::get_prediction_years($year);

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
                <th>
                    <table class="table table-bordered" style="margin-bottom: 0px;">
                        <tr><td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_QUANTITY"); ?></td></tr>
                        <tr>
                            <td><?php echo System_helper::get_year_name($year)?></td>
                            <?php
                            foreach($prediction_years as $prediction_year)
                            {
                            ?>
                            <td><?php echo $prediction_year['year_name'];?></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </table>
                </th>
                <th>
                    <table class="table table-bordered" style="margin-bottom: 0px;">
                        <tr><td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_NET_SALES_PRICE"); ?></td></tr>
                        <tr>
                            <td><?php echo System_helper::get_year_name($year)?></td>
                            <?php
                            foreach($prediction_years as $prediction_year)
                            {
                            ?>
                            <td><?php echo $prediction_year['year_name'];?></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </table>
                </th>
                <th>
                    <table class="table table-bordered" style="margin-bottom: 0px;">
                        <tr><td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_NET_PROFIT"); ?></td></tr>
                        <tr>
                            <td><?php echo System_helper::get_year_name($year)?></td>
                            <?php
                            foreach($prediction_years as $prediction_year)
                            {
                            ?>
                            <td><?php echo $prediction_year['year_name'];?></td>
                            <?php
                            }
                            ?>
                        </tr>
                    </table>
                </th>
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
                                <td>
                                    <table class="table table-bordered" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="width: 33%"><?php echo $detail['final_targeted_quantity']; ?></td>
                                            <?php
                                            foreach($prediction_years as $prediction_year)
                                            {
                                                ?>
                                                <td style="width: 33%"><?php echo $this->report_pricing_model->get_prediction_year_quantity($prediction_year['year_id'], $variety_id);?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-bordered" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="width: 33%"><?php echo $detail['final_targeted_quantity']*round($net_sales_price); ?></td>
                                            <?php
                                            foreach($prediction_years as $prediction_year)
                                            {
                                                ?>
                                                <td style="width: 33%"><?php echo $this->report_pricing_model->get_prediction_year_quantity($prediction_year['year_id'], $variety_id)*round($net_sales_price);?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-bordered" style="margin-bottom: 0px;">
                                        <tr>
                                            <td style="width: 33%"><?php echo $detail['final_targeted_quantity']*round(($detail['target_profit']/100)*$cogs); ?></td>
                                            <?php
                                            foreach($prediction_years as $prediction_year)
                                            {
                                                ?>
                                                <td style="width: 33%"><?php echo $this->report_pricing_model->get_prediction_year_quantity($prediction_year['year_id'], $variety_id)*round(($detail['target_profit']/100)*$cogs);?></td>
                                                <?php
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
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
