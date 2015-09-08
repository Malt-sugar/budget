<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
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
                            <td class="text-center"><?php echo $division['text'];?> Qty (kg)</td>
                        </tr>
                        <tr>
                            <td class="text-center"><label class="label label-info"><?php echo $this->lang->line('REQUIRED');?></label></td>
                        </tr>
                    </table>
                </td>
            <?php
            }
            ?>
            <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_TOTAL');?> (kg)</label></th>
            <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_BUDGETED_TOTAL');?></label></th>
            <th class="text-center"><label class="label label-success text-center"><?php echo $this->lang->line('LABEL_REMARKS');?></label></th>
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
                $total_required = 0;
                foreach($divisions as $division)
                {
                    $required = Sales_target_helper::get_total_target_division($division['value'], $variety['varriety_id'], $year);
                    $total_required += $required;
                    ?>
                    <td>
                        <div class="col-lg-12" style="width: 120px;">
                            <label class="label label-warning"><?php if($required){echo $required;}else{echo 0;}?></label>
                        </div>
                    </td>
                <?php
                }

                $detail = Sales_target_helper::get_required_country_variety_detail($year, $variety['varriety_id']);
                ?>
                <td><label class="label label-info"><?php echo $total_required;?></label> </td>
                <td><input type="text" name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][required_quantity]" class="form-control total" value="<?php echo $detail['required_quantity'];?>" /></td>
                <td><textarea name="variety[<?php echo $variety['crop_id']?>][<?php echo $variety['product_type_id']?>][<?php echo $variety['varriety_id'];?>][bottom_up_remarks]" class="form-control"><?php echo $detail['bottom_up_remarks'];?></textarea></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
