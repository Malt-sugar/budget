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
                foreach($varieties as $variety)
                {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></td>
                        <td class="text-center"><?php echo $variety['varriety_name']?></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_TARGETED_PROFIT_PERCENT');?></td>
                        <td><input type="text" class="form-control" name="targeted_profit[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" value="" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                        <td><input type="text" class="form-control" name="sales_commission[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" value="" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                        <td><input type="text" class="form-control" name="sales_bonus[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" value="" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                        <td><input type="text" class="form-control" name="other_incentive[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" value="" /></td>
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