<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-xs-12" id="scrollTable">
    <table class="table table-bordered">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <?php
            foreach($zones as $zone)
            {
            ?>
            <td class="text-center">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center"><label class="label label-success text-center"><?php echo $zone['text'];?> Qty (kg)</label></td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <td><?php echo $this->lang->line('REQUIRED');?></td>
                        <td><?php echo $this->lang->line('ASSIGNED');?></td>
                    </tr>
                </table>
            </td>
            <?php
            }
            ?>
            <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_TOTAL');?> (kg)</label></th>
            <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_TARGETED_TOTAL');?> (kg)</label></th>
        </tr>

        <?php
        $crop_name = '';
        $product_type_name = '';

        foreach($varieties as $variety)
        {
        ?>
            <tr class="sumtr">
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
                    $required = Sales_target_helper::get_total_target_zone($zone['value'], $variety['varriety_id'], $year);
                    ?>
                    <td style="min-width: 220px;">
                        <div class="col-lg-12">
                            <div class="col-lg-5">
                                <input type="text" name="quantity[<?php echo $variety['varriety_id'];?>]" class="form-control" readonly value="<?php if($required){echo $required;}else{echo 0;}?>" />
                            </div>

                            <div class="col-lg-5">
                                <input type="text" name="quantity[<?php echo $variety['varriety_id'];?>]" class="form-control quantity" value="" />
                            </div>

                            <div class="col-lg-2">
                                <label class="label label-primary load_remark">R</label>
                            </div>
                        </div>

                        <div class="row popContainer" style="display: none;">
                            <span class="crossSpan">
                                <img src="<?php echo base_url()?>images/xmark.png" style="cursor: pointer;" width="16px" height="16px"/>
                            </span>

                            <div class="col-lg-12">
                                <textarea class="form-control" name="" placeholder="Add Remarks"></textarea>
                            </div>
                        </div>
                    </td>
                <?php
                }
                ?>
                <td style="min-width: 90px;"><input type="text" name="quantity[<?php echo $variety['varriety_id'];?>][total]" class="form-control total" value="" /></td>
                <td style="min-width: 90px;"><input type="text" name="quantity[<?php echo $variety['varriety_id'];?>][target]" class="form-control total" value="" /></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
