<?php

include("php/connect.php");
include('./php/token.php');
session_start();

//Initialize variables
$uun = "";
$validLogin = true;

//If the user is already loggeg in
if(isset($_SESSION['username'])){
    //Redirect to homepage
    header(('location: advisor_home.php'));
}

if(!empty($_POST)){
    //get the form data
    $uun = $_POST['username'];
    $pw = $_POST['password'];

    require('php/admin_creds.php');

    //If the username is the array and the passwords match
    if(array($uun, $login) && $pw == $login[$uun]){
        //Records username in the session array
        $_SESSION['username']= $uun;

        //Go to the page that the user came from, or else the home page
        $page = isset($_SESSION['page']) ? $_SESSION['page'] : 'admin.php';
        header('location: ' .$page);
    }
    //Invalid login -- set flag variable
    $validLogin = false;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/student_styles.css">
    <title> Advise-It Homepage </title>

</head>
    <body>
    <div>
        <h1 class="mb-auto text-center text-nowrap no-mobile"> Advise-It Homepage </h1>
    </div>
    <?php
    $uni_urlToken= generateToken();
    //Append it to the end of URL

    $uni_urlToken = "student_schedule.php/".$uni_urlToken;

    ?>
    <!--Create Button will take you to student_schedule page    -->
    <div class="form-group text-center my-5">
        <?php echo '<form action="'.$uni_urlToken.'"method="post">
                    <input type="hidden" name="token" value="'.$uni_urlToken.'">
                    <button class="btn btn-outline-primary px-5" type="submit" id="create">Create New</button>
                </form>'
        ?>
    </div>
    <!--Admin Login    -->
    <form action="" method="post" id="login" autocomplete="off" class="bg-light border p-3">
        <div class="form-row justify-content-center">
            <h4 class="title my-3">Login Administration</h4>
            <div class="col-6">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
                    <div class="form-group text-center my-5">
                        <div class="row input-group mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="username"
                                    value="<?php echo $uun; ?>"
                        </div>
                    </div>
                    <div class="form-group text-center my-5">
                        <div class="row input-group mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                        </div>
                    </div>
                    <?php
                    if(!$validLogin){
                        echo'<p class="err">Login is incorrect</p>';
                    }
                    ?>
                    <div>
                        <button type="submit" class="btn btn-dark">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
