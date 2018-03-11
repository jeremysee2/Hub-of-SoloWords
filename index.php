<?php

/*
  @file
  
  Last modification: 11 March 2018

  This php file is the website homepage
  
*/

ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <head>
        <script src='js/index.js'> </script>
        <script src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.js'></script>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    </head>
<?php require_once 'navBar.php'; ?>

<body>

    <?php

        $userstr = ' (Guest)';

        if (isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $isLoggedin = TRUE;
        $userstr = " ($user)";
        } else {
        $isLoggedin = FALSE;
        }
    ?>

    <center>
    <?php if ($isLoggedin): /*if there is a user logged in*/ ?>
        <h3> <?php echo $user; ?>'s vocab book</h3>

        <div class="input-group col-sm-5">
            <input type="text" class="form-control" type='text' id='searchfield' placeholder="Search a word">
            <div class="input-group-btn">
            <button class="btn btn-default" id='submitSearch'>
                <i class="glyphicon glyphicon-search"></i>
            </button>
            </div>
        </div>

        <div id='myvocabbook'></div>
    <?php else: /* If there is no user logged in */ ?>
        <p>Please log in to use the search function</p>
    <?php endif; ?>
    </center>

</body>
</html>

<form>

</form>