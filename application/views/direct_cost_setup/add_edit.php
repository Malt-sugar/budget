<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url().'direct_cost_setup/index/list';
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);
//print_r($purchase);
?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>direct_cost_setup/index/save" method="post">
    <input type="hidden" name="setup_id" id="setup_id" value="<?php if(isset($purchase['id'])){echo $purchase['id'];}else{echo 0;}?>"/>
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
                <select name="year" id="year" class="form-control validate[required]">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($purchase['year'])?$purchase['year']:''));
                    ?>
                </select>
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="usd_conversion_rate" class="form-control validate[required] quantity" value="<?php if(isset($purchase['usd_conversion_rate'])){echo $purchase['usd_conversion_rate'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_LC_EXP');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="lc_exp" class="form-control validate[required] quantity" value="<?php if(isset($purchase['lc_exp'])){echo $purchase['lc_exp'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_INSURANCE_EXP');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="insurance_exp" class="form-control validate[required] quantity" value="<?php if(isset($purchase['insurance_exp'])){echo $purchase['insurance_exp'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="carriage_inwards" class="form-control validate[required] quantity" value="<?php if(isset($purchase['carriage_inwards'])){echo $purchase['carriage_inwards'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AIR_FREIGHT_AND_DOCS');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="air_freight_and_docs" class="form-control validate[required] quantity" value="<?php if(isset($purchase['air_freight_and_docs'])){echo $purchase['air_freight_and_docs'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CNF');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="cnf" class="form-control validate[required] quantity" value="<?php if(isset($purchase['cnf'])){echo $purchase['cnf'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="bank_other_charges" class="form-control validate[required] quantity" value="<?php if(isset($purchase['bank_other_charges'])){echo $purchase['bank_other_charges'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AIT');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="ait" class="form-control validate[required] quantity" value="<?php if(isset($purchase['ait'])){echo $purchase['ait'];}?>" />
            </div>
        </div>

        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MISCELLANEOUS');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="miscellaneous" class="form-control validate[required] quantity" value="<?php if(isset($purchase['miscellaneous'])){echo $purchase['miscellaneous'];}?>" />
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("keyup", ".quantity", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });
    });

</script>