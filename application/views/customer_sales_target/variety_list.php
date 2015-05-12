<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo '<pre>';
print_r($varieties);
echo '</pre>';
?>

<div class="clearfix"></div>
<div class="row show-grid">
    <div class="widget-header">
        <div class="title">
            <?php echo $title; ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-12">
        <table class="table table-hover table-bordered">
            <th><?php echo $this->lang->line('LABEL_VARIETY')?></th>
            <th><?php echo $this->lang->line('LABEL_QUANTITY_KG')?></th>
            <?php
            foreach($varieties as $variety)
            {
            ?>
            <tr>
                <td><?php echo $variety['varriety_name']?></td>
                <td><input type="text" class="form-control variety_quantity" name="quantity[<?php echo $variety['varriety_id']?>]" value="" /></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>