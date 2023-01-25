<?php

//Turn on error reporting put at the top
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Connect to Database
$username = "menchac1_sdev485";
$password = "HIwarrior12";
$hostname = "localhost";
$database = "menchac1_Plans";

$cnxn = @mysqli_connect($hostname, $username, $password, $database)
or die("<p>Oops! We weren't able to connect to the database</p>");

