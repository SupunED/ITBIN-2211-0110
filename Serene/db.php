<?php
    $hostname = "localhost";
    $dbuser = "root";
    $dbname = "serene";
    $dbpassword = "";

    $conn = mysqli_connect($hostname, $dbuser, $dbpassword, $dbname);

    if(!$conn){
        die("Connection failed: ". mysqli_connect_error());
    }

?>