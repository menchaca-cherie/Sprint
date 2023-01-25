<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('./php/token.php');


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

    if (!empty($tokenID)) {

        validateToken($tokenID);
    }
    else {
        $tokenID = generateToken();

    }
    $uni_url = "student_schedule.php/".$tokenID;

    ?>
    <div class="position-relative text-center my-5">
        <?php echo '<form action='.$uni_url.'method="post">
                    <button class="btn btn-outline-primary px-5" type="submit" id="create">Create New</button>
                </form>'
        ?>
    </div>

    </body>
</html>
