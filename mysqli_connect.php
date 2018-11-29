<?php
DEFINE ('DB_USER','marium');
DEFINE ('DB_PASSWORD' , '13099');
DEFINE ('DB_HOST' , 'localhost');
DEFINE ('DB_NAME' , 'CUSTOMERS');

$dbc =@mysqli connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connet to MySql'.
     mysqli_connect_error());

?>

