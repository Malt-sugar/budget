<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url().'incentive_setup/index/list';
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);

//echo '<pre>';
//print_r($details);
//echo '</pre>';
?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>incentive_setup/index/save" method="post">
    <input type="hidden" name="setup_id" value="<?php echo isset($details['id'])?$details['id']:0; ?>" />
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
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>isset($details['year'])?$details['year']:''));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MONTH_FROM');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="from_month" id="from_month" class="form-control validate[required]">
                    <?php
                    $monthConfig = $this->config->item('month');
                    foreach($monthConfig as $val=>$month)
                    {
                        ?>
                        <option value="<?php echo $val;?>" <?php if(isset($details['from_month']) && $val==$details['from_month']){echo 'selected';}?>><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MONTH_TO');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="to_month" id="to_month" class="form-control validate[required]">
                    <?php
                    $monthConfig = $this->config->item('month');
                    foreach($monthConfig as $val=>$month)
                    {
                        ?>
                        <option value="<?php echo $val;?>" <?php if(isset($details['to_month']) && $val==$details['to_month']){echo 'selected';}?>><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_AMOUNT_100PER');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="total" class="form-control validate[required] quantity" value="<?php echo isset($details['total'])?$details['total']:''; ?>" />
            </div>
        </div>

<!--        Increment-->
        <div class="row show-grid">
            <div class="col-xs-12">
                <table class="table table-bordered" id="adding_elements">
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('LABEL_LOWER_LIMIT');?></th>
                            <th><?php echo $this->lang->line('LABEL_UPPER_LIMIT');?></th>
                            <th><?php echo $this->lang->line('LABEL_ACHIEVEMENT_PER');?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(isset($details['detail']) && sizeof($details['detail'])>0)
                    {
                        foreach($details['detail'] as $detail)
                        {
                            ?>
                            <tr class="edit_tr">
                                <td>
                                    <div>
                                        <input type="text" name="lower_limit[]" class="form-control validate[required] quantity" value="<?php echo $detail['lower_limit']?>"/>
                                    </div>
                                </td>

                                <td>
                                    <div>
                                        <input type="text" name="upper_limit[]" class="form-control validate[required] quantity" value="<?php echo $detail['upper_limit']?>"/>
                                    </div>
                                </td>

                                <td>
                                    <input type="text" name="achievement[]" class="form-control validate[required] quantity" value="<?php echo $detail['achievement']?>"/>
                                </td>
                                <td style="min-width: 25px;">
                                    <img class="remove" style='width: 25px; height: 25px;' src='<?php echo base_url().'images/xmark.png'?>' />
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="lower_limit[]" class="form-control validate[required] quantity" value=""/>
                                </div>
                            </td>

                            <td>
                                <div>
                                    <input type="text" name="upper_limit[]" class="form-control validate[required] quantity" value=""/>
                                </div>
                            </td>

                            <td>
                                <input type="text" name="achievement[]" class="form-control validate[required] quantity" value=""/>
                            </td>
                            <td style="min-width: 25px;">

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>

                <table class="table">
                    <tr>
                        <td class="pull-right" style="border: 0px;">
                            <img style="width: 25px; height: 25px;" src="<?php echo base_url().'images/plus.png'?>" onclick="RowIncrement()" />
                        </td>
                    </tr>
                </table>
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

        $(document).on("click", ".remove", function()
        {
            $(this).closest('.edit_tr').remove();
        });
    });

    var ExId = 0;
    function RowIncrement()
    {
        var img_url="<?php echo base_url().'images/xmark.png'?>";
        var table = document.getElementById('adding_elements');
        var rowCount = table.rows.length;
        //alert(rowCount);
        var row = table.insertRow(rowCount);
        row.id = "T" + ExId;
        row.className = "tableHover";
        //alert(row.id);
        var cell1 = row.insertCell(0);
        cell1.innerHTML = "<input type='text' name='lower_limit[]' class='form-control numbersOnly'/>";
        var cell1 = row.insertCell(1);
        cell1.innerHTML = "<input type='text' name='upper_limit[]' class='form-control numbersOnly'/>";
        var cell1 = row.insertCell(2);
        cell1.innerHTML = "<input type='text' name='achievement[]' class='form-control numbersOnly'/>"+
        "<input type='hidden' id='elmIndex[]' name='elmIndex[]' value='" + ExId + "'/>";
        cell1.style.cursor = "default";
        cell1 = row.insertCell(3);
        cell1.innerHTML = "<img style='width: 25px; height: 25px;'  onclick=\"RowDecrement('adding_elements', 'T"+ExId+"')\" src='<?php echo base_url().'images/xmark.png'?>' />";
        cell1.style.cursor = "default";
//        document.getElementById("lower_limit" + ExId).focus();
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