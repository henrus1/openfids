<?php

	$type = $_GET['type']; 		
	require ('connect.php');
	require ('settings.php');				



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


	
	echo ('<div style="text-align: left; position:fixed;  ">Departures - Staff</div><div style="text-align: right;  ">Local Time : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td></td>';		
	echo '<td>Flight No</td>';
	echo '<td>TO</td>';
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
	if ($slottime==NULL) {
		echo '<td></td>';
	}
	else {
		echo '<td>'.$slot.'</td>';
	}
	echo '<td>'.$timeactual.'</td>';
	echo '<td>'.$registration.'</td>';
	if ($bay=='0') {
		echo '<td></td>';
	}

	else {
		echo '<td>'.$bay.'</td>';
	}

		if ($gate=='0') {
		echo '<td></td>';
	}

	else {
		echo '<td>'.$gate.'</td>';
	}
	

	echo '<td>'.$aircraft.'</td>';
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

	echo '</tr>';

}}


echo '</table>';


echo ('</body>');
echo ('</html>');





?>