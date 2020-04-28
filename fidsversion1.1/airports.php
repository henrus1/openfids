<?php

	$type = $_GET['type']; 	
	$delete = $_GET['delete'];	
	require ('connect.php');		
	require ('settings.php');	


if (isset($_POST['deleteairport'])){

$airportcode= $_GET['delete'];


$removesql = "DELETE FROM `fids`.`airports` WHERE `airports`.`airportcode` = '".$airportcode."'";


if (mysqli_query($conn, $removesql)) {
		header("Location: airports.php");

}

}


if (isset($_POST['updateairport'])){
$airportcode= $_POST['airportcode'];
$airportname= $_POST['airportname'];


$updatesql = "UPDATE `fids`.`airports` SET `airportname` = '".$airportname."' WHERE `airports`.`airportcode` = '".$airportcode."';";


if (mysqli_query($conn, $updatesql)) {
echo ('');
}

}


if (isset($_POST['newairport'])){

$airportcode= $_POST['airportcode'];
$airportname= $_POST['airportname'];


$newsql = "INSERT INTO `fids`.`airports` (`airportcode`, `airportname`) VALUES ('".$airportcode."', '".$airportname."');";


if (mysqli_query($conn, $newsql)) {
echo ('');
}

}




echo ('<!DOCTYPE html>');
echo ('<html>');
echo ('<head>');
echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<meta name="google" value="notranslate">');
echo ('</head>');
echo ('<body>');



$tquery = 'SELECT * FROM `airports` ORDER BY `airportcode`';


$ttable = mysqli_query($conn, $tquery);


if(!$ttable){

	echo('<p>Oops, Try again</p>');
} else {

		
	echo ('<div style="text-align: left; position:fixed;  ">Airports - Admin</div><div style="text-align: right;  ">Last Update : '.date("H:i").' &nbsp; </div>');


	echo '<table border="0" cellpadding="1" cellspacing="10" width="100%">';


	echo '<tr>';
	echo '<td>Airport Code</td>';		
	echo '<td>Airport Name</td>';
	echo '<td><a href="index.html"><button>Home Page</button></a></td>';

	echo '</tr>';


	echo '<tr>';
	echo ('<form name="newairport" method="post" action="airports.php">');	
	echo '<td><input type="text" id="airportcode" name="airportcode"  size="4" minlength="3" maxlength="4" value="" ></td>';
	echo '<td><input type="text" id="airportname" name="airportname"  size="25" value="" ></td>';
	echo '<td><input type="submit" value="Add Airport" name="newairport"></td>';
	echo ('</form>');
	echo '</tr>';





	while (list($airportcode,$airportname)=mysqli_fetch_row($ttable)){
	

	$airportnow = $airportcode;

	echo '<tr>';
	echo ('<form name="updateairport" method="post" action="airports.php">');	
	echo '<td>'.$airportcode.'</td>';
	echo '<td><input type="text" id="airportname" name="airportname"  size="25" value="'.$airportname.'" >';


	
	echo ('<input type="text" id="airportcode" name="airportcode" value="'.$airportcode.'" hidden>');
	echo ' <input type="submit" value="Update Airport Name" name="updateairport"></td>';
	echo ('</form>');


	echo ('<form name="deleteairport" method="post" action="airports.php?delete='.$airportcode.'">');
	echo ('<input type="text" id="airportcode" name="airportcode" value="'.$airportnow.'" hidden>');
	echo '<td><input type="submit" value="Delete Airport" name="deleteairport"></td>';


	echo '</tr>';
	

	echo '<tr>';
	echo '</tr>';


}}


echo '</table>';


echo ('</body>');
echo ('</html>');





?>