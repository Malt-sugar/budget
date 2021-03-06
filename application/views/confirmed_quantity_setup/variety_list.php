<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <th class="text-center"><?php echo $this->lang->line('LABEL_CROP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TYPE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_HO_BUDGET')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_ACTUAL_PURCHASE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_PI_VALUE_US')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_BUDGETED_COGS')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_MONTH_SETUP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>
            <?php
            $crop_name = '';
            $product_type_name = '';

            foreach($varieties as $key=>$variety)
            {
                $target_quantity = $this->confirmed_quantity_setup_model->get_target_finalise_quantity($year, $variety['varriety_id']);
                $existing_confirmed_quantity = Purchase_helper::get_existing_confirmed_quantity($year, $variety['varriety_id']);
                $existing_budget_months = Purchase_helper::get_existing_budget_months($year, $variety['varriety_id']);
                $direct_costs = $this->confirmed_quantity_setup_model->get_direct_costs($year);
                $packing_and_sticker = $this->confirmed_quantity_setup_model->get_packing_and_sticker_cost($variety['varriety_id']);

                $pi = $existing_confirmed_quantity['pi_value']*$direct_costs['usd_conversion_rate'];

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

                $cogs = $pi + ($direct_costs['lc_exp']/100)*$pi + ($direct_costs['insurance_exp']/100)*$pi + ($packing_material_cost/100)*$pi + ($sticker_cost/100)*$pi + ($direct_costs['carriage_inwards']/100)*$pi + ($direct_costs['air_freight_and_docs']/100)*$pi + ($direct_costs['cnf']/100)*$pi + ($direct_costs['bank_other_charges']/100)*$pi + ($direct_costs['ait']/100)*$pi + ($direct_costs['miscellaneous']/100)*$pi;

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
                <td class="text-center"><?php echo $target_quantity['hom_sales_target'];?></td>
                <td class="text-center">
                    <input type="hidden" class="form-control variety_total_quantity confirmed_quantity numbersOnly" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][confirmed_quantity]" value="<?php echo $target_quantity['actual_purchase'];?>" />
                    <input type="hidden" class="form-control packing_status" name="" value="<?php echo isset($packing_and_sticker['packing_status'])?$packing_and_sticker['packing_status']:0;?>" />
                    <input type="hidden" class="form-control sticker_status" name="" value="<?php echo isset($packing_and_sticker['sticker_status'])?$packing_and_sticker['sticker_status']:0;?>" />
                    <input type="hidden" class="form-control packing_material_cost" name="" value="<?php echo $packing_material_cost;?>" />
                    <input type="hidden" class="form-control sticker_cost" name="" value="<?php echo $sticker_cost;?>" />
                    <?php echo $target_quantity['actual_purchase'];?>
                </td>
                <td class="text-center"><input type="text" class="form-control pi_value_input numbersOnly" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][pi_value]" value="<?php if(isset($existing_confirmed_quantity['pi_value'])){echo $existing_confirmed_quantity['pi_value'];}?>" /></td>
                <td class="text-center budgeted_cogs"><?php if(isset($cogs)){echo round($cogs, 2);}?></td>
                <td class="text-center" style="vertical-align: middle;">
                    <label class="label label-info load_month">+S</label>
                    <div class="row popContainer2" style="display: none; max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <?php echo $this->lang->line('LABEL_CONFIRMED_QUANTITY');?>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <label class="label label-success confirmed_quantity_label">100</label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $this->lang->line('LABEL_REMAINING_QUANTITY');?>
                                </td>
                                <td style="vertical-align: middle;" class="text-center">
                                    <label class="label label-warning remaining_quantity_label">80</label>
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered" id="adding_elements<?php echo $key;?>" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo $this->lang->line('LABEL_MONTH');?></th>
                                    <th><?php echo $this->lang->line('LABEL_QUANTITY');?></th>
                                </tr>
                            </thead>

                            <tbody>

                            <?php
                            if(is_array($existing_budget_months) && sizeof($existing_budget_months)>0)
                            {
                                foreach($existing_budget_months as $budget_month)
                                {
                                ?>
                                <tr id="edit_tr">
                                    <td>
                                        <div>
                                            <select name="month_setup[<?php echo $variety['varriety_id'];?>][month][]" id="month" class="form-control">
                                                <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                                <?php
                                                $months = $this->config->item('month');
                                                foreach($months as $val=>$month)
                                                {
                                                    ?>
                                                    <option value="<?php echo $val?>" <?php if($budget_month['month']==$val){echo 'selected';}?>><?php echo $month;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <input style="width: 100px;" type="text" name="month_setup[<?php echo $variety['varriety_id'];?>][quantity][]" id="quantity" class="form-control month_qty numbersOnly" value="<?php if(isset($budget_month['quantity'])){echo $budget_month['quantity'];}?>" />
                                        </div>
                                    </td>

                                    <td style="min-width: 25px;" id="delete_edit_tr">
                                        <img src="<?php echo base_url().'images/xmark.png';?>" style="height: 25px; width: 25px;" />
                                    </td>
                                </tr>
                            <?php
                                }
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td>
                                        <div>
                                            <select name="month_setup[<?php echo $variety['varriety_id'];?>][month][]" id="month" class="form-control">
                                                <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                                <?php
                                                $months = $this->config->item('month');
                                                foreach($months as $val=>$month)
                                                {
                                                    ?>
                                                    <option value="<?php echo $val?>"><?php echo $month;?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <input style="width: 100px;" type="text" name="month_setup[<?php echo $variety['varriety_id'];?>][quantity][]" id="quantity" class="form-control month_qty numbersOnly" />
                                        </div>
                                    </td>

                                    <td style="min-width: 25px;">
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <table class="table">
                            <tr>
                                <td class="pull-right" style="border: 0px;">
                                    <img style="width: 20px; height: 20px;" src="<?php echo base_url().'images/plus.png'?>" onclick="RowIncrement(<?php echo $key;?>, '<?php echo $variety['varriety_id']?>')" />
                                </td>
                            </tr>
                        </table>

                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center" style="border: 0px;">
                                    <div class="col-lg-12">
                                        <label class="label label-primary crossSpanMonth"><?php echo $this->lang->line('OK');?></label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

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
        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
        });

        $(document).on("click","#delete_edit_tr",function()
        {
            $(this).closest('#edit_tr').remove();
        });

        $(document).on("click", ".load_month", function(event)
        {
            $(this).closest('td').find('.popContainer2').show();

            var confirmed_quantity = parseInt($(this).closest('.main_tr').find('.confirmed_quantity').val());

            if(confirmed_quantity>0)
            {
                $(this).closest('.main_tr').find('.confirmed_quantity_label').html(confirmed_quantity);

                var attr = $(this).closest('.main_tr').find('.month_qty');
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

                var new_remaining_qty = confirmed_quantity - sum;
                $(this).closest('.main_tr').find('.remaining_quantity_label').html(new_remaining_qty);
            }
            else
            {
                $(this).closest('.main_tr').find('.confirmed_quantity_label').html(0);
                $(this).closest('.main_tr').find('.remaining_quantity_label').html(0);
            }
        });

        $(document).on("keyup",".month_qty",function()
        {
            var attr = $(this).closest('.main_tr').find('.month_qty');
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

            var confirmed_qty = parseInt($(this).closest('.main_tr').find('.confirmed_quantity_label').html());
            var new_remaining_val = confirmed_qty - sum;

            if(sum > confirmed_qty)
            {
                $(this).val('');
                alert('Quantity Exceeds!')
            }
            else
            {
                $(this).closest('.main_tr').find('.remaining_quantity_label').html(new_remaining_val);
            }
        });

        $(document).on("click",".crossSpanMonth",function()
        {
            $(".popContainer2").hide();
        });
    });

    var ExId = 0;
    function RowIncrement(key, variety)
    {
        var img_url="<?php echo base_url().'images/xmark.png'?>";
        var table = document.getElementById('adding_elements'+key);
        var rowCount = table.rows.length;
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        row.id = "T" + ExId;
        row.className = "tableHover";
        //alert(row.id);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = "<select name='month_setup[" + variety + "][month][]' id='month" + ExId + "' class='form-control'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
        <?php
        foreach ($months as $val=>$month)
            echo "<option value='$val'>".$month. "</option>";
        ?>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<input style='width: 100px;' type='text' name='month_setup[" + variety + "][quantity][]' id='quantity" + ExId + "' class='form-control month_qty numbersOnly'/>\n\
        <input type='hidden' id='task_id[]' name='task_id[]' value=''/>\n\
        <input type='hidden' id='elmIndex[]' name='elmIndex[]' value='" + ExId + "'/>";
        cell1.style.cursor = "default";
        cell1 = row.insertCell(2);
        cell1.innerHTML = "<img style='width: 25px; height: 25px;'  onclick=\"RowDecrement('adding_elements"+key+"', 'T"+ExId+"')\" src='<?php echo base_url().'images/xmark.png'?>' />";
        cell1.style.cursor = "default";
        //document.getElementById('month_setup[" + variety + "][month]' + ExId).focus();
        ExId = ExId + 1;
    }

    function RowDecrement(adding_elements, id)
    {
        try {
            var table = document.getElementById(adding_elements);
            for (var i = 1; i < table.rows.length; i++)
            {
                if (table.rows[i].id == id)
                {
                    table.deleteRow(i);
                }
            }
        }
        catch (e) {
            alert(e);
        }
    }
</script>