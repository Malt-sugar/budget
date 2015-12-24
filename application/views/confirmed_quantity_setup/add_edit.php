<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]="#";
    $data["hide_approve"]="1";
    $data["hide_back"]="1";
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
                <select name="year" id="year" class="form-control validate[required]">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>''));
                    ?>
                </select>
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

    <div class="row variety_quantity" id="variety_quantity">

    </div>

    <div class="row direct_cost" id="direct_cost_div" style="display: none;">

    </div>
</div>
</form>
<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

        $(document).on("change", "#selection_type", function(event)
        {
            $("#crop_select").val('');
            $("#type_select").val('');
            $("#variety_quantity").html('');

            if($(this).val()>0)
            {
                $("#crop_select_div").show();
                $("#type_select_div").hide();
            }
            else
            {
                $("#crop_select_div").hide();
                $("#type_select_div").hide();
                $("#variety_quantity").html('');
            }
        });

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/get_direct_cost_this_year/",
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
            else
            {
                $("#direct_cost_div").html('');
            }
        });

        $(document).on("change", "#crop_select", function(event)
        {
            if($(this).val().length>1 && $("#selection_type").val()==1)
            {
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/get_quantity_detail_by_variety/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id: $(this).val(), type_id: 0, year: $("#year").val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else if($(this).val().length>1 && $("#selection_type").val()==2)
            {
                $("#type_select_div").show();
                $("#variety_quantity").html('');

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
                $("#variety_quantity").html('');
            }
        });

        $(document).on("change", "#type_select", function(event)
        {
            if($(this).val().length>1 && $("#crop_select").val().length>1 && $("#selection_type").val()==2)
            {
                $.ajax({
                    url: base_url+"confirmed_quantity_setup/get_quantity_detail_by_variety/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id: $("#crop_select").val(), type_id: $(this).val(), year: $("#year").val()},
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
                $("#variety_quantity").html('');
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

        $(document).on("keyup",".pi_value_input",function()
        {
            var usd_conversion_rate = parseFloat($(".usd_conversion_rate").val());
            var lc_exp = parseFloat($(".lc_exp").val());
            var insurance_exp = parseFloat($(".insurance_exp").val());
            var sticker_cost = parseFloat($(".sticker_cost").val());
            var carriage_inwards = parseFloat($(".carriage_inwards").val());
            var docs = parseFloat($(".docs").val());
            var cnf = parseFloat($(".cnf").val());
            var bank_other_charges = parseFloat($(".bank_other_charges").val());
            var ait = parseFloat($(".ait").val());
            var miscellaneous = parseFloat($(".miscellaneous").val());

            var packing_status = parseFloat($(".packing_status").val());
            var sticker_status = parseFloat($(".sticker_status").val());

            if(packing_status==1)
            {
                var packing_material_cost = parseFloat($(".packing_material_cost").val());
            }
            else
            {
                var packing_material_cost = 0;
            }

            if(sticker_status==1)
            {
                var sticker_cost = parseFloat($(".sticker_cost").val());
            }
            else
            {
                var sticker_cost = 0;
            }

            var pi_value = parseFloat($(this).val())*usd_conversion_rate; // USD converted to BDT

            var lc_exp_per = parseFloat(((pi_value/100)*lc_exp).toFixed(2));
            var insurance_exp_per = parseFloat(((pi_value/100)*insurance_exp).toFixed(2));

            var packing_material_per = parseFloat(((pi_value/100)*packing_material_cost).toFixed(2));
            var sticker_per = parseFloat(((pi_value/100)*sticker_cost).toFixed(2));

            var carriage_inwards_per = parseFloat(((pi_value/100)*carriage_inwards).toFixed(2));
            var docs_per = parseFloat(((pi_value/100)*docs).toFixed(2));
            var cnf_per = parseFloat(((pi_value/100)*cnf).toFixed(2));
            var bank_other_charges_per = parseFloat(((pi_value/100)*bank_other_charges).toFixed(2));
            var ait_per = parseFloat(((pi_value/100)*ait).toFixed(2));
            var miscellaneous_per = parseFloat(((pi_value/100)*miscellaneous).toFixed(2));

            var cogs = (parseFloat(pi_value) + parseFloat(lc_exp_per) + parseFloat(insurance_exp_per) + parseFloat(packing_material_per) + parseFloat(sticker_per) + parseFloat(carriage_inwards_per) + parseFloat(docs_per) + parseFloat(cnf_per) + parseFloat(bank_other_charges_per) + parseFloat(ait_per) + parseFloat(miscellaneous_per)).toFixed(2);

            if(cogs)
            {
                $(this).closest('tr').find('.budgeted_cogs').html(cogs);
            }
            else
            {
                $(this).closest('tr').find('.budgeted_cogs').html(0);
            }
        });
    });
</script>