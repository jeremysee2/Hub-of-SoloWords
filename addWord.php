<?php

/*
  @file

  Last modification: 11 March 2018

  This php file is the page where registered users store new words.
  The following information is captured in the database:
  1. name of the word (input by the user)
  2. meaning of the word (input by the user)
  3. user id of the registered user (input by the system)
  
*/

ob_start();
session_start();

$userstr = ' (Guest)';



if (isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  $userstr = " ($user)";
} else {
  //redirect to no permissions
  header("HTTP/1.1 403 Forbidden");
}

?>

<html>
<head>

  <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.js'></script>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  
<?php
require_once 'login_database_config.php';
require_once 'navBar.php';

if($_SERVER["REQUEST_METHOD"] != "POST"){
  //exit connection if request method is not post
  goto close_connection;
}

$wordToAdd_err = $user_id = $wordToAdd_meaning = $wordToAdd = "";

$is_add_successful = false;

$wordToAdd = $_POST["wordToAdd"];
$wordToAdd_meaning = $_POST["wordToAdd_meaning"];

if(false /* the word the user is trying to enter has been entered before */){
  //show error msg "You have entered the word before"
  goto close_statement;
  //close statement and connection
}

//These 4 lines of code obtain the registered user's user_id so the words he add can be registered to him.
$sql = "SELECT user_id FROM users WHERE username=\"". $_SESSION['user']."\"";
$query_result = mysqli_query($link,$sql);
$user_id = mysqli_fetch_array($query_result, MYSQLI_ASSOC);
$user_id=$user_id['user_id'];



$sql = "INSERT INTO word_storage (word_name, word_meaning, user_id) VALUES (?,?,?)";

if(!($stmt = mysqli_prepare($link, $sql))){
  //failed to prepare the mysqli statement
  goto close_statement;
}


if(!mysqli_stmt_bind_param($stmt, 'ssi', $wordToAdd, $wordToAdd_meaning, $user_id)){
  //failed to bind parameters to mysqli statement
  goto close_statement;
}

if(!mysqli_stmt_execute($stmt)){
  //failed to execute the mysqli statement
  //error msg: "Failed to add. Please try again"
  $wordToAdd_err = "Failed to add the word. Please try again.";
  //close statement and connection
  goto close_statement;
}

if(mysqli_stmt_affected_rows($stmt) == 1){
  $is_add_successful = true;
  $success_msg = "'" . $wordToAdd . "' was successfully added.";
} else {
  //means the mysql code ran but it changed more than 1 entry.
  //log error.
}

close_statement:
  if(isset($stmt))  //Close statement if set
    mysqli_stmt_close($stmt);

close_connection:
  if(isset($link))  // Close connection if set
    mysqli_close($link);

?>

  <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">

    <div class="form-group <?php echo empty($wordToAdd_err)?'':'has-error'; ?>">
      <label class="control-label col-sm-3">Word name:</label>
      <div class="col-sm-5">
        <input type="text" name="wordToAdd" class="form-control" value="<?php echo $wordToAdd; ?>">
      </div>
    </div>
    <div class="form-group <?php echo empty($wordToAdd_err)?'':'has-error'; ?>">
      <label class="control-label col-sm-3">Word meaning:</label>
      <div class="col-sm-5">
        <textarea type="text" name="wordToAdd_meaning" rows="5" class="form-control" value="<?php echo $wordToAdd_meaning; ?>"></textarea>
        <span class="help-block"><?php echo $is_add_successful?$success_msg:$wordToAdd_err; ?></span>
      </div>
    </div>
    <div class="col-sm-offset-3 col-sm-5">
      <button type="submit" class="btn btn-default">Add word</button>
    </div>

  </form>

</body>
</html>