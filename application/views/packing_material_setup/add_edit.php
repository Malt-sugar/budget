<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."packing_material_setup/index/add";
    $data["link_back"]=base_url()."packing_material_setup";
    $data["link_approve"]="#";
    $data["hide_approve"]="1";

    $this->load->view("action_buttons_edit",$data);
?>

<form class="form_valid" id="save_form" action="<?php echo base_url();?>packing_material_setup/index/save" method="post">
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-lg-12">
            <table class="table table-bordered" style="margin-right: 10px !important;">
                <tr>
                    <th><?php echo $this->lang->line('LABEL_CROP');?></th>
                    <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
                    <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
                    <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_PACKING_MATERIAL_NEED');?></label></th>
                </tr>

                <?php
                $crop_name = '';
                $product_type_name = '';

                foreach($varieties as $variety)
                {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if($crop_name == '')
                            {
                                echo $variety['crop_name'];
                                $crop_name = $variety['crop_name'];
                            }
                            elseif($crop_name == $variety['crop_name'])
                            {
                                echo "&nbsp;";
                            }
                            else
                            {
                                echo $variety['crop_name'];
                                $crop_name = $variety['crop_name'];
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($product_type_name == '')
                            {
                                echo $variety['product_type'];
                                $product_type_name = $variety['product_type'];
                            }
                            elseif($product_type_name == $variety['product_type'])
                            {
                                echo "&nbsp;";
                            }
                            else
                            {
                                echo $variety['product_type'];
                                $product_type_name = $variety['product_type'];
                            }
                            ?>
                        </td>
                        <td><?php echo $variety['varriety_name'];?></td>
                        <td class="text-center">
                            <input type="checkbox" <?php if($variety['packing_material']==1){echo 'checked';}?> name="pack[<?php echo $variety['varriety_id'];?>]" value="1" />
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
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