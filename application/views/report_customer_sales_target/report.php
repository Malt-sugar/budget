<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($purchases);
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
                <th><?php echo $this->lang->line("LABEL_FINAL_TARGET_SALES_QTY_HOM"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIANCE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_BUDGETED_PURCHASE_QUANTITY"); ?></th>
                <th><?php echo $this->lang->line("LABEL_MONTH_OF_PURCHASE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PI_VALUE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_USD_CONVERSION_RATE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_LC_EXP"); ?></th>
                <th><?php echo $this->lang->line("LABEL_INSURANCE_EXP"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PACKING_MATERIAL"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CARRIAGE_INWARDS"); ?></th>
                <th><?php echo $this->lang->line("LABEL_AIR_FREIGHT_AND_DOCS"); ?></th>
                <th><?php echo $this->lang->line("LABEL_COGS"); ?></th>
                <th><?php echo $this->lang->line("LABEL_TOTAL_COGS"); ?></th>
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
                            <td><?php echo $purchase['crop_name'];?></td>
                            <td><?php echo $purchase['type_name'];?></td>
                            <td><?php echo $purchase['variety_name'];?></td>
                            <td><?php echo $purchase['hom_target_quantity'];?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo $purchase['purchase_quantity'];?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo $purchase['purchase_quantity']*$purchase['price_per_kg'];?></td>
                            <td><?php echo $purchase['usd_conversion_rate'];?></td>
                            <td><?php echo $purchase['lc_exp'];?></td>
                            <td><?php echo $purchase['insurance_exp'];?></td>
                            <td><?php echo $purchase['packing_material'];?></td>
                            <td><?php echo $purchase['carriage_inwards'];?></td>
                            <td><?php echo $purchase['air_freight_and_docs'];?></td>
                            <td><?php echo System_helper::get_cogs_and_total_cogs($purchase['purchase_quantity'], $purchase['price_per_kg'], $purchase['usd_conversion_rate'], $purchase['lc_exp'], $purchase['insurance_exp'], $purchase['packing_material'], $purchase['carriage_inwards'], $purchase['air_freight_and_docs'], 1)?></td>
                            <td><?php echo System_helper::get_cogs_and_total_cogs($purchase['purchase_quantity'], $purchase['price_per_kg'], $purchase['usd_conversion_rate'], $purchase['lc_exp'], $purchase['insurance_exp'], $purchase['packing_material'], $purchase['carriage_inwards'], $purchase['air_freight_and_docs'], 2)?></td>
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
