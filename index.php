<?php
//Set the root path for all files based on the file location of the calling page.
#  $pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/') - 1);
$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);

// Set switches for the header file for the pages leveraging the header file.
$checkLogin = false;  // force login check.
$title = "Bug4me"; // title for the page.
$dbAccess = false;     // flag for DAO object.

require_once($pathToRoot . "includes/header.php");
 ?>

    <!-- Carousel -->
    <div id="bugCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#bugCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#bugCarousel" data-slide-to="1"></li>
        <li data-target="#bugCarousel" data-slide-to="2"></li>
        <li data-target="#bugCarousel" data-slide-to="3"></li>
      </ol> <!-- carousel-indicators -->
      
      <div class="carousel-inner">
      
        <div class="item bg bg1 active">
          <div class="container">
            <div class="carousel-caption">
              <h1>Butterfly</h1>
              <p>La voie du papillon, beauté en vol.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div> <!-- carousel-inner -->
          </div> <!-- container -->
        </div> <!-- item bg bg1 active -->
        
        <div class="item bg bg2">
          <div class="container">
            <div class="carousel-caption">
              <h1>Dragonfly</h1>
              <p>La libellule en vol puissant et pas du genre à s'emmêler avec.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div> <!-- carousel-inner -->
          </div> <!-- container -->
        </div> <!-- item bg bg2 active -->
        
        <div class="item bg bg3">
          <div class="container">
            <div class="carousel-caption">
              <h1>Honey Bee</h1>
              <p>L'abeille crée les bonbons, mais peut apporter la douleur doit-il se sentir acculé.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div> <!-- carousel-inner -->
          </div> <!-- container -->
        </div> <!-- item bg bg3 active -->
        
        <div class="item bg bg4">
          <div class="container">
            <div class="carousel-caption">
              <h1>Grasshopper</h1>
              <p>La sauterelle erre la terre, mais méfiez-vous qu'il ne supprime pas la terre.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div> <!-- carousel-inner -->
          </div> <!-- container -->
        </div> <!-- item bg bg4 active -->
        
      </div> <!-- carousel-inner -->
      
      <a class="left carousel-control" href="#bugCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#bugCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div> <!-- id="bugCarousel" class="carousel slide" data-ride="carousel" -->

<?php
  echo "    <script src='/ent/js/ent.js'></script>" . PHP_EOL;
  // if ($_GET['login'] == 'verify'){
  if ($verification_successful) {
    echo "
      <script>
        $(document).ready(function() {
        alert('".MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL."'); 
        window.location.href='';
        });
      </script>
    ";
  } else if ($_GET['login'] == 'verify' && !$verification_successful){
      echo "
        <script>
          $(document).ready(function() {
          alert('".MESSAGE_REGISTRATION_FAILED."'); 
          window.location.href='';
          });
        </script>
      ";
  }
  require_once("includes/footer.php");
?>