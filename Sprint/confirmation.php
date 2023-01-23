<?php

$tokenID = $_POST['tokenID'];
$fall = $_POST['fall'];
$winter = $_POST['winter'];
$spring = $_POST['spring'];
$summer = $_POST['summer'];


include("php/connect.php");

$sql_add = "INSERT INTO advise_it (`tokenID`, `fall`, `winter`, `spring`, `summer`) 
       VALUES ('$tokenID' ,'$fall', '$winter' , '$spring', '$summer')";

if ($cnxn->query($sql_add) === TRUE){
    echo "New record created successfully";
} else {
    echo "Something happened! Please go back and resubmit your form.";
}

