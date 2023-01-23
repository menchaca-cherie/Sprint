?php
//include token function
include('./php/token.php');
include('./php/connect.php');

$tokenID = getToken();

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
    <link rel="stylesheet" href="../styles/styles.css">
    <title>Student Schedule</title>
</head>

<body>
<button href="advisors_home.html" class="btn btn-primary btn-lg ml-5">Back</button>
<!--H1 Title-->
<h1 class="mb-auto text-center text-nowrap no-mobile">Student Schedule</h1>

<div class="row justify-content-center">
    <input type="text" id="url" value="https://menchaca.cherie.greenriverdev.com/485/Sprint1/student_schedule.php/?token=<?php echo $tokenID; ?>">
    <button onclick="copyURL()">Copy</button>
</div>
<div class="row justify-content-center my-2" >
    <h3 class="mx-2">Token: </h3>
    <h3 id="tokenDisplay"><?php echo $tokenID; ?></h3>
</div>
<!--Form id, action, method-->
<form id="student_schedule" action="confirmation.html" method="post">

    <input type="hidden" name="tokenID" value="<?php echo $tokenID ?>">
    <!--Starting cards first row-->
    <div class="row">
        <div class="col-sm-5 my-5 mx-auto">
            <div class="card text-white bg-secondary">
                <h5 class="card-header text-center">Fall</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                                <textarea class="justify-content-center" name="fall" id="fall">
                                </textarea>
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
                                <textarea name="winter" id="winter">
                                </textarea>
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
                                <textarea name="spring" id="spring">
                                </textarea>
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
                                <textarea name="summer" id="summer">
                                </textarea>
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
<script src="../js/function.js"></script>
</body>
</html>
