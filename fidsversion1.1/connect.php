<?php


////////////////////////////////////////////
///////// CONNECTION SETTINGS //////////////
////////////////////////////////////////////


// Simply Update the Host, Username  and Password to match your SQL server. Also ensure that the database name is  'fids' and has been created as a utf16_bin database. For any help please don't hestiate to email openfids@henrus1.com for support.

$host		=	'localhost';
$usrname	=	'hot';
$passwd		=	'hots';

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

$conn = new mysqli($host, $usrname, $passwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


mysqli_select_db($conn,$dbname) or die ('Cannot find the DB');


?>