<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($predictions);
//echo "</pre>";

?>

<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="wrapper1">
        <div class="div1"></div>
    </div>

    <div class="wrapper2">
    <div class="col-xs-12 div2" id="doublescroll" style="overflow-x: auto;">
        <table class="table table-hover table-bordered">
            <thead class="hidden-print">
                <tr>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_INDIRECT_EXPENSE');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_PREDICTION_BY_BMS');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_INITIAL_TARGET_BY_MGT');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_PROPOSED_BY_HOM');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_FINAL_DECISION_BY_MGT');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_ACTUAL');?></th>
                    <th class="text-center"><?php echo $this->lang->line('LABEL_VARIANCE');?></th>
                </tr>
                <tr>
                    <td><?php echo $this->lang->line('LABEL_CROP');?></td>
                    <td><?php echo $this->lang->line('LABEL_TYPE');?></td>
                    <td><?php echo $this->lang->line('LABEL_VARIETY');?></td>
                    <td><?php echo $this->lang->line('LABEL_SELLING_MONTH');?></td>
                    <td><?php echo $this->lang->line('LABEL_QTY_KG');?></td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: lavender;">
                            <tr>
                                <td><?php echo $this->lang->line('LABEL_HO_GEN_EXP_PER');?></td>
                                <td><?php echo $this->lang->line('LABEL_MARKETING_PER');?></td>
                                <td><?php echo $this->lang->line('LABEL_FINANCE_COST_PER');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: darkgray;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TARGETED_PROFIT_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_MRP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: lightblue;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_MRP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_MRP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: burlywood;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_MRP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: lightseagreen;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                            <tr>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                                <td style="min-width: 60px;"><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </thead>
            <tbody class="order">
                <?php
                if(sizeof($predictions)>0)
                {
                    foreach($predictions as $key=>$prediction)
                    {
                        //$total_target = System_helper::get_total_sales_target_of_variety($prediction['variety_id'], $prediction['year']);
                        $budget_purchase_quantity = System_helper::get_budget_purchase_quantity($prediction['year'], $prediction['variety_id']);

                        $mrp_cal = System_helper::get_mrp_of_last_years($prediction['variety_id'], $this->config->item('budgeted_mrp_cal_year'));

                        $net_profit_per_kg_initial = System_helper::calculate_net_profit($prediction['year'], $prediction['variety_id'], $mrp_cal, $prediction['sales_commission'], $prediction['sales_bonus'], $prediction['other_incentive']);
                        $total_net_profit_initial = $net_profit_per_kg_initial*$budget_purchase_quantity;
                        $total_sales_initial = $mrp_cal*$budget_purchase_quantity;

                        $net_profit_initial_percentage = System_helper::calculate_net_profit_percentage($prediction['year'], $prediction['variety_id'], $mrp_cal, $prediction['sales_commission'], $prediction['sales_bonus'], $prediction['other_incentive']);

                        if(isset($prediction['mgt_budgeted_mrp']) && isset($prediction['mgt_sales_commission']) && isset($prediction['mgt_sales_bonus']) && isset($prediction['mgt_other_incentive']))
                        {
                            $net_profit_per_kg_mgt = System_helper::calculate_net_profit($prediction['year'], $prediction['variety_id'], $prediction['mgt_budgeted_mrp'], $prediction['mgt_sales_commission'], $prediction['mgt_sales_bonus'], $prediction['mgt_other_incentive']);
                            $total_net_profit_mgt = $net_profit_per_kg_mgt*$budget_purchase_quantity;
                            $total_sales_mgt = $prediction['mgt_budgeted_mrp']*$budget_purchase_quantity;

                            $net_profit_mgt_percentage = System_helper::calculate_net_profit_percentage($prediction['year'], $prediction['variety_id'], $prediction['mgt_budgeted_mrp'], $prediction['mgt_sales_commission'], $prediction['mgt_sales_bonus'], $prediction['mgt_other_incentive']);
                        }

                        if(isset($prediction['mkt_budgeted_mrp']) && isset($prediction['mkt_sales_commission']) && isset($prediction['mkt_sales_bonus']) && isset($prediction['mkt_other_incentive']))
                        {
                            $net_profit_per_kg_mkt = System_helper::calculate_net_profit($prediction['year'], $prediction['variety_id'], $prediction['mkt_budgeted_mrp'], $prediction['mkt_sales_commission'], $prediction['mkt_sales_bonus'], $prediction['mkt_other_incentive']);
                            $total_net_profit_mkt = $net_profit_per_kg_mkt*$budget_purchase_quantity;
                            $total_sales_mkt = $prediction['mkt_budgeted_mrp']*$budget_purchase_quantity;

                            $net_profit_mkt_percentage = System_helper::calculate_net_profit_percentage($prediction['year'], $prediction['variety_id'], $prediction['mkt_budgeted_mrp'], $prediction['mkt_sales_commission'], $prediction['mkt_sales_bonus'], $prediction['mkt_other_incentive']);
                        }

                        if(isset($prediction['final_budgeted_mrp']) && isset($prediction['final_sales_commission']) && isset($prediction['final_sales_bonus']) && isset($prediction['final_other_incentive']))
                        {
                            $net_profit_per_kg_final = System_helper::calculate_net_profit($prediction['year'], $prediction['variety_id'], $prediction['final_budgeted_mrp'], $prediction['final_sales_commission'], $prediction['final_sales_bonus'], $prediction['final_other_incentive']);
                            $total_net_profit_final = $net_profit_per_kg_final*$budget_purchase_quantity;
                            $total_sales_final = $prediction['final_budgeted_mrp']*$budget_purchase_quantity;

                            $net_profit_final_percentage = System_helper::calculate_net_profit_percentage($prediction['year'], $prediction['variety_id'], $prediction['final_budgeted_mrp'], $prediction['final_sales_commission'], $prediction['final_sales_bonus'], $prediction['final_other_incentive']);
                        }

                        if(isset($net_profit_final_percentage))
                        {
                            $attr = $net_profit_final_percentage;
                        }
                        elseif(!isset($net_profit_final_percentage) && isset($net_profit_mkt_percentage))
                        {
                            $attr = $net_profit_mkt_percentage;
                        }
                        elseif(!isset($net_profit_final_percentage) && !isset($net_profit_mkt_percentage) && isset($net_profit_mgt_percentage))
                        {
                            $attr = $net_profit_mgt_percentage;
                        }
                        elseif(!isset($net_profit_final_percentage) && !isset($net_profit_mkt_percentage) && !isset($net_profit_mgt_percentage) && isset($net_profit_initial_percentage))
                        {
                            $attr = $net_profit_initial_percentage;
                        }
                        else
                        {
                            $attr = 0;
                        }

                        ?>

                            <tr class="ordered" myAttribute="<?php echo $attr;?>" style="<?php if(isset($prediction_from) && !isset($prediction_to)){if($attr >= $prediction_from){echo 'display:show';}else{echo 'display:none';}}elseif(isset($prediction_to) && !isset($prediction_from)){if($attr <= $prediction_to){echo 'display:show';}else{echo 'display:none';}}elseif(isset($prediction_from) && isset($prediction_to)){if($attr >= $prediction_from && $attr <= $prediction_to){echo 'display:show';}else{echo 'display:none';}}?>">
                                <td><?php echo $prediction['crop_name'];?></td>
                                <td><?php echo $prediction['type_name'];?></td>
                                <td><?php echo $prediction['variety_name'];?></td>
                                <td><?php echo '';?></td>
                                <td><?php if(isset($budget_purchase_quantity)){echo $budget_purchase_quantity;}?></td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: lavender;">
                                        <tr>
                                            <td><?php echo $prediction['ho_and_general_exp'];?></td>
                                            <td><?php echo $prediction['marketing'];?></td>
                                            <td><?php echo $prediction['finance_cost'];?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: darkgray;">
                                        <tr>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['targeted_profit'])){echo $prediction['targeted_profit'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($mrp_cal)){echo $mrp_cal;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['sales_commission'])){echo $prediction['sales_commission'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['sales_bonus'])){echo $prediction['sales_bonus'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['other_incentive'])){echo $prediction['other_incentive'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($net_profit_per_kg_initial)){echo $net_profit_per_kg_initial;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_net_profit_initial)){echo $total_net_profit_initial;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_sales_initial)){echo $total_sales_initial;}?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: lightblue;">
                                        <tr>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mgt_budgeted_mrp'])){echo $prediction['mgt_budgeted_mrp'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mgt_sales_commission'])){echo $prediction['mgt_sales_commission'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mgt_sales_bonus'])){echo $prediction['mgt_sales_bonus'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mgt_other_incentive'])){echo $prediction['mgt_other_incentive'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($net_profit_per_kg_mgt)){echo $net_profit_per_kg_mgt;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_net_profit_mgt)){echo $total_net_profit_mgt;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_sales_mgt)){echo $total_sales_mgt;}?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                                        <tr>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mkt_budgeted_mrp'])){echo $prediction['mkt_budgeted_mrp'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mkt_sales_commission'])){echo $prediction['mkt_sales_commission'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mkt_sales_bonus'])){echo $prediction['mkt_sales_bonus'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['mkt_other_incentive'])){echo $prediction['mkt_other_incentive'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($net_profit_per_kg_mkt)){echo $net_profit_per_kg_mkt;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_net_profit_mkt)){echo $total_net_profit_mkt;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_sales_mkt)){echo $total_sales_mkt;}?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: burlywood;">
                                        <tr>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['final_budgeted_mrp'])){echo $prediction['final_budgeted_mrp'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['final_sales_commission'])){echo $prediction['final_sales_commission'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['final_sales_bonus'])){echo $prediction['final_sales_bonus'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($prediction['final_other_incentive'])){echo $prediction['final_other_incentive'];}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($net_profit_per_kg_final)){echo $net_profit_per_kg_final;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_net_profit_final)){echo $total_net_profit_final;}?></td>
                                            <td style="min-width: 60px;"><?php if(isset($total_sales_final)){echo $total_sales_final;}?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: lightseagreen;">
                                        <tr>
                                            <td><?php echo System_helper::get_actual_total_sales($prediction['variety_id'], $prediction['year']);?></td>
                                            <td><?php echo '';?></td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                                        <tr>
                                            <td><?php echo $budget_purchase_quantity-System_helper::get_actual_total_sales($prediction['variety_id'], $prediction['year']);?></td>
                                            <td><?php echo '';?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="20" class="text-center alert-danger">
                            <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div>

<script>
    jQuery(document).ready(function()
    {
        var rows = $(".order").find('.ordered').get();
        rows.sort(function(a, b)
        {
            var keyA = $(a).attr('myAttribute');
            var keyB = $(b).attr('myAttribute');
            if (keyA > keyB) return 1;
            if (keyA < keyB) return -1;
            return 0;
        });

        $.each(rows, function(index, row)
        {
            $(".order").append(row);
        });

        $('.order .ordered').each(function(index)
        {
            if(index < 5)
            {
                $(this).addClass("flag");
            }
        });
    });

    $(function(){
        $(".wrapper1").scroll(function(){
            $(".wrapper2").scrollLeft($(".wrapper1").scrollLeft());
        });
        $(".wrapper2").scroll(function(){
            $(".wrapper1").scrollLeft($(".wrapper2").scrollLeft());
        });
    });

</script>

<style>

    .flag
    {
        background-image: url('<?php echo base_url()?>images/flag.png');
        background-repeat: no-repeat;
        background-position: left;
    }

    .wrapper1, .wrapper2 {
        width: auto;
        overflow-x: scroll;
        overflow-y:hidden;
    }

    .wrapper1 {height: 20px; }
    .wrapper2 {height: auto; }

    .div1 {
        width:4800px;
        height: 20px;
    }

    .div2 {
        width:auto;
        height: auto;
        background-color: white;
        overflow: auto;
    }

</style>