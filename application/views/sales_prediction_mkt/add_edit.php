<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url()."sales_prediction_mkt";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);

//echo '<pre>';
//print_r($predictions);
//echo '</pre>';

$arranged_prediction = array();

if(is_array($predictions) && sizeof($predictions)>0)
{
    foreach($predictions as $prediction)
    {
        $arranged_prediction['year'] = $prediction['year'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['variety_name'] = $prediction['variety_name'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['budgeted_mrp'] = $prediction['budgeted_mrp'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['sales_commission'] = $prediction['sales_commission'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['sales_bonus'] = $prediction['sales_bonus'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['other_incentive'] = $prediction['other_incentive'];
        $arranged_prediction['crop'][$prediction['crop_id']][$prediction['type_id']]['variety'][$prediction['variety_id']]['created_by'] = $prediction['created_by'];
    }
}

if(!isset($arranged_prediction['year']))
{
    redirect(base_url()."sales_prediction_mkt");
}

?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>sales_prediction_mkt/index/save" method="post">
    <input type="hidden" name="year_id" value="<?php if(isset($arranged_prediction['year'])){echo $arranged_prediction['year'];}else{echo 0;}?>" />
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
                <select name="year" id="year" class="form-control validate[required]" <?php if(isset($arranged_prediction['year']) && strlen($arranged_prediction['year'])>1){echo 'disabled';}?>>
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($arranged_prediction['year'])?$arranged_prediction['year']:''));
                    ?>
                </select>
                <?php
                if(isset($arranged_prediction['year']) && strlen($arranged_prediction['year'])>1)
                {
                    ?>
                    <input type="hidden" name="year" value="<?php echo $arranged_prediction['year'];?>" />
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <div id="budget_add_more_container">
    <?php
    if(isset($arranged_prediction['crop']))
    {
        $sl = 0;
        foreach($arranged_prediction['crop'] as $key=>$crop)
        {
            foreach($crop as $typeKey=>$typeVal)
            {
            ?>
            <div class="budget_add_more_container" style="display: <?php if(isset($crop) && sizeof($crop)>0){echo 'show';}else{echo 'none';}?>;">
                <div class="row widget">
                    <div class="widget-header">
<!--                        <div class="title">-->
<!--                            --><?php //echo $this->lang->line('LABEL_SALES_PREDICTION'); ?>
<!--                        </div>-->
                    </div>

                    <div class="crop">
                        <div class="col-xs-1">
                            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                        </div>
                        <div class="col-xs-2">
                            <select name="prediction[<?php echo $sl;?>][crop]" class="form-control crop_id" id="crop<?php echo $sl;?>" <?php if(isset($key) && strlen($key)>1){echo 'disabled';}?>>
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>isset($key)?$key:''));
                                ?>
                            </select>
                            <?php
                            if(isset($key) && strlen($key)>1)
                            {
                                ?>
                                <input type="hidden" name="prediction[<?php echo $sl;?>][crop]" value="<?php echo $key;?>" />
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
                            <select name="prediction[<?php echo $sl;?>][type]" class="form-control type_id" id="type<?php echo $sl;?>" <?php if(strlen($typeKey)>1){echo 'disabled';}?> data-type-current-id="<?php echo $sl;?>">
                                <?php
                                $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>isset($typeKey)?$typeKey:''));
                                ?>
                            </select>
                            <?php
                            if(isset($typeKey) && strlen($typeKey)>1)
                            {
                                ?>
                                <input type="hidden" name="prediction[<?php echo $sl;?>][type]" value="<?php echo $typeKey;?>" />
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
                                                <th><?php echo $this->lang->line('LABEL_BUDGETED_MRP')?></th>
                                                <th><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT')?></th>
                                                <th><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT')?></th>
                                                <th><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT')?></th>
                                                <?php
                                                foreach($typeVal['variety'] as $varKey=>$detail)
                                                {
                                                    $mkt_detail = System_helper::get_prediction_detail($varKey, $this->config->item('prediction_phase_marketing'), $arranged_prediction['year']);
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $detail['variety_name'];?></td>
                                                        <td>
                                                            <input type="text" class="form-control quantity_number" name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][budgeted_mrp]" value="<?php if(isset($detail['budgeted_mrp'])){echo $detail['budgeted_mrp'];}?>" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control quantity_number" name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][sales_commission]" value="<?php if(isset($mkt_detail['sales_commission'])){echo $mkt_detail['sales_commission'];}else{ if(isset($detail['sales_commission'])){echo $detail['sales_commission'];}}?>" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control quantity_number" name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][sales_bonus]" value="<?php if(isset($mkt_detail['sales_bonus'])){echo $mkt_detail['sales_bonus'];}else{ if(isset($detail['sales_bonus'])){echo $detail['sales_bonus'];}}?>" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control quantity_number" name="detail[<?php echo $sl;?>][<?php echo $varKey;?>][other_incentive]" value="<?php if(isset($mkt_detail['other_incentive'])){echo $mkt_detail['other_incentive'];}else{ if(isset($detail['other_incentive'])){echo $detail['other_incentive'];}}?>" />
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
                        <?php echo $this->lang->line('LABEL_SALES_PREDICTION'); ?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="prediction[0][crop]" class="form-control crop_id" id="crop0">
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
                        <select name="prediction[0][type]" class="form-control type_id" id="type0" data-type-current-id="0">
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

<!--    <div class="row text-center" id="add_more">-->
<!--        <button type="button" class="btn btn-warning budget_add_more_button">--><?php //echo $this->lang->line('ADD_MORE');?><!--</button>-->
<!--    </div>-->

<!--    <h1>&nbsp;</h1>-->

    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container"  data-current-id="<?php if(isset($sl)){echo ($sl-1);}else{echo 0;}?>">
        <div class="widget-header">
            <div class="title">
                <?php echo $this->lang->line('LABEL_SALES_PREDICTION'); ?>
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

<div class="text-center">
    <button type="button" id="finalise" class="btn btn-success"><?php echo $this->lang->line('FINALISE');?></button>
</div>
<h1>&nbsp;</h1>
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

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('name','prediction['+current_id+'][crop]');
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('name','prediction['+current_id+'][type]');

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
                    url: base_url+"sales_prediction_mkt/get_varieties_by_crop_type/",
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

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"sales_prediction_mkt/check_sales_prediction/",
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

        $(document).on("keyup", ".quantity_number", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on("click","#finalise",function()
        {
            $.ajax({
                url: base_url+"sales_prediction_mkt/sales_prediction_mgt_finalise/",
                type: 'POST',
                dataType: "JSON",
                data:{year:$("#year").val()},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });
        });
    });
</script>