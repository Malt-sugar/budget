<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-lg-12" style="overflow: auto;">
        <table class="table table-hover table-bordered">
            <th class="text-center"><?php echo $this->lang->line('LABEL_CROP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TYPE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_LAST_YEAR_MRP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_MRP_BY_MGT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_MARKETING_MRP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_COMMISSION')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_BONUS')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>
            <?php
            $crop_name = '';
            $product_type_name = '';

            foreach($varieties as $key=>$variety)
            {
                $detail = Pricing_helper::get_pricing_marketing_info($year, $variety['varriety_id']);
                $existing_data = Pricing_helper::get_pricing_marketing_existing_info($year, $variety['varriety_id']);
            ?>
            <tr class="main_tr">
                <td class="text-center">
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
                <td class="text-center">
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
                <td class="text-center"><?php echo $variety['varriety_name'];?></td>
                <td class="text-center"><?php echo $detail['last_year_mrp'];?></td>
                <td class="text-center"><?php echo $detail['mrp_by_mgt'];?></td>
                <td class="text-center"><input type="text" name="pricing[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][mrp]" class="form-control sales_bonus numbersOnly" value="<?php echo isset($existing_data['mrp'])?$existing_data['mrp']:'';?>" /></td>
                <td class="text-center"><input type="text" name="pricing[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_commission]" class="form-control sales_bonus numbersOnly" value="<?php echo isset($existing_data['sales_commission'])?$existing_data['sales_commission']:$detail['sales_commission'];?>" /></td>
                <td class="text-center"><input type="text" name="pricing[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_bonus]" class="form-control sales_bonus numbersOnly" value="<?php echo isset($existing_data['sales_bonus'])?$existing_data['sales_bonus']:$detail['sales_bonus'];?>" /></td>
                <td class="text-center"><input type="text" name="pricing[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][other_incentive]" class="form-control other_incentive numbersOnly" value="<?php echo isset($existing_data['other_incentive'])?$existing_data['other_incentive']:$detail['other_incentive'];?>" /></td>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-primary load_remark">+R</label>
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="pricing[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][remarks]" placeholder="Add Remarks"><?php if(isset($existing_confirmed_quantity['remarks'])){echo $existing_confirmed_quantity['remarks'];}?><?php echo isset($existing_data['remarks'])?$existing_data['remarks']:'';?></textarea>
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
            <?php
            }
            ?>
        </table>
    </div>
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

        $(document).on("blur",".other_incentive",function()
        {
            var net_sales_price = parseFloat($(this).closest('.main_tr').find(".net_sales_price").val());
            var sales_bonus = parseFloat($(this).closest('.main_tr').find(".sales_bonus").val());
            var other_incentive = parseFloat($(this).val());

            var total_budgeted_mrp = (net_sales_price + (sales_bonus/100)*net_sales_price + (other_incentive/100)*net_sales_price).toFixed(2);
            $(this).closest('.main_tr').find(".total_budgeted_mrp").val(total_budgeted_mrp);
        });
    });
</script>