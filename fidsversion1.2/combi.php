<?php

$type = $_GET['type']; 		
require ('connect.php');	
require ('settings.php');
ini_set('display_errors', 'Off');

echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<meta http-equiv="refresh" content="10">');
echo ('<link rel="stylesheet" type="text/css" href="combistyle.css">');
echo ('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');
echo ('</head>');
echo ('<body>');


$dquery = 'SELECT * FROM `departures` ORDER BY `departs`,`departstime` LIMIT '.$combidepartingflightsdisplayed.'';
$aquery = 'SELECT * FROM `arrivals` ORDER BY `arrives`,`arrivestime` LIMIT '.$combiarrivingflightsdisplayed.'';


$dtable = mysqli_query($conn, $dquery);


if(!$dtable){
	echo('<p>Oops, It seems the connection to the database has failed</p>');
			} 

else {

	
	echo ('<div style="position: fixed; bottom: 0px; left: 0px; width: 100%; height:7.5%; background-color: rgb(39,40,34); text-align: right; vertical-align: middle; line-height: 200%;  ">Local Time : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';

echo '<colgroup>
    <col style="width:15%">
    <col style="width:5%">
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:5%">
    <col style="width:15%">
  </colgroup> ';





	echo '<tr>';
	echo '<td>Departures</td>';		
	echo '<td></td>';
	echo '<td></td>';
	echo '<td>Time</td>';

	if ($type=='c') {
		echo '<td>Check In</td>';
	}

	else {
		echo '<td>Gate</td>';
	}

	echo '<td>Status</td>';
	echo '</tr>';



	while (list($airlinecode,$flightno,$departs,$departstime,$airport,$registration,$slottime,$edt,$bay,$gate,$aircraft,$checkin,$status)=mysqli_fetch_row($dtable)){
	

$airquery = "SELECT `airlinename` FROM `airlines` WHERE `airlinecode`='".$airlinecode."'";
if ($airresult = mysqli_query($conn, $airquery)) {
    while ($airrow = mysqli_fetch_row($airresult)) {
        $airlinename = $airrow[0];
    }

}


$destquery = "SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'";
if ($destresult = mysqli_query($conn, $destquery)) {
    while ($destrow = mysqli_fetch_row($destresult)) {
        $destinationname = $destrow[0];
    }

}

	$timescheduled = date('H:i', strtotime($departstime));
	$timeactual = date('H:i', strtotime($edt));

	echo '<tr>';

	if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="width:50px;height:39px" > '.$airlinename.'</td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="width:50px;height:39px" > '.$airlinename.'</td>';	
	}
	
	echo '<td>'.$airlinecode.$flightno.'</td>';
	echo '<td>'.$destinationname.'</td>';

	if ($timescheduled==$timeactual) {
		echo '<td>'.$timescheduled.'</td>';
	}

	else{
		echo '<td><old style="color:grey;">'.$timescheduled.'</old><br><delay style="color:red;">'.$timeactual.'</delay></td>';
		$delay = '1';
	}




	if ($type=='c') {
		echo '<td>'.$checkin.'</td>';
					}

	else {
		
			if ($gate=='0') {
			echo '<td></td>';
			}

			else {
			echo '<td>Gate '.$gate.'</td>';
			}

		}




	if ($status=='Boarding') {
		echo '<td><boarding style="color:rgb(0,226,85);">'.$status.'</boarding></td>';
	}


	elseif ($delay=='1') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}


	else {
		echo '<td>'.$status.'</td>';
	}
	
	echo '</tr>';


}}


echo '</table>';




$atable = mysqli_query($conn, $aquery);


if(!$atable){
	echo('<p>Oops, It seems the connection to the database has failed</p>');
} else {

	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';

	echo '<colgroup>
    <col style="width:15%">
    <col style="width:5%">
    <col style="width:15%">
    <col style="width:10%">
    <col style="width:5%">
    <col style="width:15%">
  </colgroup> ';


	echo '<tr>';
	echo '<td>Arrivals</td>';		
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '</tr>';


	while (list($airlinecode,$flightno,$arrives,$arrivestime,$airport,$registration,$slottime,$eta,$bay,$gate,$aircraft,$belt,$type,$status,$staffmsg)=mysqli_fetch_row($atable)){
	

$airquery = "SELECT `airlinename` FROM `airlines` WHERE `airlinecode`='".$airlinecode."'";
if ($airresult = mysqli_query($conn, $airquery)) {
    while ($airrow = mysqli_fetch_row($airresult)) {
        $airlinename = $airrow[0];
    }

}


$destquery = "SELECT `airportname` FROM `airports` WHERE `airportcode` = '".$airport."'";
if ($destresult = mysqli_query($conn, $destquery)) {
    while ($destrow = mysqli_fetch_row($destresult)) {
        $destinationname = $destrow[0];
    }

}

	$timescheduled = date('H:i', strtotime($arrivestime));
	$timeactual = date('H:i', strtotime($eta));

	echo '<tr>';
	
	if (file_exists('airlinelogos/'.$airlinecode.'.png')) {
    echo '<td><img src="airlinelogos/'.$airlinecode.'.png" style="width:50px;height:39px" > '.$airlinename.'</td>';	
	} 

	else {
    echo '<td><img src="airlinelogos/default.png" style="width:50px;height:39px" > '.$airlinename.'</td>';	
	}


	
	echo '<td>'.$airlinecode.$flightno.'</td>';
	echo '<td>'.$destinationname.'</td>';

	if ($timescheduled==$timeactual) {
		echo '<td>'.$timescheduled.'</td>';
	}

	elseif ($timescheduled>$timeactual) {
		echo '<td><old style="color:grey;">'.$timescheduled.'</old><br><early style="color:rgb(0,226,85);">'.$timeactual.'</earyl></td>';
		$delay = '2';
	}

	else{
		echo '<td><old style="color:grey;">'.$timescheduled.'</old><br><delay style="color:red;">'.$timeactual.'</delay></td>';
		$delay = '1';
	}


	if ($gate==NULL) {
			echo '<td></td>';
			}

			else {
			echo '<td>Gate '.$gate.'</td>';
			}




	if ($delay=='2') {
		echo '<td><early style="color:rgb(0,226,85);">'.$status.'</early></td>';
	}


	elseif ($delay=='1') {
		echo '<td><delay style="color:red;">'.$status.'</delay></td>';
	}


	else {
		echo '<td>'.$status.'</td>';
	}
	

	echo '</tr>';


}}


echo '</table>';



echo ('</body>');
echo ('</html>');





?>