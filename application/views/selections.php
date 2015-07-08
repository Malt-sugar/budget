<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_YEAR');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <select name="year" id="year" class="form-control validate[required]" <?php if(isset($arranged_targets['year']) && strlen($arranged_targets['year'])>1){echo 'disabled';}?>>
            <?php
            $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($arranged_targets['year'])?$arranged_targets['year']:''));
            ?>
        </select>
        <?php
        if(isset($arranged_targets['year']) && strlen($arranged_targets['year'])>1)
        {
            ?>
            <input type="hidden" name="year" value="<?php echo $arranged_targets['year'];?>" />
        <?php
        }
        ?>
    </div>
</div>

<div class="row show-grid">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DIVISION');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <select name="division" class="form-control validate[required]" id="division" <?php if(isset($arranged_targets['division_id']) && strlen($arranged_targets['division_id'])>1){echo 'disabled';}?>>
            <?php
            $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>isset($arranged_targets['division_id'])?$arranged_targets['division_id']:''));
            ?>
        </select>
        <?php
        if(isset($arranged_targets['division_id']) && strlen($arranged_targets['division_id'])>1)
        {
            ?>
            <input type="hidden" name="division" value="<?php echo $arranged_targets['division_id'];?>" />
        <?php
        }
        ?>
    </div>
</div>

<div class="row show-grid zone" style="display: <?php if(isset($arranged_targets['zone_id']) && strlen($arranged_targets['zone_id'])>1){echo 'show';}else{echo 'none';}?>;">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_ZONE');?><span style="color:#FF0000">*</span></label>
    </div>

    <div class="col-sm-4 col-xs-8">
        <select name="zone" class="form-control validate[required]" id="zone" <?php if(isset($arranged_targets['zone_id']) && strlen($arranged_targets['zone_id'])>1){echo 'disabled';}?>>
            <?php
            $this->load->view('dropdown',array('drop_down_options'=>$zones,'drop_down_selected'=>isset($arranged_targets['zone_id'])?$arranged_targets['zone_id']:''));
            ?>
        </select>
        <?php
        if(isset($arranged_targets['zone_id']) && strlen($arranged_targets['zone_id'])>1)
        {
            ?>
            <input type="hidden" name="zone" value="<?php echo $arranged_targets['zone_id'];?>" />
        <?php
        }
        ?>
    </div>
</div>

<div class="row show-grid territory" style="display: <?php if(isset($arranged_targets['territory_id']) && strlen($arranged_targets['territory_id'])>1){echo 'show';}else{echo 'none';}?>;">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TERRITORY');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <select name="territory" class="form-control validate[required]" id="territory" <?php if(isset($arranged_targets['territory_id']) && strlen($arranged_targets['territory_id'])>1){echo 'disabled';}?>>
            <?php
            $this->load->view('dropdown',array('drop_down_options'=>$territories,'drop_down_selected'=>isset($arranged_targets['territory_id'])?$arranged_targets['territory_id']:''));
            ?>
        </select>
        <?php
        if(isset($arranged_targets['territory_id']) && strlen($arranged_targets['territory_id'])>1)
        {
            ?>
            <input type="hidden" name="territory" value="<?php echo $arranged_targets['territory_id'];?>" />
        <?php
        }
        ?>
    </div>
</div>

<div class="row show-grid customer" style="display: <?php if(isset($arranged_targets['customer_id']) && strlen($arranged_targets['customer_id'])>1){echo 'show';}else{echo 'none';}?>;">
    <div class="col-xs-4">
        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER');?><span style="color:#FF0000">*</span></label>
    </div>
    <div class="col-sm-4 col-xs-8">
        <select name="customer" class="form-control validate[required]" id="customer" <?php if(isset($arranged_targets['customer_id']) && strlen($arranged_targets['customer_id'])>1){echo 'disabled';}?>>
            <?php
            $this->load->view('dropdown',array('drop_down_options'=>$customers,'drop_down_selected'=>isset($arranged_targets['customer_id'])?$arranged_targets['customer_id']:''));
            ?>
        </select>
        <?php
        if(isset($arranged_targets['customer_id']) && strlen($arranged_targets['customer_id'])>1)
        {
            ?>
            <input type="hidden" name="customer" value="<?php echo $arranged_targets['customer_id'];?>" />
        <?php
        }
        ?>
    </div>
</div>