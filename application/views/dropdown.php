<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<option value=""><?php echo $this->lang->line('SELECT');?></option>
<?php
if(!isset($selected))
{
    $selected='';
}
if(isset($value)&& isset($name))
{


    for($i=0;$i<sizeof($value);$i++)
    {
    ?>
        <option value="<?php echo $value[$i];?>" <?php if($selected==$value[$i]){ echo "selected";}?>><?php echo $name[$i];?></option>

    <?php
    }
}
?>

