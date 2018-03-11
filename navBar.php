<?php
ob_start();
session_start();

/*
  @file

  Last modification: 11 March 2018
  
  This php file is the navigation bar of the website.
  It does NOT generate a complete HTML page by itself. 
*/

?>

<?php

/* 
* This function checks to see if the script name given is the active script name.
* If yes, it gives it the class="active" attribute to highlight to the user that said script is the active page.
*
* @param string $scriptname The name of the php script.
* @return void
*/

echo <<< _END
<script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.js'></script>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
_END;

function echoActiveClassIfPageIsActive($scriptname)
{
    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if (strcmp($current_file_name, $scriptname) == 0)
        echo 'class="active"';
}


$userstr = ' (Guest)';
if (isset($_SESSION['user'])){
  $user = $_SESSION['user'];
  $isLoggedin = TRUE;
  $userstr = " ($user)";
} else {
  $isLoggedin = FALSE;
}
?>

<nav class="navbar navbar-default">
<?php if ($isLoggedin): /*if there is a user logged in*/ ?> 
  <ul class="nav navbar-nav">
    <li><a href='index.php' <?=echoActiveClassIfPageIsActive('index')?> >Home</a></li>
    <li><a href='addWord.php' <?=echoActiveClassIfPageIsActive('addWord')?> >Add a new word</a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li><a href='logout.php' ><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
  </ul>
<?php else: /*if there is no user logged in*/ ?>
  <ul class="nav navbar-nav">
    <li><a href='index.php' <?=echoActiveClassIfPageIsActive('index')?> > Home </a></li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li><a href='register.php' <?=echoActiveClassIfPageIsActive('login')?> ><span class="glyphicon glyphicon-user"> Sign up </span> 
    <li><a href='login.php' <?=echoActiveClassIfPageIsActive('login')?> ><span class="glyphicon glyphicon-log-in"></span> Login </a></li>
  </ul>
<?php endif; ?>
</nav>