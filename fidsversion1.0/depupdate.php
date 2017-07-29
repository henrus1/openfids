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



$gate = mysql_result(mysql_query("SELECT `gate` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);


$airport = mysql_result(mysql_query("SELECT `airport` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);


$departstime = mysql_result(mysql_query("SELECT `departstime` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$rego = mysql_result(mysql_query("SELECT `registration` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$slot = mysql_result(mysql_query("SELECT `slottime` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$edt = mysql_result(mysql_query("SELECT `edt` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$bay = mysql_result(mysql_query("SELECT `bay` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$gate = mysql_result(mysql_query("SELECT `gate` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$aircraft = mysql_result(mysql_query("SELECT `aircraft` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$checkin = mysql_result(mysql_query("SELECT `checkin` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$status = mysql_result(mysql_query("SELECT `status` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$type = mysql_result(mysql_query("SELECT `type` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);

$staffmsg = mysql_result(mysql_query("SELECT `staffmsg` FROM `departures` WHERE `departures`.`airlinecode` = '".$airlinecode."' AND `departures`.`flightno` = '".$flightno."' AND `departures`.`departs` = '".$departs."'"),0);


$airlinenameselect = mysql_result(mysql_query("SELECT `airlinename` FROM `airlines` WHERE `airlinecode` = '".$airlinecode."'"),0);

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


$airportnameselect = mysql_result(mysql_query("SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'"),0);

echo ('<option selected value="'.$airport.'">'.$airportnameselect.'</option>');	


$aquery = 'SELECT * FROM `airports`';
$atable = mysql_query($aquery);

while (list($airportcode,$airportname)=mysql_fetch_row($atable)){

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