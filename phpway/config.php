<?php
   define('DB_USER', 'comp440');
   define('DB_PASSWORD', 'pass1234');
   define('DB_HOST','localhost');
   define('DB_NAME','university');

   $dbc = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
   OR die ('Could not connect to MySQL: ' .
    mysqli_connection_error());
?>