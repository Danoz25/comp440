<?php  include('mysqli_connect.php'); 



        if(array_key_exists('droptable', $_POST))
         {
            $query = "SELECT * FROM user";
            $results = mysqli_query($connection, $query);
       
            if (mysqli_num_rows($results) == 0) {
               echo 'how many rows 0';
       
              // The query returned 0 rows!
            } else {
                echo 'how many rows';
              // the query returned ATLEAST one row
            }
       
            if (mysqli_num_rows($results) >= 5) {
               echo 'how many rows 5';
       
              // the query returned more than 5 rows
              }
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
                        class = "btn btn-outline-primary btn-lg btn-block" value ="Initialize DataBase!" />  </div>
                        </form>
                    </div>
        </div>
        <h3>Blog Post</h3>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" />
        </div>
        <div class="form-group">
            <label> Description</label>
            <div></div>
            <textarea id="description" name="description" rows = "7" style="width:100%; max_width=100%;"></textarea>
        </div>
        <div class="form-group">
            <label>Tags</label>
            <input type="tag" class="form-control" name="tag" id="tag" />
        </div>
        

</body>
</html>