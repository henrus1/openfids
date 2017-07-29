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



$gate = mysql_result(mysql_query("SELECT `gate` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);


$airport = mysql_result(mysql_query("SELECT `airport` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);


$arrivestime = mysql_result(mysql_query("SELECT `arrivestime` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$rego = mysql_result(mysql_query("SELECT `registration` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$slot = mysql_result(mysql_query("SELECT `slottime` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$eta = mysql_result(mysql_query("SELECT `eta` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$bay = mysql_result(mysql_query("SELECT `bay` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$gate = mysql_result(mysql_query("SELECT `gate` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$aircraft = mysql_result(mysql_query("SELECT `aircraft` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$belt = mysql_result(mysql_query("SELECT `belt` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$status = mysql_result(mysql_query("SELECT `status` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$type = mysql_result(mysql_query("SELECT `type` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);

$staffmsg = mysql_result(mysql_query("SELECT `staffmsg` FROM `arrivals` WHERE `arrivals`.`airlinecode` = '".$airlinecode."' AND `arrivals`.`flightno` = '".$flightno."' AND `arrivals`.`arrives` = '".$arrives."'"),0);



$airlinenameselect = mysql_result(mysql_query("SELECT `airlinename` FROM `airlines` WHERE `airlinecode` = '".$airlinecode."'"),0);

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


$airportnameselect = mysql_result(mysql_query("SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'"),0);

echo ('<option selected value="'.$airport.'">'.$airportnameselect.'</option>');	


$aquery = 'SELECT * FROM `airports`';
$atable = mysql_query($aquery);

while (list($airportcode,$airportname)=mysql_fetch_row($atable)){

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