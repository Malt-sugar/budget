<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 20-Jan-16
 * Time: 3:13 PM
 */
?>
<table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
    <thead>
        <tr>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_YEAR');?>
            </th>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_TYPE');?>
            </th>
            <th style="width:17%; display: none;" class="comparison">
                <?php echo $this->lang->line('LABEL_COMPARISON_TYPE');?>
            </th>
        </tr>
        <tr>
            <td>
                <select name="year" id="year" class="form-control validate[required]">
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>''));
                    ?>
                </select>
            </td>
            <td>
                <select name="report_type" id="report_type" class="form-control validate[required]">
                    <?php
                    $typeConfig = $this->config->item('pricing_report_type');
                    foreach($typeConfig as $val=>$type)
                    {
                        ?>
                        <option value="<?php echo $val;?>"><?php echo $type;?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td class="comparison" style="display: none;">
                <select name="comparison_type" id="comparison_type" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    $compConfig = $this->config->item('pricing_report_comparison');
                    foreach($compConfig as $val=>$cType)
                    {
                        ?>
                        <option value="<?php echo $val;?>"><?php echo $cType;?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </thead>
</table>

