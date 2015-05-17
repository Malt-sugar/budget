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
                        <th class="text-center"><?php echo $this->lang->line('LABEL_VARIETY')?></th>
                        <th class="text-center"><?php echo $variety['varriety_name']?></th>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_PURCHASE_QUANTITY');?></td>
                        <td><input type="text" class="form-control number_only_class" name="purchase_quantity[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_PRICE_PER_KG_USD');?></td>
                        <td><input type="text" class="form-control number_only_class" name="price_per_kg[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_TOTAL_PRICE_USD');?></td>
                        <td><input type="text" class="form-control number_only_class" name="total_price[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_COGS');?></td>
                        <td><input type="text" class="form-control number_only_class" name="cogs[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" /></td>
                    </tr>
                    <tr>
                        <td><?php echo $this->lang->line('LABEL_TOTAL_COGS');?></td>
                        <td><input type="text" class="form-control number_only_class" name="total_cogs[<?php echo $serial;?>][<?php echo $variety['varriety_id'];?>]" /></td>
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