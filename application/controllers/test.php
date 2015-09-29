<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Test extends CI_Controller
{
    public static function index()
    {
        $sStartDate = '20-09-2015';
        $sEndDate = '30-11-2015';

        $sStartDate = date("Y-m-d", strtotime($sStartDate));
        $sEndDate = date("Y-m-d", strtotime($sEndDate));

        $aDays[] = $sStartDate;
        $sCurrentDate = $sStartDate;

        while($sCurrentDate < $sEndDate)
        {
            $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
            $aDays[] = $sCurrentDate;
        }

        foreach($aDays as $aDay)
        {
            $month[] = @date('F', strtotime($aDay));
        }

        print_r($month);
    }
}


?>
