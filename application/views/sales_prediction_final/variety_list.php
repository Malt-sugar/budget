<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//echo '<pre>';
//print_r($varieties);
//echo '</pre>';
?>

<div class="clearfix"></div>

<div class="row show-grid">
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <?php
            if(is_array($varieties) && sizeof($varieties)>0)
            {
            ?>
                <th><?php echo $this->lang->line('LABEL_VARIETY')?></th>
                <th><?php echo $this->lang->line('LABEL_TARGETED_PROFIT_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_BUDGETED_MRP')?></th>
                <th><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_NET_PROFIT_KG')?></th>
                <?php
                foreach($varieties as $variety)
                {
                ?>
                <tr>
                    <td><?php echo $variety['varriety_name']?></td>
                    <td><input type="text" class="form-control quantity_number" name="" disabled value="<?php echo $variety['targeted_profit'];?>" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][budgeted_mrp]" value="" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][sales_commission]" value="<?php echo $variety['sales_commission'];?>" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][sales_bonus]" value="<?php echo $variety['sales_bonus'];?>" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][other_incentive]" value="<?php echo $variety['other_incentive'];?>" /></td>
                    <td><input type="text" class="form-control quantity_number" name="" value="" /></td>
                </tr>
                <?php
                }
            }
            else
            {
            ?>
                <tr><td class="label-danger"><?php echo $this->lang->line('NOT_PREDICTED_YET');?></td></tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>