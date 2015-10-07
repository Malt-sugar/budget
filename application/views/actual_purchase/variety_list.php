<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <th class="text-center"><?php echo $this->lang->line('LABEL_QUANTITY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_PI_VALUE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_LC_EXP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_INSURANCE_EXP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_AIR_FREIGHT_AND_DOCS')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_CNF')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>

            <tr>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][pi_value]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][pi_value]" value="" /></td>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-primary load_remark">+R</label>
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="quantity[<?php echo $crop_id;?>][<?php echo $type_id;?>][<?php echo $variety_id;?>][remarks]" placeholder="Add Remarks"></textarea>
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