<?php
//Set the root path for all files based on the file location of the calling page.
#$pathToRoot = str_repeat('../' , substr_count( pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_DIRNAME) , '/') - 1);
$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);

// Set switches for the header file for the pages leveraging the header file.
$checkLogin = true;  // force login check.
$title = "Bugs4me"; // title for the page.
$dbAccess = true;     // flag for DAO object.

#Debugging turned on.
#error_reporting(E_ALL);
#ini_set("display_errors", 1);

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
                        <a class="btn btn-mini" type="submit" id="addMOCModalButton" name="addMOC" value="Add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add</a>
                        <a class="btn btn-mini" type="submit" id="editMOCModalButton" name="editMOC" value="Edit"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
                        <a class="btn btn-mini" type="submit" id="deleteMOCModalButton" name="deleteMOC" value="Delete" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a>
                      </div>  <!-- class="actionButtons" -->
        
                       <!-- Table record navigation -->
                      <div class="pageNav pull-right">
                      
                        <!-- Select number of records to display in the table. -->
                        <div class="pull-left">
                          <label for="tableRows">Table rows:&nbsp&nbsp</label>
                          <select name="tableRows" class="tableRows" id="tableRows" onchange="getRecords('action=printTableRows&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET');">
                            <option value="1">1</option>
                            <option value="5">5</option>
                            <option val0ue="10" selected="selected">10</option>
                            <option value="20">20</option>
                          </select>
                        </div> <!-- class="pull-left" -->
                
                        <!-- Pagination buttons and page numbers -->
                        <div class="btn-group">
                          <input onclick="getRecords('action=firstButton&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET')" class="btn btn-mini" type="submit" name="firstButton" value="&#171;"/>
                          <input onclick="getRecords('action=prevButton&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET')" class="btn btn-mini" type="submit" name="prevButton" value="&#8249;"/>
                          <!-- <input class="btn btn-mini btn-text" id="btn-mini-text" disabled="disabled" value="Page: "/> -->
                          <span class="btn btn-mini" disabled="disabled">Page: </span><input class="btn btn-mini currentPage" value="1"/><span class="btn btn-mini totalPages" id="totalPages" disabled="disabled">: &nbsp</span>
                          <input onclick="getRecords('action=nextButton&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET')" class="btn btn-mini" type="submit" name="nextButton" value="&#8250;"/> 
                          <input onclick="getRecords('action=lastButton&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET')" class="btn btn-mini" type="submit" name="lastButton" value="&#187;"/>
                        </div>  <!-- class="btn-group pull-right" -->
                        
                      </div>  <!-- class="pageNav" pull-right -->
                      
                    </div>  <!-- class="row tableNav" -->
                    
                  </div>  <!-- class="container-fluid" -->
               
              </div>  <!-- class="panel-body" -->
              
            </div> <!-- id="methodOfCapture" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" -->

            <div  id="specimen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSpecimen">Specimen Gender</div>

        </div> <!-- class="panel-body" -->

      </div> <!-- class="panel-group col-md-9 col-sm-9 col-xs-9" id="accordion" role="tablist" aria-multiselectable="true" -->

    </div> <!-- class="container-fluid container-format" -->
    
<?php
  echo "    <script src='" . $pathToRoot . "js/ent.js'></script>" . PHP_EOL;
  echo "    <script src='" . $pathToRoot . "js/ent-db.js'></script>" . PHP_EOL;
?>
    <!-- Creates the Method of Capture Table with values. -->
    <script>
        getRecords('action=printTableRows&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET');
        //getRecords('action=displayPageNumber&pageRowCount=' + $('select option:selected').val(), 'tableRowCol', '../admin/moc-data.php', 'GET');
    </script>
    
<!-- Close the body and put in the footer -->    
<?php require_once($pathToRoot . "includes/footer.php"); ?>
