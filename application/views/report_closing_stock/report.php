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
                        $current_stock = System_helper::get_current_stock($stock['crop_id'], $stock['product_type_id'], $stock['varriety_id']);
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $stock['crop_name'];?></td>
                            <td><?php echo $stock['type_name'];?></td>
                            <td><?php echo $stock['varriety_name'];?></td>
                            <td><?php echo System_helper::get_opening_balance($stock['varriety_id'])?System_helper::get_opening_balance($stock['varriety_id']):'Not Available';?></td>
                            <td><?php echo $stock['min_stock_quantity']?$stock['min_stock_quantity']:'Not Set';?></td>
                            <td><?php echo $current_stock;?></td>
                            <td><?php if(isset($stock['min_stock_quantity']) && isset($current_stock)){echo $current_stock-$stock['min_stock_quantity'];}?></td>
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
