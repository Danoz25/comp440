<?php

// MUST DOUBLE CHECK WEHRE ALL THE BRACKETS GO
    require_once('mysqli_connect.php');

     $_username = $_password = $_firstName = $_lastName = $_email = "";
    $username_err = $password_err = $confirm_password_err = $firstName_err = $lastName_err = $email_err = "";

    if(isset($_POST['submit']))
    {
    
        $username  = $_POST["username"];
        $password =$_POST["password"];
        $firstName = $_POST["firsName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];

        $email_check_query = mysqli_query($connection, "SELECT * FROM user WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstName) && empty($lastName) && empty($email))
        {
            // possible display an error message
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                 // clean the form data before sending to database
                 $_username = mysqli_real_escape_string($connection, $username);
                 $_password = mysqli_real_escape_string($connection, $password);
                 $_firstName = mysqli_real_escape_string($connection, $firstName);
                 $_lastName = mysqli_real_escape_string($connection, $lastName);
                 $_email = mysqli_real_escape_string($connection, $email);

                 if(!preg_match("/^[a-zA-Z ]*$/", $_username)) {
                    $username_err = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{4,20}$/", $_password)) {
                    $password_err = '<div class="alert alert-danger">
                             Password should be between 4 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }

                if(!preg_match("/^[a-zA-Z ]*$/", $_firstName)) {
                    $firstName_err = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!preg_match("/^[a-zA-Z ]*$/", $_lastName)) {
                    $lastName_err = '<div class="alert alert-danger">
                            Only letters and white space allowed.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $email_err = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }

                // finished check all parameters for registering
                if((preg_match("/^[a-zA-Z ]*$/", $username)) && (preg_match("/^[a-zA-Z ]*$/", $firstName)) && (preg_match("/^[a-zA-Z ]*$/", $lastName)) &&
                (filter_var($email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{4,20}$/", $password)))
                {

                      // Generate random activation token
                      $token = md5(rand().time());
                      // Password hash
                      $password_hash = password_hash($password, PASSWORD_BCRYPT);
                      // Query
                      $sql = "INSERT INTO user (username, password, firstname lastname, email, token, is_active,
                      date_time) VALUES ('{$username}','{$password_hash}','{$firstname}', '{$lastname}', '{$email}', 
                      '{$token}', '0', now())";
                      
                      // Create mysql query
                      $sqlQuery = mysqli_query($connection, $sql);
                      
                      if(!$sqlQuery){
                          die("MySQL query failed!" . mysqli_error($connection));
                      } 
                    // genearte tokens and create my sql query and password hash
                }



             }


        }else
        {
            if(empty(trim($_POST["username"]))){
                $firstName_err = "Enter a username.";
        }else
        {
         $firstName = trim($_POST["username"]);
        }

        // Validate password
          if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";     
     } elseif(strlen(trim($_POST["password"])) < 4){
            $password_err = "Password must have atleast 4 characters.";
     } else{
        $password = trim($_POST["password"]);
     }

     //validate first name
        if(empty(trim($_POST["firstName"]))){
            $firstName_err = "Enter a First Name.";
     }else{
            $firstName = trim($_POST["firstName"]);
      }
        //validate last name
            //validate first name
           if(empty(trim($_POST["lastName"]))){
              $lastName_err = "Enter a Last Name.";
          }else{
              $lastName = trim($_POST["lastName"]);
          }

        //validate email
         if(empty(trim($_POST["email"]))){
            $email_err = "Enter a valid Email.";
        }else{
            $email = trim($_POST["email"]);
        }
    }
}



    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
   
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstName" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_firstName; ?>">
                <span class="invalid-feedback"><?php echo $firstName_err; ?></span>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastName" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_lastName; ?>">
                <span class="invalid-feedback"><?php echo $lastName_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $_email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
