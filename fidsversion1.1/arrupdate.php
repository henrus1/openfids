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
$arrives= $_POST['arrives'];



	echo ('<div style="text-align: left; position:fixed;  ">Updating Flight '.$airlinecode.$flightno.'</div><div style="text-align: right;  ">Last Reload : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td></td>';		
	echo '<td>Flight No</td>';
	echo '<td>FROM</td>';
	echo '<td>SchDate</td>';
	echo '<td>SchTime</td>';
	echo '<td>Slot</td>';
	echo '<td>ETA</td>';
	echo '<td>Rego</td>';
	echo '<td>Bay</td>';
	echo '<td>Gate</td>';
	echo '<td>A/C</td>';
	echo '<td>Belt</td>';
	echo '<td>Status</td>';
	echo '<td>TYPE</td>';
	echo '<td>Staff Msg</td>';
	echo '</tr>';



$aquery = "SELECT `gate` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$arow = mysqli_fetch_row(mysqli_query($conn, $aquery));
$gate = $arow[0];


$bquery = "SELECT `airport` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$brow = mysqli_fetch_row(mysqli_query($conn, $bquery));
$airport = $brow[0];


$cquery = "SELECT `arrivestime` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$crow = mysqli_fetch_row(mysqli_query($conn, $cquery));
$arrivestime = $crow[0];


$dquery = "SELECT `registration` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$drow = mysqli_fetch_row(mysqli_query($conn, $dquery));
$rego = $drow[0];


$equery = "SELECT `slottime` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$erow = mysqli_fetch_row(mysqli_query($conn, $equery));
$slot = $erow[0];


$fquery = "SELECT `eta` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$frow = mysqli_fetch_row(mysqli_query($conn, $fquery));
$eta = $frow[0];


$gquery = "SELECT `bay` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$grow = mysqli_fetch_row(mysqli_query($conn, $gquery));
$bay = $grow[0];


$hquery = "SELECT `aircraft` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$hrow = mysqli_fetch_row(mysqli_query($conn, $hquery));
$aircraft = $hrow[0];


$iquery = "SELECT `belt` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$irow = mysqli_fetch_row(mysqli_query($conn, $iquery));
$belt = $irow[0];


$jquery = "SELECT `status` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$jrow = mysqli_fetch_row(mysqli_query($conn, $jquery));
$status = $jrow[0];


$kquery = "SELECT `type` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$krow = mysqli_fetch_row(mysqli_query($conn, $kquery));
$type = $krow[0];


$lquery = "SELECT `staffmsg` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'";

$lrow = mysqli_fetch_row(mysqli_query($conn, $lquery));
$staffmsg = $lrow[0];


$mquery = "SELECT `airlinename` FROM `airlines` WHERE `airlinecode` = '".$airlinecode."'";

$mrow = mysqli_fetch_row(mysqli_query($conn, $mquery));
$airlinenameselect = $mrow[0];


	echo '<tr>';



echo ('<form name="updateflight" method="post" action="arradmin.php">');


	if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="height:20px" ></td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="height:20px" ></td>';	
	}

echo '<td>'.$airlinecode.$flightno.'</td>';



echo ('<input type="text" id="airlinecde" name="airlinecde" value="'.$airlinecode.'" hidden>');
echo ('<input type="text" id="flightnumber" name="flightnumber" value="'.$flightno.'" hidden>');
echo ('<input type="text" id="date" name="date" value="'.$arrives.'" hidden></td>');



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
echo ('<td><input type="date" id="datea" name="datea" value="'.$arrives.'" disabled></td>');
echo ('<td><input type="time" id="arrivestime" name="arrivestime" value="'.$arrivestime.'"></td>');
echo ('<td><input type="time" id="slottime" name="slottime" size="8" value="'.$slot.'"></td>');
echo ('<td><input type="time" id="eta" name="eta" size="8" value="'.$eta.'"></td>');
echo ('<td><input type="text" id="rego" name="rego" size="7" value="'.$rego.'"></td>');
echo ('<td><input type="text" id="bay" name="bay" size="4" value="'.$bay.'"></td>');
echo ('<td><input type="text" id="gate" name="gate" size="4" value="'.$gate.'"></td>');
echo ('<td><input type="text" id="aircraft" name="aircraft" size="6" value="'.$aircraft.'"></td>');
echo ('<td><input type="text" id="belt" name="belt" size="15" value="'.$belt.'"></td>');
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


echo ('<a href="arradmin.php"><button>Admin Flight Display</button></a>');





echo ('</body>');
echo('</html>');
}

else {
	echo('hacker');
}

?>