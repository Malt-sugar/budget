<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<table class="table table-bordered">
    <tr>
        <th><?php echo $this->lang->line('LABEL_CROP');?></th>
        <th><?php echo $this->lang->line('LABEL_PRODUCT_TYPE');?></th>
        <th><?php echo $this->lang->line('LABEL_VARIETY');?></th>
        <td class="text-center">
            <table class="table table-bordered" style="margin: 0px;">
                <tr>
                    <td class="text-center"><label class="label label-success">Divisions</label></td>
                </tr>
            </table>

            <table class="table table-bordered" style="margin: 0px;">
                <tr>
                    <?php
                    foreach($divisions as $key=>$division)
                    {
                        ?>
                        <td class="customer" style="width: 120px;">
                            <table class="table table-bordered">
                                <tr style="height: 35px;">
                                    <td class="text-center"><?php echo $division['text'];?></td>
                                </tr>
                            </table>
                            <table class="table table-bordered" style="margin: 0px;">
                                <tr>
                                    <td><?php echo $this->lang->line('LABEL_BUDGETED_TOTAL');?></td>
                                    <td><?php echo $this->lang->line('LABEL_TARGETED_TOTAL');?></td>
                                </tr>
                            </table>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
            </table>
        </td>
        <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_HO');?></label></th>
        <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_PRINCIPAL');?></label></th>
        <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_TARGETED');?></label></th>
        <th class="text-center"><label class="label label-warning text-center"><?php echo $this->lang->line('LABEL_REMAINING');?></label></th>
        <th class="text-center"><label class="label label-warning text-center">R</label></th>
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
            <td class="div_target">
                <table class="table table-bordered" style="margin-bottom: 0px;">
                    <tr>
                    <?php
                    $total_required = 0;
                    foreach($divisions as $division)
                    {
                        $required = Sales_target_helper::get_total_target_division($division['value'], $variety['varriety_id'], $year);
                        $total_required+=$required['targeted_quantity'];
                    ?>
                        <td>
                            <div style="margin-top: 0px; z-index: 1000;" class="pull-right"><label class="label label-primary load_remark">+R</label></div>
                            <table class="table table-bordered" style="margin: 0px;">
                                <tr>
                                    <td><input type="text" name="" class="form-control" disabled value="<?php if(isset($required['total_quantity'])){echo $required['total_quantity'];}else{echo 0;}?>" /></td>
                                    <td><input type="text" name="variety[<?php echo $division['value'];?>][<?php echo $variety['varriety_id'];?>][targeted_quantity]" class="form-control quantity targeted" value="<?php if(isset($required['targeted_quantity'])){echo $required['targeted_quantity'];}else{echo 0;}?>" /></td>
                                </tr>
                            </table>

                            <div class="row popContainer" style="display: none;">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <div class="col-lg-12">
                                                <textarea class="form-control" name="variety[<?php echo $division['value'];?>][<?php echo $variety['varriety_id'];?>][top_down_remarks]" placeholder="Add Remarks"></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pull-right" style="border: 0px;">
                                            <div class="col-lg-12">
                                                <label class="label label-primary crossSpan"><?php echo $this->lang->line('OK');?></label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    <?php
                    }
                    ?>
                    </tr>
                </table>
            </td>

            <?php
            $detail = Sales_target_helper::get_required_country_variety_detail_principal($year, $variety['varriety_id']);
            ?>
            <td class="text-center"><label class="label label-success"><?php echo $detail['budgeted_quantity'];?></label></td>
            <td class="text-center"><label class="label label-success"><?php echo $detail['principal_quantity'];?></label></td>
            <td class="text-center"><input type="text" name="detail[<?php echo $variety['varriety_id'];?>][targeted_quantity]" class="form-control quantity targeted_total" value="<?php echo $detail['targeted_quantity'];?>" /></td>
            <td class="text-center"><input type="text" name="" class="form-control quantity remaining" value="<?php if(isset($detail['targeted_quantity']) && $detail['targeted_quantity']>0){echo $detail['targeted_quantity']-$total_required;}?>" /></td>
            <td class="text-center">
                <label class="label label-primary load_remark">+R</label>
                <div class="row popContainer" style="display: none;">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <div class="col-lg-12">
                                    <textarea class="form-control" name="detail[<?php echo $variety['varriety_id'];?>][top_down_remarks]" placeholder="Add Remarks"><?php echo $detail['top_down_remarks'];?></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="pull-right" style="border: 0px;">
                                <div class="col-lg-12">
                                    <label class="label label-primary crossSpan"><?php echo $this->lang->line('OK');?></label>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
