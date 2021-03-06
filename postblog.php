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
    <form action="" method="post">
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
        <div class="form-group">
            
            </div>
            <input type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block" value = "Submit"></input>
            <button type ="load" name = "loadblogs" id ="loadblogs" 
                        class = "btn btn-outline-primary btn-lg btn-block"><a href ="initalziedb.php"> Load blogs! </a></button>
</div>

            </form>
        </body>
</html>

<?php

    include('mysqli_connect.php');

    $username = $_SESSION["username"];
    $lastPost = "";


    $sqlDateCheck = "SELECT date, username FROM blog ORDER BY date asc";
    $dateCheckResults = mysqli_query($connection, $sqlDateCheck);

    if ($dateCheckResults->num_rows > 0)
    {
        while ($row = $dateCheckResults->fetch_assoc())
        {
            if ($username == $row["username"])
            {
                $lastPost = $row["date"];
            }
        }
    }
    
    
    if(isset($_POST['submit']))
    {
        
        date_default_timezone_set('America/Los_Angeles');
        $date = date('Y/m/d');
        $subject  = $_POST["subject"];
        $description = $_POST["description"];
        $tag_name = $_POST['tag'];
        $currentpost = 0;

        $subject_err = $description_err = $tag_error = "";

        $foundTag = false;
        
        
        $tag_check_query = mysqli_query($connection, "SELECT * FROM tags");
        $tagRows = mysqli_fetch_all($tag_check_query, MYSQLI_ASSOC);
        

        if($date != $lastPost)
        {
            $currentpost = 0;
        }
        if($currentpost <= 2)
        {
        if(!empty($subject) && !empty($description) && !empty($tag_name))
        {
            
            foreach($tagRows as $row)
            {
                if ($tag_name == $row["tag_name"])
                {
                    $foundTag = true;
                }
            }
            
            if (!$foundTag)
            {
                $sqlTag = "INSERT INTO tags (tag_id,tag_name) VALUES ('{AUTO_INCREMENT}', '{$tag_name}')";
                $sqlQueryTag = mysqli_query($connection, $sqlTag);
            }
            
            $sql = "INSERT INTO blog (id, date, subject, username, description) VALUES ('{AUTO_INCREMENT}','{$date}','{$subject}','{$username}', '{$description}')";
         
                      
            // Create mysql query
            $sqlQuery = mysqli_query($connection, $sql);
            $currentpost++;
            
            if(!$sqlQuery)
            {
                die("MySQL post query failed!" . mysqli_error($connection));
            }

         }
    }
    else 
    {
        echo '<script>alert("You have made 2 post today come back tomorrow)"</script>';
        if(empty($subject))
        {
            $subject_error = '<div class="alert alert-danger">
            Subject can not blank</div>'; 
        }
        if(empty($description))
        {
            $description_error = '<div class="alert alert-danger">
                Description can not be blank.
                </div>';
        } 
        if(empty($tag_name))
        {
            $tag_error = '<div class="alert alert-danger">
                Tags can not be blank.
            </div>';
        }
    }
    }
?>