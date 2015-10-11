<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
<div class="clearfix"></div>


<div class="row show-grid">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <th class="text-center"><?php echo $this->lang->line('LABEL_CROP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_TYPE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_BUDGETED_SALES_QTY_HO')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_VARIANCE')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_BUDGETED_PURCHASE_QUANTITY')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_ACTUAL_PURCHASE_CONFIRMED')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_PI_VALUE_US')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_MONTH_SETUP')?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>
            <?php
            foreach($varieties as $key=>$variety)
            {
                $budgeted_sales_quantity = $this->confirmed_quantity_setup_model->get_budgeted_sales_quantity($year, $variety['crop_id'], $variety['product_type_id'], $variety['varriety_id']);
                $min_stock_quantity = $this->confirmed_quantity_setup_model->get_budget_min_stock_quantity($variety['crop_id'], $variety['product_type_id'], $variety['varriety_id']);
                $current_stock = Purchase_helper::get_current_stock($variety['crop_id'], $variety['product_type_id'], $variety['varriety_id']);
            ?>
            <tr class="main_tr">
                <td class="text-center"><?php echo $variety['crop_name'];?></td>
                <td class="text-center"><?php echo $variety['product_type'];?></td>
                <td class="text-center"><?php echo $variety['varriety_name'];?></td>
                <td class="text-center"><?php echo $budgeted_sales_quantity;?></td>
                <td class="text-center"><?php echo $current_stock - $min_stock_quantity;?></td>
                <td class="text-center"><?php echo $budgeted_sales_quantity - ($current_stock - $min_stock_quantity);?></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity confirmed_quantity_input numbersOnly" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][confirmed_quantity]" value="" /></td>
                <td class="text-center"><input type="text" class="form-control variety_total_quantity pi_value_input numbersOnly" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][pi_value]" value="" /></td>
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
                                <tr>
                                    <td>
                                        <div>
                                            <select name="month_setup[<?php echo $variety['varriety_id'];?>][month]" id="month" class="form-control">
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
                                            <input style="width: 100px;" type="text" name="month_setup[<?php echo $variety['varriety_id'];?>][quantity]" id="quantity" class="form-control month_qty numbersOnly" />
                                        </div>
                                    </td>

                                    <td style="min-width: 25px;">
<!--                                        <img style="width: 25px; height: 25px;" src="--><?php //echo base_url().'images/xmark.png'?><!--" />-->
                                    </td>
                                </tr>
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
                                        <textarea class="form-control" name="quantity[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][remarks]" placeholder="Add Remarks"></textarea>
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

        $(document).on("click", ".load_month", function(event)
        {
            $(this).closest('td').find('.popContainer2').show();

            var confirmed_quantity = parseInt($(this).closest('.main_tr').find('.confirmed_quantity_input').val());

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

            $(this).closest('.main_tr').find('.remaining_quantity_label').html(new_remaining_val);
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
        cell1.innerHTML = "<select name='month_setup[" + variety + "][month]' id='month" + ExId + "' class='form-control'>\n\
        <option value=''><?php echo $this->lang->line('SELECT');?></option>\n\
        <?php
        foreach ($months as $val=>$month)
            echo "<option value='$val'>".$month. "</option>";
        ?>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<input style='width: 100px;' type='text' name='month_setup[" + variety + "][quantity]' id='quantity" + ExId + "' class='form-control month_qty numbersOnly'/>\n\
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