<?php


////////////////////////////////////////////
///////// CONNECTION SETTINGS //////////////
////////////////////////////////////////////


// Simply Update the Host, Username  and Password to match your SQL server. Also ensure that the database name and database call 'fids' has been created as a utf16_bin database. For any help please don't hestiate to email openfids@outlook.com for free support.

$host		=	'host';
$usrname	=	'username';
$passwd		=	'password';

////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
//// DO NOT EDIT ANYTHING BELOW HERE ///////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////

$dbname		=	'fids';

$connection = mysql_connect($host,$usrname,$passwd) or die ('Problems Connecting');



$conn = new mysqli($host, $usrname, $passwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


mysql_select_db($dbname) or die ('Cannot find the DB');


?>
