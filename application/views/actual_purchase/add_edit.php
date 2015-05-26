<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url()."actual_purchase";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);


$arranged_purchase = array();

if(is_array($purchases) && sizeof($purchases)>0)
{
    foreach($purchases as $purchase)
    {
        $arranged_purchase['year'] = $purchase['year'];
        $arranged_purchase['setup_id'] = $purchase['setup_id'];
        $arranged_purchase['crop'][$purchase['crop_id']][$purchase['type_id']]['variety'][$purchase['variety_id']]['variety_name'] = $purchase['variety_name'];
        $arranged_purchase['crop'][$purchase['crop_id']][$purchase['type_id']]['variety'][$purchase['variety_id']]['purchase_quantity'] = $purchase['purchase_quantity'];
        $arranged_purchase['crop'][$purchase['crop_id']][$purchase['type_id']]['variety'][$purchase['variety_id']]['price_per_kg'] = $purchase['price_per_kg'];
        $arranged_purchase['crop'][$purchase['crop_id']][$purchase['type_id']]['variety'][$purchase['variety_id']]['created_by'] = $purchase['created_by'];
    }
}
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>actual_purchase/index/save" method="post">
    <input type="hidden" name="year_id" value="<?php if(isset($arranged_purchase['year'])){echo $arranged_purchase['year'];}else{echo 0;}?>" />
    <input type="hidden" name="setup_id" value="<?php if(isset($arranged_purchase['setup_id'])){echo $arranged_purchase['setup_id'];}else{echo 0;}?>" />
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
                <select name="year" id="year" class="form-control validate[required]" <?php if(isset($arranged_purchase['year']) && strlen($arranged_purchase['year'])>1){echo 'disabled';}?>>
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($arranged_purchase['year'])?$arranged_purchase['year']:''));
                    ?>
                </select>
                <?php
                if(isset($arranged_purchase['year']) && strlen($arranged_purchase['year'])>1)
                {
                    ?>
                    <input type="hidden" name="year" value="<?php echo $arranged_purchase['year'];?>" />
                <?php
                }
                ?>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="usd_conversion_rate" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['usd_conversion_rate'])){echo $setups['usd_conversion_rate'];}?>" />
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_LC_EXP');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="lc_exp" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['lc_exp'])){echo $setups['lc_exp'];}?>" />
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_INSURANCE_EXP');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="insurance_exp" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['insurance_exp'])){echo $setups['insurance_exp'];}?>" />
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="packing_material" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['packing_material'])){echo $setups['packing_material'];}?>" />
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="carriage_inwards" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['carriage_inwards'])){echo $setups['carriage_inwards'];}?>" />
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AIR_FREIGHT_AND_DOCS');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="air_freight_and_docs" class="form-control validate[required] setup_quantity" value="<?php if(isset($setups['air_freight_and_docs'])){echo $setups['air_freight_and_docs'];}?>" />
            </div>
        </div>
    </div>

    <div id="budget_add_more_container">
    <?php
    if(isset($arranged_purchase['crop']))
    {
        $sl = 0;
        foreach($arranged_purchase['crop'] as $key=>$crop)
        {
            foreach($crop as $typeKey=>$typeVal)
            {
            ?>
            <div class="budget_add_more_container" style="display: <?php if(isset($crop) && sizeof($crop)>0){echo 'show';}else{echo 'none';}?>;">
                <div class="row widget">
                    <div class="widget-header">
                        <div class="title">
                            <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
                        </div>
                        <?php
                        foreach($typeVal['variety'] as $perm)
                        {
                            $created_by = $perm['created_by'];
                        }

                        if(User_helper::check_edit_permission($created_by))
                        {
                        ?>
                            <button type="button" class="btn btn-danger pull-right budget_add_more_delete"><?php echo $this->lang->line('DELETE'); ?></button>
                        <?php
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>

                    <div class="crop">
                        <div class="col-xs-1">
                            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                        </div>
                        <div class="col-xs-2">
                            <select name="purchase[<?php echo $sl;?>][crop]" class="form-control crop_id" id="crop<?php echo $sl;?>" <?php if(isset($key) && strlen($key)>1){echo 'disabled';}?>>
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>isset($key)?$key:''));
                                ?>
                            </select>
                            <?php
                            if(isset($key) && strlen($key)>1)
                            {
                                ?>
                                <input type="hidden" name="purchase[<?php echo $sl;?>][crop]" value="<?php echo $key;?>" />
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="type" style="display: <?php if(isset($crop) && sizeof($crop)>0){echo 'show';}else{echo 'none';}?>;">
                        <div class="col-xs-1">
                            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
                        </div>
                        <div class="col-xs-2">
                            <select name="purchase[<?php echo $sl;?>][type]" class="form-control type_id" id="type<?php echo $sl;?>" <?php if(strlen($typeKey)>1){echo 'disabled';}?> data-type-current-id="<?php echo $sl;?>">
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>isset($typeKey)?$typeKey:''));
                                ?>
                            </select>
                            <?php
                            if(isset($typeKey) && strlen($typeKey)>1)
                            {
                                ?>
                                <input type="hidden" name="purchase[<?php echo $sl;?>][type]" value="<?php echo $typeKey;?>" />
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-xs-6 variety_quantity" id="variety<?php echo $sl;?>" data-variety-current-id="<?php echo $sl;?>">
                        <?php
                            if(isset($crop) && sizeof($crop)>0)
                            {
                                ?>
                                <div class="row show-grid">
                                    <div class="col-lg-12">
                                        <table class="table table-hover table-bordered">
                                            <?php
                                            if(is_array($typeVal['variety']) && sizeof($typeVal['variety'])>0)
                                            {
                                                ?>
                                                <th><?php echo $this->lang->line('LABEL_VARIETY')?></th>
                                                <th><?php echo $this->lang->line('LABEL_QUANTITY')?></th>
                                                <th><?php echo $this->lang->line('LABEL_PRICE_PER_KG_USD')?></th>
                                                <th><?php echo $this->lang->line('LABEL_TOTAL_PRICE_USD')?></th>
                                                <?php
                                                foreach($typeVal['variety'] as $varKey=>$detail)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $detail['variety_name']?></td>
                                                        <td>
                                                            <input type="text" class="form-control variety_quantity"  name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][purchase_quantity]" value="<?php if(isset($detail['purchase_quantity'])){echo $detail['purchase_quantity'];}?>" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control variety_price_per_kg"  name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][price_per_kg]" value="<?php if(isset($detail['price_per_kg'])){echo $detail['price_per_kg'];}?>" />
                                                            </td>
                                                        <td>
                                                            <input type="text" class="form-control variety_total_quantity"  name="" value="<?php if(isset($detail['purchase_quantity']) && isset($detail['price_per_kg'])){echo $detail['purchase_quantity']*$detail['price_per_kg'];}?>" />
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <tr><td class="label-danger"><?php echo $this->lang->line('NO_VARIETY_EXIST');?></td></tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                            <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                $sl++;
            }
        }
    }
    else
    {
    ?>
        <div class="budget_add_more_container">
            <div class="row widget">
                <div class="widget-header">
                    <div class="title">
                        <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="purchase[0][crop]" class="form-control crop_id" id="crop0">
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
                        <select name="purchase[0][type]" class="form-control type_id" id="type0" data-type-current-id="0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-6 variety_quantity" id="variety0" data-variety-current-id="0">
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    </div>

    <div class="row text-center" id="add_more">
        <button type="button" class="btn btn-warning budget_add_more_button"><?php echo $this->lang->line('ADD_MORE');?></button>
    </div>

    <h1>&nbsp;</h1>

    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container"  data-current-id="<?php if(isset($sl)){echo ($sl-1);}else{echo 0;}?>">
        <div class="widget-header">
            <div class="title">
                <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
            </div>
            <button type="button" class="btn btn-danger pull-right budget_add_more_delete"><?php echo $this->lang->line('DELETE'); ?></button>
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

        <div class="col-xs-6 variety_quantity" id="variety_quantity">
        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

        // ROW INCREMENT FUNCTION
        $(document).on("click", ".budget_add_more_button", function(event)
        {
            var current_id=parseInt($('.budget_add_more_content .budget_add_more_holder').attr('data-current-id'));
            current_id=current_id+1;

            $('.budget_add_more_content .budget_add_more_holder').attr('data-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('name','purchase['+current_id+'][crop]');
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('name','purchase['+current_id+'][type]');

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('data-crop-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('data-type-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('id','crop'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('id','type'+current_id);

            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('data-variety-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('id','variety'+current_id);

            var html=$('.budget_add_more_content').html();
            $('#budget_add_more_container').append(html);
        });

        // Incremented Row Delete Button
        $(document).on("click", ".budget_add_more_delete", function(event)
        {
            $(this).closest('.budget_add_more_container').remove();
        });

        $(document).on("change",".crop_id",function()
        {
            var current_id=parseInt($(this).parents().next('.type').find('.type_id').attr('data-type-current-id'));

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
            var current_id=parseInt($(this).parents().next('.variety_quantity').attr('data-variety-current-id'));

            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"budgeted_purchase/get_varieties_by_crop_type/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop"+current_id).val(), type_id:$(this).val(), current_id: current_id},
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

        $(document).on("keyup", ".variety_quantity", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on("keyup", ".setup_quantity", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on("keyup", ".variety_price_per_kg", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on("blur", ".variety_price_per_kg", function()
        {
            var quantity = parseInt($(this).parent().parent().find('.variety_quantity').val());
            var price_per_kg = parseFloat($(this).val());
            var total = Math.round(quantity*price_per_kg*100)/100;

            $(this).parent().parent().find('.variety_total_quantity').val(total);
        });
    });
</script>