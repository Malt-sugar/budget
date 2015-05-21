<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons",$data);

//echo '<pre>';
//print_r($sales_targets);
//echo '</pre>';
?>

<div class="row widget">
    <div class="widget-header">
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-xs-12" style="overflow-x: auto;">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line("SERIAL"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_YEAR"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_TERRITORY"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_CUSTOMER_NAME"); ?></th>
                    <th><?php echo $this->lang->line("ACTION"); ?></th>
                </tr>
            </thead>

            <tbody>
            <?php
                if(sizeof($sales_targets)>0)
                {
                    foreach($sales_targets as $key=>$sales_target)
                    {
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $sales_target['year_name'];?></td>
                            <td><?php echo $sales_target['territory_name'];?></td>
                            <td><?php echo $sales_target['distributor_name'];?></td>

                            <td>
                                <a href="<?php echo base_url();?>approval_sales_target_zi/index/edit/<?php echo $sales_target['id'];?>/<?php echo $sales_target['customer_id'];?>/<?php echo $sales_target['year'];?>">
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
