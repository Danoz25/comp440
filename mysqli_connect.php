
<?php 
    // Enable us to use Headers
    ob_start();
    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }
    $hostname = "127.0.0.1:3050";
    $username = "comp440";
    $password = "pass1234";
    $dbname = "comp_440_projectdb";
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>