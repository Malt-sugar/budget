<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]="#";
    $data["hide_back"]="1";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);

?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>sales_target_edit/index/save" method="post">
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
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_EDIT_LEVEL');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="edit_type" id="edit_type" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="1"><?php echo $this->lang->line('LABEL_DIVISION');?></option>
                    <option value="2"><?php echo $this->lang->line('LABEL_ZONE');?></option>
                    <option value="3"><?php echo $this->lang->line('LABEL_TERRITORY');?></option>
                    <option value="4"><?php echo $this->lang->line('LABEL_CUSTOMER');?></option>
                </select>
            </div>
        </div>

        <div class="row show-grid division zone territory customer" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DIVISION');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="division" id="division" class="form-control validate[required]">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid zone territory customer" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_ZONE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="zone" id="zone" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>

        <div class="row show-grid territory customer" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TERRITORY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="territory" id="territory" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>

        <div class="row show-grid customer" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="customer" id="customer" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                </select>
            </div>
        </div>
    </div>

    <div id="budget_add_more_container">
        <div class="budget_add_more_container">
            <div class="row widget">
                <div class="widget-header" style="padding: 3px 4px 3px 10px;">
                    <div class="title">
                        <?php echo $this->lang->line('SALES_TARGET_EDIT')?>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="crop">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="quantity[0][crop]" class="form-control crop_id" id="crop0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="type" style="display: none;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="quantity[0][type]" class="form-control type_id" id="type0" data-type-current-id="0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="variety" style="display: none;">
                    <div class="col-xs-1">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
                    </div>
                    <div class="col-xs-2">
                        <select name="quantity[0][variety]" class="form-control variety_id" id="variety0" data-variety-current-id="0">
                            <?php
                            $this->load->view('dropdown',array('drop_down_options'=>$varieties,'drop_down_selected'=>''));
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-3 variety_quantity" id="variety_quantity0" data-varietyDetail-current-id="0" style="padding-bottom: 0px;">
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center" id="add_more">
        <button type="button" class="btn btn-warning budget_add_more_button"><?php echo $this->lang->line('ADD_MORE');?></button>
    </div>

    <h1>&nbsp;</h1>

    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container"  data-current-id="0">
        <div class="widget-header" style="padding: 3px 4px 3px 10px;">
            <div class="title">
                <?php echo $this->lang->line('SALES_TARGET_EDIT')?>
            </div>
            <div class="pull-right budget_add_more_delete"><img style="width: 25px; height: 25px;" src="<?php echo base_url().'images/xmark.png'?>" /></div>
            <div class="clearfix"></div>
        </div>

        <div class="crop">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
            </div>
            <div class="col-xs-2">
                <select class="form-control crop_id" id="crop_id">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$crops,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="type" style="display: none;">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?></label>
            </div>
            <div class="col-xs-2">
                <select name="" class="form-control type_id" id="type_id">

                </select>
            </div>
        </div>

        <div class="variety" style="display: none;">
            <div class="col-xs-1">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_VARIETY');?></label>
            </div>
            <div class="col-xs-2">
                <select name="" class="form-control variety_id" id="variety_id">

                </select>
            </div>
        </div>

        <div class="col-xs-3 variety_quantity" id="variety_quantity" data-varietyDetail-current-id="" style="padding-bottom: 0px;">
        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

        $(document).on("change", "#edit_type", function(event)
        {
            if($(this).val()==1)
            {
                $(".zone").hide();
                $(".territory").hide();
                $(".customer").hide();

                $("#zone").val('');
                $("#territory").val('');
                $("#customer").val('');

                $(".division").show();
            }
            else if($(this).val()==2)
            {
                $(".division").hide();
                $(".territory").hide();
                $(".customer").hide();

                $("#division").val('');
                $("#territory").val('');
                $("#customer").val('');

                $(".zone").show();
            }
            else if($(this).val()==3)
            {
                $(".division").hide();
                $(".zone").hide();
                $(".customer").hide();

                $("#division").val('');
                $("#zone").val('');
                $("#customer").val('');

                $(".territory").show();
            }
            else if($(this).val()==4)
            {
                $(".division").hide();
                $(".zone").hide();
                $(".territory").hide();

                $("#division").val('');
                $("#zone").val('');
                $("#territory").val('');

                $(".customer").show();
            }
            else
            {
                $(".division").hide();
                $(".zone").hide();
                $(".territory").hide();
                $(".customer").hide();

                $("#division").val('');
                $("#zone").val('');
                $("#territory").val('');
                $("#customer").val('');
            }
        });

        $(document).on("change","#division",function()
        {
            if($(this).val().length>0 && $("#edit_type").val()>1)
            {
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_zone_by_division/",
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
        });

        $(document).on("change","#zone",function()
        {
            if($(this).val().length>0 && $("#division").val().length>0 && $("#edit_type").val()>2)
            {
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_territory_by_zone/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{zone_id: $(this).val()},
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

        $(document).on("change","#territory",function()
        {
            if($(this).val().length>0 && $("#division").val().length>0 && $("#zone").val().length>0 && $("#edit_type").val()>3)
            {
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_customer_by_territory/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{zone_id: $("#zone").val(), territory_id: $(this).val()},
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

        // ROW INCREMENT FUNCTION
        $(document).on("click", ".budget_add_more_button", function(event)
        {
            var current_id = parseInt($('.budget_add_more_content .budget_add_more_holder').attr('data-current-id'));
            current_id = current_id+1;
            $('.budget_add_more_content .budget_add_more_holder').attr('data-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('data-crop-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('data-type-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('data-variety-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('id','crop'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('id','type'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('id','variety'+current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('name','quantity['+current_id+'][crop]');
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('name','quantity['+current_id+'][type]');
            $('.budget_add_more_content .budget_add_more_holder .variety_id').attr('name','quantity['+current_id+'][variety]');

            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('data-varietyDetail-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('id','variety_quantity'+current_id);

            var html = $('.budget_add_more_content').html();
            $('#budget_add_more_container').append(html);
        });

        // Incremented Row Delete Button
        $(document).on("click", ".budget_add_more_delete", function(event)
        {
            $(this).closest('.budget_add_more_container').next('.variety_quantity').remove();
            $(this).closest('.budget_add_more_container').remove();
        });

        $(document).on("change",".crop_id",function()
        {
            var current_id = parseInt($(this).parents().next('.type').find('.type_id').attr('data-type-current-id'));

            $(this).parents().next('.type').next('.variety').hide();
            $(this).parents().next('.type').next('.variety_id').val('');
            $(this).parents().next('.type').next('.variety').next('.variety_quantity').html('');

            if($(this).val().length>0)
            {
                $(this).parents().next('.type').show();
                $(this).parents().next('.type').next('.variety_quantity').html('');

                $.ajax({
                    url: base_url+"budget_common/get_dropDown_type_by_crop/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$(this).val(), current_id:current_id},
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
                $(this).parents().next('.type').hide();
                $(this).parents().next('.type_id').val('');

                $(this).parents().next('.type').next('.variety').hide();
                $(this).parents().next('.type').next('.variety_id').val('');

                $(this).parents().next('.type').next('.variety').next('.variety_quantity').html('');
            }
        });

        $(document).on("change",".type_id",function()
        {
            var current_id = parseInt($(this).parents().next('.variety').find('.variety_id').attr('data-variety-current-id'));

            if($(this).val().length>0)
            {
                $(this).parents().next('.variety').show();
                $(this).parents().next('.variety').next('.variety_quantity').html('');

                $.ajax({
                    url: base_url+"budget_common/get_dropDown_variety_by_cropType/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop"+current_id).val(), type_id:$(this).val(), current_id:current_id},
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
                $(this).parents().next('.variety').hide();
                $(this).parents().next('.variety').val('');
                $(this).parents().next('.variety').next('.variety_quantity').html('');
            }
        });

        $(document).on("change",".variety_id",function()
        {
            var current_id = parseInt($(this).parents().next('.variety_quantity').attr('data-varietyDetail-current-id'));
            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"sales_target_edit/get_sales_target_edit_detail/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id: $("#crop"+current_id).val(), type_id: $("#type"+current_id).val(), variety_id: $(this).val(), current_id: current_id, year: $("#year").val(), edit_type: $("#edit_type").val()},
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
                $(this).parents().next('.variety_quantity').html('');
            }
        });

        $(document).on("keyup", ".variety_quantity", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

    });
</script>