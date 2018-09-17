<?php
	session_start();
	require_once '../db_connection.php';
	
	$vhid = intval($_POST["vhid"]);
	$email = $_POST["email"];
	$score = intval($_POST["score"]);
	
	$aResponse['error'] = FALSE;
	$aResponse['message'] = '';
	$aResponse['updated_rating'] = '';
	
	$return_message = "";
	$success = FALSE;
	
	$sql = "INSERT INTO `tblratings` (`FutsalId`, `Email`, `ratings_score`) VALUES "
	. "( :vhid, :email, :score)";
	$stmt = $dbh->prepare($sql);
	try {
		
		$stmt->bindValue(":vhid", $vhid);
		$stmt->bindParam(':email',$email, PDO::PARAM_STR);
		$stmt->bindValue(":score", $score);
		$stmt->execute();
		$result = $stmt->rowCount();
		if ($result > 0) {
			$aResponse['message'] = "Your rating has been added successfully";
			} else {
			$aResponse['error'] = TRUE;
			$aResponse['message'] = "There was a problem updating your rating. Try again later";
		}
		} catch (Exception $ex) {
		$aResponse['error'] = TRUE;
		$aResponse['message'] = $ex->getMessage();
	}
	
	if ($aResponse['error'] === FALSE) {
		// now fetch the latest ratings for the product.
		$sql = "SELECT count(*) as count, AVG(ratings_score) as score FROM `tblratings` WHERE 1 AND FustalId = :vhid";
		try {
			$stmt = $dhb->prepare($sql);
			$stmt->bindValue(":vhid", $vhid);
			$stmt->execute();
			$products = $stmt->fetchAll();
			
			if ($products[0]["count"] > 0) {
				// update ratings
				$aResponse['updated_rating'] = "Average rating <strong>" . round($products[0]["score"], 2) . "</strong> based on <strong>" . $products[0]["count"] . "</strong> users";
				} else {
				$aResponse['updated_rating'] = '<strong>Ratings: </strong>No ratings for this product';
			}
			} catch (Exception $ex) {
			#echo $ex->getMessage();
		}
	}
	
	echo json_encode($aResponse);
?>