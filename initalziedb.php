<?php  include('mysqli_connect.php'); 



        if(array_key_exists('droptable', $_POST))
         {
            $query = "SELECT * FROM blog ORDER BY id asc";
            $results = mysqli_query($connection, $query);
       
            if($results->num_rows > 0)
            {
                while ($row = $results->fetch_assoc())
                {
                    echo " Blog date " . $row["date"] . " <a href = 'loadblogs.php?id=" . $row["blog_id"] . "'><b>Blog subject</b></a> " . $row["subject"]; //pls work
                    echo "<br>";
                }
            }
            echo "<br>";
            echo '<script>alert("Database was Intialized")</script>';
            
        }
    

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>PHP User Registration System Example</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Welcome In</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $_SESSION['username']; ?>

                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $_SESSION['firstname']; ?>
                        <?php echo $_SESSION['lastname']; ?></h6>
                    <p class="card-text">Email address: <?php echo $_SESSION['email']; ?></p>
                    
                    <form method ="post">
                    <input type ="submit" name = "droptable" id ="droptable"
                        class = "btn btn-outline-primary btn-lg btn-block" value ="Initialize DataBase!" /> 
                  <button type ="submit" name = "postblog" id ="postblog" 
                        class = "btn btn-outline-primary btn-lg btn-block"><a href ="postblog.php"> Post blog! </a></button>
                    </div>
                        </form>
                    </div>
        </div>

        

</body>
</html>