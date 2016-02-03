<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($allocations);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="row show-grid hidden-print">
        <a class="btn btn-primary btn-rect pull-right external" style="margin-right: 10px;" onclick="print_rpt()"><?php echo $this->lang->line("BUTTON_PRINT"); ?></a>
    </div>
</div>

<div class="row show-grid" id="PrintArea">
    <div>&nbsp;</div>
    <div class="row">
        <div class="col-lg-12"><?php $this->load->view('print_header');?></div>
    </div>

    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" style="overflow-x: auto">
            <thead class="hidden-print">
                <tr>
                    <th><?php echo $this->lang->line("LABEL_CROP"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_TYPE"); ?></th>
                    <th><?php echo $this->lang->line("LABEL_VARIETY"); ?></th>
                    <th class="text-center"><?php echo $this->lang->line("LABEL_BUDGETED"); ?></th>
                    <th class="text-center"><?php echo $this->lang->line("LABEL_TARGETED"); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($allocations)>0)
                {
                    $sum_total_budgeted = 0;
                    $sum_total_targeted = 0;
                    foreach($allocations as $key=>$allocation)
                    {
                        ?>
                        <tr>
                            <td><?php echo $allocation['crop_name'];?></td>
                            <td><?php echo $allocation['type_name'];?></td>
                            <td><?php echo $allocation['variety_name'];?></td>
                            <td class="text-center"><?php echo $allocation['total_budgeted'];?></td>
                            <td class="text-center"><?php echo $allocation['total_targeted'];?></td>
                        </tr>
                        <?php
                        $sum_total_budgeted+=$allocation['total_budgeted'];
                        $sum_total_targeted+=$allocation['total_targeted'];
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="vertical-align: middle;"><label class="label label-danger pull-right"><?php echo $this->lang->line('LABEL_TOTAL')?></label></td>
                        <td class="text-center"><?php echo $sum_total_budgeted;?></td>
                        <td class="text-center"><?php echo $sum_total_targeted;?></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="150" class="text-center alert-danger">
                            <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="col-lg-12">
            <?php $this->load->view('print_footer');?>
        </div>
    </div>
</div>
