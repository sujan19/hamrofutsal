<?php 
	session_start();
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New Reservation</title>
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />    
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	</head>
    <body>
        <?php
            // check the input
            //is_numeric($_GET['id']) or die("invalid URL");
            
            require_once 'db_connection.php';
			
            $courts = $dbh->query('SELECT * FROM resources');
            
            $start = $_GET['start'];
            $end = $_GET['end']; 
            $resource = $_GET['resource']; 
            
            // basic sanity check
            new DateTime($start) or die("invalid date (start)");
            new DateTime($end) or die("invalid date (end)");
            is_numeric($resource) or die("invalid resource id"); 
		?>
		<?php 
			$useremail=$_SESSION['login'];
			$sql = "SELECT * from tblusers where EmailId=:useremail";
			$query = $dbh -> prepare($sql);
			$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
				foreach($results as $result)
				{ ?>
				<form id="f" style="padding:20px;">
					<h1>New Reservation</h1>
					<div>Email: </div>
				<div><input  name="name" value="<?php echo htmlentities($result->EmailId);}}?>" /></div>
				<div class="space">
					<div>Start:</div>
					<div>
						<?php print (new DateTime($start))->format('d/M/y g:i A') ?>
						<input type="hidden" id="start" name="start" value="<?php echo $start ?>" />
					</div>
				</div>
				<div class="space">
					<div>End:</div>
					<div>
						<?php print (new DateTime($end))->format('d/M/y g:i A') ?>
						<input type="hidden" id="end" name="end" value="<?php echo $end ?>" />
					</div>
				</div>
				<div class="space">
					<div>Futsal Id:</div>
					<?php 
						$vhid=$_SESSION['vhid'];
						$sql = "SELECT * from addfutsal where id=:vhid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
							foreach($results as $result)
							{  
							?> 
						<div><input  name="vhid" value="<?php echo htmlentities($result->id);}}?>" /></div>
				</div>
				<div>Court:</div>
				<div>
					<input type="hidden" id="resource" name="resource" value="<?php echo $resource ?>" />
					<select id="resource_list" name="resource_list" disabled>
						<?php 
							foreach ($courts as $court) {
								$selected = $_GET['resource'] == $court['id'] ? ' selected="selected"' : '';
								$id = $court['id'];
								$name = $court['name'];
								print "<option value='$id' $selected>$name</option>";
							}
						?>
					</select>
					
				</div>
				<div class="space"><input type="submit" name="submit" value="Save" /> <a href="javascript:close();">Cancel</a></div>
		</form>
		
		<script type="text/javascript">
			function close(result) {
				DayPilot.Modal.close(result);
			}
			
			$("#f").submit(function(ev) {
				ev.preventDefault();
				var f = $("#f");
				var url = "backend_create.php";
				$.post(url, f.serialize(), function (result) {
					close(eval(result));
				});            
			});
			
			$(document).ready(function () {
				$("#name").focus();
			});
			
		</script>
	</body>
</html>
