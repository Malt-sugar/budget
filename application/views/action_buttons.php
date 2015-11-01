<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI = & get_instance();
$module_id=System_helper::get_parent_id_of_task($CI->router->class);

?>
<div class="row widget hidden-print" style="padding-bottom: 0px;">
    <div class="action_button">
        <a class="btn" href="<?php echo base_url().'home/login/'.$module_id;?>"><?php echo $this->lang->line("ACTION_DASHBOARD"); ?></a>
    </div>
    <div class="action_button" style="display: <?php if(isset($hide_new)&&($hide_new==1)){ echo "none";} else{echo "block";} ?>">
        <a class="btn" href="<?php echo $link_new; ?>"><?php echo $this->lang->line("ACTION_NEW"); ?></a>
    </div>
    <div class="action_button">
        <a class="btn" href="<?php echo base_url()?>home/logout"><?php echo $this->lang->line("ACTION_LOGOUT"); ?></a>
    </div>
</div>
<div class="clearfix"></div>