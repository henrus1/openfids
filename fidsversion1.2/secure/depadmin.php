<?php

	$type = $_GET['type']; 		
	$login = $_GET['login']; 	
	require ('connect.php');
	require ('settings.php');				


if (isset($_POST['newflight'])){

$airlinecode= $_POST['airlinecode'];
$flightno= $_POST['flightno'];
$departs= $_POST['departs'];
$departstime= $_POST['departstime'];
$airport= $_POST['airportcode'];
$registration= $_POST['registration'];
$slottime= $_POST['slottime'];
$edt= $_POST['edt'];
$bay= $_POST['bay'];
$gate= $_POST['gate'];
$aircraft= $_POST['aircraft'];
$checkin= $_POST['checkin'];
$status= $_POST['status'];
$type= $_POST['type'];
$staffmsg= $_POST['staffmsg'];


$newsql = "INSERT INTO `fids`.`departures` (`airlinecode`, `flightno`, `departs`, `departstime`, `airport`, `registration`, `slottime`, `edt`, `bay`, `gate`, `aircraft`, `checkin`, `status`, `type`, `staffmsg`) VALUES ('".$airlinecode."', '".$flightno."', '".$departs."', '".$departstime."', '".$airport."', '".$registration."', '".$slottime."', '".$edt."', '".$bay."', '".$gate."', '".$aircraft."', '".$checkin."', '".$status."', '".$type."', '".$staffmsg."');";


if (mysqli_query($conn, $newsql)) {
echo ('');
}


}


if (isset($_POST['updateflight'])){
$airlinecde= $_POST['airlinecde'];
$flightnumber= $_POST['flightnumber'];
$departsa= $_POST['date'];
$departstimes= $_POST['departstime'];
$airportcd= $_POST['airportcode'];
$rego= $_POST['rego'];
$slottime= $_POST['slottime'];
$edt= $_POST['edt'];
$bay= $_POST['bay'];
$gate= $_POST['gate'];
$aircraft= $_POST['aircraft'];
$checkin= $_POST['checkin'];
$status= $_POST['status'];
$type= $_POST['type'];
$staffmsg= $_POST['staffmsg'];


$sql = "UPDATE `fids`.`departures` SET `departstime` = '".$departstimes."', `airport` = '".$airportcd."', `registration` = '".$rego."', `slottime` = '".$slottime."', `edt` = '".$edt."', `bay` = '".$bay."', `gate` = '".$gate."', `aircraft` = '".$aircraft."', `checkin` = '".$checkin."', `status` = '".$status."', `type` = '".$type."', `staffmsg` = '".$staffmsg."' WHERE `departures`.`airlinecode` = '".$airlinecde."' AND `departures`.`flightno` = ".$flightnumber." AND `departures`.`departs` = '".$departsa."';";


if (mysqli_query($conn, $sql)) {
echo ('');
}


}



if (isset($_POST['deleteflight'])){
$airlineco= $_POST['airlinecode'];
$flightnumber= $_POST['flightno'];
$date= $_POST['departs'];


$removesql = "DELETE FROM `fids`.`departures` WHERE `departures`.`airlinecode` = '".$airlineco."' AND `departures`.`flightno` = '".$flightnumber."' AND `departures`.`departs` = '".$date."'";


if (mysqli_query($conn, $removesql)) {
echo ('');
}

}




echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<meta http-equiv="refresh" content="10">');
echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<meta name="google" value="notranslate">');
echo ('</head>');
echo ('<body>');



$tquery = 'SELECT * FROM `departures` ORDER BY `departs`, `departstime`';


$ttable = mysqli_query($conn, $tquery);


if(!$ttable){

	echo('<p>Oops, Try again</p>');
} else {

		
	echo ('<div style="text-align: left; position:fixed;  ">Departures - Admin</div><div style="text-align: right;  ">Local Time : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td></td>';		
	echo '<td>Flight</td>';
	echo '<td>TO</td>';
	echo '<td>Sch</td>';
	echo '<td>EDT</td>';
	echo '<td>Gate</td>';
	echo '<td>CheckIn</td>';
	echo '<td>Status</td>';
	echo '<td>TYPE</td>';
	echo '<td>Staff Msg</td>';
	echo '<td><a href="depnewdeparture.php"><button>New Departure</button></a></td>';
	echo '<td><a href="index.html"><button>Home Page</button></a></td>';
	echo '</tr>';



	while (list($airlinecode,$flightno,$departs,$departstime,$airport,$registration,$slottime,$edt,$bay,$gate,$aircraft,$checkin,$status,$type,$staffmsg)=mysqli_fetch_row($ttable)){
	


	$timescheduled = date('H:i', strtotime($departstime));
	$timeactual = date('H:i', strtotime($edt));
	$slot = date('H:i', strtotime($slottime));


	echo '<tr>';
	
	if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="height:20px" ></td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="height:20px" ></td>';	
	}


	
	echo '<td>'.$airlinecode.$flightno.'</td>';
	echo '<td>'.$airport.'</td>';
	echo '<td>'.$timescheduled.'</td>';
	echo '<td>'.$timeactual.'</td>';

		if ($gate=='0') {
		echo '<td></td>';
	}

	else {
		echo '<td>'.$gate.'</td>';
	}



	echo '<td>'.$checkin.'</td>';
	echo '<td>'.$status.'</td>';

	if ($type=='d') {
		echo '<td>Dom</td>';
	}

	elseif ($type=='i') {
		echo '<td>Intl</td>';
	}

	else
	{
		echo '<td>Other</td>';
	}

	echo '<td>'.$staffmsg.'</td>';

	echo ('<form name="updateflights" method="post" action="depupdate.php">');
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinecode.'" hidden>');
	echo ('<input type="text" id="flightno" name="flightno" value="'.$flightno.'" hidden>');
	echo ('<input type="date" id="departs" name="departs" value="'.$departs.'" hidden>');

	if ($login=='y') {
		echo '<td><input type="submit" value="Update Flight" name="updateflight"></td>';
	}

	else {
		echo '<td><input type="submit" value="Update Flight" name="updateflight"></td>';
	}

	echo ('</form>');


	

	echo ('<form name="deleteflights" method="post" action="depadmin.php">');
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinecode.'" hidden>');
	echo ('<input type="text" id="flightno" name="flightno" value="'.$flightno.'" hidden>');
	echo ('<input type="text" id="departs" name="departs" value="'.$departs.'" hidden>');

	if ($login=='y') {
		echo '<td><input type="submit" value="Delete Flight" name="deleteflight"></td>';
	}

	else {
		echo '<td><input type="submit" value="Delete Flight" name="deleteflight"></td>';
	}

	
	echo ('</form>');

	echo '</tr>';


}}


echo '</table>';


echo ('</body>');
echo ('</html>');





?>