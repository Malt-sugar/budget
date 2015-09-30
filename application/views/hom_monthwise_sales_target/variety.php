<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <td class="text-center">
                <table class="table table-bordered" style="margin-bottom: 0px;">
                    <tr>
                        <td class="text-center"><label class="label label-success">Monthwise Target</label></td>
                    </tr>
                </table>
            </td>
            <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_TARGETED');?></label></th>
            <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_REMAINING');?></label></th>
        </tr>

        <?php
        $crop_name = '';
        $product_type_name = '';

        foreach($varieties as $variety)
        {
        ?>
            <tr class="variety_tr">
                <td>
                    <?php
                    if($crop_name == '')
                    {
                        echo $variety['crop_name'];
                        $crop_name = $variety['crop_name'];
                    }
                    elseif($crop_name == $variety['crop_name'])
                    {
                        echo "&nbsp;";
                    }
                    else
                    {
                        echo $variety['crop_name'];
                        $crop_name = $variety['crop_name'];
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if($product_type_name == '')
                    {
                        echo $variety['product_type'];
                        $product_type_name = $variety['product_type'];
                    }
                    elseif($product_type_name == $variety['product_type'])
                    {
                        echo "&nbsp;";
                    }
                    else
                    {
                        echo $variety['product_type'];
                        $product_type_name = $variety['product_type'];
                    }
                    ?>
                </td>
                <td><?php echo $variety['varriety_name'];?></td>
                <td>
                    <table class="table table-bordered" style="margin-bottom: 0px;">
                        <tr class="sum_tr">
                            <?php
                            $months = Sales_target_helper::get_variety_months($year, $variety['varriety_id']);

                            $monthConfig = $this->config->item('month');
                            $total_target = 0;
                            if(is_array($months) && sizeof($months)>0)
                            {
                                foreach($months as $month)
                                {
                                    $existingDetail = Sales_target_helper::get_monthWise_hom_sales_target($year, $month, $variety['varriety_id'], $type, $division);
                                    $total_target += $existingDetail['target'];
                                    ?>
                                    <td class="customer_value text-center">
                                        <table class="table table-bordered" style="margin-bottom: 0px;">
                                            <tr>
                                                <td style="padding-top: 15px;"><label class="label label-warning"><?php if($month){echo $monthConfig[$month];}?></label></td>
                                                <td style="width: 100px;">
                                                    <input type="text" disabled class="form-control month_total quantity" name="variety[<?php echo $variety['varriety_id'];?>][<?php echo $month;?>][target]" value="<?php echo $existingDetail['target'];?>" />

                                                    <div class="col-lg-1 pull-right" style="margin-top: -44px;">
                                                        <label class="label label-primary load_remark">+R</label>
                                                    </div>

                                                    <div class="row popContainer" style="display: none;">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <td>
                                                                    <div class="col-lg-12">
                                                                        <textarea class="form-control" disabled name="variety[<?php echo $variety['varriety_id'];?>][<?php echo $month;?>][remarks]" placeholder="Add Remarks"><?php echo $existingDetail['remarks'];?></textarea>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pull-right" style="border: 0px;">
                                                                    <div class="col-lg-12">
                                                                        <label class="label label-primary crossSpan"><?php echo $this->lang->line('OK');?></label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                <?php
                                }
                            }
                            $detail = Sales_target_helper::get_hom_monthwise_variety_detail($year, $variety['varriety_id'], $type, $division);
                            ?>
                        </tr>
                    </table>
                </td>
                <td class="text-center" style="padding-top: 36px;">
                    <input type="hidden" name="sales_id[<?php echo $variety['varriety_id'];?>]" value="<?php echo $detail['id'];?>"/>
                    <?php if($detail['targeted_quantity']>0){ ?>
                        <label class="label label-info targeted_total">
                            <?php echo $detail['targeted_quantity'];?>
                        </label>
                    <?php }?>
                </td>
                <td class="text-center" style="width: 80px; padding-top: 36px;">
                    <?php if($detail['targeted_quantity']>0){ ?>
                    <label class="label label-info remaining_total"><?php echo $detail['targeted_quantity']-$total_target;?></label>
                    <?php }?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    jQuery(document).ready(function()
    {
        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
        });

        $('[data-toggle="tooltip"]').tooltip();

        $(document).on("keyup", ".month_total", function(event)
        {
            var attr = $(this).closest('.sum_tr').find('.month_total');
            var sum = 0;

            attr.each(function()
            {
                var val = $(this).val();
                if(val)
                {
                    val = parseFloat( val.replace( /^\$/, "" ));
                    sum += !isNaN( val ) ? val : 0;
                }
            });

            var targeted_val = parseInt($(this).closest('.sum_tr').closest('.variety_tr').find('.targeted_total').html());
            var new_remaining_val = targeted_val - sum;

            $(this).closest('.sum_tr').closest('.variety_tr').find('.remaining_total').html(new_remaining_val);
        });
    });
</script>