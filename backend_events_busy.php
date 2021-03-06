<?php
	session_start();
	require_once 'db_connection.php';
    
	$json = file_get_contents('php://input');
	$params = json_decode($json);
	$vhid=$_SESSION['vhid'];
	$stmt = $dbh->prepare('SELECT * FROM events WHERE FutsalId=:vhid AND NOT ((end <= :start) OR (start >= :end))');
	$stmt->bindParam(':start', $params->start);
	$stmt->bindParam(':end', $params->end);
	$stmt->bindParam(':vhid', $vhid);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	class Event {}
	$events = array();
	
	foreach($result as $row) {
		$e = new Event();
		$e->id = $row['id'];
		$e->text = "";
		$e->start = $row['start'];
		$e->end = $row['end'];
		$e->resource = $row['resource_id'];
		$e->moveDisabled = true;
		$e->resizeDisabled = true;
		$e->clickDisabled = true;
		$e->backColor = "#E69138";   // lighter #F6B26B
		$e->bubbleHtml = "Not Available";
		
		$events[] = $e;
	}
	
	header('Content-Type: application/json');
	echo json_encode($events);
	
?>
