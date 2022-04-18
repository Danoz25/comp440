<?php include('mysqli_connect.php'); 

$query = "SELECT * FROM blog ORDER BY id asc";
$results = mysqli_query($connection, $query);

if($results->num_rows > 0)
{
    while ($row = $results->fetch_assoc())
    {
        echo " Blog date " . $row["date"] . " <a href = 'loadblogs.php'><b>Blog subject</b></a> " . $row["subject"];
        echo "<br>";
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
        <h3>Blog Post <?php echo $_query['subject']; ?></h3>
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
            <input type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block" value = "Submit">
    </body>
</html>