<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($targets);
//echo "</pre>";

?>
<div class="row show-grid">
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
                <th><?php echo $this->lang->line("LABEL_TARGET_FROM_CUSTOMER"); ?></th>
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
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $target['year_name'];?></td>
                            <td><?php echo $target['crop_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['variety_name'];?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo $target['distributor_name'];?></td>
                            <td><?php if($target['is_approved_by_zi']==0){echo '<label class="label label-warning">'.$this->lang->line('LABEL_NO').'</label>';}else{echo '<label class="label label-success">'.$this->lang->line('LABEL_YES').'</label>';}?></td>
                            <td><?php if($target['is_approved_by_di']==0){echo '<label class="label label-warning">'.$this->lang->line('LABEL_NO').'</label>';}else{echo '<label class="label label-success">'.$this->lang->line('LABEL_YES').'</label>';}?></td>
                            <td><?php echo $target['quantity'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>
                            <td><?php echo $target['type_name'];?></td>

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
