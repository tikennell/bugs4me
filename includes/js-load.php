<?php
  //Set the root path for all files based on the file location of the calling page.
  #$pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);
  $pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);
  
  echo "    <script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "bootstrap/js/jquery.min.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "bootstrap/js/bootstrap.min.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/bootbox.min.js' type='text/javascript'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/geo.js' type='text/javascript'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/specimen.js' type='text/javascript'></script>" . PHP_EOL;
  
?>