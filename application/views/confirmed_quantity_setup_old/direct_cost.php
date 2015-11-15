<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_USD_CONVERSION_RATE');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="usd_conversion_rate" class="form-control validate[required] usd_conversion_rate" value="<?php echo $costs['usd_conversion_rate'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_LC_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="lc_exp" class="form-control validate[required] lc_exp" value="<?php echo $costs['lc_exp'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_INSURANCE_EXP_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="insurance_exp" class="form-control validate[required] insurance_exp" value="<?php echo $costs['insurance_exp'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="packing_material" class="form-control validate[required] packing_material" value="<?php echo $costs['packing_material'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CARRIAGE_INWARDS_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="carriage_inwards" class="form-control validate[required] carriage_inwards" value="<?php echo $costs['carriage_inwards'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DOCS_ACTUAL');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="docs" class="form-control validate[required] docs" value="<?php echo $costs['air_freight_and_docs'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CNF');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="cnf" class="form-control validate[required] cnf" value="<?php echo $costs['cnf'];?>" />
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_BANK_OTHER_CHARGES');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <input type="text" name="bank_other_charges" class="form-control validate[required] bank_other_charges" value="<?php echo $costs['bank_other_charges'];?>" />
    </div>
</div>

