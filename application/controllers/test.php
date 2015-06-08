<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Test extends CI_Controller
{
    public function index()
    {
        $arr1 = Array
        (
            [0] => Array
            (
                ['a']=>2,
                ['b']=>3,
                ['c']=>4
            )
        );

        $arr2 = Array
        (
            [0] => Array
            (
                ['d']=>5,
                ['e']=>6,
                ['f']=>7
            )
        );

        $new_arr = array_merge_recursive($arr1, $arr2);

        print_r($new_arr);
    }
}


?>
