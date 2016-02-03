<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($targets);
//echo "</pre>";
//exit;

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
                <th><?php echo $this->lang->line("LABEL_SELLING_MONTH"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_FROM_CUSTOMER"); ?></th>
                <th><?php echo $this->lang->line("LABEL_FINAL_TARGETED_SALES"); ?></th>
                <th class="text-center"><?php echo $this->lang->line("LABEL_ACTUAL_SALES_QTY"); ?></th>
                <th class="text-center"><?php echo $this->lang->line("LABEL_VARIANCE"); ?></th>
                <th class="text-center"><?php echo $this->lang->line("LABEL_UNIT_PRICE_PER_KG"); ?></th>
                <th class="text-center"><?php echo $this->lang->line("LABEL_TOTAL_SALES_TK"); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($targets)>0)
                {
                    $sum_total_budgeted = 0;
                    $sum_total_targeted = 0;
                    $sum_actual_sales = 0;
                    $sum_total_sales = 0;

                    foreach($targets as $key=>$target)
                    {
                        $actual_sales = Report_helper::get_actual_sales_qty($target['year'], $target['zone_id'], $target['territory_id'], $target['customer_id'], $target['variety_id']);
                        $months = $this->config->item('month');
                        ?>
                        <tr class="tr_class">
                            <td><?php echo $target['crop_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['variety_name'];?><input type="hidden" name="variety_id" id="variety_id" value="<?php echo $target['variety_id'];?>"></td>
                            <td><?php echo isset($target['selling_month'])?$months[str_pad($target['selling_month'], 2,0, STR_PAD_LEFT)]:'';?></td>
                            <td>
                                <?php echo $target['total_budgeted'];?>
                                <label class="label label-default pull-right target_from_customer"><?php echo $this->lang->line('LABEL_DETAIL');?></label>
                                <input type="hidden" name="serial" class="serial" value="<?php echo $key?>" />
                                <div id="totalBudgeted<?php echo $key?>" class="row popBudgetContainer" style="display: none;">

                                </div>
                            </td>
                            <td>
                                <?php echo $target['total_targeted'];?>
                                <label class="label label-default pull-right final_target"><?php echo $this->lang->line('LABEL_DETAIL');?></label>
                                <div id="totalTargeted<?php echo $key?>" class="row popTargetContainer" style="display: none;">

                                </div>
                            </td>
                            <td class="text-center"><?php echo $actual_sales?$actual_sales:0;?></td>
                            <td class="text-center"><?php echo $target['total_targeted']-$actual_sales;?></td>
                            <td class="text-center"><?php echo $target['unit_price_per_kg'];?></td>
                            <td class="text-center"><?php echo $actual_sales*$target['unit_price_per_kg'];?></td>
                        </tr>
                        <?php
                        $sum_total_budgeted += $target['total_budgeted'];
                        $sum_total_targeted += $target['total_targeted'];
                        $sum_actual_sales += $actual_sales?$actual_sales:0;
                        $sum_total_sales += $actual_sales*$target['unit_price_per_kg'];
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td style="vertical-align: middle;" class="text-center"><label class="label label-danger"><?php echo $this->lang->line('LABEL_TOTAL')?></label></td>
                        <td class="text-center"><?php echo $sum_total_budgeted;?></td>
                        <td class="text-center"><?php echo $sum_total_targeted;?></td>
                        <td class="text-center"><?php echo $sum_actual_sales;?></td>
                        <td></td>
                        <td></td>
                        <td class="text-center"><?php echo $sum_total_sales;?></td>
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

<script>
    jQuery(document).ready(function()
    {
        $(document).off("click", ".target_from_customer");
        $(document).off("click", ".final_target");

        $(document).on("click",".crossSpan",function()
        {
            $(".popBudgetContainer").hide();
            $(".popTargetContainer").hide();
        });

        $(document).on("click", ".target_from_customer", function(event)
        {
            $(this).closest('.tr_class').find('.popBudgetContainer').html('');
            var year = $("#year").val();
            var variety = $(this).closest('.tr_class').find('#variety_id').val();
            var division = $("#division").val();
            var zone = $("#zone").val();
            var territory = $("#territory").val();
            var district = $("#district").val();
            var customer = $("#customer").val();

            if((division).length<2 && (zone).length<2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 0;
            }
            else if((division).length>2 && (zone).length<2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 1;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 2;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && !district && (customer).length<2)
            {
                var selection_type = 3;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && district>0 && (customer).length<2)
            {
                var selection_type = 4;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && district>0 && (customer).length>2)
            {
                var selection_type = 5;
            }

            var sl = $(this).closest('.tr_class').find('.serial').val();
            $(this).closest('.tr_class').find('.popBudgetContainer').show();

            $.ajax({
                url: base_url+"report_sales_quantity_target/get_budgeted_detail_info",
                type: 'POST',
                dataType: "JSON",
                data:{data_type:1, sl:sl, selection_type:selection_type, year:year, variety:variety, division:division, zone:zone, territory:territory, district:district, customer:customer},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });
        });

        $(document).on("click", ".final_target", function(event)
        {
            $(this).closest('.tr_class').find('.popTargetContainer').html('');
            var year = $("#year").val();
            var variety = $(this).closest('.tr_class').find('#variety_id').val();
            var division = $("#division").val();
            var zone = $("#zone").val();
            var territory = $("#territory").val();
            var district = $("#district").val();
            var customer = $("#customer").val();

            if((division).length<2 && (zone).length<2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 0;
            }
            else if((division).length>2 && (zone).length<2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 1;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length<2 && !district && (customer).length<2)
            {
                var selection_type = 2;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && !district && (customer).length<2)
            {
                var selection_type = 3;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && district>0 && (customer).length<2)
            {
                var selection_type = 4;
            }
            else if((division).length>2 && (zone).length>2 && (territory).length>2 && district>0 && (customer).length>2)
            {
                var selection_type = 5;
            }

            var sl = $(this).closest('.tr_class').find('.serial').val();
            $(this).closest('.tr_class').find('.popTargetContainer').show();

            $.ajax({
                url: base_url+"report_sales_quantity_target/get_budgeted_detail_info",
                type: 'POST',
                dataType: "JSON",
                data:{data_type:2, sl:sl, selection_type:selection_type, year:year, variety:variety, division:division, zone:zone, territory:territory, district:district, customer:customer},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });
        });
    });
</script>