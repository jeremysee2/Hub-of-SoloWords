<?php

/*
  @file

  Last modification: 11 March 2018
  
  This php file is the login page of the website.

*/
ob_start();
session_start();

require_once 'navBar.php';
require_once 'login_database_config.php';
 
// Define variables and initialize with empty values
//$username = $passwd = "";
//$username_err = $passwd_err = "";
 
/* 
*  Checks if this page was loaded with GET or POST request
*  POST is for user validation. So the script proceeds.
*  GET merely loads the page (ie user validation not needed). So the script exits.
*/
if($_SERVER["REQUEST_METHOD"] != "POST"){
    goto close_connection;
}


/* 
*  Checks if username and/or password field(s) is/are submitted in POST request is empty. 
*  If empty, the error variables are assigned the error messages.
*  If not empty, strip whitespaces from input for processing.
*/
if(empty(trim($_POST["username"]))){
    $username_err = 'Please enter username.';
} else{
    $username = trim($_POST["username"]);
}
if(empty(trim($_POST['password']))){
    $passwd_err = 'Please enter your password.';
} else{
    $passwd = trim($_POST['password']);
}

/* 
*  Checks if username and/or password error msg(s) is/are empty.
*  If empty, the username & passwd inputs are good to process against the database of users.
*  If not empty, the username and/or passwd input(s) is/are empty. So the script exits.
*/
if(!(empty($username_err) && empty($passwd_err))){
    goto close_connection;
}

// Prepare a select statement
$sql = "SELECT username, password FROM users WHERE username = ?";

if(!($stmt = mysqli_prepare($link, $sql))){
    //failed to prepare the mysqli statement
    goto close_statement;
}

// Set parameters
$param_username = $username;

// Bind variables to the prepared statement as a parameter
mysqli_stmt_bind_param($stmt, "s", $param_username);

// Attempt to execute the prepared statement
if(!mysqli_stmt_execute($stmt)){
    echo "Oops! Something went wrong. Please try again later.";
    goto close_statement;
}

// Store result
mysqli_stmt_store_result($stmt);

// Check if username exists, if yes then verify password
if(mysqli_stmt_num_rows($stmt) != 1){      
    // Display an error message if username doesn't exist
    $username_err = 'No account found with that username.';
    goto close_statement;
}

// Bind result variables
mysqli_stmt_bind_result($stmt, $username, $hashed_password);

if(!mysqli_stmt_fetch($stmt)){
    goto close_statement;
}

/* 
*  Checks the passwd given against the database.
*  If they match, the user is authenticated. A session is started.
*  Else, the user is not authenticated, and an error message is returned.
*/
if(password_verify($passwd, $hashed_password)){
    $_SESSION['user'] = $username;      
    header("location: index.php");
} else{
    $passwd_err = 'The password you entered was not valid.';
}

close_statement:
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
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>

<body>
    <center>
    <div class="wrapper">

        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    

            <div class="form-group <?php echo (!empty($passwd_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $passwd_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>

            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>

    </div> 
    </center>   
</body>
</html>