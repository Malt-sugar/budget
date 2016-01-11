<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="usd_conversion_rate" class="form-control validate[required] usd_conversion_rate" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_LC_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="lc_exp" class="form-control validate[required] total_lc_exp" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_INSURANCE_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="insurance_exp" class="form-control validate[required] total_insurance_exp" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="carriage_inwards" class="form-control validate[required] total_carriage_inwards" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DOCS_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="docs" class="form-control validate[required] total_docs" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CNF');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="cnf" class="form-control validate[required] total_cnf" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="bank_other_charges" class="form-control validate[required] total_bank_other_charges" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AIT');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="ait" class="form-control validate[required] total_ait" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MISCELLANEOUS');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="miscellaneous" class="form-control validate[required] total_miscellaneous" value="" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MONTH_OF_PURCHASE');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <select name="month_of_purchase" id="month_of_purchase" class="form-control validate[required] month_of_purchase">
            <option value=""><?php echo $this->lang->line('SELECT');?></option>
            <?php
            $months = $this->config->item('month');
            foreach($months as $key=>$val)
            {
            ?>
                <option value="<?php echo $key;?>"><?php echo $val;?></option>
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
        <input type="text" name="consignment_no" class="form-control validate[required] consignment_no" value="" />
    </div>
</div>