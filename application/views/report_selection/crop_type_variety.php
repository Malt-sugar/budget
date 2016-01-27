<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 20-Jan-16
 * Time: 3:13 PM
 */
?>
<table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
    <thead>
        <tr>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_CROP');?>
            </th>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_TYPE');?>
            </th>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_VARIETY');?>
            </th>
        </tr>
        <tr>
            <td>
                <select name="crop" id="crop" class="form-control validate[required]">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                    ?>
                </select>
            </td>
            <td>
                <select name="type" id="type" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </td>
            <td>
                <select name="variety" id="variety" class="form-control validate[required]">
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
        $(document).on("change","#crop",function()
        {
            $("#report_list").html("");
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
        });
    });

</script>