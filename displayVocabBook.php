<?php
ob_start();
session_start();

/*
  @file

  Last modification: 11 March 2018

  This php file displays words saved by a particular user to the website.
  It does NOT generate a complete HTML page by itself. 

*/

?>

<style>
table {
    width: 300px;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}


th {text-align: left;}
</style>

<?php

require_once 'login_database_config.php';


//These 4 lines of code obtain the registered user's user_id so the words he added in addWord.php shows up here.
$sql = "SELECT user_id FROM users WHERE username=\"". $_SESSION['user']."\"";
$query_result = mysqli_query($link,$sql);
$user_id = mysqli_fetch_array($query_result, MYSQLI_ASSOC);
$user_id=$user_id['user_id'];



$sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE user_id=\"" . $user_id."\"";

if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST["searchfield"])) {
  $searchword = $_POST["searchfield"];
  $sql = "SELECT word_id, word_name, word_meaning FROM word_storage WHERE word_name LIKE '%".$searchword."%' AND user_id=" . $user_id; //This search is INSECURE.
}

$result = mysqli_query($link,$sql);

if (!$result || $result->num_rows === 0) { //Empty set is returned
  echo "<br><p>No results found. :'(</p>";
} else {
  echo "<br>
  <table>
  <tr>
  <th>Word name</th>
  </tr>";
  while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td>" . $row['word_name'] . "
      <button data-toggle='collapse' data-target='#showID" . $row['word_id'] . "'>Meaning</button>

      <button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#modalCenterFor" . $row['word_id'] . "\"> Show meaning in modal </button>

      <div id='showID". $row['word_id'] . "' class='collapse'>" . $row['word_meaning'] . "</div>

      <div class=\"modal fade\" id=\"modalCenterFor" .$row['word_id'] . "\"tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalCenterTitle\" aria-hidden=\"true\">
        <div class=\"modal-dialog modal-dialog-centered\" role=\"document\">
        <div class=\"modal-content\">
          <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"exampleModalLongTitle\"> " . $row['word_name'] . " </h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
              <span aria-hidden=\"true\">&times;</span>
            </button>
          </div>
          <div class=\"modal-body\">
            Meaning of the word: " . $row['word_meaning'] . "
          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
            <button type=\"button\" class=\"btn btn-primary\">Save changes</button>
          </div>
        </div>
      </div>
      
      </td>";
      echo "</tr>";
  }
  echo "</table>";
}

close_connection:
    if(isset($link))   // Close connection if set
        mysqli_close($link);
?>
