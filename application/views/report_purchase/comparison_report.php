<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($purchases);
//echo "</pre>";

$arranged = array();
foreach($purchases as $purchase)
{
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['year'] = $purchase['year'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['crop_name'] = $purchase['crop_name'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['type_name'] = $purchase['type_name'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['variety_name'] = $purchase['variety_name'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['pi_value'] = $purchase['pi_value'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['quantity'] = $purchase['quantity'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['usd_conversion_rate'] = $purchase['usd_conversion_rate'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['lc_exp'] = $purchase['lc_exp'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['insurance_exp'] = $purchase['insurance_exp'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['packing_material'] = $purchase['packing_material'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['carriage_inwards'] = $purchase['carriage_inwards'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['air_freight_and_docs'] = $purchase['air_freight_and_docs'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['cnf'] = $purchase['cnf'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['bank_other_charges'] = $purchase['bank_other_charges'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['ait'] = $purchase['ait'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['miscellaneous'] = $purchase['miscellaneous'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['sticker_cost'] = $purchase['sticker_cost'];
    $arranged[$purchase['crop_id']][$purchase['type_id']][$purchase['variety_id']][$purchase['month']]['pi_sum'] = $purchase['pi_sum'];
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
                    <th><?php echo $this->lang->line("LABEL_MONTH_OF_PURCHASE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_USD_CONVERSION_RATE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_INSURANCE_EXPENSE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_LC_EXPENSE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_BANK_OTHER_CHARGES"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_AIR_FREIGHT"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_CARRIAGE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_CNF"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_AIT"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_MISC"); ?></th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_QUANTITY"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_PI_VALUE_USD"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_INSURANCE_EXPENSE"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_LC_EXPENSE"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_BANK_OTHER_CHARGES"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%" style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%" style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%" style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_AIR_FREIGHT"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_CARRIAGE"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_CNF"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_AIT"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_MISC"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_COGS_KG"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_TOTAL_COGS"); ?></td>
                            </tr>
                            <tr>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td style="width: 33%"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
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
                            foreach ($typeArranged as $variety_id=>$varietyArranged)
                            {
                                foreach ($varietyArranged as $month => $detail)
                                {
                                    $monthConfig = $this->config->item('month');
                                    $packing_and_sticker = $this->report_purchase_model->get_packing_and_sticker_cost($variety_id);

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

                                    $total_pi = $detail['pi_value']*$detail['usd_conversion_rate']*$detail['quantity'];
                                    $pi_percentage = ($detail['pi_value']/$detail['pi_sum'])*100;
                                    $total_cogs = $total_pi + ($pi_percentage/100)*$detail['lc_exp'] + ($pi_percentage/100)*$detail['insurance_exp'] + $detail['packing_material']*$detail['quantity'] + $detail['sticker_cost']*$detail['quantity'] + ($pi_percentage/100)*$detail['carriage_inwards'] + ($pi_percentage/100)*$detail['air_freight_and_docs'] + ($pi_percentage/100)*$detail['cnf'] + ($pi_percentage/100)*$detail['bank_other_charges'] + ($pi_percentage/100)*$detail['ait'] + ($pi_percentage/100)*$detail['miscellaneous'];

                                    $budgeted_data = $this->report_purchase_model->get_budgeted_data_for_comparison($detail['year'], $month, $crop_id, $type_id, $variety_id);
                                    $budget_pi = $budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['quantity'];
                                    $budgeted_total_cogs = $budget_pi + ($budgeted_data['lc_exp']/100)*$budget_pi + ($budgeted_data['insurance_exp']/100)*$budget_pi + $packing_material_cost*$budgeted_data['quantity'] + $sticker_cost*$budgeted_data['quantity'] + ($budgeted_data['carriage_inwards']/100)*$budget_pi + ($budgeted_data['air_freight_and_docs']/100)*$budget_pi + ($budgeted_data['cnf']/100)*$budget_pi + ($budgeted_data['bank_other_charges']/100)*$budget_pi + ($budgeted_data['ait']/100)*$budget_pi + ($budgeted_data['miscellaneous']/100)*$budget_pi;

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
                                        <td><?php echo isset($month)?$monthConfig[str_pad($month, 2,0, STR_PAD_LEFT)]:''; ?></td>
                                        <td><?php echo $detail['usd_conversion_rate']; ?></td>
                                        <td><?php echo round(($budgeted_data['insurance_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['lc_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['bank_other_charges']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['air_freight_and_docs']/100)*$detail['pi_value']*$detail['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['carriage_inwards']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['cnf']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['ait']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td><?php echo round(($budgeted_data['miscellaneous']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate'])*$budgeted_data['final_quantity']; ?></td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo $budgeted_data['quantity']; ?></td>
                                                    <td style="width: 33%"><?php echo $detail['quantity']; ?></td>
                                                    <td style="width: 33%"><?php echo abs($budgeted_data['quantity']-$detail['quantity']); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo $budgeted_data['pi_value'];?></td>
                                                    <td style="width: 33%"><?php echo $detail['pi_value']; ?></td>
                                                    <td style="width: 33%"><?php echo abs($budgeted_data['pi_value']- $detail['pi_value']);?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['insurance_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['insurance_exp']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['insurance_exp'])-round(($budgeted_data['insurance_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['lc_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['lc_exp']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['lc_exp'])-round(($budgeted_data['lc_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['bank_other_charges']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['bank_other_charges']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['bank_other_charges'])-round(($budgeted_data['lc_exp']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['air_freight_and_docs']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['air_freight_and_docs']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['air_freight_and_docs'])-round(($budgeted_data['air_freight_and_docs']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['carriage_inwards']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['carriage_inwards']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['carriage_inwards'])-round(($budgeted_data['carriage_inwards']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['cnf']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['cnf']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['cnf'])-round(($budgeted_data['cnf']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['ait']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['ait']);?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['ait'])-round(($budgeted_data['ait']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round(($budgeted_data['miscellaneous']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round(($pi_percentage/100)*$detail['miscellaneous']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round(($pi_percentage/100)*$detail['miscellaneous'])-round(($budgeted_data['miscellaneous']/100)*$budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round($budgeted_total_cogs/$budgeted_data['quantity']);?></td>
                                                    <td style="width: 33%"><?php echo round($total_cogs/$detail['quantity']); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round($total_cogs/$detail['quantity'])-round($budgeted_total_cogs/$budgeted_data['quantity']));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">
                                                <tr>
                                                    <td style="width: 33%"><?php echo round($budgeted_total_cogs);?></td>
                                                    <td style="width: 33%"><?php echo round($total_cogs); ?></td>
                                                    <td style="width: 33%"><?php echo abs(round($total_cogs)-round($budgeted_total_cogs));?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }
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
