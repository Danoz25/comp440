<?php
//all DB host name may change based off what yours says.
   define('DB_USER', 'comp440');
   define('DB_PASSWORD', 'pass1234');
   define('DB_HOST','127.0.0.1:3050');
   define('DB_NAME','comp_440_projectdb');





   $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,)
   OR die ('Could not connect to MySQL: ' .
    mysqli_connection_error());
?>