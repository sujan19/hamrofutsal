
<?php 
session_start();
require_once 'db_connection.php';
$vhid=$_SESSION['vhid'];
$stmt = $dbh->prepare("INSERT INTO events (name, start, end, resource_id,FutsalId) VALUES (:name, :start, :end, :resource ,:vhid)");
$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':resource', $_POST['resource']);
$stmt->bindParam(':vhid', $_POST['vhid']);
$stmt->execute();
class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created with id: '.$dbh->lastInsertId();
$response->id = $dbh->lastInsertId();

header('Content-Type: application/json');
echo json_encode($response);

?>