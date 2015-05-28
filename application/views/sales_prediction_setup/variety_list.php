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
                <th><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT')?></th>
                <th><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT')?></th>
                <?php
                foreach($varieties as $variety)
                {
                ?>
                <tr>
                    <td><?php echo $variety['varriety_name']?></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][targeted_profit]" value="" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][sales_commission]" value="" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][sales_bonus]" value="" /></td>
                    <td><input type="text" class="form-control quantity_number" name="detail[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>][other_incentive]" value="" /></td>
                </tr>
                <?php
                }
            }
            else
            {
            ?>
                <tr><td class="label-danger"><?php echo $this->lang->line('NO_VARIETY_EXIST');?></td></tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>