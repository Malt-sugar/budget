<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<table class="table table-bordered">
    <tr>
        <th><?php echo $this->lang->line('LABEL_CROP');?></th>
        <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
        <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
        <?php
        foreach($zones as $zone)
        {
        ?>
            <td class="text-center"><label class="label label-success text-center"><?php echo $zone['text'];?> Qty (kg)</label></td>
        <?php
        }
        ?>
        <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_TOTAL');?> (kg)</label></th>
    </tr>

    <?php
    $crop_name = '';
    $product_type_name = '';

    foreach($varieties as $variety)
    {
    ?>
        <tr>
            <td>
                <?php
                if($crop_name == '')
                {
                    echo $variety['crop_name'];
                    $crop_name = $variety['crop_name'];
                }
                elseif($crop_name == $variety['crop_name'])
                {
                    echo "&nbsp;";
                }
                else
                {
                    echo $variety['crop_name'];
                    $crop_name = $variety['crop_name'];
                }
                ?>
            </td>
            <td>
                <?php
                if($product_type_name == '')
                {
                    echo $variety['product_type'];
                    $product_type_name = $variety['product_type'];
                }
                elseif($product_type_name == $variety['product_type'])
                {
                    echo "&nbsp;";
                }
                else
                {
                    echo $variety['product_type'];
                    $product_type_name = $variety['product_type'];
                }
                ?>
            </td>
            <td><?php echo $variety['varriety_name'];?></td>
            <?php
            foreach($zones as $zone)
            {
                ?>
                <td><input type="text" name="quantity[<?php echo $variety['varriety_id'];?>]" class="form-control quantity" value="" /></td>
            <?php
            }
            ?>
            <td><input type="text" name="total[<?php echo $variety['varriety_id'];?>]" class="form-control total" value="" /></td>
        </tr>
    <?php
    }
    ?>
</table>
