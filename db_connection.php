<?php

    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "root";
    $db_name = "podcast";

    $con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if(!$con){
        die("Connection Failed : ".mysqli_connect_error());
    }
