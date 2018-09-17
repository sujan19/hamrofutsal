<?php
	session_start();
	require_once 'db_connection.php';
	$vhid=$_SESSION['vhid'];
	$stmt1 = $dbh->prepare('SELECT addfutsal.*,groups.* from groups join addfutsal on addfutsal.Type=groups.name where addfutsal.id=:vhid');
	$stmt1->bindParam(':vhid',$vhid);
	$stmt1->execute();
	$scheduler_groups = $stmt1->fetchAll();
	
	class Group {}
	class Resource {}
	$groups = array();
	foreach($scheduler_groups as $group) {
		$g = new Group();
		$g->id = "group_".$group['id'];
		$g->name = $group['name'];
		$g->expanded = true;
		$g->children = array();
		$g->eventHeight = 25;
		$groups[] = $g;
		
		$stmt = $dbh->prepare('SELECT * FROM resources WHERE group_id = :group ORDER BY name');
		$stmt->bindParam(':group', $group['id']);
		$stmt->execute();
		$scheduler_resources = $stmt->fetchAll();
		
		foreach($scheduler_resources as $resource) {
			$r = new Resource();
			$r->id = $resource['id'];
			$r->name = $resource['name'];
			$g->children[] = $r;
		}
	}
	
	header('Content-Type: application/json');
	echo json_encode($groups);
?>