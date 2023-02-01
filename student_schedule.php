<?php
//include token function

include('./php/connect.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php');

$uri = $_SERVER['REQUEST_URI'];
$token = (substr($uri, -6));//last six characters token

//Initiate variables

$fall = "";
$winter = "";
$spring = "";
$summer = "";
$advisor = "";
$date = "";


$query = "SELECT * FROM advise_it WHERE token ='$token'";
$query_run = mysqli_query($cnxn, $query);

if(mysqli_num_rows($query_run) == 0)
{
    $sql = "INSERT INTO advise_it ('token') VALUES ('$token')";
    $connect = mysqli_query($cnxn, $sql);
    $query_statement = $dbh->prepare($sql);
    $query_statement->execute();
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/student_styles.css">

    <title>Student Schedule</title>
</head>

<body>

<!--H1 Title-->
<h1 class="mb-auto text-center text-nowrap no-mobile">Student Schedule</h1>
<!--Token copy URL with the token -->
<div class="row justify-content-center">
    <input type="text" id="url" value="https://menchaca.cherie.greenriverdev.com/485/Sprint/student_schedule.php/token = <?php echo $token; ?>">
    <button onclick="copyURL()">Copy</button>
</div>
<div class="row justify-content-center my-2" >
    <h3 class="mx-2">Token: </h3>
    <h3 id="tokenDisplay"><?php echo $token; ?></h3>
</div>
<!--Token ID-->
    <input type="hidden" name="token" value="<?php echo $token ?>">
<!--Form id, action, method-->
    <form action="" method="post" id="save">

            <?php

            $query = "SELECT * FROM advise_it WHERE token = '$token'";
            $result = mysqli_query($cnxn, $query);

            if(mysqli_num_rows($result)== 0) {
                foreach ($result as $row) {
                    $fall = $row['fall'];
                    $winter = $row['winter'];
                    $spring = $row['spring'];
                    $summer = $row['summer'];
                    $advisor = $row['advisor'];

                }
            }
            ?>
            <div class="row">
                <div class="col text-center my-1">
                    <h5 class="text-center">Advisor: </h5>
                    <textarea id="advisor"  name="advisor" rows="1"><?php
                        echo $advisor;?>Name:</textarea>
                </div>
            </div>
    <!--Starting cards first row-->
            <div class="row">
                <div class="col-sm-5 my-3 mx-auto">
                    <div class="card text-white bg-secondary">
                        <h5 class="card-header text-center">Fall: </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <textarea id="fall"  name="fall" rows="4">Classes:<?php echo $fall; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 my-3 mx-auto">
                    <div class="card text-white bg-secondary">
                        <h5 class="card-header text-center">Winter: </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <textarea id="winter"  name="winter" rows="4">Classes:<?php echo $winter; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Starting card 2nd row-->
            <div class="row">
                <div class="col-sm-5 my-3 mx-auto">
                    <div class="card text-white bg-secondary">
                        <h5 class="card-header text-center">Spring: </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <textarea id="spring"  name="spring" rows="4">Classes:<?php echo $spring; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5 my-3 mx-auto">
                    <div class="card text-white bg-secondary">
                        <h5 class="card-header text-center">Summer: </h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <textarea id="summer"  name="summer" rows="4">Classes:<?php echo $summer; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-sm-12 my-5">
                    <div>
                        <button type="submit" class="btn btn-primary btn-lg mr-5 float-right px-5">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <?php


        //Insert Schedule
        //1. Define the query
//        $sql_add = "INSERT INTO advise_it (`token`, `fall`, `winter`, `spring`, `summer`)
//        VALUES ('$token' ,'$fall', '$winter' , '$spring', '$summer')";

        $sql_add = "INSERT INTO advise_it (token, fall, winter, spring, summer,advisor) 
       VALUES (:token ,:fall, :winter , :spring, :summer, :advisor)";

//        if ($cnxn->query($sql_add) === TRUE) {
//            $fall = $_POST['fall'];
//            $winter = $_POST['winter'];
//            $spring = $_POST['spring'];
//            $summer = $_POST['summer'];
//            $advisor = $_POST['advisor'];
//        }
//

        //2. Prepare the statement
        $statement = mysqli_query($cnxn, $sql_add);
        $query_statement = $dbh->prepare($sql_add);

        if(isset($fall)){
            $fall = $_POST[$fall];
        }
        if(isset($winter)){
            $winter = $_POST[$winter];
        }
        if(isset($spring)){
            $spring = $_POST[$spring];
        }
        if(isset($summer)){
            $summer = $_POST[$summer];
        }
        if (isset($advisor)) {
            $advisor = $_POST[$advisor];
        }

        $query_statement->bindParam('token', $token, PDO::PARAM_STR);
        $query_statement->bindParam('fall', $fall, PDO::PARAM_STR);
        $query_statement->bindParam('winter', $winter, PDO::PARAM_STR);
        $query_statement->bindParam('spring', $spring, PDO::PARAM_STR);
        $query_statement->bindParam('summer', $summer, PDO::PARAM_STR);
        $query_statement->bindParam('advisor', $advisor, PDO::PARAM_STR);


        //Time and update time

//        $date = time();
//        $date_update = date("Y-m-d h:m:s", $date);

        //statement to use the date/time

//        $update_current = "UPDATE advise_it
//        SET fall ='$fall', winter ='$winter', spring = '$spring', summer = '$summer',time = '$date_update'
//        WHERE token = '$token'";

//        $update_statement = $dbh->prepare($update_current);
//        $update_statement ->execute();
//
//        if(mysqli_num_rows($result) > 0)
//        {
//            foreach ($result as $row)
//            {
//                $save_current_time = $row['time'];
//
//                echo '<p id="time" > Update: '.$save_current_time.'</p>';
//
//            }
//
//        }
        ?>
    <!--Primary Save Button for all quarters-->

</form>

<script src="js/functions.js"></script>
</body>
</html>
