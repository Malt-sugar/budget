<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="clearfix"></div>


<div class="row show-grid">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <th class="text-center"><?php echo $this->lang->line('LABEL_CROP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TYPE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_NET_SALES_PRICE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_BONUS')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_BUDGETED_MRP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_NET_SALES')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_NET_PROFIT')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>
            <?php
            $crop_name = '';
            $product_type_name = '';
            foreach($varieties as $key=>$variety)
            {
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
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center"><?php echo '';?></td>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-primary load_remark">+R</label>
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][remarks]" placeholder="Add Remarks"><?php if(isset($existing_confirmed_quantity['remarks'])){echo $existing_confirmed_quantity['remarks'];}?></textarea>
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
        turn_off_triggers();
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