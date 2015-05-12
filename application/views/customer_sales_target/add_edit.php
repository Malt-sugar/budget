<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."customer_sales_target/index/add";
    $data["link_back"]=base_url()."customer_sales_target";
    $this->load->view("action_buttons_edit",$data);

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
                <select name="year" id="year" class="form-control validate[required]">
                    <?php
                    $current_year=date("Y",time());
                    for($i=$this->config->item("start_year");$i<=($current_year+$this->config->item("next_year_range"));$i++)
                    {?>
                        <option value="<?php echo $i;?>" <?php echo ($i==$current_year)?"selected":"";?>><?php echo $i;?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>

<!--        <div class="row show-grid">-->
<!--            <div class="col-xs-4">-->
<!--                <label class="control-label pull-right">--><?php //echo $this->lang->line('LABEL_DIVISION');?><!--<span style="color:#FF0000">*</span></label>-->
<!--            </div>-->
<!--            <div class="col-sm-4 col-xs-8">-->
<!--                <select name="division" class="form-control" id="division">-->
<!--                    --><?php
//                        $this->load->view('dropdown',array('drop_down_options'=>$divisions,'drop_down_selected'=>''));
//                    ?>
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row show-grid zone" style="display: none;">-->
<!--            <div class="col-xs-4">-->
<!--                <label class="control-label pull-right">--><?php //echo $this->lang->line('LABEL_ZONE');?><!--<span style="color:#FF0000">*</span></label>-->
<!--            </div>-->
<!---->
<!--            <div class="col-sm-4 col-xs-8">-->
<!--                <select name="zone" class="form-control" id="zone">-->
<!--                    --><?php
//                        $this->load->view('dropdown',array('drop_down_options'=>$zones,'drop_down_selected'=>''));
//                    ?>
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="row show-grid territory" style="display: none;">-->
<!--            <div class="col-xs-4">-->
<!--                <label class="control-label pull-right">--><?php //echo $this->lang->line('LABEL_TERRITORY');?><!--<span style="color:#FF0000">*</span></label>-->
<!--            </div>-->
<!--            <div class="col-sm-4 col-xs-8">-->
<!--                <select name="territory" class="form-control" id="territory">-->
<!--                    --><?php
//                        $this->load->view('dropdown',array('drop_down_options'=>$territories,'drop_down_selected'=>''));
//                    ?>
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->

        <div class="row show-grid customer">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CUSTOMER');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="customer" class="form-control" id="customer">
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$customers,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div class="row show-grid crop" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_CROP');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="crop" class="form-control" id="crop">
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
                <select name="type" class="form-control" id="type">
                    <?php
                        $this->load->view('dropdown',array('drop_down_options'=>$types,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>
    </div>

    <div class="row widget" id="customer_varieties">

    </div>

    <div class="clearfix"></div>
</form>
<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".form_valid").validationEngine();

//        $(document).on("change", "#division", function()
//        {
//            if($(this).val().length>0)
//            {
//                $(".zone").show();
//            }
//            else
//            {
//                $(".zone").hide();
//                $("#zone").val('');
//                $(".territory").hide();
//                $("#territory").val('');
//                $(".customer").hide();
//                $("#customer").val('');
//            }
//        });
//
//        $(document).on("change","#zone",function()
//        {
//            // alert($(this).val());
//            if($(this).val().length>0)
//            {
//                $(".territory").show();
//                $.ajax({
//                    url: base_url+"budget_common/get_dropDown_territory_by_zone/",
//                    type: 'POST',
//                    dataType: "JSON",
//                    data:{zone_id:$("#zone").val()},
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
//                $(".territory").hide();
//                $("#territory").val('');
//                $(".customer").hide();
//                $("#customer").val('');
//            }
//        });
//
//        $(document).on("change","#territory",function()
//        {
//            // alert($(this).val());
//            if($(this).val().length>0)
//            {
//                $(".customer").show();
//                $.ajax({
//                    url: base_url+"budget_common/get_dropDown_customer_by_territory/",
//                    type: 'POST',
//                    dataType: "JSON",
//                    data:{zone_id:$("#zone").val(), territory_id:$(this).val()},
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
//                $(".customer").hide();
//                $("#customer").val('');
//            }
//        });

        $(document).on("change","#customer",function()
        {
            if($(this).val().length>0)
            {
                $(".crop").show();
            }
            else
            {
                $(".crop").hide();
                $("#customer_varieties").html('');
            }
        });

        $(document).on("change","#crop",function()
        {
            // alert($(this).val());
            if($(this).val().length>0)
            {
                $(".type").show();
                $.ajax({
                    url: base_url+"budget_common/get_dropDown_type_by_crop/",
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
                $(".type").hide();
                $("#type").val('');
                $("#customer_varieties").html('');
            }
        });

        $(document).on("change","#type",function()
        {
            $.ajax({
                url: base_url+"budget_common/get_dropDown_variety_by_crop_type/",
                type: 'POST',
                dataType: "JSON",
                data:{crop_id:$("#crop").val(), type_id:$(this).val()},
                success: function (data, status)
                {

                },
                error: function (xhr, desc, err)
                {
                    console.log("error");
                }
            });
        });

        $(document).on("keyup", ".variety_quantity", function()
        {
            this.value = this.value.replace(/[^0-9\.]/g,'');
        });

    });
</script>