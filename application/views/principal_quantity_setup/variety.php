<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_HOM_BUDGET');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_CURRENT_VARIANCE');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_EXPECTED_YEAR_END_VARIANCE');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_QUANTITY_NEEDED');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_INITIAL_CONFIRMATION');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_FINAL_CONFIRMATION');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_ACTUAL_PURCHASE');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_FINAL_TARGETED_QUANTITY');?></th>
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
                <?php
                    $detail = Sales_target_helper::get_required_country_variety_detail_principal($year, $variety['varriety_id']);
                    $current_stock = Purchase_helper::get_current_stock($variety['crop_id'], $variety['product_type_id'], $variety['varriety_id']);
                    $min_stock = $this->principal_quantity_setup_model->get_budget_min_stock_quantity($variety['crop_id'], $variety['product_type_id'], $variety['varriety_id']);
                    $variance = $current_stock - $min_stock;
                    $existing = $this->principal_quantity_setup_model->get_existing_principal_quantity($year, $variety['varriety_id']);
                ?>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-info"><?php echo $detail['budgeted_quantity'];?></label>
                    <input type="hidden" class="ho_budget" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][hom_sales_target]" value="<?php echo $detail['budgeted_quantity'];?>" />
                </td>
                <td><input type="text" name="" class="form-control current_variance quantity" value="<?php echo $variance;?>" /></td>
                <td>
                    <div style="margin-top: -7px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                    <input type="text" class="form-control expected_variance quantity" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][expected_year_end_variance]" value="<?php if(isset($existing['expected_year_end_variance'])){echo $existing['expected_year_end_variance'];}else{echo $variance;}?>" />
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][expected_year_end_variance_remark]" placeholder="Add Remarks"><?php if(isset($existing['expected_year_end_variance_remark'])){echo $existing['expected_year_end_variance_remark'];}?></textarea>
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
                <td><input type="text" class="form-control quantity_needed" name="" value="<?php if(isset($existing['expected_year_end_variance'])){echo ($detail['budgeted_quantity']-$existing['expected_year_end_variance']);}else{echo ($detail['budgeted_quantity']-$variance);}?>" /></td>
                <td>
                    <div style="margin-top: -7px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                    <input type="text" class="form-control quantity" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][initial_confirmation]" value="<?php if(isset($existing['initial_confirmation'])){echo $existing['initial_confirmation'];}?>" />
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][initial_confirmation_remark]" placeholder="Add Remarks"><?php if(isset($existing['initial_confirmation_remark'])){echo $existing['initial_confirmation_remark'];}?></textarea>
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
                <td>
                    <div style="margin-top: -7px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                    <input type="text" class="form-control quantity" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][final_confirmation]" value="<?php if(isset($existing['final_confirmation'])){echo $existing['final_confirmation'];}?>" />
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][final_confirmation_remarks]" placeholder="Add Remarks"><?php if(isset($existing['final_confirmation_remarks'])){echo $existing['final_confirmation_remarks'];}?></textarea>
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
                <td>
                    <div style="margin-top: -7px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                    <input type="text" class="form-control quantity" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][actual_purchase]" value="<?php if(isset($existing['actual_purchase'])){echo $existing['actual_purchase'];}?>" />
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][actual_purchase_remarks]" placeholder="Add Remarks"><?php if(isset($existing['actual_purchase_remarks'])){echo $existing['actual_purchase_remarks'];}?></textarea>
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
                <td>
                    <div style="margin-top: -7px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                    <input type="text" class="form-control quantity" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][final_targeted_quantity]" value="<?php if(isset($existing['final_targeted_quantity'])){echo $existing['final_targeted_quantity'];}?>" />
                    <div class="row popContainer" style="display: none;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <div class="col-lg-12">
                                        <textarea class="form-control" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][final_targeted_quantity_remarks]" placeholder="Add Remarks"><?php if(isset($existing['final_targeted_quantity_remarks'])){echo $existing['final_targeted_quantity_remarks'];}?></textarea>
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