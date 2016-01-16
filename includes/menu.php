    <!-- Menu --> 
    <nav class="navbar navbar-fixed-top navbar-bugs4me" role="navigation">
    <div class="navbar-inner">
      <div class="container-fluid">

        <div class="navbar-header">
        <?php
          #$pathtoroot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);
          echo "  <a class='navbar-brand' href='index.php' title='Bugs 4 Me'>";
          echo "  <img class='bug-a-boo' src='" . $pathToRoot . "images/bee.gif' border='0' alt=''><span class='bug-a-boo'>Bugs 4 Me</span></a>" . PHP_EOL;
          //echo "  <img class='bug-a-boo' src='" . $pathToRoot . "images/bee.gif' alt=''>" . PHP_EOL;
        ?>
          <!-- <a class="navbar-brand" href="/index.php">Bugs4me</a>-->
          
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button> <!-- navbar-toggle -->
        </div> <!--/ navbar-header -->

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
<?php
// Load menu selections available once logged in.
if($login->isUserLoggedIn() == true) {
	echo "            <li class='dropdown' id='specimenMenu'>" . PHP_EOL;
	echo "              <a class='dropdown-toggle' data-toggle='dropdown' href='/specimen.php'>Specimen<b class='caret'></b></a>" . PHP_EOL;
	echo "              <ul class='dropdown-menu' role='menu' aria-labelledby='dLabel'>" . PHP_EOL;
	//echo "                <li><a href='/specimen.php'>Manage Specimen</a></li>" . PHP_EOL;
	echo "                <li><a href='" . htmlspecialchars($pathToRoot . 'specimen/specimen.php') . "'>Manage Specimen</a></li>" . PHP_EOL;
	echo "                <li><a href='#'>Collecting Trip</a></li>" . PHP_EOL;
	echo "                <li><a href='#'>Label Printing</a></li>" . PHP_EOL;
	echo "              </ul><!-- class='dropdown-menu' role='menu' aria-labelledby='dLabel' -->" . PHP_EOL;
	echo "            </li>" . PHP_EOL;
}
?>
            <!-- Global menu selections -->
            <li><a href='location.php'>Location</a></li>
            <li><a href="equipment.php">Equipment</a></li>
            <li><a href="preserve.php">Preservation</a><li>
<?php
if ($login->isUserLoggedIn() == true && $login->isUserAdmin() == true) {
    echo "            <li><a href='" . htmlspecialchars($pathToRoot . 'admin/admin.php') . "'>Administration</a></li>" . PHP_EOL;
}
if($login->isUserLoggedIn() == true) {
    // Load menu selections available once logged in.
    echo "            <li><a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?logout'><span class='glyphicon glyphicon-log-out'></span>&nbsp SIGN OUT</a></li>" . PHP_EOL;
}
else { 
    // Load menu selections for not logged in or new user.
    echo "            <li><a href='#' onclick=\"$('#registerModal').modal('toggle');\"><span class='glyphicon glyphicon-user'></span>&nbsp SIGN UP</a></li>" . PHP_EOL;
    echo "            <li><a href='#' onclick=\"$('#loginModal').modal('toggle');\"><span class='glyphicon glyphicon-log-in'></span>&nbsp SIGN IN</a></li>" . PHP_EOL;
}
//echo "           </ul> <!-- class='nav navbar-nav' -->" .PHP_EOL;
?>
          </ul> <!-- class='nav navbar-nav' -->
        </div> <!-- collapse navbar-collapse navbar-right-->

      </div> <!-- container-fluid -->
    </div>
    </nav> <!-- navbar navbar-inverse navbar-fixed-top -->

    <!-- Sign In (login) modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
        
          <!-- Sign In Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN IN</h4>
          </div> <!-- modal-header -->
          
          <!-- Sign In Modal Body -->
          <div class="modal-body">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>" name="loginform">
              <div class="form-group">
                <label for="user_name"><?php echo WORDING_USERNAME; ?></label>
                <input class="form-control" id="user_name" type="text" name="user_name" placeholder="User Name" autofocus required />
              </div> <!-- form-group -->
              <div class="form-group">
                <label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
                <input class="form-control" id="user_password" type="password" name="user_password" placeholder="Password" autocomplete="off" required />
              </div> <!-- form-group -->
              <div class="form-group">
              
                <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
                <label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
               
                <!--
                <p>
                  <script>
                     var stateObj = { foo: "BugaBoo" };
                     window.history.pushState(stateObj, "Bug-a-Boo", "");
                  </script>
                </p>
                -->
                  <p>
                  <input type="submit" class="btn btn-warning btn-block" name="login" value="<?php echo WORDING_LOGIN; ?>" />
                  </p>
                  <p>
                  <a href="register.php"><?php echo WORDING_REGISTER_NEW_ACCOUNT; ?></a>
                  <span class="pull-right">
                     <a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
                  </span>
                  </p>
              </div> <!-- form-group -->
             </form> <!-- method="post" name="login" -->
          </div> <!-- modal-body -->
        </div> <!-- /.modal-content -->
      </div> <!-- /.modal-dialog modal-sm -->
    </div> <!-- class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->

    <!-- Sign Up (register) modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Sign Up Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN UP</h4>
          </div> <!-- modal-header -->
          
          <!-- Sign Up Modal Body -->
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
                <img src="/login/tools/showCaptcha.php" alt="captcha" />
              </div> <!-- form-group showCaptcha -->
              <div class="form-group">
                <label><?php echo WORDING_REGISTRATION_CAPTCHA; ?></label>
                <input class="form-control" type="text" name="captcha" required />
              </div> <!-- form-group enterCaptcha -->
              <p>
                <button type="submit" class="btn btn-warning" name="register"><?php echo WORDING_REGISTER; ?></button><br><br>
                <a href="password_reset.php"><?php echo WORDING_FORGOT_MY_PASSWORD; ?></a>
              </p>
            </form> <!-- method="post" action="index.php" name="loginform" -->
          </div> <!-- class="modal-body" -->
          
        </div><!-- class="modal-content -->
      </div><!-- class="modal-dialog -->
    </div><!-- class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->

    <!-- Error Handling modal -->
    <div class="modal fade" id="loginErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <!-- Error Handling Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title">SIGN IN ERRORS</h4>
          </div> <!-- modal-header -->
          
          <!-- Error Handling Modal Body -->
          <div class="modal-body">
            <p>
<?php
foreach ($login->errors as $error) {
	echo "   $error " . PHP_EOL;
}
?>
            </p>
            <button onclick="toggleLoginModal()" data-dismiss="modal" class="btn btn-warning">Back</button>
          </div> <!-- modal-body -->
          
        </div><!-- class="modal-content" -->
      </div><!-- class="modal-dialog" -->
    </div><!-- class="modal fade" id="loginErrorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->
    
<?php
if((isset($_POST['login']) == WORDING_LOGIN && !empty($login->errors)))
{
	echo "
    <script>
      $(document).ready(function() {
       $('#loginErrorModal').modal('toggle'); 
      });
    </script>
	";
} else {
//echo WORDING_LOGIN . " " . $_POST['login'] . " " . !empty($login->errors);
}
?>