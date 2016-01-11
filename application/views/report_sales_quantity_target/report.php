<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($targets);
//echo "</pre>";
//exit;

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
                <th><?php echo $this->lang->line("LABEL_SELLING_MONTH"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_FROM_CUSTOMER"); ?></th>
                <th><?php echo $this->lang->line("LABEL_FINAL_TARGETED_SALES"); ?></th>
                <th><?php echo $this->lang->line("LABEL_ACTUAL_SALES_QTY"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIANCE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_UNIT_PRICE_PER_KG"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TOTAL_SALES_TK"); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($targets)>0)
                {
                    foreach($targets as $key=>$target)
                    {
                        $actual_sales = Report_helper::get_actual_sales_qty($target['year'], $target['zone_id'], $target['territory_id'], $target['customer_id'], $target['variety_id']);
                        $months = $this->config->item('month');
                        ?>
                        <tr>
                            <td><?php echo $target['crop_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['variety_name'];?></td>
                            <td><?php echo isset($target['selling_month'])?$months[str_pad($target['selling_month'], 2,0, STR_PAD_LEFT)]:'';?></td>
                            <td><?php echo $target['target_from_customer'];?></td>
                            <td><?php echo $target['final_target'];?></td>
                            <td><?php echo $actual_sales?$actual_sales:0;?></td>
                            <td><?php echo $target['final_target']-$actual_sales;?></td>
                            <td><?php echo $target['unit_price_per_kg'];?></td>
                            <td><?php echo $actual_sales*$target['unit_price_per_kg'];?></td>
                        </tr>
                        <?php
                    }
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
