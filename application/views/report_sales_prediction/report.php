<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($predictions);
//echo "</pre>";

?>
<div class="row show-grid">
    <div>&nbsp;</div>
    <div class="col-xs-12" style="overflow-x: auto">
        <table class="table table-hover table-bordered" >
            <thead class="hidden-print">
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_INDIRECT_EXPENSE');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_PREDICTION_BY_BMS');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_INITIAL_TARGET_BY_MGT');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_PROPOSED_BY_HOM');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_FINAL_DECISION_BY_MGT');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_ACTUAL');?></th>
                <th class="text-center"><?php echo $this->lang->line('LABEL_VARIANCE');?></th>
            </tr>
            <tr>
                <td><?php echo $this->lang->line('LABEL_CROP');?></td>
                <td><?php echo $this->lang->line('LABEL_TYPE');?></td>
                <td><?php echo $this->lang->line('LABEL_VARIETY');?></td>
                <td><?php echo $this->lang->line('LABEL_SELLING_MONTH');?></td>
                <td><?php echo $this->lang->line('LABEL_QTY_KG');?></td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: lavender;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_HO_GEN_EXP_PER');?></td>
                            <td><?php echo $this->lang->line('LABEL_MARKETING_PER');?></td>
                            <td><?php echo $this->lang->line('LABEL_FINANCE_COST_PER');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: darkgray;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_TARGETED_PROFIT_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_MRP');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: lightblue;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_MRP');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_MRP');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: burlywood;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_MRP');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_COMMISSION_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_SALES_BONUS_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_OTHER_INCENTIVE_PERCENT');?></td>
                            <td><?php echo $this->lang->line('LABEL_NP_PER_KG');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: lightseagreen;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                        <tr>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_SALES');?></td>
                            <td><?php echo $this->lang->line('LABEL_TOTAL_NP');?></td>
                        </tr>
                    </table>
                </td>

            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($predictions)>0)
                {
                    foreach($predictions as $key=>$prediction)
                    {
                        ?>
                        <tr>
                            <td><?php echo $prediction['crop_name'];?></td>
                            <td><?php echo $prediction['type_name'];?></td>
                            <td><?php echo $prediction['variety_name'];?></td>
                            <td><?php echo '';?></td>
                            <td><?php echo '';?></td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: lavender;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: darkgray;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: lightblue;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: burlywood;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: lightseagreen;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-hover table-bordered" style="background-color: lightsteelblue;">
                                    <tr>
                                        <td><?php echo '';?></td>
                                        <td><?php echo '';?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="20" class="text-center alert-danger">
                            <?php echo $this->lang->line("NO_DATA_FOUND"); ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
