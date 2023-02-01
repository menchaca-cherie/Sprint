    <?php

    //328/pdo/config.php
    //Define constants
    define("DB_DSN", "mysql:dbname=menchac1_Plans");
    define("DB_USERNAME", "menchac1_sdev485");
    define("DB_PASSWORD", "HIwarrior12");

    try{
        //connect to db
        $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        //echo "still connected";
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
