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




	echo ('<div style="text-align: left; position:fixed;  ">Adding New Flight - Departure</div><div style="text-align: right;  ">Last Reload : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td>Airline</td>';		
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



	echo '<tr>';


echo ('<form name="newflight" method="post" action="depadmin.php">');


echo ('<td><select name="airlinecode" size="10" required>');


$aquery = 'SELECT * FROM `airlines`';
$atable = mysqli_query($conn,$aquery);

while (list($airlinecode,$airlinename)=mysqli_fetch_row($atable)){

echo ('<option value="'.$airlinecode.'">'.$airlinename.'</option>');	

}

echo ('</select></td>');


echo '<td><input type="number" id="flightno" name="flightno" min="1" max="9999" value="" required></td>';


echo ('<td><select name="airportcode" size="10" required>');


$aquery = 'SELECT * FROM `airports`';
$atable = mysqli_query($conn, $aquery);

while (list($airportcode,$airportname)=mysqli_fetch_row($atable)){

echo ('<option value="'.$airportcode.'">'.$airportname.'</option>');	

}

echo ('</select></td>');
$datenow = date("Y-m-d");

echo ('<td><input type="date" id="departs" name="departs" value="'.$datenow.'" required></td>');
echo ('<td><input type="time" id="departstime" name="departstime" value="" required></td>');
echo ('<td><input type="time" id="slottime" name="slottime" size="8" value=""></td>');
echo ('<td><input type="time" id="edt" name="edt" size="8" value="" required></td>');
echo ('<td><input type="text" id="registration" name="registraion" size="7" value=""></td>');
echo ('<td><input type="text" id="bay" name="bay" size="4" value=""></td>');
echo ('<td><input type="text" id="gate" name="gate" size="4" value=""></td>');
echo ('<td><input type="text" id="aircraft" name="aircraft" size="6" value=""></td>');
echo ('<td><input type="text" id="checkin" name="checkin" size="15" value=""></td>');
echo ('<td><input type="text" id="status" name="status" size="15" value=""></td>');


	echo ('<td><select name="type" size="4" required>');
	echo ('<option value="d">Dom</option>');	
	echo ('<option value="i">Intl</option>');	
	echo ('<option value="o">Other</option>');	

echo ('<td><input type="text" id="staffmsg" name="staffmsg" size="10" value=""></td>');


echo '</table>';


echo ('<input type="submit" value="Add New Flight" name="newflight">');


echo '</form>';
echo ('<a href="depadmin.php"><button>Admin Flight Display</button></a>');





echo ('</body>');
echo('</html>');



?>