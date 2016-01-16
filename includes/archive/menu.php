    
    <!-- Menu --> 
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
        <?php
          $pathtoroot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);
          echo "<img class='bug-a-boo' src='" . $pathtoroot . "images/bee.gif' alt=''>";
        ?>
          <a class="brand" href="index.php">Bug A Boo</a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> <!-- navbar-toggle -->
    
        </div> <!--/ navbar-header -->
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav">
<?php
  // Load menu selections available once logged in.
  if($login->isUserLoggedIn() == true) {
     echo "            <li class='dropdown' id='specimenMenu'>" . PHP_EOL;
     echo "              <a class='dropdown-toggle' data-toggle='dropdown' href='#'>Specimen<b class='caret'></b></a>" . PHP_EOL;
     echo "              <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>" . PHP_EOL;
     echo "                <li><a href='#'>Manage Specimen</a></li>" . PHP_EOL;
     echo "                <li><a href='#'>Collecting Trip</a></li>" . PHP_EOL;
     echo "                <li><a href='#'>Label Printing</a></li>" . PHP_EOL;
     echo "              </ul> <!-- class='dropdown-menu' role='menu' aria-labelledby='dLabel' -->" . PHP_EOL;
  }
?>
            <!-- Global menu selections -->
            <li><a href='location.php'>Location</a></li>
            <li><a href="equipment.php">Equipment</a></li>
            <li><a href="preserve.php">Preservation</a><li>
          </ul> <!-- class="nav navbar-nav" -->
<?php
  if($login->isUserLoggedIn() == true) {
  // Load menu selections available once logged in.
    echo "          <a href='index.php?logout' class='btn btn-default navbar-btn btn-sm login'>SIGN OUT</a>" . PHP_EOL;
  }
  else {
    // Load menu selections for not logged in or new user.
    echo "          <a href='#' onclick=\"$('#registerModal').modal('toggle');\" class='btn btn-default navbar-btn btn-sm login'>SIGN UP</a>" . PHP_EOL;
    echo "          <a href='#' onclick=\"$('#loginModal').modal('toggle');\" class='btn btn-default navbar-btn btn-sm login'>SIGN IN</a>" . PHP_EOL;
  }
?>
        </div> <!-- collapse navbar-collapse navbar-right-->
      </div> <!-- container-fluid -->
    </div> <!-- navbar navbar-inverse navbar-fixed-top -->
    
    <!-- Sign In (login) modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN IN</h4>
          </div> <!-- modal-header -->
          <div class="modal-body">

            <form method="post" name="loginform">
              <div class="form-group">
                <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
                <input class="form-control" id="user_name" type="text" name="user_name" placeholder="User Name" required />
              </div> <!-- form-group -->
              <div class="form-group">
                <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
                <input class="form-control" id="user_password" type="password" name="user_password" placeholder="Password" autocomplete="off" required />
              </div> <!-- form-group -->
              <div class="form-group">
                <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
                <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
                <p>
                <input type="submit" class="btn btn-warning" name="login" value="<?php echo WORDING_LOGIN; ?>" /><br>
                </p>
                <p>
                   <a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
                   <a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
                </p>
              </div> <!-- form-group -->
             </form> <!-- method="post" name="login" -->
          </div> <!-- modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Sign Up (register) modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN UP</h4>
          </div> <!-- modal-header -->
          <div class="modal-body">
    
            <form method="post" action="index.php" name="registerform">
              <div class="form-group">
                <label for="user_name"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
                <input class="form-control" id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="User Name" required />
              </div> <!-- form-group user_name -->
              <div class="form-group">
                <label for="user_email"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
                <input class="form-control" id="user_email" type="email" name="user_email" placeholder="Email Address" required />
              </div> <!-- form-group email -->
              <div class="form-group">
                <label for="user_password_new"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
                <input class="form-control" id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" placeholder="Password" required autocomplete="off" />
              </div> <!-- form-group user_password_new -->
              <div class="form-group">
                <label for="user_password_repeat"><?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?></label>
                <input class="form-control" id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" placeholder="Confirm Password" required autocomplete="off" />
              </div> <!-- form-group user_password_repeat -->
              <div class="form-group">
                <img src="login/tools/showCaptcha.php" alt="captcha" />
                </div> <!-- form-group showCaptcha -->
              <div class="form-group">
                <label><?php echo WORDING_REGISTRATION_CAPTCHA; ?></label>
                <input class="form-control" type="text" name="captcha" required />
              </div> <!-- form-group enterCaptcha -->
              <p class="registerLinks">
                <a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
              </p>
              <p>
                <button type="submit" class="btn btn-warning" name="register"><?php echo WORDING_REGISTER; ?></button>
              </p>
            </form> <!-- method="post" action="index.php" name="loginform" -->
            <div><p><br></p></div> <!-- Adding extra space in the modal below the Sign Up button -->
          </div> <!-- modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- Error Handling modal -->
    <div class="modal fade" id="loginErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN IN ERRORS</h4>
          </div> <!-- modal-header -->
          <div class="modal-body">
            <p>
<?php
foreach ($login->errors as $error) {
	echo "   $error" . PHP_EOL;
}
?>
            <p>
            <button onclick="toggleLoginModal()" data-dismiss="modal" class="btn btn-warning">Back</button>
          </div> <!-- modal-body -->
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        function toggleLoginModal() {
          $('#loginModal').modal('toggle');
        };
    </script>
   
   <?php
   echo $_POST['login'] . " " . empty($login->errors) . PHP_EOL;
if(($_POST['login'] == "Sign in" && !empty($login->errors)))
{
	echo "
    <script>
      $(document).ready(function() {
       $('#loginErrorModal').modal('toggle'); 
      });
    </script>
	";
}
?>
<?php //echo PHP_EOL ?>
