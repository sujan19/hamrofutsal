<?php
	session_start();
	require_once '../database/db_connection.php';
	
	$stmt = $dbh->prepare("UPDATE events SET start = :start, end = :end WHERE id = :id");
	$stmt->bindParam(':id', $_POST['id']);
	$stmt->bindParam(':start', $_POST['newStart']);
	$stmt->bindParam(':end', $_POST['newEnd']);
	$stmt->execute();
	
	class Result {}
	
	$response = new Result();
	$response->result = 'OK';
	$response->message = 'Update successful';
	
	header('Content-Type: application/json');
	echo json_encode($response);
	
?>
