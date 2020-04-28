<?php

	require ('connect.php');	
	require ('settings.php');	



echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<meta name="google" value="notranslate">');
echo ('</head>');
echo ('<body>');



if (isset($_POST['updateflight'])){
$airlinecode= $_POST['airlinecode'];
$flightno= $_POST['flightno'];
$departs= $_POST['departs'];



	echo ('<div style="text-align: left; position:fixed;  ">Updating Flight '.$airlinecode.$flightno.'</div><div style="text-align: right;  ">Last Reload : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td></td>';		
	echo '<td>Flight No</td>';
	echo '<td>TO</td>';
	echo '<td>SchDate</td>';
	echo '<td>SchTime</td>';
	echo '<td>Slot</td>';
	echo '<td>EDT</td>';
	echo '<td>Rego</td>';
	echo '<td>Bay</td>';
	echo '<td>Gate</td>';
	echo '<td>A/C</td>';
	echo '<td>CheckIn</td>';
	echo '<td>Status</td>';
	echo '<td>TYPE</td>';
	echo '<td>Staff Msg</td>';
	echo '</tr>';




$aquery = "SELECT `gate` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$arow = mysqli_fetch_row(mysqli_query($conn, $aquery));
$gate = $arow[0];


$bquery = "SELECT `airport` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$brow = mysqli_fetch_row(mysqli_query($conn, $bquery));
$airport = $brow[0];


$cquery = "SELECT `departstime` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$crow = mysqli_fetch_row(mysqli_query($conn, $cquery));
$departstime = $crow[0];



$dquery = "SELECT `registration` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$drow = mysqli_fetch_row(mysqli_query($conn, $dquery));
$rego = $drow[0];


$equery = "SELECT `slottime` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$erow = mysqli_fetch_row(mysqli_query($conn, $equery));
$slot = $erow[0];


$fquery = "SELECT `edt` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$frow = mysqli_fetch_row(mysqli_query($conn, $fquery));
$edt = $frow[0];


$gquery = "SELECT `bay` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$grow = mysqli_fetch_row(mysqli_query($conn, $gquery));
$bay = $grow[0];


$hquery = "SELECT `aircraft` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$hrow = mysqli_fetch_row(mysqli_query($conn, $hquery));
$aircraft = $hrow[0];



$iquery = "SELECT `checkin` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$irow = mysqli_fetch_row(mysqli_query($conn, $iquery));
$checkin = $irow[0];


$jquery = "SELECT `status` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$jrow = mysqli_fetch_row(mysqli_query($conn, $jquery));
$status = $jrow[0];


$kquery = "SELECT `type` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$krow = mysqli_fetch_row(mysqli_query($conn, $kquery));
$type = $krow[0];


$lquery = "SELECT `staffmsg` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'";

$lrow = mysqli_fetch_row(mysqli_query($conn, $lquery));
$staffmsg = $lrow[0];


$mquery = "SELECT `airlinename` FROM `airlines` WHERE `airlinecode` = '".$airlinecode."'";

$mrow = mysqli_fetch_row(mysqli_query($conn, $mquery));
$airlinenameselect = $mrow[0];



	echo '<tr>';



echo ('<form name="updateflight" method="post" action="depadmin.php">');

	
	if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="height:20px" ></td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="height:20px" ></td>';	
	}




echo '<td>'.$airlinecode.$flightno.'</td>';

echo ('<input type="text" id="airlinecde" name="airlinecde" value="'.$airlinecode.'" hidden>');
echo ('<input type="text" id="flightnumber" name="flightnumber" value="'.$flightno.'" hidden>');
echo ('<input type="text" id="date" name="date" value="'.$departs.'" hidden></td>');



echo ('<td><select name="airportcode">');


$nquery = "SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'";

$nrow = mysqli_fetch_row(mysqli_query($conn, $nquery));
$airportnameselect = $nrow[0];


echo ('<option selected value="'.$airport.'">'.$airportnameselect.'</option>');	


$aquery = 'SELECT * FROM `airports`';
$atable = mysqli_query($conn, $aquery);

while (list($airportcode,$airportname)=mysqli_fetch_row($atable)){

echo ('<option value="'.$airportcode.'">'.$airportname.'</option>');	

}

echo ('</select></td>');
echo ('<td><input type="date" id="datea" name="datea" value="'.$departs.'" disabled></td>');
echo ('<td><input type="time" id="departstime" name="departstime" value="'.$departstime.'"></td>');
echo ('<td><input type="time" id="slottime" name="slottime" size="8" value="'.$slot.'"></td>');
echo ('<td><input type="time" id="edt" name="edt" size="8" value="'.$edt.'"></td>');
echo ('<td><input type="text" id="rego" name="rego" size="7" value="'.$rego.'"></td>');
echo ('<td><input type="text" id="bay" name="bay" size="4" value="'.$bay.'"></td>');
echo ('<td><input type="text" id="gate" name="gate" size="4" value="'.$gate.'"></td>');
echo ('<td><input type="text" id="aircraft" name="aircraft" size="6" value="'.$aircraft.'"></td>');
echo ('<td><input type="text" id="checkin" name="checkin" size="15" value="'.$checkin.'"></td>');
echo ('<td><input type="text" id="status" name="status" size="15" value="'.$status.'"></td>');


if ($type=='d') {
	echo ('<td><select name="type">');
	echo ('<option selected value="d">Dom</option>');	
	echo ('<option value="i">Intl</option>');	
	echo ('<option value="o">Other</option>');	
}

elseif ($type=='i') {
	echo ('<td><select name="type">');
	echo ('<option selected value="i">Intl</option>');	
	echo ('<option value="d">Dom</option>');	
	echo ('<option value="o">Other</option>');	
}

else {
	echo ('<td><select name="type">');
	echo ('<option selected value="o">Other</option>');	
	echo ('<option value="d">Dom</option>');	
	echo ('<option value="i">Intl</option>');	
}

echo ('<td><input type="text" id="staffmsg" name="staffmsg" size="10" value="'.$staffmsg.'"></td>');


echo '</table>';




echo ('<input type="submit" value="Update Flight" name="updateflight">');

echo '</form>';

echo ('<a href="depadmin.php"><button>Admin Flight Display</button></a>');





echo ('</body>');
echo('</html>');
}

else {
	echo('You need to first pick a flight to update from the Admin Flight Display');
	echo ('<a href="depadmin.php"><button>Admin Flight Display</button></a>');
}

?>