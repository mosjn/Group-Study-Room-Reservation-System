<?php
     $server = "localhost";
     $db_username = "root";
     $db_password = "";
     $db = "project_mo";
     $con = mysqli_connect("$server", "$db_username", "$db_password" , "$db");
     if (!$con) {
         die('Could not connect: ' . mysql_error());
         echo "error!";
     }
    else{
        /*echo "connect success!";*/
     }
?>