<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="row">
    <div class="pull-right" style="margin-right: 10px;">
        <span>
            <img style="width: 30px; height: 20px; margin-top: 10px;" src="<?php echo base_url().'images/envelope.png'?>" />
            <span>
                <label style="border-radius: 10px !important; margin-left: -12px;" data-toggle="modal" data-target="#myModal" class="label label-danger">
                    <?php echo Notification_helper::get_all_notifications();?>
                </label>
            </span>
        </span>
    </div>
</div>

<div class="row widget">
    <div class="widget-header">
        <div class="title">
            Dashboard Menu
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="main-menu-container">
        <?php
            foreach($modules as $module)
            {
                ?>
                <div class="menu-item col-sm-2" data-menu-id="<?php echo $module['id'];?>">
                    <div class="menu_left pull-left">
                        <div class="menu_image">
                            <img alt="menu" src="<?php echo base_url().'images/'.$module['icon'];?>">

                        </div>
                        <div class="menu_title">
                            <?php echo $module['name']; ?>
                        </div>
                    </div>
                    <div class="menu_right pull-right">
                        <div class="menu_sub_count"><?php echo $module['subcount']; ?></div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</div>
<div class="clearfix"></div>
<div class="" id="sub-menu">

</div>
<div class="clearfix"></div>


<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Notification Panel</h4>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <?php
                    $notification_detail = Notification_helper::get_all_notification_detail();
                    foreach($notification_detail as $notification)
                    {
                        $return_array = Notification_helper::get_notification_text($notification);
                    ?>
                        <tr>
                            <td>
                                <a class="external" href="<?php echo $return_array['link'];?>" target="_self"><?php echo $return_array['text'];?></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>