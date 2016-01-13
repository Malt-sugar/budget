<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($pricingData);
//echo "</pre>";

$arranged = array();
foreach($pricingData as $pricing)
{
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['year'] = $pricing['year'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['crop_name'] = $pricing['crop_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['type_name'] = $pricing['type_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['variety_name'] = $pricing['variety_name'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['pi_value'] = $pricing['pi_value'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['quantity'] = $pricing['quantity'];
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
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['sticker_cost'] = $pricing['sticker_cost'];
    $arranged[$pricing['crop_id']][$pricing['type_id']][$pricing['variety_id']]['pi_sum'] = $pricing['pi_sum'];
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
                    <th><?php echo $this->lang->line("LABEL_FINAL_NET_SALES_PRICE"); ?></th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_COGS"); ?></td>
                            </tr>
                            <tr>
                                <td width="70"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_NET_PROFIT"); ?></td>
                            </tr>
                            <tr>
                                <td width="70"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
                            </tr>
                        </table>
                    </th>
                    <th>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td colspan="3" class="text-center"><?php echo $this->lang->line("LABEL_TOTAL_NET_PROFIT"); ?></td>
                            </tr>
                            <tr>
                                <td width="70"><?php echo $this->lang->line('LABEL_BUDGETED');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_ACTUAL');?></td>
                                <td width="70"><?php echo $this->lang->line('LABEL_VARIANCE');?></td>
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

                                $total_pi = $detail['pi_value']*$detail['usd_conversion_rate']*$detail['quantity'];
                                $pi_percentage = ($detail['pi_value']/$detail['pi_sum'])*100;
                                $total_cogs = $total_pi + ($pi_percentage/100)*$detail['lc_exp'] + ($pi_percentage/100)*$detail['insurance_exp'] + $detail['packing_material']*$detail['quantity'] + $detail['sticker_cost']*$detail['quantity'] + ($pi_percentage/100)*$detail['carriage_inwards'] + ($pi_percentage/100)*$detail['air_freight_and_docs'] + ($pi_percentage/100)*$detail['cnf'] + ($pi_percentage/100)*$detail['bank_other_charges'] + ($pi_percentage/100)*$detail['ait'] + ($pi_percentage/100)*$detail['miscellaneous'];
                                $cogs = $total_cogs/$detail['quantity'];

                                $budgeted_data = $this->report_pricing_model->get_budgeted_data_for_comparison($detail['year'], $crop_id, $type_id, $variety_id);
                                $budget_pi = $budgeted_data['pi_value']*$budgeted_data['usd_conversion_rate']*$budgeted_data['final_quantity'];
                                $budgeted_total_cogs = $budget_pi + ($budgeted_data['lc_exp']/100)*$budget_pi + ($budgeted_data['insurance_exp']/100)*$budget_pi + $packing_material_cost*$budgeted_data['final_quantity'] + $sticker_cost*$budgeted_data['final_quantity'] + ($budgeted_data['carriage_inwards']/100)*$budget_pi + ($budgeted_data['air_freight_and_docs']/100)*$budget_pi + ($budgeted_data['cnf']/100)*$budget_pi + ($budgeted_data['bank_other_charges']/100)*$budget_pi + ($budgeted_data['ait']/100)*$budget_pi + ($budgeted_data['miscellaneous']/100)*$budget_pi;
                                $budgeted_cogs = $budgeted_total_cogs/$budgeted_data['final_quantity'];

                                // COGS Expenses (COGS + Indirect expenses)
                                $budgeted_cogs_expenses = $this->report_pricing_model->get_cogs_expenses($year, $budgeted_cogs);
                                $actual_cogs_expenses = $this->report_pricing_model->get_cogs_expenses($year, $cogs);

                                $final_net_sales_price = $this->report_pricing_model->get_final_net_sales_price($year, $variety_id);
                                $budgeted_net_profit = $final_net_sales_price - $budgeted_cogs_expenses;
                                $actual_net_profit = $final_net_sales_price - $actual_cogs_expenses;
                                $total_budgeted_net_profit = $budgeted_net_profit*$budgeted_data['final_quantity'];
                                $total_actual_net_profit = $budgeted_net_profit*$detail['quantity'];
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
                                    <td><?php echo $detail['quantity']; ?></td>
                                    <td><?php echo $final_net_sales_price; ?></td>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="70"><?php echo round($budgeted_cogs); ?></td>
                                                <td width="70"><?php echo round($cogs); ?></td>
                                                <td width="70"><?php echo round($budgeted_cogs-$cogs); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="70"><?php echo round($budgeted_net_profit); ?></td>
                                                <td width="70"><?php echo round($actual_net_profit); ?></td>
                                                <td width="70"><?php echo round($budgeted_net_profit-$actual_net_profit); ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td width="70"><?php echo round($total_budgeted_net_profit); ?></td>
                                                <td width="70"><?php echo round($total_actual_net_profit); ?></td>
                                                <td width="70"><?php echo round($total_budgeted_net_profit-$total_actual_net_profit); ?></td>
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
