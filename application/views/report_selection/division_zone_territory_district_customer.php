<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 20-Jan-16
 * Time: 3:13 PM
 */
?>
<table class="table table-condensed table-striped table-hover table-bordered pull-left">
    <thead>
        <tr>
            <th style="width:10%">
                <?php echo $this->lang->line('LABEL_DIVISION');?>
            </th>
            <th style="width:10%">
                <?php echo $this->lang->line('LABEL_ZONE');?>
            </th>
            <th style="width:10%">
                <?php echo $this->lang->line('LABEL_TERRITORY');?>
            </th>
            <th style="width:10%">
                <?php echo $this->lang->line('LABEL_DISTRICT');?>
            </th>
            <th style="width:10%">
                <?php echo $this->lang->line('LABEL_CUSTOMER');?>
            </th>
        </tr>
        <tr>
            <td>
                <select name="division" class="form-control validate[required]" id="division">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>''));
                    ?>
                </select>
            </td>
            <td>
                <select name="zone" class="form-control validate[required]" id="zone">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>

                </select>
            </td>
            <td>
                <select name="territory" class="form-control validate[required]" id="territory">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </td>
            <td>
                <select name="district" class="form-control validate[required]" id="district">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </td>
            <td>
                <select name="customer" class="form-control validate[required]" id="customer">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </td>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    jQuery(document).ready(function()
    {
//        turn_off_triggers();
        $(document).on("change", "#division", function ()
        {
            $("#report_list").html("");
            $("#zone").val('');
            $("#territory").val('');
            $("#district").val('');
            $("#customer").val('');

            if ($(this).val().length > 0)
            {
                $.ajax({
                    url: base_url + "budget_common/get_zone_by_access/",
                    type: 'POST',
                    dataType: "JSON",
                    data: {division_id: $(this).val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }
            else
            {
                $("#zone").val('');
                $("#territory").val('');
                $("#district").val('');
                $("#customer").val('');
            }
        });

        $(document).on("change", "#zone", function ()
        {
            $("#report_list").html("");

            $("#territory").val('');
            $("#district").val('');
            $("#customer").val('');

            if ($(this).val().length > 0) {
                $(".territory").show();
                $.ajax({
                    url: base_url + "budget_common/get_territory_by_access/",
                    type: 'POST',
                    dataType: "JSON",
                    data: {zone_id: $(this).val()},
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
                $("#territory").val('');
                $("#district").val('');
                $("#customer").val('');
            }
        });

        $(document).on("change", "#territory", function ()
        {
            $("#district").val('');
            $("#customer").val('');

            if ($(this).val().length > 0)
            {
                $(".district").show();
                $.ajax({
                    url: base_url + "budget_common/get_dropDown_district_by_territory/",
                    type: 'POST',
                    dataType: "JSON",
                    data: {zone_id: $("#zone").val(), territory_id: $(this).val()},
                    success: function (data, status) {

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }
            else
            {
                $("#district").val('');
                $("#customer").val('');
            }
        });

        $(document).on("change", "#district", function ()
        {
            $("#customer").val('');

            if ($(this).val().length > 0)
            {
                $(".customer").show();
                $.ajax({
                    url: base_url + "budget_common/get_dropDown_customer_by_district/",
                    type: 'POST',
                    dataType: "JSON",
                    data: {territory_id: $("#territory").val(), district_id: $(this).val()},
                    success: function (data, status) {

                    },
                    error: function (xhr, desc, err) {
                        console.log("error");
                    }
                });
            }
            else
            {
                $("#customer").val('');
            }
        });
    });

</script>