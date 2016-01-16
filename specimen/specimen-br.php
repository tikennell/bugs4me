<?php
    /* Set up error handling. */
    error_reporting(E_ALL); 
    ini_set("display_errors", 1);
    session_start();
    
    /* Set up the data access object for the method of capture. */
    require_once("../login/config/config.php");
    require_once("../classes/dbDAO.php");
    $daoSpecimens = new Specimen;
    $brSpecimen = new specimenBusinessRules($daoSpecimens);

class specimenBusinessRules
{ 
    protected $action = "";           // What action was invoked on the web page.
    protected $daoSpecimen;           // The dao object for the data.

    public function __construct(Specimen $daoSpecimen)
    {

        $this->daoSpecimen = $daoSpecimen;
        $action = $this->setAction();
    
        // Determine the action the user has selected and take the appropriate action.
        switch ($action) {
            case "Create":
                $this->addMOC();
                break;
            case "Edit":
                $this->editMOC();
                break;
            case "Delete":
                $this->deleteMOC();
                break;
            case "verifyDelete":
                $this->verifyDelete();
                break;
            case "firstButton":
                $this->firstPage();
                break;
            case "prevButton":
                $this->prevPage();
                break;
            case "nextButton":
                $this->nextPage();
                break;
            case "lastButton":
                $this->lastPage();
                break;
            case "displayPageNumber":
                $this->displayPageNumber();
                break;
            default:
                break;
        }
        
        // Prints the transaction from the method of capture table.
        if ($action != 'verifyDelete') {
            $this->printMOCTable();
        }
        
        // Sets the record pointer session variable.
        $this->setRecordPointer();
        
        // Sets the page row count session variable.
        $this->setPageRowCount();
    }

    public function addMOC()
    {
        // Adds a new method of capture.
        $this->daoMOC->addMethodOfCapture(isset($_GET['addMethodOfCapture']) ? $_GET['addMethodOfCapture'] : NULL);
    }
    
    public function editMOC()
    {
        // Saves the edits on the method of capture record.
        $this->daoMOC->editMethodOfCapture(isset($_GET['editMethodOfCaptureId']) ? $_GET['editMethodOfCaptureId'] : NULL);
    }

    public function deleteMOC()
    {
        // Deletes the method of capture records.
        $results = isset($_GET["moc"]) ? $_GET["moc"] : NULL;
    
        if ($results != NULL) {
          foreach($results as $row) {
            $this->daoMOC->deleteMethodOfCapture($row);
          }
        }
    }

    public function verifyDelete()
    {
       // Delete dialog box verification to delete the records. 
        $results = isset($_GET["moc"]) ? $_GET["moc"] : NULL;
    
        if ($results != NULL) {
          foreach($results as $row) {
            foreach($this->daoMOC->getMethodOfCapture($row) as $record) {
              echo '<tr>
                       <td><input type="checkbox" class="moc" name="moc[]" value ="' . $record->MethodOfCaptureId . '"></td>
                       <td>' . $record->MethodOfCapture . '</td>
                     <tr>' . PHP_EOL;
            }
          }
        }
    }

    public function printMOCTable()
    {
        // Display records based on the last record pointer and amount of records to show.
        $result = $this->daoMOC->getAllMethodOfCapture($this->recPointer, $this->pageRowCount);
        // Get the number of records returned from the database select.
        $this->queryRecCount = count($result);
        // Display the records returned in a table grid.
        foreach($result as $row) {
            echo '
                <tr>
                  <td><input type="checkbox" class="moc" name="moc[]" value ="' . $row->MethodOfCaptureId . '"></td>
                  <td>' . $row->MethodOfCapture . '</td>
                <tr>' . PHP_EOL;
       }
    }

    public function nextPage()
    {
        // Navigates to the next page.
        if (($this->recPointer + $this->pageRowCount) <= $this->totalMOCRecords ) {
           if ($this->totalMOCRecords - ($this->recPointer + $this->pageRowCount) > $this->pageRowCount) {
                $this->recPointer += $this->pageRowCount;
           } else {
                $this->recPointer = $this->totalMOCRecords - $this->pageRowCount;
           }
        } else if (($this->recPointer + $this->pageRowCount) == $this->totalMOCRecords ){
           $this->recPointer = $this->totalMOCRecords - $this->pageRowCount;
        }
    }

    public function prevPage()
    {
        // Navigates to the previous page.
        if (($this->recPointer - $this->pageRowCount) > 0 ) {
           $this->recPointer -= $this->pageRowCount;
        } else {
           $this->recPointer = 0;
        }
    }

    public function firstPage()
    {
        // Navigates to the first page.
        $this->recPointer = 0;
    }

    public function lastPage()
    {
        // Navigates to the last page.
        if ($this->totalMOCRecords >= $this->pageRowCount) {
            $this->recPointer = $this->totalMOCRecords - $this->pageRowCount;
        } else {
            $this->recPointer = 0;
        }
    }

    public function displayPageNumber() 
    {
        
    }

    public function initRecordPointer()
    {
        // Check to see if there are more rows requested than are records in the database.  Set the value
        // to pageRowCount if less than the recCount.  Takes the row count into consideration.
        $this->recPointer = (isset($_SESSION['recPointer']) ? $_SESSION['recPointer'] : 0);
        if ($this->totalMOCRecords <= $this->pageRowCount) {
            $this->recPointer = 0;
        } else if ($this->prevPageRowCount != $this->pageRowCount) {
            $this->recPointer = ($this->recPointer - $this->pageRowCount > 0) ? $this->recPointer - ($this->pageRowCount-1) : 0;
        } else if (($this->recPointer + $this->pageRowCount) >= $this->totalMOCRecords) {
            $this->recPointer = $this->totalMOCRecords - $this->pageRowCount;
        }
    }
    
    public function initPrevPageRowCount()
    {
        // Gets the action's page row count.
        $this->prevPageRowCount = isset($_SESSION['pageRowCount']) ? $_SESSION['pageRowCount'] : 0;
        return $this->prevPageRowCount;
    }
    
    public function initPageRowCount()
    {
        // Initializes the page row count depending on whether it has been sent or the default.
        $this->pageRowCount = isset($_GET['pageRowCount']) ? $_GET['pageRowCount'] : 10;
        return $this->pageRowCount;
    }
    
    
    public function setTotalMOCRecords() 
    {
        // Total records in the table.  Must be initialized prior to the record pointer initialization.
        $this->totalMOCRecords = $this->daoMOC->getMOCCount();
        return $this->totalMOCRecords;
    }
    
    public function setAction()
    {
        // Determines the action the user has selected.
        $this->action = isset($_GET['action']) ? $_GET['action'] : "";
        return $this->action;
    }
    
    public function setRecordPointer()
    {
        // Sets the record pointer in a session variable.
        $_SESSION['recPointer'] = $this->recPointer;
    }
    
    public function setPageRowCount()
    {
        // Sets the page row count to be used as the previous page row count for navigation.
        $_SESSION['pageRowCount'] = $this->pageRowCount;
    }
} 
?>