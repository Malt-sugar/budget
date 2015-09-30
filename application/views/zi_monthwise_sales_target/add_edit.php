<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."ti_sales_target/index/add";
    $data["link_back"]=base_url()."ti_sales_target";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";
    $data["link_save"]="#";
    $data["hide_save"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>zi_monthwise_sales_target/index/save" method="post">
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
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="type" id="type" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="1"><?php echo $this->lang->line('TERRITORYWISE');?></option>
                    <option value="2"><?php echo $this->lang->line('ZONEWISE');?></option>
                </select>
            </div>
        </div>

        <div class="row show-grid" id="territory_div" style="display: none;">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TERRITORY');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="territory" id="territory" class="form-control">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$territories,'drop_down_selected'=>''));
                    ?>
                </select>
            </div>
        </div>

        <div id="load_variety" style="overflow-x: auto; display: none;">

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

        $(document).on("change","#type",function()
        {
            if($(this).val()==1)
            {
                $("#territory").val('');
                $("#territory_div").show();
                $("#scrollButtons").hide();
                $("#load_variety").html('');
                $("#load_variety").hide();
            }
            else
            {
                $("#territory_div").hide();
                if($(this).val()==2 && $("#year").val().length>0)
                {
                    $("#load_variety").show();
                    $.ajax({
                        url: base_url+"zi_monthwise_sales_target/get_variety_detail/",
                        type: 'POST',
                        dataType: "JSON",
                        data:{year_id:$("#year").val(), type: $("#type").val()},
                        success: function (data, status)
                        {

                        },
                        error: function (xhr, desc, err)
                        {
                            console.log("error");
                        }
                    });
                    $("#scrollButtons").show();
                }
                else
                {
                    $("#scrollButtons").hide();
                    $("#load_variety").html('');
                    $("#load_variety").hide();
                }
            }
        });

        $(document).on("change","#territory",function()
        {
            if($("#type").val()==1 && $("#year").val().length>0 && $(this).val().length>0)
            {
                $("#load_variety").show();
                $.ajax({
                    url: base_url+"zi_monthwise_sales_target/get_variety_detail/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{year_id:$("#year").val(), type: $("#type").val(), territory: $(this).val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
                $("#scrollButtons").show();
            }
            else
            {
                $("#scrollButtons").hide();
                $("#load_variety").html('');
                $("#load_variety").hide();
            }
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