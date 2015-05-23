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
                <th><?php echo $this->lang->line('LABEL_MINIMUM_STOCK_QUANTITY')?></th>
                <?php
                foreach($varieties as $variety)
                {
                ?>
                <tr>
                    <td><?php echo $variety['varriety_name']?></td>
                    <td><input type="text" class="form-control variety_quantity" name="quantity[<?php echo $serial;?>][<?php echo $variety['varriety_id']?>]" value="" /></td>
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