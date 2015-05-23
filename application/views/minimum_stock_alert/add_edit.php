<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]="#";
    $data["hide_back"]="1";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);


$arranged_stocks = array();

if(is_array($stocks) && sizeof($stocks)>0)
{
    foreach($stocks as $stock)
    {
        $arranged_stocks['division_id'] = $stock['division_id'];
        $arranged_stocks['zone_id'] = $stock['zone_id'];
        $arranged_stocks['territory_id'] = $stock['territory_id'];
        $arranged_stocks['customer_id'] = $stock['customer_id'];
        $arranged_stocks['year'] = $stock['year'];

        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['variety_name'] = $stock['variety_name'];
        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['quantity'] = $stock['quantity'];
        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['is_approved_by_zi'] = $stock['is_approved_by_zi'];
        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['is_approved_by_di'] = $stock['is_approved_by_di'];
        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['is_approved_by_hom'] = $stock['is_approved_by_hom'];
        $arranged_stocks['crop'][$stock['crop_id']][$stock['type_id']]['variety'][$stock['variety_id']]['created_by'] = $stock['created_by'];

    }
}

?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>customer_MINIMUM_STOCK_ALERT/index/save" method="post">
    <input type="hidden" name="customer_id" value="<?php if(isset($arranged_stocks['customer_id'])){echo $arranged_stocks['customer_id'];}else{echo 0;}?>" />
    <input type="hidden" name="year_id" value="<?php if(isset($arranged_stocks['year'])){echo $arranged_stocks['year'];}else{echo 0;}?>" />

    <div id="budget_add_more_container">
    <?php
    if(isset($arranged_stocks['crop']))
    {
        $sl = 0;
        foreach($arranged_stocks['crop'] as $key=>$crop)
        {
            foreach($crop as $typeKey=>$typeVal)
            {
            ?>
            <div class="budget_add_more_container" style="display: <?php if(isset($crop) && sizeof($crop)>0){echo 'show';}else{echo 'none';}?>;">
                <div class="row widget">
                    <div class="widget-header">
                        <div class="title">
                            <?php echo $this->lang->line('MINIMUM_STOCK_ALERT'); ?>
                        </div>
                        <?php
                        foreach($typeVal['variety'] as $perm)
                        {
                            $created_by = $perm['created_by'];
                            $zi_approve = $perm['is_approved_by_zi'];
                            $di_approve = $perm['is_approved_by_di'];
                            $hom_approve = $perm['is_approved_by_hom'];
                        }

                        if(User_helper::check_edit_permission($created_by) && User_helper::check_edit_permission_after_approval($zi_approve, $di_approve, $hom_approve))
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
                            <select name="stock[<?php echo $sl;?>][crop]" class="form-control crop_id" id="crop<?php echo $sl;?>" <?php if(isset($key) && strlen($key)>1){echo 'disabled';}?>>
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>isset($key)?$key:''));
                                ?>
                            </select>
                            <?php
                            if(isset($key) && strlen($key)>1)
                            {
                                ?>
                                <input type="hidden" name="stock[<?php echo $sl;?>][crop]" value="<?php echo $key;?>" />
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
                            <select name="stock[<?php echo $sl;?>][type]" class="form-control type_id" id="type<?php echo $sl;?>" <?php if(strlen($typeKey)>1){echo 'disabled';}?> data-type-current-id="<?php echo $sl;?>">
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>isset($typeKey)?$typeKey:''));
                                ?>
                            </select>
                            <?php
                            if(isset($typeKey) && strlen($typeKey)>1)
                            {
                                ?>
                                <input type="hidden" name="stock[<?php echo $sl;?>][type]" value="<?php echo $typeKey;?>" />
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
                                                <th><?php echo $this->lang->line('LABEL_QUANTITY_KG')?></th>
                                                <?php
                                                foreach($typeVal['variety'] as $varKey=>$detail)
                                                {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $detail['variety_name']?></td>
                                                        <td>
                                                            <input type="text" class="form-control variety_quantity" <?php if((!User_helper::check_edit_permission($detail['created_by']) && $detail['quantity']>0) || ($detail['is_approved_by_zi'] && $detail['quantity']>0) || ($detail['is_approved_by_di'] && $detail['quantity']>0) || ($detail['is_approved_by_hom'] && $detail['quantity']>0)){echo 'readonly';}?> name="quantity[<?php echo $sl;?>][<?php echo $varKey;?>]" value="<?php if(isset($detail['quantity'])){echo $detail['quantity'];}?>" />                                                        <input type="hidden" name="" />
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
                        <?php echo $this->lang->line('MINIMUM_STOCK_ALERT'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="stock[0][crop]" class="form-control crop_id" id="crop0">
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
                        <select name="stock[0][type]" class="form-control type_id" id="type0" data-type-current-id="0">
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
                <?php echo $this->lang->line('MINIMUM_STOCK_ALERT'); ?>
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

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('name','stock['+current_id+'][crop]');
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('name','stock['+current_id+'][type]');

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
                    url: base_url+"minimum_stock_alert/get_varieties_by_crop_type/",
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

    });
</script>