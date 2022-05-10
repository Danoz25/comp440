<?php  include('mysqli_connect.php'); 



        if(array_key_exists('droptable', $_POST))
         {
            $query = "SELECT * FROM blog ORDER BY blog_id asc";
            $results = mysqli_query($connection, $query);
       
            if($results->num_rows > 0)
            {
                while ($row = $results->fetch_assoc())
                {
                    echo " Blog date " . $row["date"] . " <a href = 'loadblogs.php?blog_id=" . $row["blog_id"] . "'><b>Blog subject</b></a> " . $row["subject"]; //pls work
                    echo "<br>";
                }
            }
            echo "<br>";
            echo '<script>alert("Database was Intialized")</script>';
            
        }
        
        if(array_key_exists('number1', $_POST))
        {
        
           $query = "SELECT DISTINCT blog.subject, blog.description, comment.rating
           FROM blog
           INNER JOIN comment ON blog.blog_id = comment.blog_id
           WHERE blog.username = 'test3' # Input username value
           AND rating = 'positive'";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "List all the blogs of user X, such that all the comments are positive for these blogs. ";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["subject"] . " " .  $row["rating"];

                }

            }

        }

        if(array_key_exists('number2', $_POST))
        {
        
           $query = "SELECT DISTINCT blog.subject, blog.description, comment.rating
           FROM blog
           INNER JOIN comment ON blog.blog_id = comment.blog_id
           WHERE blog.username = 'test3' # Input username value
           AND rating = 'positive'";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "List all the blogs of user X, such that all the comments are positive for these blogs. ";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["subject"] . " " .  $row["rating"];

                }

            }

        }

        if(array_key_exists('number3', $_POST))
        {
        
           $query = "SELECT DISTINCT blog.subject, blog.description, comment.rating
           FROM blog
           INNER JOIN comment ON blog.blog_id = comment.blog_id
           WHERE blog.username = 'test3' # Input username value
           AND rating = 'positive'";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "List the users who posted the most number of blogs on 5/1/2022; if there is a tie, 
                list all the users who have a tie. ";
                while ($row = $results->fetch_assoc())
                {
                
                    
                    echo $row["subject"] . " " .  $row["rating"];

                }

            }

        }
        if(array_key_exists('number4', $_POST))
        {
        
           $query = "SELECT F1.following_username
           FROM following F1 #, following F2
           join following F2 on F1.user_username != F2.user_username
           WHERE F1.user_username = 'test2'
           AND F2.user_username = 'test1'
           AND F1.following_username = F2.following_username;";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "List the users who are followed by both X and Y. Usernames X and Y are inputs from the user"; 
                while ($row = $results->fetch_assoc())
                {
                   
                    echo "<br>";
                    echo $row["following_username"];

                }

            }

        }
        if(array_key_exists('number5', $_POST))
        {
        
           $query = "SELECT F1.following_username
           FROM following F1 #, following F2
           join following F2 on F1.user_username != F2.user_username
           WHERE F1.user_username = 'test2'
           AND F2.user_username = 'test1'
           AND F1.following_username = F2.following_username;";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "List a user pair (A, B) such that they have at least one common hobby. ";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["following_username"];

                }

            }

        }
        if(array_key_exists('number6', $_POST))
        {
        
           $query = "SELECT DISTINCT(username) FROM user WHERE username NOT IN (SELECT DISTINCT(username) FROM blog);";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "Display all the users who never posted a blog. ";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["username"];

                }

            }

        }
        if(array_key_exists('number7', $_POST))
        {
        
           $query = "SELECT DISTINCT(username)
           FROM user
           WHERE username 
           NOT IN (SELECT DISTINCT(user_username) FROM comment)";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "Display all the users who never posted a comment";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["username"];

                }

            }

        }
        if(array_key_exists('number8', $_POST))
        {
        
           $query = "SELECT DISTINCT(user_username)
           FROM comment
           WHERE user_username NOT IN (SELECT user_username FROM comment WHERE rating = 'positive')";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "Display all the users who posted some comments, but each of them is negative.";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["user_username"];

                }

            }

        }
        if(array_key_exists('number9', $_POST))
        {
        
           $query = "SELECT DISTINCT(username)
           FROM blog
           WHERE username NOT IN (
               SELECT username 
               FROM blog
               WHERE blog_id IN (
                   SELECT blog_id 
                   FROM comment
                   WHERE rating = 'negative'))";
            $results = mysqli_query($connection, $query);
            if($results->num_rows > 0)
            {
                echo "Display those users such that all the blogs they posted so far never received any 
                negative comments.";
                while ($row = $results->fetch_assoc())
                {
                    echo "<br>";
                    echo $row["username"];

                }

            }

        }


    
    

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
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

                    
                    <button type ="submit" name = "number1" id ="number1" 
                    class = "btn btn-outline-primary btn-lg btn-block">Number 1 </button>
                    <button type ="submit" name = "number2" id ="number2" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 2</button>
                    <button type ="submit" name = "number3" id ="number3" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 3 </button>
                    <button type ="submit" name = "number4" id ="number4" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 4</button>
                    <button type ="submit" name = "number5" id ="number5" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 5</button>
                    <button type ="submit" name = "number6" id ="number6" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 6</button>
                    <button type ="submit" name = "number7" id ="number7" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 7 </button>
                    <button type ="submit" name = "number8" id ="number8" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 8 </button>
                    <button type ="submit" name = "number9" id ="number9" 
                    class = "btn btn-outline-primary btn-lg btn-block"> Number 9 </button>
                
                        </form>
                </div>
            </div>
        </div>
    </div>
    <div class="phase3">
  <div class="dropdown">
    <div class="dropdown-content">
  </div> 
    </div>

        

</body>
</html>