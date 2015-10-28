<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["link_back"]=base_url()."home";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";
    $data["link_back"]="#";
    $data["hide_back"]="1";

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

        <div class="col-lg-12">
            <div class="row show-grid">
                <div class="col-xs-4">
                    <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_TYPE');?><span style="color:#FF0000">*</span></label>
                </div>
                <div class="col-sm-4 col-xs-8">
                    <select name="year" id="year" class="form-control validate[required]">
                        <option value=""><?php echo $this->lang->line('SELECT');?></option>
                        <option value="1"><?php echo $this->lang->line('LABEL_DIVISION');?></option>
                        <option value="2"><?php echo $this->lang->line('LABEL_ZONE');?></option>
                        <option value="3"><?php echo $this->lang->line('LABEL_TERRITORY');?></option>
                        <option value="4"><?php echo $this->lang->line('LABEL_CUSTOMER');?></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</form>

<script type="text/javascript">

//    jQuery(document).ready(function()
//    {
//
//    });
//
//    $(document).on("keyup", ".quantity", function()
//    {
//        this.value = this.value.replace(/[^0-9\.]/g,'');
//    });
//
//    $(document).on("keyup", ".total", function()
//    {
//        this.value = this.value.replace(/[^0-9\.]/g,'');
//    });

</script>