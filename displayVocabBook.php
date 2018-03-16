<?php
ob_start();
session_start();

/*
  @file

  Last modification: 14 March 2018

  This php file displays words saved by a particular user to the website.
  It does NOT generate a complete HTML page by itself. 



*/



require_once 'login_database_config.php';


//These 4 lines of code obtain the registered user's user_id so the words he added in addWord.php shows up here.
$sql = "SELECT user_id FROM users WHERE username=\"". $_SESSION['user']."\"";
$query_result = mysqli_query($link,$sql);
$user_id = mysqli_fetch_array($query_result, MYSQLI_ASSOC);
$user_id=$user_id['user_id'];


$sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE user_id=?";

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["searchfield"])) {

  $searchword = '%' . $_POST["searchfield"] . '%';
  $sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE word_name LIKE ? AND user_id=?";

} 

$stmt = mysqli_prepare($link, $sql);


if(mysqli_stmt_param_count($stmt) === 2){
  mysqli_stmt_bind_param($stmt, "si", $searchword, $user_id);
} else {
  mysqli_stmt_bind_param($stmt, "i", $user_id);
}


if(!mysqli_stmt_execute($stmt)){
  error_log("Error executing query in displayvocabbook.php");
  goto close_statement;
}

if(!mysqli_stmt_store_result($stmt)){
  error_log("Error storing results in displayvocabbook.php");
  goto close_statement;
}



if (mysqli_stmt_num_rows($stmt) === 0){ //An empty set is returned
  echo "<br><p>No results found. :'(</p>";

} else { //There are word results to display.
  mysqli_stmt_bind_result($stmt, $word_id, $word_name, $word_meaning);
  echo <<<_END
  <div class="panel-group col-sm-5" id="accordion">
_END;

  while(mysqli_stmt_fetch($stmt)){
    echo <<<_END

    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse$word_id">
          $word_name
          </a>
        </h4>
      </div>
      <div id="collapse$word_id" class="panel-collapse collapse">
        <div class="panel-body">
        Meaning: $word_meaning.<br><br>

        More information of the word will be added...
        </div>
      </div>
    </div>

_END;
  }

  echo <<<_END
  </div>
_END;
  
}


close_statement:
  if(isset($stmt))  //Close statement if set
      mysqli_stmt_close($stmt);

close_connection:
    if(isset($link))   // Close connection if set
        mysqli_close($link);
?>

