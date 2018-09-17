<?php
		session_start();
require_once '../database/db_connection.php';

date_default_timezone_set("UTC");

  $stmt = $dbh->prepare('DELETE FROM [events]');
  $stmt->execute();

  $stmt = $dbh->prepare('SELECT * FROM [resources]');
  $stmt->execute();
  $scheduler_resources = $stmt->fetchAll();  
  
  foreach($scheduler_resources as $resource) {
    $rid = $resource['id'];

    for ($i = 0; $i <= 400; $i++) {
        $start = new DateTime('2014-01-01');
        $start->modify("+".$i." days");
        $startstr = $start->format('Y-m-d H:i:s');
        
        $end = clone $start;
        $end->modify("+2 days");
        $endstr = $end->format('Y-m-d H:i:s');
        
        $name = "Event ".$i;
        $vhid=$_SESSION['vhid'];
        $stmt = $dbh->prepare("INSERT INTO events (name, start, end, resource_id,FutsalId) VALUES (:name, :start, :end, :resource,:vhid)");
        $stmt->bindParam(':start', $startstr);
        $stmt->bindParam(':end', $endstr);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':resource', $rid);
		$stmt->bindParam(':vhid', $_POST['vhid']);
        $stmt->execute();        
    }

  }

class Result {}

$response = new Result();
$response->result = 'OK';
$response->message = 'Created';

header('Content-Type: application/json');
echo json_encode($response);

?>
