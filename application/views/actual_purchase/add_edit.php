<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url()."actual_purchase";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>actual_purchase/index/save" method="post">
    <input type="hidden" name="edit_id" class="edit_id" value="<?php echo isset($edit_id)?$edit_id:0;?>" />
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
                <select name="year" id="year" class="form-control validate[required]" <?php if(isset($setup['year']) && strlen($setup['year'])>1){echo 'disabled';}?>>
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($setup['year'])?$setup['year']:''));
                    ?>
                </select>
                <?php
                if(isset($setup['year']) && strlen($setup['year'])>1)
                {
                    ?>
                    <input type="hidden" name="year" value="<?php echo $setup['year'];?>" />
                <?php
                }
                ?>
            </div>
        </div>

        <div id="direct_cost_div">
            <?php
            if($edit_id>0)
            {
            ?>
                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="usd_conversion_rate" class="form-control validate[required] usd_conversion_rate" value="<?php echo $setup['usd_conversion_rate'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_LC_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="lc_exp" class="form-control validate[required] total_lc_exp" value="<?php echo $setup['lc_exp'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_INSURANCE_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="insurance_exp" class="form-control validate[required] total_insurance_exp" value="<?php echo $setup['insurance_exp'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS_ACTUAL');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="carriage_inwards" class="form-control validate[required] total_carriage_inwards" value="<?php echo $setup['carriage_inwards'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DOCS_ACTUAL');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="docs" class="form-control validate[required] total_docs" value="<?php echo $setup['docs'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CNF');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="cnf" class="form-control validate[required] total_cnf" value="<?php echo $setup['cnf'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="bank_other_charges" class="form-control validate[required] total_bank_other_charges" value="<?php echo $setup['bank_other_charges'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AIT');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="ait" class="form-control validate[required] total_ait" value="<?php echo $setup['ait'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MISCELLANEOUS');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="miscellaneous" class="form-control validate[required] total_miscellaneous" value="<?php echo $setup['miscellaneous'];?>" />
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MONTH_OF_PURCHASE');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <select name="month_of_purchase" id="month_of_purchase" class="form-control validate[required]">
                            <option value=""><?php echo $this->lang->line('SELECT');?></option>
                            <?php
                            $months = $this->config->item('month');
                            foreach($months as $key=>$val)
                            {
                                ?>
                                <option value="<?php echo $key;?>" <?php if(isset($setup['month_of_purchase']) && str_pad($setup['month_of_purchase'], 2, "0", STR_PAD_LEFT)==$key){echo 'selected';}?>><?php echo $val;?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CONSIGNMENT_NO');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-sm-4 col-xs-8">
                        <input type="text" name="consignment_no" class="form-control validate[required]" value="<?php echo $setup['consignment_no'];?>" />
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div id="budget_add_more_container" class="main_div">
    <?php
    if(is_array($purchases) && sizeof($purchases)>0)
    {
        $grand_total = 0;
        foreach($purchases as $key=>$quantity)
        {
        ?>
        <div class="budget_add_more_container" style="display: <?php if(isset($quantity['crop_id']) && sizeof($quantity['crop_id'])>0){echo 'show';}else{echo 'none';}?>;">
            <div class="row widget">
                <div class="widget-header" style="padding: 3px 4px 3px 10px;">
                    <div class="title">
                        <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
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
                    $variety_values = Purchase_helper::get_variety_actual_purchase_values($edit_id, $quantity['variety_id'], $setup['usd_conversion_rate'], $setup['lc_exp'], $setup['insurance_exp'], $setup['packing_material'], $setup['carriage_inwards'], $setup['docs'], $setup['cnf'], $setup['bank_other_charges'], $setup['ait'], $setup['miscellaneous'], $setup['packing_material'], $setup['sticker_cost']);
                    $grand_total+=$variety_values['total_cogs'];
                ?>
                <div class="row show-grid">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered">
                            <th class="text-center"><?php echo $this->lang->line('LABEL_QUANTITY')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_PI_VALUE')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_LC_EXP_ACTUAL')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_INSURANCE_EXP_ACTUAL')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL_ACTUAL')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS_ACTUAL')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_DOCS_ACTUAL')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_CNF')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_COGS_TAKA')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_TOTAL_COGS_TAKA')?></th>
                            <th class="text-center"><?php echo $this->lang->line('LABEL_REMARKS')?></th>

                            <tr>
                                <td class="text-center"><input type="text" disabled class="form-control numbersOnly purchase_quantity" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][purchase_quantity]" value="<?php echo $variety_values['purchase_quantity'];?>" /></td>
                                <td class="text-center"><input type="text" class="form-control numbersOnly pi_value" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][pi_value]" value="<?php echo $variety_values['pi_value'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control lc_exp" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][lc_exp]" value="<?php echo $variety_values['lc_exp'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control insurance_exp" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][insurance_exp]" value="<?php echo $variety_values['insurance_exp'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control packing_material" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][packing_material]" value="<?php echo $setup['packing_material'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control carriage_inwards" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][carriage_inwards]" value="<?php echo $variety_values['carriage_inwards'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control docs" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][docs]" value="<?php echo $variety_values['docs'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control cnf" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][cnf]" value="<?php echo $variety_values['cnf'];?>" /></td>
                                <td class="text-center">
                                    <input type="text" disabled class="form-control bank_other_charges" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][bank_other_charges]" value="<?php echo $variety_values['bank_other_charges'];?>" />
                                    <input type="hidden" disabled class="form-control ait" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][ait]" value="<?php echo $variety_values['ait'];?>" />
                                    <input type="hidden" disabled class="form-control miscellaneous" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][miscellaneous]" value="<?php echo $variety_values['miscellaneous'];?>" />
                                    <input type="hidden" disabled class="form-control sticker" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][sticker_cost]" value="<?php echo $setup['sticker_cost'];?>" />
                                </td>
                                <td class="text-center"><input type="text" disabled class="form-control cogs" name="" value="<?php echo $variety_values['cogs'];?>" /></td>
                                <td class="text-center"><input type="text" disabled class="form-control total_cogs" name="" value="<?php echo $variety_values['total_cogs'];?>" /></td>
                                <td class="text-center" style="vertical-align: middle;">
                                    <label class="label label-primary load_remark">+R</label>
                                    <div class="row popContainer" style="display: none;">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td>
                                                    <div class="col-lg-12">
                                                        <textarea class="form-control" name="quantity[<?php echo $quantity['crop_id'];?>][<?php echo $quantity['type_id'];?>][<?php echo $quantity['variety_id'];?>][remarks]" placeholder="Add Remarks"><?php echo $variety_values['remarks'];?></textarea>
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
                        <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
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
    <div class="row grand_total_div" style="display: <?php if($edit_id>0){echo 'show';}else{echo 'none';}?>;">
        <div class="col-lg-12">
            <table class="table table-hover table-bordered">
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_QUANTITY')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_PI_VALUE')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_LC_EXP_ACTUAL')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_INSURANCE_EXP_ACTUAL')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL_ACTUAL')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS_ACTUAL')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_DOCS_ACTUAL')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_CNF')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_COGS_TAKA')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_TOTAL_COGS_TAKA')?></th>
                <th class="text-center" style="display: none;"><?php echo $this->lang->line('LABEL_REMARKS')?></th>

                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center" style="width: 100px; font-weight: bold;"><?php echo $this->lang->line('LABEL_GRAND_TOTAL');?>: </td>
                    <td class="text-center" style="width: 100px; vertical-align: middle;"><label style="vertical-align: middle;" class="label label-danger grand_total"><?php if($edit_id>0){echo $grand_total;}else{echo '00.00';}?></label></td>
                    <td class="text-center" style="width: 70px;"></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container" data-current-id="<?php if(isset($purchases) && sizeof($purchases)>0){echo (sizeof($purchases)-1);}else{echo 0;}?>">
        <div class="widget-header" style="padding: 3px 4px 3px 10px;">
            <div class="title">
                <?php echo $this->lang->line('LABEL_PURCHASE'); ?>
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

        // ROW INCREMENT FUNCTION
        $(document).on("click", ".budget_add_more_button", function(event)
        {
            var current_id = parseInt($('.budget_add_more_content .budget_add_more_holder').attr('data-current-id'));
            current_id = current_id+1;

            $('.budget_add_more_content .budget_add_more_holder').attr('data-current-id',current_id);

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
                    url: base_url+"actual_purchase/get_purchase_detail_by_variety/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id: $("#crop"+current_id).val(), type_id: $("#type"+current_id).val(), variety_id: $(this).val(), current_id: current_id, year: $("#year").val(), month_of_purchase: $("#month_of_purchase").val()},
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
                    url: base_url+"actual_purchase/get_direct_cost_this_year/",
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

                $(".grand_total_div").show();
            }
            else
            {
                $("#direct_cost_div").html('');
                $(".grand_total_div").hide();
            }
        });

        $(document).on("blur",".consignment_no",function()
        {
            if($("#year").val().length>1)
            {
                if($(".month_of_purchase").val()>0)
                {
                    if($(this).val().length>0)
                    {
                        $.ajax({
                            url: base_url+"actual_purchase/check_consignment_no/",
                            type: 'POST',
                            dataType: "JSON",
                            data:{year:$("#year").val(), month_of_purchase: $(".month_of_purchase").val(), consignment_no: $(this).val(), edit_id: $(".edit_id").val()},
                            success: function (data, status)
                            {

                            },
                            error: function (xhr, desc, err)
                            {
                                console.log("error");
                            }
                        });
                    }
                }
                else
                {
                    $(".consignment_no").val('');
                }
            }
            else
            {
                $(".month_of_purchase").val('');
            }
        });

        $(document).on("keyup", ".numbersOnly", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
        });

        $(document).on("keyup",".pi_value",function()
        {
            var usd_conversion_rate = parseFloat($(".usd_conversion_rate").val());
            var total_lc_exp = parseFloat($(".total_lc_exp").val());
            var total_insurance_exp = parseFloat($(".total_insurance_exp").val());
            var total_carriage_inwards = parseFloat($(".total_carriage_inwards").val());
            var total_docs = parseFloat($(".total_docs").val());
            var total_cnf = parseFloat($(".total_cnf").val());
            var total_bank_other_charges = parseFloat($(".total_bank_other_charges").val());
            var total_ait = parseFloat($(".total_ait").val());
            var total_miscellaneous = parseFloat($(".total_miscellaneous").val());

            var pi_value = parseFloat($(this).closest('tr').find('.pi_value').val());

            var pi_attr = $(this).closest('.main_div').find('.pi_value');
            var pi_sum = 0;

            pi_attr.each(function()
            {
                var val = $(this).val();
                if(val)
                {
                    val = parseFloat( val.replace( /^\$/, "" ));
                    pi_sum += !isNaN( val ) ? val : 0;
                }
            });

            pi_attr.each(function()
            {
                var purchase_quantity = $(this).closest('tr').find('.purchase_quantity').val();
                if(purchase_quantity>0)
                {
                    var packing_material = $(this).closest('tr').find('.packing_material').val();
                    var sticker = $(this).closest('tr').find('.sticker').val();

                    var val = $(this).val()*usd_conversion_rate*purchase_quantity;
                    var this_pi_val = $(this).val();

                    var pi_percentage = parseFloat(((this_pi_val/pi_sum)*100).toFixed(2));

                    var lc_exp = parseFloat(((pi_percentage/100)*total_lc_exp).toFixed(2));
                    var insurance_exp = parseFloat(((pi_percentage/100)*total_insurance_exp).toFixed(2));
                    var carriage_inwards = parseFloat(((pi_percentage/100)*total_carriage_inwards).toFixed(2));
                    var docs = parseFloat(((pi_percentage/100)*total_docs).toFixed(2));
                    var cnf = parseFloat(((pi_percentage/100)*total_cnf).toFixed(2));
                    var bank_other_charges = parseFloat(((pi_percentage/100)*total_bank_other_charges).toFixed(2));
                    var ait = parseFloat(((pi_percentage/100)*total_ait).toFixed(2));
                    var miscellaneous = parseFloat(((pi_percentage/100)*total_miscellaneous).toFixed(2));

                    var total_cogs = (parseFloat(val) + parseFloat(lc_exp) + parseFloat(insurance_exp) + parseFloat(carriage_inwards) + parseFloat(docs) + parseFloat(cnf) + parseFloat(bank_other_charges) + parseFloat(ait) + parseFloat(miscellaneous) + parseFloat(packing_material*purchase_quantity) + parseFloat(sticker*purchase_quantity)).toFixed(2);
                    var cogs = (total_cogs/purchase_quantity).toFixed(2);

                    $(this).closest('tr').find('.lc_exp').val(lc_exp);
                    $(this).closest('tr').find('.insurance_exp').val(insurance_exp);
                    $(this).closest('tr').find('.carriage_inwards').val(carriage_inwards);
                    $(this).closest('tr').find('.docs').val(docs);
                    $(this).closest('tr').find('.cnf').val(cnf);
                    $(this).closest('tr').find('.bank_other_charges').val(bank_other_charges);
                    $(this).closest('tr').find('.ait').val(ait);
                    $(this).closest('tr').find('.miscellaneous').val(miscellaneous);
                    $(this).closest('tr').find('.cogs').val(cogs);
                    $(this).closest('tr').find('.total_cogs').val(total_cogs);
                }
                else
                {
                    alert('No Purchase Quantity!');
                }
            });

            // Grand Total
            var total_cogs_attr = $(this).closest('.main_div').find('.total_cogs');
            var total_cogs_sum = 0;

            total_cogs_attr.each(function()
            {
                var total_cogs_val = $(this).val();
                if(total_cogs_val)
                {
                    total_cogs_val = parseFloat( total_cogs_val.replace( /^\$/, "" ));
                    total_cogs_sum += !isNaN( total_cogs_val ) ? total_cogs_val : 0;
                }
            });

            var grand_total = total_cogs_sum.toFixed(2);
            $(".grand_total").html(grand_total);
        });
    });
</script>