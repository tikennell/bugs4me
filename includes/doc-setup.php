    <!-- Header -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
<?php

  //Set the root path for all files based on the file location of the calling page.
#  $pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);

  // Bootstrap core CSS
  echo "    <link rel='stylesheet' href='" . $pathToRoot . "bootstrap/css/bootstrap.min.css'>" . PHP_EOL . PHP_EOL;
  echo "    <link rel='stylesheet' href='" . $pathToRoot . "bootstrap/css/bootstrap-theme.min.css'>" . PHP_EOL . PHP_EOL;
  
  // Custom styles for this template
   echo "    <link rel='stylesheet' href='" . $pathToRoot . "css/ent.css'>" . PHP_EOL . PHP_EOL;
?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
    <script src= "http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script> -->
