<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $data["link_new"]="#";
    $data["hide_new"]="1";
    $data["link_back"]=base_url().'bonus_setup/index/list';
    $data["hide_approve"]="1";
    $this->load->view("action_buttons_edit",$data);
//print_r($cost);
?>
<form class="form_valid" id="save_form" action="<?php echo base_url();?>bonus_setup/index/save" method="post">
    <input type="hidden" name="year_id" id="year_id" value="<?php if(isset($year_id)){echo $year_id;}else{echo 0;}?>"/>
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_YEAR');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <select name="year" id="year" class="form-control validate[required]" <?php if(strlen($year_id)>1){echo 'disabled';}?>>
                    <?php
                    $this->load->view('dropdown',array('drop_down_options'=>$years,'drop_down_selected'=>strlen($year_id)>1?$year_id:''));
                    ?>
                </select>
                <?php if(strlen($year_id)>1){?>
                    <input type="hidden" name="year" value="<?php echo $year_id;?>" />
                <?php }?>
            </div>
        </div>
    </div>

    <div class="row load_variety" id="load_variety">
        <?php
            if(strlen($year_id)>1)
            {
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
                            $bonus_detail = Pricing_helper::get_bonus_detail_info($year_id, $variety['varriety_id']);
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
                                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_commission]" value="<?php echo $bonus_detail['sales_commission'];?>" /></td>
                                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][sales_bonus]" value="<?php echo $bonus_detail['sales_bonus'];?>" /></td>
                                <td class="text-center"><input type="text" class="form-control" name="bonus[<?php echo $variety['crop_id'];?>][<?php echo $variety['product_type_id'];?>][<?php echo $variety['varriety_id'];?>][other_incentive]" value="<?php echo $bonus_detail['other_incentive'];?>" /></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
        <?php
            }
        ?>
    </div>

    <div class="clearfix"></div>
</form>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        $(".form_valid").validationEngine();
        turn_off_triggers();

        $(document).on("change","#year",function()
        {
            if($(this).val().length>0)
            {
                $("#load_variety").show();
                $.ajax({
                    url: base_url+"bonus_setup/get_variety_detail/",
                    type: 'POST',
                    dataType: "JSON",
                    data:{year_id:$(this).val()},
                    success: function (data, status)
                    {

                    },
                    error: function (xhr, desc, err)
                    {
                        console.log("error");
                    }
                });
            }
            else
            {
                $("#load_variety").html('');
                $("#load_variety").hide();
            }
        });
    });

</script>