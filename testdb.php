
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="App">
        <div class="vertical-center"> 
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>

        <form action="" method="post">
        <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username" />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <label> Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" />
                    </div>
            <div class="form-group">
                        <label>First name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" />
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" />
                    </div>
                    <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block" value = "Sumbit">
           <br> <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>
</div>    
</body>
</html>

<?php

// MUST DOUBLE CHECK WEHRE ALL THE BRACKETS GO
    include('mysqli_connect.php');

    $username_err = $password_err = $confirm_password_err = $firstName_err = $lastName_err = $email_err = "";


    $_username = $_password = $_confirmpassword = $_firstName = $_lastName = $_email = "";
    if(isset($_POST["submit"]))
    {
    

        $username  = $_POST["username"];
        $password =$_POST["password"];
        $confirmpassword = $_POST['confirmpassword'];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];

        $email_check_query = mysqli_query($connection, "SELECT * FROM user WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);

        if(!empty($username) && !empty($password) && !empty($confirmpassword) && !empty($firstName) && !empty($lastName) && !empty($email))
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
                 $_confirmpassword = mysqli_real_escape_string($connection,$confirmpassword);
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
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{4,20}$/", $_confirmpassword))
                {
                    $confirm_password_err =   '<div class="alert alert-danger">
                    Password deos not match
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
                
                      // Generate random activation token
                      // Password hash
                      $password_hash = password_hash($password, PASSWORD_BCRYPT);
                      // Query
                      $sql = "INSERT INTO user (username, password, lastname, firstname, email) VALUES ('{$username}','{$password}','{$lastName}', '{$firstName}', '{$email}')";
                      
                      // Create mysql query
                      $sqlQuery = mysqli_query($connection, $sql);
                      
                      if(!$sqlQuery){
                          die("MySQL query failed!" . mysqli_error($connection));
                      } 
                    // genearte tokens and create my sql query and password hash
                
            }
        }





        }else {
            if(empty($username))
                 {
                $username_err = '<div class="alert alert-danger">
                username can not blank</div>';       
                 }
                if(empty($password)){
                    $passwordEmptyErr = '<div class="alert alert-danger">
                        Password can not be blank.
                    </div>';
                } 
                if(empty($confirmpassword) && $confirmpassword == $password){
                    $confirm_password_err =  '<div class="alert alert-danger">
                        Can Not be empty and must match
               </div>';
                }
                if(empty($firstname)){
                $firstName_err = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }
            if(empty($lastname)){
                $lastName_err = '<div class="alert alert-danger">
                    Last name can not be blank.
                </div>';
            }
            if(empty($email)){
                $email_err = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }
        }



    
?>

