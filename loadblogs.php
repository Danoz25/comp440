<?php include('mysqli_connect.php'); 

$blog_id = $_GET['id'];

$query = "SELECT * FROM blog ORDER BY id asc";
$results = mysqli_query($connection, $query);

if($results->num_rows > 0)
{
    while ($row = $results->fetch_assoc())
    {
        if ($row["id"] == $blog_id)
        {
            echo $row["subject"] . "<br>" . $row["username"] . "<br>" . $row["date"] . "<br>" . $row["description"];
            echo "<br>";
        }
    }
}


if(isset($_POST['submit']))
{
    date_default_timezone_set('America/Los_Angeles');
    $date = date('Y-m-d');
    $rating = $_POST['formRating'];
    $comment_description = $_POST["formComment"];
    $username = $_SESSION["username"];
    
    
    if(!empty($rating) && !empty($comment_description))
    {
        echo $rating;
        echo $date;
        
        $sql = "INSERT INTO comment (comment_id, date, rating, description, blog_id, user_username) VALUES ('{AUTO_INCREMENT}', '{$date}', '{$rating}', '{$comment_description}', '{$blog_id}', '{$username}')";
        $sqlQuery = mysqli_query($connection, $sql);
        // Create mysql query
        
        if(!$sqlQuery)
        {
            die("MySQL comment post query failed!" . mysqli_error($connection));
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
            Rate: 
            <select name="formRating">
                <option value="Select">Select</option>
                <option value="positive">positive</option>
                <option value="negative">negative</option>
            </select>
        </div>
        <div class="form-group">
            <label> Comment</label>
            <div></div>
            <textarea id="formComment" name="formComment" rows = "3" style="width:100%; max_width=100%;"></textarea>
        </div>
        <div class="form-group">
            
            </div>
            <input type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block" value = "Submit">
    </body>
</html>