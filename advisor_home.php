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

<h1 class="mb-auto text-center text-nowrap no-mobile"> Advise-It Homepage </h1>
<div class="position-relative text-center my-5">
  <div class="col mx-2">
    <a href="student_schedule.php" class="btn btn-outline-primary">Create New Schedule</a>
  </div>
  <form action="" method="get">
    <div class="position-relative text-center my-5">
      <label>Token: </label>
      <input type="text" id="tokenID" value="<?php if (isset($_GET['tokenID'])) {
                    echo $_GET['tokenID'];
                } ?>" class="form">
    </div>
    <div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  <form action="" method="post" id="save">
    <div class="row">
      <div class="col-md-12">
        <hr>

        <?php

                    include("./php/connect.php");
                    $tokenID = "";
                    if (!isset($_GET['tokenID'])) {
                        include("php/connect.php");
                        $tokenID = $_GET['tokenID'];
                        $query = "SELECT * FROM advise_it WHERE tokenID = '$tokenID'";
                        $query_run = mysqli_query($cnxn, $query);
                        //if statement
                            if(mysqli_num_rows($query_run) > 0){
        foreach ($query_run as $row) {

        echo $row['fall'] ;
        }
        }
        } else {
        echo "Something happened!";

        }
        ?>
      </div>
    </div>
  </form>
</div>
</body>
</html>