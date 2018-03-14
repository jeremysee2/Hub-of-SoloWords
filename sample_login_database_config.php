<?php
/*
  @file
  This php file connects to a mysql database with the credentials herein.
  If successful, the connection to mysql is in variable $link.
  Else, an error message is returned.
  It does NOT generate a complete HTML page by itself. 
*/

/* MySQL database credentials */
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWD', '');
define('DB_NAME', '');
 
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>