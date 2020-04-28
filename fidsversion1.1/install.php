<?php
require ('connect.php');

echo ('<link rel="stylesheet" type="text/css" href="staff.css">');
echo ('<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">');


$sql = "CREATE TABLE `fids`.`airlines` ( `airlinecode` VARCHAR(2) NOT NULL , `airlinename` TEXT NOT NULL , PRIMARY KEY (`airlinecode`)) ENGINE = InnoDB;";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table Airlines created successfully";
} else {
    echo "<br>Error creating Airlines table: " . $conn->error;
}




$sql = "CREATE TABLE `fids`.`airports` ( `airportcode` VARCHAR(4) NOT NULL , `airportname` TEXT NOT NULL , PRIMARY KEY (`airportcode`)) ENGINE = InnoDB;";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table Airports created successfully";
} else {
    echo "<br>Error creating Airports table: " . $conn->error;
}





$sql = "CREATE TABLE `fids`.`arrivals` ( `airlinecode` VARCHAR(2) NOT NULL , `flightno` INT(4) NOT NULL , `arrives` DATE NOT NULL , `arrivestime` TIME NOT NULL , `airport` VARCHAR(4) NOT NULL , `registration` VARCHAR(7) NULL DEFAULT NULL , `slottime` TIME NULL DEFAULT NULL , `eta` TIME NOT NULL , `bay` VARCHAR(5) NULL DEFAULT NULL , `gate` VARCHAR(5) NULL DEFAULT NULL , `aircraft` VARCHAR(8) NULL DEFAULT NULL , `belt` VARCHAR(5) NULL DEFAULT NULL , `type` VARCHAR(1) NOT NULL , `status` TEXT NOT NULL , `staffmsg` TEXT NOT NULL , PRIMARY KEY (`airlinecode`, `flightno`, `arrives`)) ENGINE = InnoDB;";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table Arrivals created successfully";
} else {
    echo "<br>Error creating Arrivals table: " . $conn->error;
}




$sql = "CREATE TABLE `fids`.`departures` ( `airlinecode` VARCHAR(2) NOT NULL , `flightno` INT(4) NOT NULL , `departs` DATE NOT NULL , `departstime` TIME NOT NULL , `airport` VARCHAR(4) NOT NULL , `registration` VARCHAR(8) NULL , `slottime` TIME NULL , `edt` TIME NOT NULL , `bay` VARCHAR(5) NULL , `gate` VARCHAR(5) NULL , `aircraft` VARCHAR(8) NULL , `checkin` TEXT NULL , `status` TEXT NULL , `type` VARCHAR(1) NULL , `staffmsg` TEXT NULL , PRIMARY KEY (`airlinecode`, `flightno`, `departs`)) ENGINE = InnoDB;";

if ($conn->query($sql) === TRUE) {
    echo "<br>Table Departures created successfully";
} else {
    echo "<br>Error Departures table: " . $conn->error;
}




$sql = "insert into airports (airportcode,airportname)
values ('ZZZ','Test Airport')";

if ($conn->query($sql) === TRUE) {
    echo "<br>Airports data inserted successfully";
} else {
    echo "<br>Error Insterting Airports Data: " . $conn->error;
}



$sql = "insert into airlines (airlinecode,airlinename)
values ('ZZ','Test Airline')";

if ($conn->query($sql) === TRUE) {
    echo "<br>Airlines Data Inserted Successfully";
    echo "<br><br><h1>Setup Complete<br><br>It's recomended you now delete this setup file!</h1>";
} else {
    echo "<br>Error Inserting Airlines Data: " . $conn->error;
}






$conn->close();
?>