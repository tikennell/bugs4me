<?php

#Debugging turned on.
error_reporting(E_ALL);
ini_set("display_errors", 1);

header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

session_start();

$pathToRoot = str_repeat('../' , substr_count( $_SERVER['SCRIPT_NAME'] , '/') - 1);
require_once($pathToRoot . 'login/config/config.php');

if (!isset($_GET['personLookUp'])) {
    die();
} else {
  // Add a wild card % to the value passed to get all like the value passed.
  $PersonName = "%" . $_GET['personLookUp'] . "%";
}

$db_connection = new PDO(DB_TYPE . ':host='. DB_HOST .';dbname='. DB_APP_NAME, DB_APP_USER, DB_APP_PASS);
$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//Disable emulated prepares (the MySQL driver has a bug/feature that will make it quote numeric arguments).
$db_connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

//$query = "SELECT CONCAT(FirstName, ' ', MiddleName, ' ', LastName) AS Name FROM Person WHERE CONCAT(FirstName, ' ', MiddleName, ' ', LastName) LIKE ?" . "'%';";
$query = "SELECT CONCAT(FirstName, ' ', MiddleInitial, ' ', LastName) AS Name FROM Person WHERE CONCAT(FirstName, ' ', MiddleInitial, ' ', LastName) LIKE :PersonName;";
$stmtPerson = $db_connection->prepare($query);
//$stmtGetSpecimen->bindParam(':methodOfCaptureId', $methodOfCaptureId);
$stmtPerson->bindParam(':PersonName', $PersonName, PDO::PARAM_STR);
$stmtPerson->execute();


// Put the specimen data into an associated array for PersonName / value combo.
$results = $stmtPerson->fetchALL(PDO::FETCH_ASSOC);

// Convert to json and echo the json string.
echo json_encode( $results );
?>