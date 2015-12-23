<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="col-lg-12">
    <table class="table table-bordered" style="margin-right: 10px !important;">
        <tr>
            <th><?php echo $this->lang->line('LABEL_CROP');?></th>
            <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
            <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
            <?php
            foreach($prediction_years as $prediction)
            {
            ?>
                <th class="text-center" style="vertical-align: middle;"><label class="label label-success"><?php echo $prediction['year_name'];?></label></th>
            <?php
            }
            ?>
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
                foreach($prediction_years as $prediction)
                {
                    $zone_prediction = $this->zi_sales_target_prediction_model->get_zone_sales_prediction($prediction['year_id'], $variety['varriety_id']);
                    $existing_prediction = $this->zi_sales_target_prediction_model->get_existing_prediction($prediction['year_id'], $year, $variety['varriety_id']);
                    ?>
                    <td>
                        <table class="table table-bordered" style="margin-bottom: 0px;">
                            <tr>
                                <td><input type="text" name="" class="form-control" readonly value="<?php echo $zone_prediction;?>" /></td>
                                <td><input type="text" name="prediction[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][<?php echo $prediction['year_id'];?>]" class="form-control" value="<?php echo $existing_prediction;?>" /></td>
                            </tr>
                        </table>
                    </td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<script>
    jQuery(document).ready(function()
    {
        $(document).on("click", ".load_remark", function(event)
        {
            $(this).closest('td').find('.popContainer').show();
        });

        $(document).on("click",".crossSpan",function()
        {
            $(".popContainer").hide();
        });

        $('[data-toggle="tooltip"]').tooltip();
    });
</script>