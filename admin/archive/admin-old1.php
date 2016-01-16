<?php
//b Set the root path for all files based on the file location of the calling page.
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
              <li><a href='#'><span>Classifications</span></a></li>
              <li><a href='#'><span>Levels</span></a></li>
              <li class="last"><a href='#'><span>Hierarchy</span></a></li>
            </ul>
          <li><a href='#methodOfCapture'><span>Method Of Capture</span></a></li>
          <li class='last'><a href='#specimenGender'><span>Specimen Gender</span></a></li>
        </ul>
    
      </div> <!-- id='leftNavMenu' class="col-sm-2" -->

      <div class="adminPanels col-md-9 col-sm-9 col-xs-9">
        <div>To be Classified</div>
        <div>Leveled</div>
        <div>Hierarchy</div><br />
   
        <!-- Method of Capture table-->
        <div class="container-fluid" id="methodOfCapture">
          <div class="row">
          <form class="form" id="tableForm" role="form" name="tableForm" method="get" action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th><input id="selectAllChkBoxes" type="checkbox" name="selectAllMOC" value ="unchecked"></th>
                      <th><span id="tblHeaderText" >Method of Capture</span></th>
                    </tr>
                  </thead>
                  <tbody>
<?php
// Get the amount of rows to be displayed.
$rowCount = isset($_GET['tableRows']) ? $_GET['tableRows'] : 10;
$recordPointer = isset($_SESSION['recordPointer']) ? $_SESSION['recordPointer'] : 0; 
echo "Record pointer: " . !empty($_SESSION['recordPointer']);
$i = 0;

// Display records based on the last record pointer and amount of records to show.
foreach($daoMethodOfCapture->getAllMethodOfCapture() as $row) {
	if ($i >= $recordPointer) {
		if ($i < $rowCount) {
			echo '
                      <tr>
                        <td><input type="checkbox" class="moc" name="moc[]" value ="' . $row->MethodOfCaptureId . '"></td>
                        <td>' . $row->MethodOfCapture . '</td>
                      <tr>' . PHP_EOL;
		}
		else {
			break;
		}
	}
	$i++;
}
?>
                  </tbody>  
                </table>
              </div>  <!-- class="table-responsive" -->
       
              <div class="container-fluid">
                <div class="row tableNav">
                
                  <!-- Table action buttons -->
                  <div class="actionButtons">
                   <a class="btn btn-mini" type="submit" name="addMOC" value="Add" data-toggle="modal" data-target="#addMOCModal">Add</a>
                   <input href="admin.php" class="btn btn-mini" type="submit" name="deleteMOC" value="Delete"/>
                   <a class="btn btn-mini" type="submit" name="updateMOC" value="Update" data-toggle="modal" data-target="#updateMOCModal">Update</a>
                  </div>  <!-- class="actionButtons pull-left" -->
                  
                  <!-- Table record navigation -->
                  <div class="pageNav pull-right">
                  
                    <!-- Select number of records to display in the table. -->
                    <div class="pull-left">
                      <label for="tableRows">Table pages:</label>
                      <select name="tableRows" class="tableRows" id="tableRows" onclick="">
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="25">25</option>
                      </select>
            
                      <script>
                        $("select option").filter(function() {
                          var tablePageValue = decodeURI(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURI("tableRows").replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
                          
                          if (tablePageValue === undefined) {tablePageValue = "10";}
                          return $(this).text() == tablePageValue; 
                        }).prop('selected', true);
                      </script>
                      
                    </div>  <!-- class="pull-left" -->
                    
                    <!-- Table row navigation with display of current page and number of pages. -->
                    <div class="btn-group">
                      <input href="admin.php" class="btn btn-mini" type="submit" name="firstButton" value="&#171;"/>
                      <input href="admin.php" class="btn btn-mini" type="submit" name="prevButton" value="&#8249;"/>
                      <input class="btn btn-mini" id="btn-mini-text" type="text" name="pageTracker" value="Records" disabled="disabled"/>
                      <input href="admin.php" class="btn btn-mini" type="submit" name="nextButton" value="&#8250;"/>
                      <input href="admin.php" class="btn btn-mini" type="submit" name="lastButton" value="&#187;"/>
                    </div>  <!-- class="btn-group pull-right" -->
                    
                  </div>  <!-- class="pageNav" -->
                  
                </div>  <!-- class="row" -->
              </div>  <!-- class="container-fluid" -->

            </form>  <!-- class="form" role="form" method="get" action="echo htmlspecialchars($_SERVER["PHP_SELF"]);" -->
          </div>  <!-- class="row" -->
        </div>  <!-- class="container-fluid" -->
        
        <!-- Method of Capture Add modal -->
        <div class="modal fade" id="addMOCModal" tabindex="-1" role="dialog" aria-labelledby="addMOCModal" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
        
              <!-- Method of Capture Modal Header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Method of Capture - Add</h4>
              </div> <!-- modal-header -->
          
              <!-- Method of Capture Modal Body -->
              <div class="modal-body">
                <form class="form-inline" id="addMethodOfCapture" method="get" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>">
    
                  <div class="form-group">
                    <label for="addMethodOfCapture" class="control-label">Method of Capture:</label>
                    <div>
                      <input class="form-control" id="addMethodOfCapture" type="text" name="methodOfCapture" placeholder="Enter new method of capture" autofocus required>
                    </div>
                  </div> <!-- form-group -->
                </form> <!-- method="post" name="login" -->
              </div> <!-- modal-body -->
              
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" form="addMethodOfCapture" name="addMOC" value="Create"/>
              </div>
              
            </div> <!-- /.modal-content -->
                          <script>document.forms['addMOCModal'].auth_username.focus();</script>
          </div> <!-- /.modal-dialog modal-sm -->


        </div> <!-- class="modal fade" id="addMOCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->

        <!-- Method of Capture Update modal -->
        <div class="modal fade" id="updateMOCModal" tabindex="-1" role="dialog" aria-labelledby="updateMOCModal" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
        
              <!-- Method of Capture Modal Header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Method of Capture - Update</h4>
              </div> <!-- modal-header -->
          
              <!-- Method of Capture Modal Body -->
              <div class="modal-body">
                <form class="form-inline" id="updateMethodOfCapture" method="get" action="<?php echo htmlspecialchars($_SERVER['SCRIPT_NAME']);?>">
    
                  <div class="form-group">
                    <label for="updateMethodOfCapture" class="control-label">Method of Capture:</label>
                    <div>
                      <input class="form-control" id="updateMethodOfCapture" type="text" name="methodOfCapture" placeholder="Enter new method of capture" autofocus required>
                    </div>
                  </div> <!-- form-group -->
                </form> <!-- method="post" name="login" -->
              </div> <!-- modal-body -->
               
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" form="updateMethodOfCapture" name="updateMOC" value="Create"/>
              </div>
              
            </div> <!-- /.modal-content -->
                          <script>document.forms['updateMOCModal'].auth_username.focus();</script>
          </div> <!-- /.modal-dialog modal-sm -->

        </div> <!-- class="modal fade" id="updateMOCModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" -->

        <div class="container-fluid" id="specimenGender">Specimen Gender</div>

      </div> <!-- class="container-fluid container-format" -->
    
    </div> <!-- class="container-fluid" -->
<?php
  echo "    <script src='" . $pathToRoot . "js/ent.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/ent-db.js'></script>" . PHP_EOL;
?>
    
<!-- Close the body and put in the footer -->    
<?php require_once($pathToRoot . "includes/footer.php"); ?>

</html>