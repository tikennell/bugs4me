<?php
// Check whether the user is logged in or send them back to the main menu.
$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);

require_once($pathToRoot . "login/config/config.php");
require_once($pathToRoot . "classes/dao.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class Specimen extends DAO {

    public function __construct()
    {
        // Open database connection.
        $this->dbConnection();
    }
    
    // Owner method
    public function getPerson($personId)
    {
        if (!isset($_GET['personLookUp'])) {
          die();
        } else {
          // Add a wild card % to the value passed to get all like the value passed.
          $PersonName = "%" . $_GET['personLookUp'] . "%";
        }
       
        $query = "SELECT CONCAT(FirstName, ' ', MiddleInitial, ' ', LastName) AS Name FROM Person WHERE CONCAT(FirstName, ' ', MiddleInitial, ' ', LastName) LIKE :PersonName;";
        $stmtPerson = $db_connection->prepare($query);
        $stmtPerson->bindParam(':PersonName', $PersonName, PDO::PARAM_STR);
        $stmtPerson->execute();
       
        // Put the specimen data into an associated array for PersonName / value combo.
        $results = $stmtPerson->fetchALL(PDO::FETCH_ASSOC);
       
        // Convert to json and echo the json string.
        echo json_encode( $results );
    }
    
    // Get matching Owners.
    public function getOwnerList($specimenOwner)
    {
        // SELECT the specimen based off of the specimen Id.
        $query = "SELECT * FROM Owner WHERE Like :specimenOwnerId;";
        $stmtGetSpecimenOwner = $this->db_connection->prepare($query);
        $stmtGetSpecimenOwner->bindParam(':specimenOwnerId', $specimenOwnerId);
        $stmtGetSpecimenOwner->execute();

        // Put the specimen data into an associated array for key / value combo.
        $stmtGetSpecimen->fetchAll(PDO::FETCH_ASSOC);
        
        // Convert to json and echo the json string.
        echo json_encode( $stmtGetSpecimen );
    }
    
    //Specimen methods.
    public function getSpecimen($specimenId)
    {
        // SELECT the specimen based off of the specimen Id.
        $query = "SELECT * FROM Specimen
                     WHERE specimenid = :specimenId;";
        $stmtGetSpecimen = $this->db_connection->prepare($query);
        $stmtGetSpecimen->bindParam(':specimenId', $specimenId);
        $stmtGetSpecimen->execute();

        // Return the specimen data selected.
        return $stmtGetSpecimen->fetchAll(PDO::FETCH_OBJ);
    }
    
    
}

?>