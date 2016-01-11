<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <td class="text-center text-center" style="vertical-align: middle;">
                <table class="table table-bordered" style="margin-bottom: 0px;">
                    <tr>
                        <?php
                        foreach($distributors as $key=>$distributor)
                        {
                        ?>
                            <td class="customer text-center" style="width: 120px; vertical-align: middle;">
                                <label class="label label-primary"><?php echo $distributor['text'];?></label>
                            </td>
                        <?php
                        }
                        ?>
                    </tr>
                </table>
            </td>
            <th class="text-center" style="vertical-align: middle;"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_TOTAL');?> (kg)</label></th>
            <th class="text-center" style="vertical-align: middle;"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_TERRITORY_BUDGET');?></label></th>
            <th class="text-center" style="vertical-align: middle;"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_VARIANCE');?></label></th>
            <th class="text-center" style="vertical-align: middle;"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_REMARKS');?></label></th>
        </tr>

        <?php
        $crop_name = '';
        $product_type_name = '';

        foreach($varieties as $variety)
        {
        ?>
            <tr>
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
                <td class="text-center" style="vertical-align: middle;">
                    <table class="table table-bordered" style="margin-bottom: 0px;">
                        <tr>
                            <?php
                            $total_required = 0;
                            foreach($distributors as $distributor)
                            {
                                $required = Sales_target_helper::get_total_target_customer($distributor['value'], $variety['varriety_id'], $year);
                                $total_required += $required;
                                ?>
                                <td class="customer_value text-center">
                                    <div class="col-lg-12" style="width: 120px;">
                                        <label class="label label-default"><?php if($required){echo $required;}else{echo 0;}?></label>
                                    </div>
                                </td>
                            <?php
                            }
                            $detail = Sales_target_helper::get_required_territory_variety_detail($year, $variety['varriety_id']);
                            ?>
                        </tr>
                    </table>
                </td>
                <td class="text-center" style="vertical-align: middle;"><label class="label label-info required_total"><?php echo $total_required;?></label> </td>
                <td class="text-center" style="vertical-align: middle;"><input type="text" <?php if(Sales_target_helper::check_ti_edit_target_permission($year, $variety['varriety_id'])){echo 'readonly';}?> name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][budgeted_quantity]" class="form-control total" value="<?php echo $detail['budgeted_quantity'];?>" /></td>
                <td class="text-center" style="vertical-align: middle;"><input type="text" readonly class="form-control variance" value="<?php if(isset($detail['budgeted_quantity'])){echo $detail['budgeted_quantity']-$total_required;}?>" /></td>
                <td class="text-center" style="vertical-align: middle;">
                    <div class="col-lg-2">
                        <label data-toggle="tooltip" data-placement="left" title="<?php echo $detail['bottom_up_remarks'];?>" class="label label-primary load_remark">+R</label>
                    </div>

                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" <?php if(Sales_target_helper::check_ti_edit_target_permission($year, $variety['varriety_id'])){echo 'readonly';}?> name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][bottom_up_remarks]" placeholder="Add Remarks"><?php echo $detail['bottom_up_remarks'];?></textarea>
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

    <table class="table table-bordered">
        <tr>
            <td class="text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <input type="checkbox" name="forward" value="1" /> <label class="label label-primary"><?php echo $this->lang->line('LABEL_FORWARD');?></label>
                    </div>
                </div>
            </td>
        </tr>
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
    });
</script>