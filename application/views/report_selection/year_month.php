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
                <?php echo $this->lang->line('LABEL_MONTH_FROM');?>
            </th>
            <th style="width:17%">
                <?php echo $this->lang->line('LABEL_MONTH_TO');?>
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
                <select name="from_month" id="from_month" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    $monthConfig = $this->config->item('month');
                    foreach($monthConfig as $val=>$month)
                    {
                        ?>
                        <option value="<?php echo $val;?>"><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
            <td>
                <select name="to_month" id="to_month" class="form-control validate[required]">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <?php
                    $monthConfig = $this->config->item('month');
                    foreach($monthConfig as $val=>$month)
                    {
                        ?>
                        <option value="<?php echo $val;?>"><?php echo $month;?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
    </thead>
</table>

