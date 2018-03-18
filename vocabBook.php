

<?php

ob_start();
session_start();


$isLoggedin = FALSE;

if (isset($_SESSION['user'])){

  $user = $_SESSION['user'];
  $isLoggedin = TRUE;

} else {

  header("HTTP/1.1 401 Authorization Required"); 

}

?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>My Vocab Book</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">SW.js</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#vocabBook">View My Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#addWord">Add more words</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="header-site text-white">
      <div class="container text-center">
        <h1>Welcome to Hub of Solowords</h1>
        <p class="lead">Your repository of words, anytime, anywhere</p>
      </div>
    </header>

    <section id="vocabBook" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
          <div class="wrapper">

            <h2>Your Vocab Book</h2>
            <div class="input-group">
              <input type="text" class="form-control" id='searchfield' placeholder="Search a word">
                <div class="input-group-btn">
                  <button class="btn btn-default" id='submitSearch'>
                    <i class="fa fa-search"></i>
                  </button>
                </div>
            </div>
            <br>
            <div id='myvocabbook'></div>

          </div> 
          </div>
        </div>
      </div>
    </section>

    <section id="addWord">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
          <div class="wrapper">
            <h2>Add more words</h2>
            <p>Supplement your vocabulary book with more words</p>

              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label>Word</label>
                  <input type="text" name="word" class="form-control" value="<?php echo $username; ?>">
                  <span class="help-block"><?php echo $username_err; ?></span>
                </div>    

                <div class="form-group <?php echo (!empty($passwd_err)) ? 'has-error' : ''; ?>">
                  <label>Meaning</label>
                  <textarea name="meaning" class="form-control" rows="5"></textarea>
                  <span class="help-block"><?php echo $passwd_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($conf_passwd_err)) ? 'has-error' : ''; ?>">
                  <label>Other notes</label>
                  <textarea name="meaning" class="form-control" rows="5"></textarea>
                  <span class="help-block"><?php echo $conf_passwd_err; ?></span>
                </div>

                <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Submit">
                  <input type="reset" class="btn btn-default" value="Reset">
                </div>

              </form>

          </div>  
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; SW.js</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>

  </body>

</html>
