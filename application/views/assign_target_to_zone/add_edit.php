<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."assign_target_to_zone/index/add";
    $data["link_back"]=base_url()."home";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>assign_target_to_zone/index/save" method="post">
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

        <div class="col-lg-12" id="load_variety" style="overflow-x: auto;">

        </div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("change", "#selection_type", function(event)
        {
            $("#crop_select").val('');
            $("#type_select").val('');
            $("#load_variety").html('');

            if($(this).val()>0)
            {
                $("#crop_select_div").show();
                $("#type_select_div").hide();
            }
            else
            {
                $("#crop_select_div").hide();
                $("#type_select_div").hide();
                $("#load_variety").html('');
            }
        });

        $(document).on("keyup", ".targeted_total", function(event)
        {
            var targeted = $(this).val();
            $(this).closest('tr').find(".remaining").val(targeted)
        });

        $(document).on("keyup", ".targeted", function(event)
        {
            var attr = $(this).closest('.div_target').find('.targeted');
            var sum = 0;

            attr.each(function()
            {
                var val = $(this).val();
                if(val)
                {
                    val = parseFloat( val.replace( /^\$/, "" ));
                    sum += !isNaN( val ) ? val : 0;
                }
            });

            var targeted_val = $(this).closest('.div_target').closest('tr').find('.targeted_total').val();
            var new_remaining_val = targeted_val - sum;

            $(this).closest('.div_target').closest('tr').find('.remaining').val(new_remaining_val);
        });

        $(document).on("change", "#crop_select", function(event)
        {
            if($(this).val().length>1 && $("#selection_type").val()==1)
            {
                $.ajax({
                    url: base_url+"assign_target_to_zone/get_variety_detail/",
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
                $("#load_variety").html('');
                $("#type_select_div").show();

                $.ajax({
                    url: base_url+"assign_target_to_zone/get_dropDown_type_by_crop/",
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
                $("#load_variety").html('');
            }
        });

        $(document).on("change", "#type_select", function(event)
        {
            if($(this).val().length>1 && $("#crop_select").val().length>1 && $("#selection_type").val()==2)
            {
                $.ajax({
                    url: base_url+"assign_target_to_zone/get_variety_detail/",
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
                $("#load_variety").html('');
            }
        });

        $(document).on("change","#year",function()
        {
            $("#load_variety").html('');
//            if($(this).val().length>0)
//            {
//                $.ajax({
//                    url: base_url+"assign_target_to_zone/get_variety_detail/",
//                    type: 'POST',
//                    dataType: "JSON",
//                    data:{year_id:$(this).val()},
//                    success: function (data, status)
//                    {
//
//                    },
//                    error: function (xhr, desc, err)
//                    {
//                        console.log("error");
//                    }
//                });
//            }
//            else
//            {
//                $("#load_variety").html('');
//            }
        });


        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
        });

    });

    $(document).on("keyup", ".quantity", function()
    {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $(document).on("keyup", ".total", function()
    {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

</script>