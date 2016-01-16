<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Check whether the user is logged in or send them back to the main menu.
$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);

require_once($pathToRoot . "login/config/config.php");

class MethodOfCapture extends dbDAO {

    public function __construct()
    {
        // Open database connection.
        $this->dbConnection();
    }

    public function getMethodOfCapture($methodOfCaptureId)
    {
        // Check to see if the method of capture is already in the table.
        $query = "SELECT * FROM MethodOfCapture
                     WHERE methodofcaptureid = :methodOfCaptureId;";
        $stmtGetMOC = $this->db_connection->prepare($query);
        $stmtGetMOC->bindParam(':methodOfCaptureId', $methodOfCaptureId);
        $stmtGetMOC->execute();

        // Verify whether the method of capture is already entered.  If not, then create a new method of capture.
        return $stmtGetMOC->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllMethodOfCapture($startRow, $numOfRows)
    {
        $query = "SELECT * FROM MethodOfCapture LIMIT :startRow, :numOfRows;";
        $stmtGetAllMOC = $this->db_connection->prepare($query);
        $stmtGetAllMOC->bindParam(':startRow', $startRow, PDO::PARAM_INT);
        $stmtGetAllMOC->bindParam(':numOfRows', $numOfRows, PDO::PARAM_INT);
        $stmtGetAllMOC->execute();
        return $stmtGetAllMOC->fetchAll(PDO::FETCH_OBJ);
    }
    
    // Change to CountMethodOfCapture()
    public function getMOCCount()
    {
        $query = "SELECT COUNT(*) AS recCount FROM MethodOfCapture;";
        $stmtMOCCount = $this->db_connection->prepare($query);
        $stmtMOCCount->execute();
        $result = $stmtMOCCount->fetchObject();
        return $result->recCount;
    }
    
    public function addMethodOfCapture($addMethodOfCapture)
    {
        // Check to see if the method of capture is already in the table.
        $query = "SELECT COUNT(*) AS recCount 
                     FROM MethodOfCapture
                     WHERE methodofcapture = TRIM(BOTH ' ' FROM :methodofcapture);";
        $stmtSaveMOC = $this->db_connection->prepare($query);
        $stmtSaveMOC->bindParam(':methodofcapture', $addMethodOfCapture);
        $stmtSaveMOC->execute();

        // Verify whether the method of capture is already entered.  If not, then create a new method of capture.
        $result = $stmtSaveMOC->fetchObject();
        if ($result->recCount == 0) {
            $query = "INSERT INTO MethodOfCapture (methodofcapture) VALUES (TRIM(BOTH ' ' FROM :methodofcapture));";
            $stmtSaveMOC = $this->db_connection->prepare($query);
            $stmtSaveMOC->bindParam(':methodofcapture', $addMethodOfCapture, PDO::PARAM_STR);
            $stmtSaveMOC->execute();
        }
    }
    
    public function deleteMethodOfCapture($methodOfCaptureId = NULL)
    {
        $query = "DELETE FROM MethodOfCapture
                      WHERE methodofcaptureid = :methodOfCaptureId;";
        $stmtDeleteMOC = $this->db_connection->prepare($query);
        $stmtDeleteMOC->bindParam(':methodOfCaptureId', $methodOfCaptureId);
        $stmtDeleteMOC->execute();
    }
    
    // Change edit to set
    public function editMethodOfCapture($methodOfCaptureId = NULL)
    {
        $query = "UPDATE MethodOfCapture SET
                    methodofcapture = '" . $_GET["editMethodOfCapture"] . 
                 "' WHERE methodofcaptureid = :methodOfCaptureId;";
        $stmtDeleteMOC = $this->db_connection->prepare($query);
        $stmtDeleteMOC->bindParam(':methodOfCaptureId', $methodOfCaptureId);
        $stmtDeleteMOC->execute();
    }
}
?> 