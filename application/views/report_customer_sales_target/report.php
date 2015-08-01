<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($targets);
//echo "</pre>";

//echo "<pre>";
//print_r($customers);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" style="overflow-x: auto">
            <thead class="hidden-print">
            <tr>
                <th><?php echo $this->lang->line("SERIAL"); ?></th>
                <th><?php echo $this->lang->line("LABEL_CROP_NAME"); ?></th>
                <th><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?></th>
                <th><?php echo $this->lang->line("LABEL_VARIETY"); ?></th>
                <?php
                foreach($customers as $customer)
                {
                    ?>
                    <th><?php echo $customer['distributor_name']; ?></th>
                <?php
                }
                ?>
                <th><?php echo $this->lang->line("LABEL_TOTAL"); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($targets)>0)
                {
                    foreach($targets as $key=>$target)
                    {
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $target['crop_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['variety_name'];?></td>
                            <?php
                            $total = 0;
                            foreach($customers as $customer)
                            {
                                $quantity = System_helper::get_total_sales_target_of_customer($target['variety_id'], $customer['distributor_id']);
                                $total += $quantity;
                                ?>
                                <td><?php if($quantity){echo $quantity;}else{echo 0;} ?></td>
                            <?php
                            }
                            ?>
                            <td><?php echo $total; ?></td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="120" class="text-center alert-danger">
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
