<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($stocks);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" >
            <thead class="hidden-print">
            <tr>
                <th><?php echo $this->lang->line("SERIAL"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CROP_NAME"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIETY"); ?></th>
                <th><?php echo $this->lang->line("LABEL_OPENING_BALANCE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_BUDGETED_MIN_STOCK"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CURRENT_STOCK"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIANCE_QTY"); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($stocks)>0)
                {
                    foreach($stocks as $key=>$stock)
                    {
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $stock['crop_name'];?></td>
                            <td><?php echo $stock['type_name'];?></td>
                            <td><?php echo $stock['variety_name'];?></td>
                            <td><?php echo $stock['opening_balance'];?></td>
                            <td><?php echo $stock['min_stock_quantity'];?></td>
                            <td><?php echo print_r(System_helper::get_current_stock($stock['crop_id'], $stock['type_id'], $stock['variety_id']));?></td>
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
