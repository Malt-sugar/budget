<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url()."confirmed_quantity_setup";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);

?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>confirmed_quantity_setup/index/save" method="post">
    <input type="hidden" name="year_id" value="<?php echo isset($year)?$year:0;?>" />
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_YEAR');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="year" id="year" class="form-control validate[required]" <?php if(isset($year) && strlen($year)>1){echo 'disabled';}?>>
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($year)?$year:''));
                    ?>
                </select>
                <?php
                if(isset($year) && strlen($year)>1)
                {
                    ?>
                    <input type="hidden" name="year" value="<?php echo $year;?>" />
                <?php
                }
                ?>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_SELECTION_TYPE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="selection_type" id="selection_type" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="1"><?php echo $this->lang->line('LABEL_CROP_WISE');?></option>
                    <option value="2"><?php echo $this->lang->line('LABEL_TYPE_WISE');?></option>
                </select>
            </div>
        </div>

        <div class="row show-grid" id="crop_select_div" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="crop_select" id="crop_select" class="form-control">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid" id="type_select_div" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="type_select" id="type_select" class="form-control">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div id="budget_add_more_container">
    <?php
    if(is_array($quantity_setups) && sizeof($quantity_setups)>0)
    {
        foreach($quantity_setups as $key=>$quantity)
        {
        ?>
        <div class="budget_add_more_container" style="display: <?php if(isset($quantity['crop_id']) && sizeof($quantity['crop_id'])>0){echo 'show';}else{echo 'none';}?>;">
            <div class="row widget">
                <div class="widget-header" style="padding: 3px 4px 3px 10px;">
                    <div class="title">
                        <?php echo $this->lang->line('LABEL_QUANTITY'); ?>
                    </div>
                    <div class="pull-right budget_add_more_delete"><img style="width: 25px; height: 25px;" src="<?php echo base_url().'images/xmark.png'?>" /></div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="" class="form-control crop_id" id="crop<?php echo $key;?>" <?php if(isset($quantity['crop_id']) && strlen($quantity['crop_id'])>1){echo 'disabled';}?>>
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>isset($quantity['crop_id'])?$quantity['crop_id']:''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="type" style="display: <?php if(isset($quantity['type_id']) && sizeof($quantity['type_id'])>0){echo 'show';}else{echo 'none';}?>;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="purchase[<?php echo $key;?>][type]" class="form-control type_id" id="type<?php echo $key;?>" <?php if(strlen($quantity['type_id'])>1){echo 'disabled';}?> data-type-current-id="<?php echo $key;?>">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>isset($quantity['type_id'])?$quantity['type_id']:''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="variety" style="display: <?php if(isset($quantity['variety_id']) && sizeof($quantity['variety_id'])>0){echo 'show';}else{echo 'none';}?>;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="" class="form-control variety_id" id="variety<?php echo $key;?>" <?php if(strlen($quantity['variety_id'])>1){echo 'disabled';}?> data-variety-current-id="<?php echo $key;?>">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$varieties,'drop_down_selected'=>isset($quantity['variety_id'])?$quantity['variety_id']:''));
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row variety_quantity" id="variety_quantity<?php echo $key;?>" data-varietyDetail-current-id="<?php echo $key;?>">
                <?php
                $variety_detail = Purchase_helper::get_variety_detail($quantity['variety_id']);
                $current_stock = Purchase_helper::get_current_stock($quantity['crop_id'], $quantity['type_id'], $quantity['variety_id']);
                $min_stock_quantity = Purchase_helper::get_budget_min_stock_quantity($quantity['crop_id'], $quantity['type_id'], $quantity['variety_id']);
                $budgeted_sales_quantity = Purchase_helper::get_budgeted_sales_quantity($year, $quantity['crop_id'], $quantity['type_id'], $quantity['variety_id']);
                ?>
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
                            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>

                            <tr>
                                <td class="text-center"><?php echo $variety_detail['crop_name'];?></td>
                                <td class="text-center"><?php echo $variety_detail['product_type'];?></td>
                                <td class="text-center"><?php echo $variety_detail['varriety_name'];?></td>
                                <td class="text-center"><?php echo $budgeted_sales_quantity;?></td>
                                <td class="text-center"><?php echo $current_stock - $min_stock_quantity;?></td>
                                <td class="text-center"><?php echo $budgeted_sales_quantity - ($current_stock - $min_stock_quantity);?></td>
                                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][confirmed_quantity]" value="<?php echo $quantity['confirmed_quantity'];?>" /></td>
                                <td class="text-center"><input type="text" class="form-control variety_total_quantity numbersOnly" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][pi_value]" value="<?php echo $quantity['pi_value'];?>" /></td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <label class="label label-primary load_remark">+R</label>
                                    <div class="row popContainer" style="display: none;">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][remarks]" placeholder="Add Remarks"><?php echo $quantity['remarks'];?></textarea>
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
            </div>
        </div>
        <?php
        }
    }
    else
    {
    ?>
        <div class="budget_add_more_container">
            <div class="row widget">
                <div class="widget-header" style="padding: 3px 4px 3px 10px;">
                    <div class="title">
                        <?php echo $this->lang->line('LABEL_QUANTITY'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="" class="form-control crop_id" id="crop0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="type" style="display: none;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="" class="form-control type_id" id="type0" data-type-current-id="0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="variety" style="display: none;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="" class="form-control variety_id" id="variety0" data-variety-current-id="0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$varieties,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row variety_quantity" id="variety_quantity0" data-varietyDetail-current-id="0">
            </div>
        </div>
        <?php
    }
    ?>
    </div>

    <div class="row text-center" id="add_more">
        <button type="button" class="btn btn-success budget_add_more_button"><?php echo $this->lang->line('ADD_MORE');?></button>
    </div>

    <h1>&nbsp;</h1>

    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container" data-current-id="<?php if(isset($quantity_setups) && sizeof($quantity_setups)>0){echo (sizeof($quantity_setups)-1);}else{echo 0;}?>">
        <div class="widget-header" style="padding: 3px 4px 3px 10px;">
            <div class="title">
                <?php echo $this->lang->line('LABEL_QUANTITY'); ?>
            </div>
            <div class="pull-right budget_add_more_delete"><img style="width: 25px; height: 25px;" src="<?php echo base_url().'images/xmark.png'?>" /></div>
            <div class="clearfix"></div>
        </div>

        <div class="crop">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
            </div>
            <div class="col-xs-2">
                <select class="form-control crop_id" id="crop_id">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="type" style="display: none;">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
            </div>
            <div class="col-xs-2">
                <select name="" class="form-control type_id" id="type_id">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="variety" style="display: none;">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
            </div>
            <div class="col-xs-2">
                <select name="" class="form-control variety_id" id="variety_id">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$varieties,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row variety_quantity" id="variety_quantity" data-varietyDetail-current-id="">
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

        $(document).on("change", "#selection_type", function(event)
        {
            if($(this).val()>0)
            {
                $("#crop_select_div").show();
                $("#type_select_div").hide();
            }
            else
            {
                $("#crop_select_div").hide();
                $("#type_select_div").hide();
            }
        });

        $(document).on("change", "#crop_select", function(event)
        {
            if($(this).val().length>1 && $("#selection_type").val()==1)
            {

            }
            else if($(this).val().length>1 && $("#selection_type").val()==2)
            {
                $("#type_select_div").show();
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/get_dropDown_type_by_crop/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$(this).val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else
            {
                $("#type_select_div").hide();
            }
        });

        // ROW INCREMENT FUNCTION
        $(document).on("click", ".budget_add_more_button", function(event)
        {
            var current_id = parseInt($('.budget_add_more_content .budget_add_more_holder').attr('data-current-id'));
            current_id = current_id+1;

            $('.budget_add_more_content .budget_add_more_holder').attr('data-current-id',current_id);

//            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('name','purchase['+current_id+'][crop]');
//            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('name','purchase['+current_id+'][type]');
//            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('name','purchase['+current_id+'][variety]');

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('data-crop-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('data-type-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('data-variety-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('id','crop'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('id','type'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('id','variety'+current_id);

            $('.budget_add_more_content .budget_add_more_holder').next('.variety_quantity').attr('data-varietyDetail-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder').next('.variety_quantity').attr('id','variety_quantity'+current_id);

            var html = $('.budget_add_more_content').html();
            $('#budget_add_more_container').append(html);
        });

        // Incremented Row Delete Button
        $(document).on("click", ".budget_add_more_delete", function(event)
        {
            $(this).closest('.budget_add_more_container').next('.variety_quantity').remove();
            $(this).closest('.budget_add_more_container').remove();
        });

        $(document).on("change",".crop_id",function()
        {
            var current_id = parseInt($(this).parents().next('.type').find('.type_id').attr('data-type-current-id'));

            //alert(current_id);
            if($(this).val().length>0)
            {
                $(this).parents().next('.type').show();
                $(this).parents().next('.type').next('.variety_quantity').html('');

                $.ajax({
                    url: base_url+"budget_common/get_dropDown_type_by_crop/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$(this).val(), current_id:current_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else
            {
                $(this).parents().next('.type').hide();
                $(this).parents().next('.type').val('');
                $(this).parents().next('.type').next('.variety_quantity').html('');
            }
        });

        $(document).on("change",".type_id",function()
        {
            var current_id = parseInt($(this).parents().next('.variety').find('.variety_id').attr('data-variety-current-id'));

            if($(this).val().length>0)
            {
                $(this).parents().next('.variety').show();
                $(this).parents().next('.variety').next('.variety_quantity').html('');

                $.ajax({
                    url: base_url+"budget_common/get_dropDown_variety_by_cropType/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop"+current_id).val(), type_id:$(this).val(), current_id:current_id},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else
            {
                $(this).parents().next('.variety').hide();
                $(this).parents().next('.variety').val('');
                $(this).parents().next('.variety').next('.variety_quantity').html('');
            }
        });

        $(document).on("change",".variety_id",function()
        {
            var current_id = parseInt($(this).parents().next('.variety_quantity').attr('data-varietyDetail-current-id'));
            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/get_quantity_detail_by_variety/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id: $("#crop"+current_id).val(), type_id: $("#type"+current_id).val(), variety_id: $(this).val(), current_id: current_id, year: $("#year").val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else
            {
                $(this).parents().next('.variety_quantity').html('');
            }
        });

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/check_budget_purchase_this_year/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{year:$(this).val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
        });

        $(document).on("keyup", ".numbersOnly", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        // tooltip trigger
        //$('[data-toggle="tooltip"]').tooltip();

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