<table class="table table-bordered">
    <?php
    if($data_type==1)
    {
        ?>
        <tr>
            <td class="text-center"><label class="label label-default"><?php echo $this->lang->line('LABEL_LOCATION');?></label></td>
            <td class="text-center"><label class="label label-default"><?php echo $this->lang->line('LABEL_TARGET_FROM_CUSTOMER');?></label></td>
        </tr>
        <?php
    }
    elseif($data_type==2)
    {
        ?>
        <tr>
            <td class="text-center"><label class="label label-default"><?php echo $this->lang->line('LABEL_LOCATION');?></label></td>
            <td class="text-center"><label class="label label-default"><?php echo $this->lang->line('LABEL_FINAL_TARGETED_SALES');?></label></td>
        </tr>
        <?php
    }
    if(isset($detail) && sizeof($detail)>0)
    {
        foreach ($detail as $info)
        {
            ?>
            <tr>
                <td><?php echo $info['location_name']; ?></td>
                <td class="text-center"><?php echo $info['budgeted']; ?></td>
            </tr>
            <?php
        }
    }
    else
    {
        ?>
        <tr>
            <td class="text-center" colspan="2"><?php echo $this->lang->line('NO_DATA_FOUND'); ?></td>
        </tr>
    <?php
    }
    ?>
    <tr>
        <td class="text-center" colspan="2" style="border: 0px;">
            <label class="label label-primary crossSpan"><?php echo $this->lang->line('OK');?></label>
        </td>
    </tr>
</table>




