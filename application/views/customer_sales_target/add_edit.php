<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."customer_sales_target/index/add";
    $data["link_back"]=base_url()."customer_sales_target";
    //$data["hide_back"]="1";
    $this->load->view("action_buttons_edit",$data);

//echo '<pre>';
//print_r($targets);
//echo '</pre>';

$arranged_targets = array();
foreach($targets as $target)
{
    $arranged_targets['division_id'] = $target['division_id'];
    $arranged_targets['zone_id'] = $target['zone_id'];
    $arranged_targets['territory_id'] = $target['territory_id'];
    $arranged_targets['customer_id'] = $target['customer_id'];
    $arranged_targets['year'] = $target['year'];

    $arranged_targets['crop'][$target['crop_id']]['crop_id'] = $target['crop_id'];
    $arranged_targets['crop'][$target['crop_id']]['type_id'] = $target['type_id'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['variety_id']=$target['variety_id'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['quantity']=$target['quantity'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['is_approved_by_zi']=$target['is_approved_by_zi'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['is_approved_by_di']=$target['is_approved_by_di'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['is_approved_by_hom']=$target['is_approved_by_hom'];
    $arranged_targets['crop'][$target['crop_id']]['variety'][$target['variety_id']]['created_by']=$target['created_by'];

}

//echo sizeof($arranged_targets['crop']);
//echo '<pre>';
//print_r($arranged_targets);
//echo '</pre>';

?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>customer_sales_target/index/save" method="post">
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
                <select name="year" id="year" class="form-control validate[required]" <?php if(strlen($arranged_targets['year'])>1){echo 'disabled';}?>>
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>$arranged_targets['year']));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DIVISION');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="division" class="form-control" id="division" <?php if(strlen($arranged_targets['division_id'])>1){echo 'disabled';}?>>
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>$arranged_targets['division_id']));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid zone" style="display: <?php if(strlen($arranged_targets['zone_id'])>1){echo 'show';}else{echo 'none';}?>;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_ZONE');?><span style="color:#FF0000">*</span></label>
            </div>

            <div class="col-sm-4 col-xs-8">
                <select name="zone" class="form-control" id="zone" <?php if(strlen($arranged_targets['zone_id'])>1){echo 'disabled';}?>>
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$zones,'drop_down_selected'=>$arranged_targets['zone_id']));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid territory" style="display: <?php if(strlen($arranged_targets['territory_id'])>1){echo 'show';}else{echo 'none';}?>;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TERRITORY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="territory" class="form-control" id="territory" <?php if(strlen($arranged_targets['territory_id'])>1){echo 'disabled';}?>>
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$territories,'drop_down_selected'=>$arranged_targets['territory_id']));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid customer" style="display: <?php if(strlen($arranged_targets['customer_id'])>1){echo 'show';}else{echo 'none';}?>;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="customer" class="form-control" id="customer" <?php if(strlen($arranged_targets['customer_id'])>1){echo 'disabled';}?>>
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$customers,'drop_down_selected'=>$arranged_targets['customer_id']));
                    ?>
                </select>
            </div>
        </div>
    </div>

<!--    ////////////////////////////////////////////////////// SALES TARGET ////////////////////////////////////////////////   -->

    <div id="budget_add_more_container" class="budget_add_more_container" style="display: none;">
        <div class="row widget">
            <div class="widget-header">
                <div class="title">
                    <?php echo $this->lang->line('SALES_TARGET'); ?>
                </div>
                <div class="clearfix"></div>
            </div>
    
            <div class="crop">
                <div class="col-xs-1">
                    <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?></label>
                </div>
                <div class="col-xs-2">
                    <select name="target[0][crop]" class="form-control crop_id" id="crop0">
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
                    <select name="target[0][type]" class="form-control type_id" id="type0" data-type-current-id="0">
                        <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                        ?>
                    </select>
                </div>
            </div>
    
            <div class="col-xs-6 variety_quantity" id="variety0" data-variety-current-id="0">
            </div>
        </div>
    </div>

    <div class="row text-center" id="add_more" style="display: none;">
        <button type="button" class="btn btn-warning budget_add_more_button"><?php echo $this->lang->line('ADD_MORE');?></button>
    </div>

    <h1>&nbsp;</h1>

    <div class="clearfix"></div>
</form>

<div class="budget_add_more_content" style="display: none;">
    <div class="row widget budget_add_more_holder budget_add_more_container"  data-current-id="0">
        <div class="widget-header">
            <div class="title">
                <?php echo $this->lang->line('SALES_TARGET'); ?>
            </div>
            <button type="button" class="btn btn-danger pull-right budget_add_more_delete"><?php echo $this->lang->line('DELETE'); ?></button>
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
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="col-xs-6 variety_quantity" id="variety_quantity">
        </div>
    </div>
</div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

        // ROW INCREMENT FUNCTION
        $(document).on("click", ".budget_add_more_button", function(event)
        {
            var current_id=parseInt($('.budget_add_more_content .budget_add_more_holder').attr('data-current-id'));
            current_id=current_id+1;

            $('.budget_add_more_content .budget_add_more_holder').attr('data-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder #crop_id').attr('name','target['+current_id+'][crop]');
            $('.budget_add_more_content .budget_add_more_holder #type_id').attr('name','target['+current_id+'][type]');

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('data-crop-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('data-type-current-id',current_id);

            $('.budget_add_more_content .budget_add_more_holder .crop_id').attr('id','crop'+current_id);
            $('.budget_add_more_content .budget_add_more_holder .type_id').attr('id','type'+current_id);

            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('data-variety-current-id',current_id);
            $('.budget_add_more_content .budget_add_more_holder .variety_quantity').attr('id','variety'+current_id);

            var html=$('.budget_add_more_content').html();
            $('#budget_add_more_container').append(html);
        });

        // Incremented Row Delete Button
        $(document).on("click", ".budget_add_more_delete", function(event)
        {
            $(this).closest('.budget_add_more_container').remove();
        });

        $(document).on("change", "#division", function()
        {
            if($(this).val().length>0)
            {
                $(".zone").show();

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
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#zone",function()
        {
            // alert($(this).val());
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
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#territory",function()
        {
            if($(this).val().length>0)
            {
                $(".customer").show();
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_customer_by_territory/",
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
                $(".customer").hide();
                $("#customer").val('');
            }
        });

        $(document).on("change","#customer",function()
        {
            if($(this).val().length>0)
            {
                $(".budget_add_more_container").show();
                $("#add_more").show();
                $(".crop").show();
                $("#crop").val('');
            }
            else
            {
                $(".budget_add_more_container").hide();
                $("#add_more").hide();
                $(".crop").hide();
            }

            $("#crop").val('');
        });

        $(document).on("change",".crop_id",function()
        {
            var current_id=parseInt($(this).parents().next('.type').find('.type_id').attr('data-type-current-id'));

            if($(this).val().length>0)
            {
                $(this).parents().next('.type').show();

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
                $(this).parents().next('.type').val('');
                $(this).parents().next('.type').next('.variety_quantity').html('');
            }
        });

        $(document).on("change",".type_id",function()
        {
            var current_id=parseInt($(this).parents().next('.variety_quantity').attr('data-variety-current-id'));

            if($(this).val().length>0)
            {
                $.ajax({
                    url: base_url+"customer_sales_target/get_dropDown_variety_by_crop_type/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{crop_id:$("#crop"+current_id).val(), type_id:$(this).val(), year:$("#year").val(), customer:$("#customer").val(), current_id: current_id},
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