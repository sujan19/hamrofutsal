<?php
session_start();
require_once '../database/db_connection.php';
$stmt = $dbh->prepare("DELETE FROM  events  WHERE id = :id");
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();
class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Delete successful';

header('Content-Type: application/json');
echo json_encode($response);

?>
