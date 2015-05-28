<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    $data["link_new"]=base_url()."sales_prediction_setup/index/add";
    $data["hide_approve"]="1";
    $this->load->view("action_buttons",$data);

//echo '<pre>';
//print_r($purchases);
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
                    <th><?php echo $this->lang->line("ACTION"); ?></th>
                </tr>
            </thead>

            <tbody>
            <?php
                if(sizeof($purchases)>0)
                {
                    foreach($purchases as $key=>$purchase)
                    {
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $purchase['year_name'];?></td>
                            <td>
                                <a href="<?php echo base_url();?>budgeted_purchase/index/edit/<?php echo $purchase['year'];?>">
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
