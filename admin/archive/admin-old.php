<?php 
// Check to see if the user is logged in.
  $pathtoroot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);
  
  require_once($pathtoroot . "includes/check-login.php");
  require_once($pathtoroot . "classes/dao.php");

  $daoMethodOfCapture = new MethodOfCapture();
?>

<html lang="en">
  <head>
    <title>Bug a Boo</title>
  
<?php
// Check whether the user is logged in or send them back to the main menu.
$pathtoroot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);

//Bootstrap links to Metadata, CSS, JS, etc. and navigation bar
require_once($pathtoroot . "includes/doc-setup.php");

// Link to javascript google library and external javascript files. -->
require_once($pathtoroot . "includes/js-load.php");

//Menu based on whether the individual is logged in or not.
require_once($pathtoroot . "includes/menu.php");
?>

    </head>

    <body>
    
        <br><br><br>
        <div class="admin">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="well bs-sidebar affix" id="sidebar">
                        <ul class="nav nav-bar nav-stacked">

                            <li role="presentation" class="active"><a class="collapsed" data-toggle="collapse" href="#classification" aria-expanded="true" aria-controls="classification">Classification</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" href="#classificationLevel" aria-expanded="false" aria-controls="classificationLevel">Classification Level</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" href="#classificationHierarchy" aria-expanded="false" aria-controls="classificationHierarchy">Classification Hierarchy</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" href="#methodOfCapture" aria-expanded="false" aria-controls="methodOfCapture">Method of Capture</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" href="#specimenGender" aria-expanded="false" aria-controls="specimenGender">Specimen Gender</a></li>                        
                        
                           
                          <!--  <li role="presentation" class="active"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classification" aria-expanded="true" aria-controls="classification">Classification</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classificationLevel" aria-expanded="false" aria-controls="classificationLevel">Classification Level</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classificationHierarchy" aria-expanded="false" aria-controls="classificationHierarchy">Classification Hierarchy</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#methodOfCapture" aria-expanded="false" aria-controls="methodOfCapture">Method of Capture</a></li>
                            <li role="presentation"><a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#specimenGender" aria-expanded="false" aria-controls="specimenGender">Specimen Gender</a></li> -->
                        </ul> <!-- nav nav-bar nav-stacked -->
                    </div> <!-- well bs-sidebar affix -->
                </div> <!-- col-md-3 col-sm-3 col-xs-3-->
                <div class="panel-group col-md-9 col-sm-9 col-xs-9" id="accordion" role="tablist" aria-multiselectable="true">
                
                    <!-- Classification panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                              <!--  <a data-toggle="collapse" data-parent="#accordion" href="#classification" aria-expanded="true" aria-controls="classification">Classification</a> -->
                                <a data-toggle="collapse" href="#classification" aria-expanded="true" aria-controls="classification">Classification</a>
                            </h4> <!-- class="panel-title" -->
                        </div> <!-- class="panel-heading" role="tab" id="headingTwo" -->
                        <div id="classification" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                            <div class="panel-body">
                                To be Classified
                            </div> <!-- class="panel-body" -->
                        </div> <!-- id="classification" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" -->
                    </div> <!-- class="panel panel-default" -->
    
                    <!-- Classification Level panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingClassificationLevel">
                            <h4 class="panel-title">
                              <!--  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classificationLevel" aria-expanded="false" aria-controls="classificationLevel">Classification Level</a> -->
                                <a class="collapsed" data-toggle="collapse" href="#classificationLevel" aria-expanded="false" aria-controls="classificationLevel">Classification Level</a>
                            </h4> <!-- class="panel-title" -->
                        </div> <!-- class="panel-heading" role="tab" id="headingClassificationLevel" -->
                        <div id="classificationLevel" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingClassificationLevel">
                            <div class="panel-body">
                                Classification Level
                            </div> <!-- class="panel-body" -->
                        </div> <!-- id="classificationLevel" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingClassificationLevel" -->
                    </div> <!-- class="panel panel-default" -->
    
                    <!-- Classification Hierarchy panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingClassificationHierarchy">
                            <h4 class="panel-title">
                              <!--  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classificationHierarchy" aria-expanded="false" aria-controls="classificationHierarchy">Classification Hierarchy</a> -->
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#classificationHierarchy" aria-expanded="false" aria-controls="classificationHierarchy">Classification Hierarchy</a>
                            </h4> <!-- class="panel-title" -->
                        </div> <!-- class="panel-heading" role="tab" id="headingClassificationHierarchy" -->
                        <div id="classificationHierarchy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingClassificationHierarchy">
                            <div class="panel-body">
                                Classification Hierarchy
                            </div> <!-- class="panel-body" -->
                        </div> <!-- id="classificationHierarchy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingClassificationHierarchy" -->
                    </div> <!-- class="panel panel-default" -->
    
                    <!-- Method of Capture panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingMethodOfCapture">
                            <h4 class="panel-title">
                              <!--  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#methodOfCapture" aria-expanded="false" aria-controls="methodOfCapture">Method of Capture</a> -->
                                <a class="collapsed" data-toggle="collapse" href="#methodOfCapture" aria-expanded="false" aria-controls="methodOfCapture">Method of Capture</a>
                            </h4> <!-- class="panel-title -->
                        </div> <!-- class="panel-heading" role="tab" id="headingMethodOfCapture -->
                        <div id="methodOfCapture" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMethodOfCapture">
                            <div class="panel-body">
                                <form class="form container-fluid" role="form" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                                    <!-- <input name="methodOfCaptureId" type="hidden" class="form-control" id="methodOfCaptureId"><br> -->
                                    <label for="methodOfCaptureId">Method of Capture</label>
                                    <select name="methodOfCaptureId" class="form-control" id="methodOfCaptureId">
                                        <option value=""></option>
<?php                              
$result = $daoMethodOfCapture->getAllMethodOfCapture(); 
foreach($result as $row) {
	echo '                                   <option value="' . $row->MethodOfCaptureId . '">' . $row->MethodOfCapture . '</option>' . PHP_EOL;
}
?>

                                  </select><br>
                                    <input href="admin.php" class="btn btn-warning" type="submit" name="SaveCapture" value="Save"/>
                                    <input href="admin.php" class="btn btn-warning" type="submit" name="DeleteCapture" value="Delete"/><br>
                                </form> <!-- class="form container-fluid" role="form" method="get" action="" -->
                            </div> <!-- class="panel-body" -->
                        </div> <!-- id="methodOfCapture" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingMethodOfCapture" -->
                    </div> <!-- class="panel panel-default" -->
    
                    <!-- Specimen Gender panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingSpecimenGender">
                            <h4 class="panel-title">
                              <!--   <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#specimenGender" aria-expanded="false" aria-controls="specimenGender">Specimen Gender</a>  -->
                                <a class="collapsed" data-toggle="collapse" href="#specimenGender" aria-expanded="false" aria-controls="specimenGender">Specimen Gender</a>
                            </h4> <!-- class="panel-title -->
                        </div> <!-- class="panel-heading" role="tab" id="headingSpecimenGender" -->
                        <div id="specimenGender" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSpecimenGender">
                            <div class="panel-body">
                                Specimen Gender
                            </div> <!-- class="panel-body" -->
                        </div> <!-- id="specimenGender" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSpecimenGender" -->
                    </div> <!-- class="panel panel-default" -->
    
            </div> <!-- class="row" -->
        </div> <!-- class="admin" -->
        
    </body>
</html>