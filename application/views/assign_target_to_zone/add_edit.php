<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."assign_target_to_zone/index/add";
    $data["link_back"]=base_url()."assign_target_to_zone";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>assign_target_to_division/index/save" method="post">
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

        <div class="col-lg-12" id="load_variety" style="overflow-x: auto; display: none;">

        </div>

        <div class="col-lg-12" id="scrollButtons" style="display: none;">
            <div class="col-lg-6 pull-left">
                <input type="button" id="myButtonRight" name="scroll" value="Right" class="btn btn-warning" />
            </div>

            <div class="col-lg-6 pull-right">
                <input type="button" id="myButtonLeft" name="scroll" value="Left" class="btn btn-warning" />
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</form>



<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("click", "#myButtonRight", function(event)
        {
            $('#scrollTable').animate({'right':'+=100px'});
        });

        $(document).on("click", "#myButtonLeft", function(event)
        {
            $('#scrollTable').animate({'right':'-=100px'});
        });

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

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
                $("#scrollButtons").show();
                $("#load_variety").show();
                $.ajax({
                    url: base_url+"assign_target_to_zone/get_variety_detail/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{year_id:$(this).val()},
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
                $("#scrollButtons").hide();
                $("#load_variety").hide();
                $("#load_variety").html('');
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