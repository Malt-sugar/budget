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
            <th class="text-center"><?php echo $this->lang->line('LABEL_MGT_MRP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_MARKETING_MRP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PER')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_BONUS_MGT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_MGT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_NET_SALES_PRICE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_NET_PROFIT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_NET_SALES')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_NET_PROFIT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_PROFIT_PER')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>

            <?php
            $crop_name = '';
            $product_type_name = '';

            foreach($varieties as $key=>$variety)
            {
                $net_sales_price = 0;
                $total_net_sales_price = 0;
                $net_profit = 0;
                $total_net_profit = 0;
                $profit_percentage = 0;

                $detail = Pricing_helper::get_pricing_marketing_detail_info($year, $variety['varriety_id']);

                $total_cogs = ($detail['cogs'] + ($detail['ho_and_gen_exp']/100)*$detail['cogs'] + ($detail['marketing']/100)*$detail['cogs'] + ($detail['finance_cost']/100)*$detail['cogs']);
                $existing_data = Pricing_helper::get_pricing_marketing_existing_info($year, $variety['varriety_id']);

                if(is_array($existing_data) && sizeof($existing_data)>0)
                {
                    $net_sales_price = round($existing_data['mrp'] - ($existing_data['sales_bonus']/100)*$existing_data['mrp'] - ($existing_data['other_incentive']/100)*$existing_data['mrp'] - ($detail['sales_commission']/100)*$existing_data['mrp'], 2);
                    $total_net_sales_price = round($net_sales_price*$detail['targeted_quantity'], 2);

                    $net_profit = round($existing_data['mrp'] - $total_cogs, 2);
                    $total_net_profit = round($net_profit*$detail['targeted_quantity'], 2);
                    if($total_cogs>0)
                    {
                        $profit_percentage = round(($total_net_profit/$total_cogs)*100, 2);
                    }
                    else
                    {
                        $profit_percentage = 0;
                    }
                }
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
                <td class="text-center"><?php echo $detail['management_mrp'];?></td>
                <td class="text-center"><?php echo isset($existing_data['mrp'])?$existing_data['mrp']:'';?></td>
                <td class="text-center"><?php echo isset($existing_data['sales_commission'])?$existing_data['sales_commission']:'';?></td>
                <td class="text-center"><?php echo isset($existing_data['sales_bonus'])?$existing_data['sales_bonus']:'';?></td>
                <td class="text-center"><?php echo isset($existing_data['other_incentive'])?$existing_data['other_incentive']:'';?></td>
                <td class="text-center net_sales_price"><?php if(isset($net_sales_price)){echo $net_sales_price;}?></td>
                <td class="text-center net_profit"><?php if(isset($net_profit)){echo $net_profit;}?></td>
                <td class="text-center total_net_sales"><?php if(isset($total_net_sales_price)){echo $total_net_sales_price;}?></td>
                <td class="text-center total_net_profit"><?php if(isset($total_net_profit)){echo $total_net_profit;}?></td>
                <td class="text-center profit_percentage"><?php if(isset($profit_percentage)){echo $profit_percentage;}?></td>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-primary load_remark">+R</label>
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" readonly name="" placeholder="Add Remarks"><?php if(isset($existing_confirmed_quantity['remarks'])){echo $existing_confirmed_quantity['remarks'];}?><?php echo isset($existing_data['remarks'])?$existing_data['remarks']:'';?></textarea>
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
    });
</script>