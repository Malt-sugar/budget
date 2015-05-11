<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'/libraries/root_controller.php';

class Test extends CI_Controller
{
    public function index()
    {
        $row=array(9,8,0,7);
        echo "<td>".$row[0], $row[1],$row[2], $row[3]."</td>";
    }
}

        // Create connection
        $con = mysqli_connect("localhost", "", "", "");
        mysqli_set_charset('utf8', $con);

        // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        // This SQL statement selects ALL from the table 'Locations'
        $sql = "SELECT * FROM Mothakirat";
        mysqli_set_charset('utf8', $sql);

        // Check if there are results
        if ($result = mysqli_query($con, $sql))
        {
            // If so, then create a results array and a temporary one
            // to hold the data
            $resultArray = array();
            $tempArray = array();

            // Loop through each row in the result set
            while ($row = $result->fetch_object())
            {
                // Add each row into our results array
                $tempArray = $row;
                array_push($resultArray, $tempArray);
            }

            // Finally, encode the array to JSON and output the results
            echo htmlentities(json_encode($resultArray));
        }

        // Close connections
        mysqli_close($con);
?>
<script type="text/javascript">
    $.ajax({
        url: "qa.php",
        type: "POST",
        datatype: "html",
        contentType: "application/x-www-form-urlencoded; charset=iso-8859-2",
        data: {
            indeks: tekst, q: question},
        success: function (result) {
            jQuery("#kontener").html(result);
        },
    });
</script>
    <table id="q">
        <tr><td><input type="radio" name="answer" value="1">q1</td></tr>
        <tr><td><input type="radio" name="answer" value="2">q2</td></tr>
        <tr><td><input type="radio" name="answer" value="3">q3</td></tr>
        <tr><td><input type="radio" name="answer" value="4">q4</td></tr>
    </table>