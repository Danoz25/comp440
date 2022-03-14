<?php
    require_once('mysqli_connect.php');
    $query = "SELECT username, lastname FROM COMP440_PROJECTDB";
    $response = @mysqli_query($dbc, $query);
    if($response){
        while($row=mysqli_fetch_array($response)){
            echo $row['username'] . ' ' . $row['lastname'];
        }
    }
?>