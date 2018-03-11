<?php

/*
  @file

  Last modification: 9 March 2018

  This php file is the page where new users register for an account.

  Upon successful registration, the following information is kept in the database:
  1. Username
  2. Password
  
*/

// Include config file
require_once 'navBar.php';
require_once 'login_database_config.php';
 
// Define variables and initialize with empty values
$username = $passwd = $conf_passwd = "";
$username_err = $passwd_err = $conf_passwd_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] != "POST"){
    //exit connection if request method is not post
    goto close_connection;
}

// Validate username
if(empty(trim($_POST["username"]))){
    $username_err = "Please enter a username.";
} else{
    // Prepare a select statement
    $sql = "SELECT username FROM users WHERE username=?";
    
    if(!($stmt = mysqli_prepare($link, $sql))){
        //mysqli_prepare is not successful.
        //exit connection.
        $username_err = "An error occurred with checking the username.";
        goto close_usernamecheck_statement;
    }

    // Set parameters
    $param_username = trim($_POST["username"]);

    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        /* store result */
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1){
            $username_err = "This username is already taken.";
        } else{
            $username = trim($_POST["username"]);
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }
        
    close_usernamecheck_statement:
        if($stmt)
            mysqli_stmt_close($stmt);
}

// Validate password
if(empty(trim($_POST['password']))){
    $passwd_err = "Please enter a password.";     
} elseif(strlen(trim($_POST['password'])) < 6){
    $passwd_err = "Password must have at least 6 characters.";
} else{
    $passwd = trim($_POST['password']);
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
    $conf_passwd_err = 'Please confirm password.';     
} else{
    $conf_passwd = trim($_POST['confirm_password']);
    if($passwd != $conf_passwd){
        $conf_passwd_err = 'Password does not match.';
    }
}

// Check input errors before inserting in database
if(!(empty($username_err) && empty($passwd_err) && empty($conf_passwd_err))){
    //exit connection
    goto close_connection;
}
// Prepare an insert statement
$sql = "INSERT INTO users (username, password) VALUES (?, ?)";


if(!($stmt = mysqli_prepare($link, $sql))){
    //close statement and close connection
    goto close_useradd_statement;
}

// Set parameters
$param_username = $username;
$param_password = password_hash($passwd, PASSWORD_DEFAULT); // Creates a password hash

// Bind variables to the prepared statement as parameters
mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

// Attempt to execute the prepared statement
if(mysqli_stmt_execute($stmt)){
    // Redirect to login page
    header("location: login.php");
} else{
    echo "Something went wrong. Please try again later.";
}
    
close_useradd_statement:
    if(isset($stmt))    // Close statement if set
        mysqli_stmt_close($stmt);

close_connection:
    if(isset($link))   // Close connection if set
        mysqli_close($link);

?>
 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>

<body>

    <center>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($passwd_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $passwd; ?>">
                <span class="help-block"><?php echo $passwd_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($conf_passwd_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $conf_passwd; ?>">
                <span class="help-block"><?php echo $conf_passwd_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>

            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>

    </div>  
    </center>

</body>
</html>