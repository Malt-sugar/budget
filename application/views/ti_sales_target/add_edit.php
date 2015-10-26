<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."ti_sales_target/index/add";
    $data["link_back"]=base_url()."home";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>ti_sales_target/index/save" method="post">
    <input type="hidden" name="type_id" id="type_id" value=""/>
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

        <div id="variety_quantity" style="overflow-x: auto; display: none;">

        </div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("keyup", ".quantity", function(event)
        {
            var attr = $(this).closest('tr').find('.quantity');
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

            $(this).closest('tr').find('.total').val(sum);
        });

        $(document).on("keyup", ".total", function(event)
        {
            var attr = $(this).closest('tr').find('.total');
            var required_total_attr = $(this).closest('tr').find('.required_total');
            var variance = attr.val() - required_total_attr.html().trim();

            $(this).closest('tr').find('.variance').val(variance);
        });

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

        $(document).on("change", "#crop_select", function(event)
        {
            if($(this).val().length>1 && $("#selection_type").val()==1)
            {
                $("#variety_quantity").show();
                $.ajax({
                    url: base_url+"ti_sales_target/get_variety_detail/",
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
                    url: base_url+"ti_sales_target/get_dropDown_type_by_crop/",
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
                $("#variety_quantity").show();
                $.ajax({
                    url: base_url+"ti_sales_target/get_variety_detail/",
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

        $(document).on("change","#year",function()
        {
//            if($(this).val().length>0)
//            {
//                $("#load_variety").show();
//                $.ajax({
//                    url: base_url+"ti_sales_target/get_variety_detail/",
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
//                $("#scrollButtons").show();
//            }
//            else
//            {
//                $("#scrollButtons").hide();
//                $("#load_variety").html('');
//                $("#load_variety").hide();
//            }
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