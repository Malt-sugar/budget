<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."assign_target_to_zone/index/add";
    $data["link_back"]=base_url()."assign_target_to_zone";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>assign_target_to_zone/index/save" method="post">
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

        <div class="col-lg-12" id="load_variety" style="overflow-x: auto;">

        </div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("keyup", ".targeted_total", function(event)
        {
            var targeted = $(this).val();
            $(this).closest('tr').find(".remaining").val(targeted)
        });

        $(document).on("keyup", ".targeted", function(event)
        {
            var attr = $(this).closest('.div_target').find('.targeted');
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

            var targeted_val = $(this).closest('.div_target').closest('tr').find('.targeted_total').val();
            var new_remaining_val = targeted_val - sum;

            $(this).closest('.div_target').closest('tr').find('.remaining').val(new_remaining_val);
        });

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
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
                $("#load_variety").html('');
            }
        });


        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
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