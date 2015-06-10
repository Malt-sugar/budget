<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($targets);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" >
            <thead class="hidden-print">
            <tr>
                <th><?php echo $this->lang->line("SERIAL"); ?></th>
                <th><?php echo $this->lang->line("LABEL_YEAR"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CROP_NAME"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIETY"); ?></th>
                <th><?php echo $this->lang->line("LABEL_SELLING_MONTH"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CUSTOMER"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_SET_BY_TI"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_CONFIRMED_BY_ZI"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TARGET_APPROVED_BY_DI"); ?></th>
                <th><?php echo $this->lang->line("LABEL_FINAL_TARGET_SALES_QTY_HOM"); ?></th>
                <th><?php echo $this->lang->line("LABEL_ACTUAL_SALES_QTY"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIANCE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_UNIT_PRICE_PER_KG"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TOTAL_SALES_TK"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TOTAL_COLLECTION_TK"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TOTAL_COLLECTION_PERCENTAGE"); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($targets)>0)
                {
                    foreach($targets as $key=>$target)
                    {
                        $actual_sales = System_helper::get_actual_sales_quantity($target['year'], $target['variety_id'], $target['customer_id']);
                        $record_data = System_helper::get_sales_target_record_data($target['year'], $target['variety_id'], $target['customer_id']);
                        $final_prediction = System_helper::get_prediction_detail($target['variety_id'], $this->config->item('prediction_phase_final'), $target['year']);
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $target['year_name'];?></td>
                            <td><?php echo $target['crop_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['variety_name'];?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo $target['distributor_name'];?></td>
                            <td><?php if(isset($record_data['quantity_ti'])){echo $record_data['quantity_ti'];}?></td>
                            <td><?php if(isset($record_data['quantity_zi'])){echo $record_data['quantity_zi'];}?></td>
                            <td><?php if(isset($record_data['quantity_di'])){echo $record_data['quantity_di'];}?></td>
                            <td><?php echo $target['quantity'];?></td>
                            <td><?php echo $actual_sales?$actual_sales:0;?></td>
                            <td><?php if($actual_sales>0 && $target['quantity']){echo $target['quantity']-$actual_sales;}?></td>
                            <td><?php if(is_array($final_prediction) && isset($final_prediction['budgeted_mrp'])){echo $final_prediction['budgeted_mrp'];}?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo '';?></td>
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
</div>
