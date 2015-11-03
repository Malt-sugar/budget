<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_COMMISSION');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_SALES_BONUS');?></th>
            <th class="text-center"><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE');?></th>
        </tr>

        <?php
        $crop_name = '';
        $product_type_name = '';

        foreach($varieties as $variety)
        {
            $bonus_detail = Pricing_helper::get_bonus_detail_info($year, $variety['varriety_id']);
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
                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_commission]" value="<?php if(isset($bonus_detail['sales_commission'])){echo $bonus_detail['sales_commission'];}?>" /></td>
                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_bonus]" value="<?php if(isset($bonus_detail['sales_bonus'])){echo $bonus_detail['sales_bonus'];}?>" /></td>
                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][other_incentive]" value="<?php if(isset($bonus_detail['other_incentive'])){echo $bonus_detail['other_incentive'];}?>" /></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>