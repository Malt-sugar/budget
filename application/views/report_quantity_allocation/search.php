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
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MONTH_FROM');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="from_month" id="from_month" class="form-control validate[required]">
                <?php
                $monthConfig = $this->config->item('month');
                foreach($monthConfig as $val=>$month)
                {
                ?>
                    <option value="<?php echo $val;?>"><?php echo $month;?></option>
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
                    <option value="<?php echo $val;?>"><?php echo $month;?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>

    <div class="row show-grid">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DIVISION');?></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="division" class="form-control validate[required]" id="division">
                <?php
                $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>''));
                ?>
            </select>
        </div>
    </div>

    <div class="row show-grid zone" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_ZONE');?></label>
        </div>

        <div class="col-sm-4 col-xs-8">
            <select name="zone" class="form-control validate[required]" id="zone">

            </select>
        </div>
    </div>

    <div class="row show-grid territory" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TERRITORY');?></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="territory" class="form-control validate[required]" id="territory">

            </select>
        </div>
    </div>

    <div class="row show-grid district" style="display: <?php if(isset($arranged_targets['zilla_id']) && strlen($arranged_targets['zilla_id'])>1){echo 'show';}else{echo 'none';}?>;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DISTRICT');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="district" class="form-control validate[required]" id="district">

            </select>
        </div>
    </div>

    <div class="row show-grid customer" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER');?></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="customer" class="form-control validate[required]" id="customer">

            </select>
        </div>
    </div>

    <div class="row show-grid">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
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
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <select name="type" id="type" class="form-control validate[required]">

            </select>
        </div>
    </div>

    <div class="row show-grid variety" style="display: none;">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
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

        $(document).on("change", "#division", function()
        {
            $("#report_list").html("");

            $(".zone").show();

            $("#zone").val('');
            $(".territory").hide();
            $("#territory").val('');
            $(".district").hide();
            $("#district").val('');
            $(".customer").hide();
            $("#customer").val('');

            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"budget_common/get_zone_by_access/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{division_id:$(this).val()},
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
                $(".zone").hide();
                $("#zone").val('');
                $(".territory").hide();
                $("#territory").val('');
                $(".district").hide();
                $("#district").val('');
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#zone",function()
        {
            $("#report_list").html("");

            $(".territory").show();
            $("#territory").val('');
            $(".district").hide();
            $("#district").val('');
            $(".customer").hide();
            $("#customer").val('');

            if($(this).val().length>0)
            {
                $(".territory").show();
                $.ajax({
                    url: base_url+"budget_common/get_territory_by_access/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{zone_id:$(this).val()},
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
                $(".territory").hide();
                $("#territory").val('');
                $(".district").hide();
                $("#district").val('');
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#territory",function()
        {
            $("#district").val('');
            $(".customer").hide();
            $("#customer").val('');

            if($(this).val().length>0)
            {
                $(".district").show();
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_district_by_territory/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{zone_id:$("#zone").val(), territory_id:$(this).val()},
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
                $(".district").hide();
                $("#district").val('');
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#district",function()
        {
            $("#customer").val('');

            if($(this).val().length>0)
            {
                $(".customer").show();
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_customer_by_district/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{territory_id: $("#territory").val(), district_id:$(this).val()},
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
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#crop",function()
        {
            $("#report_list").html("");
            $(".variety").hide();
            $("#variety").html('');

            $(".type").val('');

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
            $(".variety").val('');

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
                url: base_url+"report_quantity_allocation/index/report",
                type: 'POST',
                dataType: "JSON",
                data:{year:$("#year").val(),from_month:$("#from_month").val(), to_month:$("#to_month").val(), crop_id:$("#crop").val(), type_id:$("#type").val(), variety_id:$("#variety").val(), division: $("#division").val(), zone: $("#zone").val(), territory: $("#territory").val(), district: $("#district").val(), customer: $("#customer").val()},
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