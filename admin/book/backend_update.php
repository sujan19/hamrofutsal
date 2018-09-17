<?php
session_start();
require_once '../database/db_connection.php';
$vhid=$_SESSION['vhid'];
$stmt = $dbh->prepare("UPDATE events SET name = :name, start = :start, end = :end, resource_id = :room,FutsalId=:vhid WHERE id = :id");
$stmt->bindParam(':id', $_POST['id']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':start', $_POST['start']);
$stmt->bindParam(':end', $_POST['end']);
$stmt->bindParam(':room', $_POST['room']);
$stmt->bindParam(':vhid', $_POST['vhid']);
$stmt->execute();

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Update successful';

header('Content-Type: application/json');
echo json_encode($response);

?>
