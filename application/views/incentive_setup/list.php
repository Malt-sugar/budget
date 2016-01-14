<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]=base_url()."incentive_setup/index/add";
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
    <div class="col-xs-12"style="overflow-x: auto;">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line("SERIAL"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_YEAR"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_MONTH_FROM"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_MONTH_TO"); ?></th>
                    <th><?php echo $this->lang->line("ACTION"); ?></th>
                </tr>
            </thead>

            <tbody>
            <?php
            $months = $this->config->item('month');
            if(sizeof($setups)>0)
            {
                foreach($setups as $key=>$setup)
                {
                ?>
                <tr>
                    <td><?php echo $key+1;?></td>
                    <td><?php echo $setup['year_name'];?></td>
                    <td><?php echo isset($setup['from_month'])?$months[str_pad($setup['from_month'], 2,0, STR_PAD_LEFT)]:'';?></td>
                    <td><?php echo isset($setup['to_month'])?$months[str_pad($setup['from_month'], 2,0, STR_PAD_LEFT)]:'';?></td>
                    <td>
                        <a href="<?php echo base_url();?>incentive_setup/index/edit/<?php echo $setup['id'];?>">
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