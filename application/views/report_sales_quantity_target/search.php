<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$data["link_back"]="#";
$data["hide_back"]="1";
$data["hide_save"]="1";
$data["hide_approve"]="1";
$this->load->view("action_buttons_edit",$data);
?>

<script>
    jQuery(document).ready(function() {
        turn_off_triggers();
    });
</script>

<div class="row widget hidden-print">
    <div class="widget-header">
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget-body">
        <div class="col-lg-12">
            <?php
                $this->load->view('report_selection/division_zone_territory_district_customer');
                $this->load->view('report_selection/crop_type_variety');
                $this->load->view('report_selection/year_month');
            ?>
        </div>
        <table class="table table-condensed table-striped table-hover table-bordered pull-left" style="margin-bottom: 0px; border-right: 0px; border-left: 0px;">
            <thead>
                <tr>
                    <td colspan="12" style="text-align: right; border: 0px;">
                        <a class="btn btn-small btn-success external" id="load_report" style="margin-right: 10px;">
                            <?php echo $this->lang->line('VIEW_REPORT');?>
                        </a>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="row widget" id="report_list">
</div>

<script type="text/javascript">
    jQuery(document).ready(function()
    {
//        turn_off_triggers();
        $(document).on("click", "#load_report", function(event)
        {
            $("#report_list").html("");
            $.ajax({
                url: base_url+"report_sales_quantity_target/index/report",
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