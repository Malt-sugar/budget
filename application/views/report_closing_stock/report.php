<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

//echo "<pre>";
//print_r($stocks);
//echo "</pre>";

?>
<div class="row">
    <div class="col-lg-12"><?php $this->load->view('print_header');?></div>
</div>
<section class="">
    <div class="show-grid container" style="width: 100%">
        <table class="table table-hover table-bordered" >
            <thead class="hidden-print">
            <tr class="header">
                <th><?php echo $this->lang->line("SERIAL"); ?><div><?php echo $this->lang->line("SERIAL"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_CROP_NAME"); ?><div><?php echo $this->lang->line("LABEL_CROP_NAME"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?><div><?php echo $this->lang->line("LABEL_PRODUCT_TYPE"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_VARIETY"); ?><div><?php echo $this->lang->line("LABEL_VARIETY"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_BUDGETED_MIN_STOCK"); ?><div><?php echo $this->lang->line("LABEL_BUDGETED_MIN_STOCK"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_CURRENT_STOCK"); ?><div><?php echo $this->lang->line("LABEL_CURRENT_STOCK"); ?></div></th>
                <th><?php echo $this->lang->line("LABEL_VARIANCE_QTY"); ?><div><?php echo $this->lang->line("LABEL_VARIANCE_QTY"); ?></div></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if(sizeof($stocks)>0)
                {
                    $crop_name = '';
                    $type_name = '';
                    foreach($stocks as $key=>$stock)
                    {
                        $current_stock = Purchase_helper::get_current_stock($stock['crop_id'], $stock['product_type_id'], $stock['varriety_id']);
                        ?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td>
                                <?php
                                if($crop_name == '')
                                {
                                    echo $stock['crop_name'];
                                    $crop_name = $stock['crop_name'];
                                }
                                elseif($crop_name == $stock['crop_name'])
                                {
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $stock['crop_name'];
                                    $crop_name = $stock['crop_name'];
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if($type_name == '')
                                {
                                    echo $stock['type_name'];
                                    $type_name = $stock['type_name'];
                                }
                                elseif($type_name == $stock['type_name'])
                                {
                                    echo "&nbsp;";
                                }
                                else
                                {
                                    echo $stock['type_name'];
                                    $type_name = $stock['type_name'];
                                }
                                ?>
                            </td>
                            <td><?php echo $stock['varriety_name'];?></td>
                            <td><?php echo $stock['min_stock_quantity']?$stock['min_stock_quantity']:'Not Set';?></td>
                            <td><?php echo $current_stock;?></td>
                            <td><?php if(isset($stock['min_stock_quantity']) && isset($current_stock)){echo $current_stock-$stock['min_stock_quantity'];}?></td>
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
        <div class="col-lg-12">
            <?php $this->load->view('print_footer');?>
        </div>
    </div>
</section>

<style>
    html, body {
        margin:0;
        padding:0;
        height:100%;
    }
    section {
        position: relative;
        padding-top: 37px;
    }
    section.positioned {
        position: absolute;
        top:100px;
        left:100px;
        box-shadow: 0 0 15px #fff;
    }
    .container {
        overflow-y: auto;
        height: 700px;
    }
    table {
        margin-top: -41px;
        border-spacing: 0;
        width:100%;
    }
    td, th {
        border-bottom:1px solid #eee;
        background: #fff;
        color: #000;
        padding: 0px 25px;
    }
    th {
        height: 0;
        line-height: 0;
        padding-top: 0;
        padding-bottom: 0;
        color: transparent;
        border: none;
        white-space: nowrap;
    }
    th div {
        position: absolute;
        background: transparent;
        color: #000;
        padding: 9px 25px;
        top: 0;
        margin-left: -25px;
        line-height: normal;
    }
    th:first-child div{
        border: none;
    }
</style>