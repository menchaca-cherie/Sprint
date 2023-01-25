<?php
//include token function
include('./php/token.php');
include('./php/connect.php');

$uri = $_SERVER['REQUEST_URI'];
$tokenID = (substr($uri, -6));//last six characters token

//Initiate variables
$tokenID = "";
$fall = "";
$winter = "";
$spring = "";
$summer = "";
$date = "";

$query = "SELECT * FROM advise_it ORDER BY '$tokenID'";
$query_run = mysqli_query($cnxn, $query);

if(mysqli_num_rows($query_run) == 0)
{
    $sql = "INSERT INTO advise_it ('tokenID') VALUES ('$tokenID')";
    $connect = mysqli_query($cnxn, $sql);
    $query_statement = $dbh->prepare($sql);
    $query_statement->execute();
}



//testing
if (!empty($tokenID)) {

    validateToken($tokenID);
}
else {
    $tokenID = generateToken();
}

?>


<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/student_styles.css">
    <title>Student Schedule</title>
</head>

<body>
<button href="advisor_home.php" class="btn btn-primary btn-lg ml-5">Back</button>
<!--H1 Title-->
<h1 class="mb-auto text-center text-nowrap no-mobile">Student Schedule</h1>

<div class="row justify-content-center">
    <input type="text" id="url" value="https://menchaca.cherie.greenriverdev.com/485/Sprint/student_schedule.php/?tokenID=<?php echo $tokenID; ?>">
    <button onclick="copyURL()">Copy</button>
</div>
<div class="row justify-content-center my-2" >
    <h3 class="mx-2">Token: </h3>
    <h3 id="tokenDisplay"><?php echo $tokenID; ?></h3>
</div>
<!--Form id, action, method-->
<form id="student_schedule" action="confirmation.php" method="post">

    <input type="hidden" name="tokenID" value="<?php echo $tokenID ?>">

    <form action="" method="post" id="save">

        <?php

        $query = "SELECT * FROM student_plan WHERE token = '$tokenID'";
        $result = mysqli_query($cnxn, $query);

        if(mysqli_num_rows($result              ) > 0)
        {
            foreach ($result as $row) {
                $fall = $row['fall'];
                $winter = $row['winter'];
                $spring = $row['spring'];
                $summer = $row['summer'];
            }
        }
        ?>

        <!--Starting cards first row-->
        <div class="row">
            <div class="col-sm-5 my-5 mx-auto">
                <div class="card text-white bg-secondary">
                    <h5 class="card-header text-center">Fall</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <textarea id="fall" name="fall" rows="4"><?php echo $fall; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 my-5 mx-auto">
                <div class="card text-white bg-secondary">
                    <h5 class="card-header text-center">Winter</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <textarea id="winter"  name="winter" rows="4"><?php echo $winter; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Starting card 2nd row-->
        <div id="card2" class="row">
            <div class="col-sm-5 my-3 mx-auto">
                <div class="card text-white bg-secondary">
                    <h5 class="card-header text-center">Spring</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <textarea id="spring" name="spring" rows="4"><?php echo $spring; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-5 my-3 mx-auto">
                <div class="card text-white bg-secondary">
                    <h5 class="card-header text-center">Summer</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <textarea id="summer"  name="summer" rows="4"><?php echo $summer; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Primary Save Button for all quarters-->
        <div class="bottom-0 end-0 my-2 mx-auto">
            <button type="submit" class="btn btn-primary btn-lg mr-5 float-right">Save</button>
        </div>
    </form>
</form>

<script src="js/functions.js"></script>
</body>
</html>
