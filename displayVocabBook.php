<?php
ob_start();
session_start();

/*
  @file

  Last modification: 14 March 2018

  This php file displays words saved by a particular user to the website.
  It does NOT generate a complete HTML page by itself. 



*/

?>


<?php

require_once 'login_database_config.php';


//These 4 lines of code obtain the registered user's user_id so the words he added in addWord.php shows up here.
$sql = "SELECT user_id FROM users WHERE username=\"". $_SESSION['user']."\"";
$query_result = mysqli_query($link,$sql);
$user_id = mysqli_fetch_array($query_result, MYSQLI_ASSOC);
$user_id=$user_id['user_id'];



$sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE user_id=?";

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["searchfield"])) {
  $searchword = $_POST["searchfield"];
  $sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE word_name LIKE '%?%' AND user_id=?";

}

$stmt = mysqli_prepare($link, $sql);


if(mysqli_stmt_param_count($stmt) == 2){
  mysqli_stmt_bind_param($stmt, "si", $searchword, $user_id);
} else {
  mysqli_stmt_bind_param($stmt, "i", $user_id);
}


mysqli_stmt_execute($stmt);

mysqli_stmt_store_result($stmt);


mysqli_stmt_bind_result($stmt, $word_id, $word_name, $word_meaning);

if (mysqli_stmt_num_rows === 0){ //An empty set is returned
  echo "<br><p>No results found. :'(</p>";

} else { //There are word results to display.
  echo <<<_END
  <br>
  <div class="col-sm-5" align="center">
  <table class="table table-bordered" >
  <thead>
  <tr>
  <th scope="col">Word name</th>
  <th scope="col">Word meaning</th>
  </tr>
  </thead>
_END;

  while(mysqli_stmt_fetch($stmt)){
    echo <<<_END
    <tbody>
    <tr>
    <th scope="row"></th>
    </tr>
    <td> $word_name </td>
    <td>

      <button data-toggle='collapse' data-target='#showID$word_id'>Meaning</button>
      <div id='showID$word_id' class='collapse'> $word_meaning </div>

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCenterFor$word_id"> Show meaning in modal </button>

      <div class="modal fade" id="modalCenterFor$word_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"> $word_name </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Meaning of the word: $word_meaning
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      
    </td>

_END;
  }
  
}


close_statement:
  if(isset($stmt))  //Close statement if set
    mysqli_close($link);

close_connection:
    if(isset($link))   // Close connection if set
        mysqli_close($link);
?>