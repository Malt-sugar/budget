<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$data["link_back"]="#";
$data["hide_back"]="1";
$data["hide_save"]="1";
$data["hide_approve"]="1";
$this->load->view("action_buttons_edit",$data);
?>

<div class="row widget hidden-print">
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
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="crop" id="crop" class="form-control validate[required]">
                <?php
                $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                ?>
            </select>
        </div>
    </div>

    <div class="row show-grid type" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="type" id="type" class="form-control validate[required]">

            </select>
        </div>
    </div>

    <div class="row show-grid variety" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="variety" id="variety" class="form-control validate[required]">

            </select>
        </div>
    </div>

    <div class="row show-grid">
        <div class="col-xs-4">

        </div>
        <div class="col-xs-4">
            <input type="button" id="load_report" class="form-control btn-primary" value="<?php echo $this->lang->line('VIEW_REPORT');?>" />
        </div>
        <div class="col-xs-4">

        </div>
    </div>
</div>

<div class="row widget" id="report_list">
</div>

<script type="text/javascript">
    jQuery(document).ready(function()
    {
        turn_off_triggers();

        $(document).on("change","#crop",function()
        {
            $("#report_list").html("");
            $(".variety").hide();
            $("#variety").html('');

            if($(this).val().length>0)
            {
                $(".type").show();
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_type_by_crop/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop").val()},
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
                $(".type").hide();
            }
        });

        $(document).on("change","#type",function()
        {
            $("#report_list").html("");

            if($(this).val().length>0)
            {
                $(".variety").show();
                $.ajax({
                    url: base_url+"budget_common/get_variety_by_crop_type/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop").val(), type_id:$("#type").val()},
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
                $(".variety").hide();
            }
        });

        $(document).on("click", "#load_report", function(event)
        {
            $("#report_list").html("");
            $.ajax({
                url: base_url+"report_budgeted_purchase/index/report",
                type: 'POST',
                dataType: "JSON",
                data:{year:$("#year").val(),crop_id:$("#crop").val(), type_id:$("#type").val(), variety_id:$("#variety").val()},
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