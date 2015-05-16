<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."create_crop_type/index/add";
    $this->load->view("action_buttons",$data);
//echo '<pre>';
//print_r($typeInfo);
//echo '</pre>';
?>

<div class="row widget">
    <div class="widget-header">
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-12"style="overflow-x: auto;">
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th><?php echo $this->lang->line("SERIAL"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CROP_NAME"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TYPE_CODE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_LENGTH"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_WEIGHT"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_YIELD"); ?></th>
                <th><?php echo $this->lang->line("ACTION"); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php
            if(sizeof($typeInfo)>0)
            {
                foreach($typeInfo as $key=>$type)
                {
                ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $type['crop_name'];?></td>
                    <td><?php echo $type['type_name'];?></td>
                    <td><?php echo $type['type_code'];?></td>
                    <td><?php echo $type['terget_length'];?></td>
                    <td><?php echo $type['terget_weight'];?></td>
                    <td><?php echo $type['terget_yeild'];?></td>
                    <td>
                        <a href="<?php echo base_url();?>create_crop_type/index/edit/<?php echo $type['id'];?>">
                            <img src="<?php echo base_url();?>images/edit_record.png">
                        </a>
                    </td>
                </tr>
                <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="20" class="text-center alert-danger">
                        <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                    </td>
                </tr>
            <?php
            }
            ?>

            </tbody>
        </table>
    </div>
    <div class="col-xs-12">
        <div class="pagination_container pull-right">
            <?php
                echo $links;
            ?>
        </div>
    </div>


</div>
<div class="clearfix"></div>
<script type="text/javascript">
    jQuery(document).ready(function()
    {
        turn_off_triggers();
    });
</script>