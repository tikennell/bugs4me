<?php
// Set the root path for all files based on the file location of the calling page.
$pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/')-1);

// Set switches for the header file for the pages leveraging the header file.
$checkLogin = true;  // force login check.
$title = "Bugs4me"; // title for the page.
$dbAccess = true;     // flag for DAO object.

require_once($pathToRoot . "includes/header.php");
?>

    <!-- Main body of the page -->
    <div class="container-fluid container-format">
    
      <!-- Left Nav for Administration -->
      <div id='leftNavMenu' class="leftNavMenu col-md-3 col-sm-3 col-xs-3">
        <ul>
          <li class='leftNavMenuActive'><a href='#'><span>Administration</span></a></li>
          <li class='leftNavSubMenu'><a href='#'><span>Classification</span></a>
            <ul>
              <li><a data-toggle="collapse" data-parent="#accordion" href="#classifications" aria-expanded="true" aria-controls="classifications"><span>Classifications</span></a></li>
              <li><a data-toggle="collapse" data-parent="#accordion" href="#levels" aria-expanded="true" aria-controls="levels"><span>Levels</span></a></li>
              <li class="last"><a data-toggle="collapse" data-parent="#accordion" href="#hierarchy" aria-expanded="true" aria-controls="hierarchy"><span>Hierarchy</span></a></li>
            </ul>
          <li><a data-toggle="collapse" data-parent="#accordion" href="#methodOfCapture" aria-expanded="true" aria-controls="methodOfCapture"><span>Method Of Capture</span></a></li>
          <li class='last'><a data-toggle="collapse" data-parent="#accordion" href="#specimen" aria-expanded="true" aria-controls="specimen"><span>Specimen Gender</span></a></li>
        </ul>
      </div> <!-- id='leftNavMenu' class="leftNavMenu col-md-3 col-sm-3 col-xs-3" -->

      <div class="panel-group col-md-9 col-sm-9 col-xs-9" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div id="classifications" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingClassifications">To be Classified</div>
            <div id="levels" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingLevels">Leveled</div>
            <div id="hierarchy" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingHierarchy">Hierarchy</div>
        
            <!-- Method of Capture table -->
            <div id="methodOfCapture" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th><input id="selectAllChkBoxes" type="checkbox" name="selectAllMOC" value ="unchecked"></th>
                          <th><span id="tblHeaderText" >Method of Capture</span></th>
                        </tr>
                      </thead>
                      <tbody id="tableRowCol"></tbody>  
                    </table>
                  </div>  <!-- class="table-responsive" -->

                  <div class="container-fluid">
                    <div class="row tableNav">

                      <!-- Table action buttons -->
                      <div class="actionButtons">
                        <a class="btn btn-mini" type="submit" name="addMOC" value="Add" data-toggle="modal" data-target="#addMOCModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                        <a class="btn btn-mini" type="submit" id="editMOCModalButton" name="editMOC" value="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
                        <a class="btn btn-mini" type="submit" name="deleteMOC" value="Delete" data-toggle="modal" data-target="#deleteMOCModal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a>
                      </div>  <!-- class="actionButtons pull-left" -->
        
                       <!-- Table record navigation -->
                      <div class="pageNav pull-right">
                      
                        <!-- Select number of records to display in the table. -->
                        <div class="pull-left">
                          <label for="tableRows">Table rows:&nbsp&nbsp</label>
                          <select name="tableRows" class="tableRows" id="tableRows" onchange="showMOC($('select option:selected').val())">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option value="10" selected="selected">10</option>
                            <option value="20">20</option>
                          </select>
                        </div> <!-- class="pull-left" -->
                
                        <div class="btn-group">
                          <input href="admin.php" class="btn btn-mini" type="submit" name="firstButton" value="&#171;"/>
                          <input onclick="showMOC($('select option:selected').val())" class="btn btn-mini" type="submit" name="prevButton" value="&#8249;"/>
                          <input class="btn btn-mini" id="btn-mini-text" type="text" name="pageTracker" disabled="disabled" value="Page: "/>
                          <input href="admin.php" class="btn btn-mini" type="submit" name="nextButton" value="&#8250;"/>
                          <input href="admin.php" class="btn btn-mini" type="submit" name="lastButton" value="&#187;"/>
                        </div>  <!-- class="btn-group pull-right" -->
                        
                      </div>  <!-- class="pageNav" pull-right -->
                      
                    </div>  <!-- class="row tableNav" -->
                    
                  </div>  <!-- class="container-fluid" -->
               
              </div>  <!-- class="panel-body" -->
              
            </div> <!-- id="methodOfCapture" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" -->
        
            <!-- Method of Capture Add modal -->
            <div class="modal fade" id="addMOCModal" tabindex="-1" role="dialog" aria-labelledby="addMOCModal" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
        
                  <!-- Method of Capture Modal Header -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">ADD - Method of Capture</h4>
                  </div> <!-- modal-header -->
             
                  <!-- Method of Capture Modal Body -->
                  <div class="modal-body">
                    <form class="form-inline" id="addMethodOfCapture" method="get" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>">
                      <div class="form-group">
                        <label for="addMethodOfCapture" class="control-label">Enter Method of Capture:</label>
                        <div>
                          <input class="form-control" id="addMethodOfCapture" type="text" name="addMethodOfCapture" autofocus required>
                        </div>
                      </div> <!-- form-group -->
                    </form> <!-- method="post" name="login" -->
                  </div> <!-- modal-body -->
                
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-sm" form="addMethodOfCapture" name="addMOC" value="Create"/>
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                  </div>
              
                </div> <!-- /.modal-content -->

              </div> <!-- /.modal-dialog modal-sm -->

            </div> <!-- class="modal fade" id="addMOCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->
            
            
            <!-- Method of Capture Edit modal -->
            <div class="modal fade" id="editMOCModal" tabindex="-1" role="dialog" aria-labelledby="editMOCModal" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
        
                  <!-- Method of Capture Modal Header -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Method of Capture - Edit</h4>
                  </div> <!-- modal-header -->
          
                  <!-- Method of Capture Modal Body -->
                  <div class="modal-body">
                    <form class="form-inline" id="editMOCForm" method="get" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>">
    
                      <div class="form-group">
                        <label for="editMethodOfCapture" class="control-label">Method of Capture:</label>
                        <div>
                          <input class="form-control" id="editMethodOfCapture" type="text" name="editMethodOfCapture" autofocus required>
                        </div>
                      </div> <!-- form-group -->
                    </form> <!-- method="post" name="login" -->
                  </div> <!-- modal-body -->
               
                  <div class="modal-footer">
                    <input type="submit" class="btn btn-primary btn-sm" form="editMOCForm" name="editMOC" value="Update"/>
                    <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
                  </div>
              
                </div> <!-- /.modal-content -->
              </div> <!-- /.modal-dialog modal-sm -->
            </div> <!-- class="modal fade" id="editMOCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->

            <div  id="specimen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSpecimen">Specimen Gender</div>

        </div> <!-- class="panel-body" -->

      </div> <!-- class="panel-group col-md-9 col-sm-9 col-xs-9" id="accordion" role="tablist" aria-multiselectable="true" -->

    </div> <!-- class="container-fluid container-format" -->
    
<?php
  echo "    <script src='" . $pathToRoot . "js/ent.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/ent-db.js'></script>" . PHP_EOL;
?>
    <!-- Creates the Method of Capture Table with values. -->
    <script>showMOC($("select option:selected").val());</script>
    
<!-- Close the body and put in the footer -->    
<?php require_once($pathToRoot . "includes/footer.php"); ?>

</html>
