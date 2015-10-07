<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Test extends CI_Controller
{
    public static function index()
    {
        $arr = array("4", "4", "3", "4", "3", "3");

        $new_arr = array_unique($arr, SORT_REGULAR);

        if($arr != $new_arr)
        {
            echo 'not matched';
        }
    }
}


?>
