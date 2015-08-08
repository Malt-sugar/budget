<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

<table class="table table-bordered">
    <tr>
        <th><?php echo $this->lang->line('LABEL_CROP');?></th>
        <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
        <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
        <?php
        foreach($divisions as $division)
        {
        ?>
            <td class="text-center">

                <table class="table table-bordered">
                    <tr>
                        <td class="text-center"><label class="label label-success text-center"><?php echo $division['text'];?> Qty (kg)</label></td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <td>Assigned</td>
                        <td>Required</td>
                    </tr>
                </table>
            </td>
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
            foreach($divisions as $division)
            {
                ?>
                <td>
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <input type="text" name="quantity[<?php echo $variety['varriety_id'];?>]" class="form-control" readonly value="<?php echo $division['value'];?>" />
                        </div>

                        <div class="col-lg-6">
                            <input type="text" name="quantity[<?php echo $variety['varriety_id'];?>]" class="form-control quantity" value="" />
                        </div>
                    </div>
                </td>
            <?php
            }
            ?>
            <td><input type="text" name="total[<?php echo $variety['varriety_id'];?>]" class="form-control total" value="" /></td>
        </tr>
    <?php
    }
    ?>
</table>
