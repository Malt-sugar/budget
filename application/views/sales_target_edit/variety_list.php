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
            if(is_array($details) && sizeof($details)>0)
            {
            ?>
                <th><?php echo $this->lang->line('LABEL_BUDGETED')?></th>
                <th><?php echo $this->lang->line('LABEL_REMARKS')?></th>

                <tr>
                    <td><input type="text" class="form-control variety_quantity" name="quantity[<?php echo $serial;?>][budgeted_quantity]" value="<?php echo $details['budgeted_quantity'];?>" /></td>
                    <td class="text-center" style="vertical-align: middle;">
                        <div class="col-lg-2">
                            <label class="label label-primary load_remark">+R</label>
                        </div>

                        <div class="row popContainer" style="display: none;">
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <div class="col-lg-12">
                                            <textarea class="form-control" name="quantity[<?php echo $serial;?>][bottom_up_remarks]" placeholder="Add Remarks"><?php echo $details['bottom_up_remarks'];?></textarea>
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
            else
            {
            ?>
                <tr><td class="label-danger"><?php echo $this->lang->line('NO_DATA');?></td></tr>
            <?php
            }
            ?>
        </table>
    </div>
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