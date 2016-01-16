<?php
    /* Set up error handling. */
    error_reporting(E_ALL); 
    ini_set("display_errors", 1);
    
    /* Set up the data access object for the method of capture. */
    require_once("../login/config/config.php");
    require_once("../classes/dao.php");
    $daoMethodOfCapture = new MethodOfCapture();
        
    /*
      The CRUD for the Method of Capture table.
    */
    
    echo $_GET['action'];
    
    if (isset($_GET["addMOC"])) {
        $daoMethodOfCapture->addMethodOfCapture(isset($_GET['addMethodOfCapture']) ? $_GET['addMethodOfCapture'] : NULL);
    } else if (isset($_GET["deleteMOC"])) {
        $results = isset($_GET["moc"]) ? $_GET["moc"] : NULL;
    
        if ($results != NULL) {
          foreach($results as $row) {
            $daoMethodOfCapture->deleteMethodOfCapture($row);
          }
        }
    } else if (isset($_GET["editMOC"])) {
        $daoMethodOfCapture->editMethodOfCapture(isset($_GET['editMethodOfCaptureId']) ? $_GET['editMethodOfCaptureId'] : NULL);
    } else if (isset($_GET["getMOC"])) {
        $results = isset($_GET["moc"]) ? $_GET["moc"] : NULL;
    
        if ($results != NULL) {
          foreach($results as $row) {
            foreach($daoMethodOfCapture->getMethodOfCapture($row) as $record) {
              echo '<tr>
                       <td><input type="checkbox" class="moc" name="moc[]" value ="' . $record->MethodOfCaptureId . '"></td>
                       <td>' . $record->MethodOfCapture . '</td>
                     <tr>' . PHP_EOL;
            }
          }
        }
    }
    
    if (!isset($_GET['getMOC'])) {
        // Get the amount of rows to be displayed.
        $rowCount = isset($_GET['rowCount']) ? $_GET['rowCount'] : 10;
        $recPointer = isset($_SESSION['recPointer']) ? $_SESSION['recPointer'] : 0; 

        // Display records based on the last record pointer and amount of records to show.
        $result = $daoMethodOfCapture->getAllMethodOfCapture($recPointer, $rowCount);
        // Get the number of records returned.
        $recCount = count($result);
        // Display the records returned in a table grid.
        foreach($result as $row) {
            echo '
                <tr>
                  <td><input type="checkbox" class="moc" name="moc[]" value ="' . $row->MethodOfCaptureId . '"></td>
                  <td>' . $row->MethodOfCapture . '</td>
                <tr>' . PHP_EOL;
       }
        //Check to see if there are more rows requested than are records in the database.  Set the value
        //to rowCount if less than the recCount.
        $_SESSION['recPointer'] = (($rowCount <= $recCount) ? $rowCount : $recCount) + $recPointer;
    }
?>