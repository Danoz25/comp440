<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>PHP Login System</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Login form -->
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="post">
                    <h3>Login</h3>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="user_signin" id="user_signin" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password_signin" id="password_signin" />
                    </div>
                    <button type="login" name="login" id="login"
                        class="btn btn-outline-primary btn-lg btn-block"> <a href ="initalziedb.php">Sign
                        in </a></button>
                    <button type ="submit" name = "registerpage" id ="register"
                        class = "btn btn-outline-primary btn-lg btn-block"><a href = "testdb.php">Register Here</a></button> 
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
   
    // Database connection
    include('mysqli_connect.php');

    global $wrongPwdErr, $usernamenotfound, $userPwdErr, $user_empty_err, $pass_empty_err;
        if(isset($_POST['login'])) 
        {
        $user_signin        = $_POST['user_signin'];
        $password_signin     = $_POST['password_signin'];
        // clean data 
        $user_username = mysqli_real_escape_string($connection, $user_signin);
        $pswd = mysqli_real_escape_string($connection, $password_signin);
        // Query if email exists in db
        $sql = "SELECT * From user WHERE username = '{$user_signin}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);
        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }
        if(!empty($user_signin) && !empty($password_signin))
        {
   
            // Check if email exist
            if($rowCount <= 0) {
                $usernamenotfound = '<div class="alert alert-danger">
                        User account does not exist.
                    </div>';
            } else {
                // Fetch user data and store in php session
                while($row = mysqli_fetch_array($query)) {
                    $username      = $row['username'];
                    $pass_word     = $row['password'];
                    $lastname      = $row['lastname'];
                    $firstname     = $row['firstname'];
                    $email         = $row['email'];
                }
            }
                // Verify password
              //  $password = password_verify($password_signin, $pass_word);
                // Allow only verified user
                if($user_signin == $username) {

                    if($user_signin == $username && $password_signin == $pass_word) {
                       
                       $_SESSION['username'] = $username;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       header("Location: http://localhost/comp440/initalziedb.php ");

                    } else {
                        $userPwdErr = '<div class="alert alert-danger">
                                Either email or password is incorrect.
                            </div>';
                            //add a alert box here
                    }
                } 
        } else {
            if(empty($user_signin)){
                $user_empty_err = "<div class='alert alert-danger email_alert'>
                            Email not provided.
                    </div>";
            }
            
            if(empty($password_signin)){
                $pass_empty_err = "<div class='alert alert-danger email_alert'>
                            Password not provided.
                        </div>";
            }            
        }
    }
?>