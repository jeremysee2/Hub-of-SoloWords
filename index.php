<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hub of SoloWords - your online vocabulary book</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/scrolling-nav.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="js/scrolling-nav.js"></script>
    <!-- Custom JavaScript for this site -->
    <script src="js/index.js"></script>

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
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#login">Log in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#register">Register</a>
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

    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h2>About this page</h2>
            <p class="lead">This is a great place to talk about your webpage. This template is purposefully unstyled so you can use it as a boilerplate or starting point for you own landing page designs! This template features:</p>
            <ul>
              <li>Clickable nav links that smooth scroll to page sections</li>
              <li>Responsive behavior when clicking nav links perfect for a one page website</li>
              <li>Bootstrap's scrollspy feature which highlights which section of the page you're on in the navbar</li>
              <li>Minimal custom CSS so you are free to explore your own unique design options</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="login" class="bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
          <div class="wrapper">
            <h2>Log in</h2>
            <p class="lead">Log in to access your online vocabulary book</p>
            <form id="login_form" method="post" action="login.php#login">
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="login_username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
              </div>    

              <div class="form-group <?php echo (!empty($passwd_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="login_password" class="form-control">
                <span class="help-block"><?php echo $passwd_err; ?></span>
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
              </div>

            </form>

          </div> 
          </div>
        </div>
      </div>
    </section>

    <section id="register">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
          <div class="wrapper">
            <h2>Sign Up</h2>
            <p>Please fill this form to create an account.</p>

              <form id="registration_form" method="post" action="register.php#register">
                <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label>Username</label>
                  <input type="text" name="reg_username"class="form-control" value="<?php echo $username; ?>">
                  <span class="help-block"><?php echo $username_err; ?></span>
                </div>    

                <div class="form-group <?php echo (!empty($passwd_err)) ? 'has-error' : ''; ?>">
                  <label>Password</label>
                  <input type="password" name="reg_password" class="form-control" value="<?php echo $passwd; ?>">
                  <span class="help-block"><?php echo $passwd_err; ?></span>
                </div>

                <div class="form-group <?php echo (!empty($conf_passwd_err)) ? 'has-error' : ''; ?>">
                  <label>Confirm Password</label>
                  <input type="password" name="reg_confirm_password" class="form-control" value="<?php echo $conf_passwd; ?>">
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



  </body>

</html>
