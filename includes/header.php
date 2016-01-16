<?php
/**
 * A simple PHP Login Script / ADVANCED VERSION
 * For more versions (one-file, minimal, framework-like) visit http://www.php-login.net
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */

 #Debugging turned on.
#error_reporting(E_ALL);
#ini_set("display_errors", 1);
 
session_start();

  //Set the root path for all files based on the file location of the calling page.
#  $pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/') - 1);
$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);
  
// check for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once($pathToRoot . 'login/libraries/password_compatibility_library.php');
}

// include the config
require_once($pathToRoot . 'login/config/config.php');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once($pathToRoot . 'login/translations/en.php');

// include the PHPMailer library
require_once($pathToRoot . 'login/libraries/PHPMailer.php');

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
// load the login class
require_once($pathToRoot . 'login/classes/Login.php');
$login = new Login();

// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
// load the registration class
require_once($pathToRoot . 'login/classes/Registration.php');
$registration = new Registration();

if ($dbAccess) {
// Data access object creation.
  require_once($pathToRoot . "classes/dbDAO.php");
  require_once($pathToRoot . "/classes/methodOfCaptureDAO.php");
  $daoMethodOfCapture = new MethodOfCapture();
}
?>
<!DOCTYPE html>
<html lang="en-us"> 
  <head>
    <link rel='shortcut icon' href='/dragon_fly.png' type='image/png'>
    <title><?php echo $title ?></title>
  
<?php

//Bootstrap links to Metadata, CSS, JS, etc. and navigation bar
require_once($pathToRoot . "includes/doc-setup.php");

// Link to javascript google library and external javascript files. -->
require_once($pathToRoot . "includes/js-load.php");

if ($checkLogin) {
  if($login->isUserLoggedIn() == false){
	header('Location: ' . $pathToRoot . 'index.php?logout');
  }
}

?>
  </header>
  
  <body>
  
<?php
//Menu based on whether the individual is logged in or not.
require_once($pathToRoot . "includes/menu.php");
?>