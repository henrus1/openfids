<?php

	$type = $_GET['type']; 		
	$login = $_GET['login']; 	
	require ('connect.php');
	require ('settings.php');			


if (isset($_POST['newarrival'])){
$airlinecode= $_POST['airlinecode'];
$flightno= $_POST['flightno'];
$arrives= $_POST['arrives'];
$arrivestime= $_POST['arrivestime'];
$airport= $_POST['airportcode'];
$registration= $_POST['registration'];
$slottime= $_POST['slottime'];
$eta= $_POST['eta'];
$bay= $_POST['bay'];
$gate= $_POST['gate'];
$aircraft= $_POST['aircraft'];
$belt= $_POST['belt'];
$status= $_POST['status'];
$type= $_POST['type'];
$staffmsg= $_POST['staffmsg'];



$newsql = "INSERT INTO `fids`.`arrivals` (`airlinecode`, `flightno`, `arrives`, `arrivestime`, `airport`, `registration`, `slottime`, `eta`, `bay`, `gate`, `aircraft`, `belt`, `status`, `type`, `staffmsg`) VALUES ('".$airlinecode."', '".$flightno."', '".$arrives."', '".$arrivestime."', '".$airport."', '".$registration."', '".$slottime."', '".$eta."', '".$bay."', '".$gate."', '".$aircraft."', '".$belt."', '".$status."', '".$type."', '".$staffmsg."');";


if (mysqli_query($conn, $newsql)) {
echo ('');
}


}


if (isset($_POST['updateflight'])){
$airlinecde= $_POST['airlinecde'];
$flightnumber= $_POST['flightnumber'];
$departsa= $_POST['date'];
$arrivestimes= $_POST['arrivestime'];
$airportcd= $_POST['airportcode'];
$rego= $_POST['rego'];
$slottime= $_POST['slottime'];
$eta= $_POST['eta'];
$bay= $_POST['bay'];
$gate= $_POST['gate'];
$aircraft= $_POST['aircraft'];
$belt= $_POST['belt'];
$status= $_POST['status'];
$type= $_POST['type'];
$staffmsg= $_POST['staffmsg'];


$sql = "UPDATE `fids`.`arrivals` SET `arrivestime` = '".$arrivestimes."', `airport` = '".$airportcd."', `registration` = '".$rego."', `slottime` = '".$slottime."', `eta` = '".$eta."', `bay` = '".$bay."', `gate` = '".$gate."', `aircraft` = '".$aircraft."', `belt` = '".$belt."', `status` = '".$status."', `type` = '".$type."', `staffmsg` = '".$staffmsg."' WHERE `arrivals`.`airlinecode` = '".$airlinecde."' AND `arrivals`.`flightno` = ".$flightnumber." AND `arrivals`.`arrives` = '".$departsa."';";


if (mysqli_query($conn, $sql)) {
echo ('');
}


}



if (isset($_POST['deleteflight'])){
$airlineco= $_POST['airlinecode'];
$flightnumber= $_POST['flightno'];
$date= $_POST['arrives'];


$removesql = "DELETE FROM `fids`.`arrivals` WHERE `arrivals`.`airlinecode` = '".$airlineco."' AND `arrivals`.`flightno` = '".$flightnumber."' AND `arrivals`.`arrives` = '".$date."'";


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



$tquery = 'SELECT * FROM `arrivals` ORDER BY `arrives`, `arrivestime`';

$ttable = mysqli_query($conn, $tquery);


if(!$ttable){
	echo('<p>Oops, Try again</p>');
} else {

		
	echo ('<div style="text-align: left; position:fixed;  ">Arrivals - Admin</div><div style="text-align: right;  ">Local Time : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td></td>';		
	echo '<td>Flight</td>';
	echo '<td>FROM</td>';
	echo '<td>Sch</td>';
	echo '<td>ETA</td>';
	echo '<td>Gate</td>';
	echo '<td>Belt</td>';
	echo '<td>Status</td>';
	echo '<td>TYPE</td>';
	echo '<td>Staff Msg</td>';
	echo '<td><a href="arrnewarrival.php"><button>New Arrival</button></a></td>';
	echo '<td><a href="index.html"><button>Home Page</button></a></td>';
	echo '</tr>';



	while (list($airlinecode,$flightno,$arrives,$arrivestime,$airport,$registration,$slottime,$eta,$bay,$gate,$aircraft,$belt,$type,$status,$staffmsg)=mysqli_fetch_row($ttable)){
	


	$timescheduled = date('H:i', strtotime($arrivestime));
	$timeactual = date('H:i', strtotime($eta));
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



	echo '<td>'.$belt.'</td>';
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

	echo ('<form name="updateflights" method="post" action="arrupdate.php">');
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinecode.'" hidden>');
	echo ('<input type="text" id="flightno" name="flightno" value="'.$flightno.'" hidden>');
	echo ('<input type="date" id="arrives" name="arrives" value="'.$arrives.'" hidden>');

	if ($login=='y') {
		echo '<td><input type="submit" value="Update Flight" name="updateflight"></td>';
	}

	else {
		echo '<td><input type="submit" value="Update Flight" name="updateflight"></td>';
	}

	echo ('</form>');


	

	echo ('<form name="deleteflights" method="post" action="arradmin.php">');
	echo ('<input type="text" id="airlinecode" name="airlinecode" value="'.$airlinecode.'" hidden>');
	echo ('<input type="text" id="flightno" name="flightno" value="'.$flightno.'" hidden>');
	echo ('<input type="text" id="arrives" name="arrives" value="'.$arrives.'" hidden>');

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