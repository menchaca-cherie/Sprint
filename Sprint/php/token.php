<?php
function validateToken(string $token) {
    // validate length
    if (strlen($token) != 6) {
        return false;
    }

    // Allowed chars (letters and numbers)
    if (!ctype_alnum($token)) {
        return false;
    }

    return true;
}

function generateToken() {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 6);
}

//function getToken() {
//    // Access PDO from globals
//    include('./php/connect.php');
//    $tokenID = "";
//    //Define query:
//    $sql = "SELECT * FROM advise_it WHERE tokenID = '$tokenID'";
//
//    //Prepare the statement
//    $statement = cnxn->prepare($sql);
//    $statement->bindParam(':Token', $tokenID, PDO::PARAM_STR);
//
//    //Execute the statement
//    $statement->execute();
//
//    return $sql->fetch(PDO::FETCH_ASSOC);
//
//}