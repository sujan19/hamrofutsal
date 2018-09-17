
<?php 
	session_start();
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Event</title>
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />    
        <script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	</head>
    <body>
        <?php
            // check the input
            is_numeric($_GET['id']) or die("invalid URL");
            
         	require_once '../database/db_connection.php';
            
            $stmt = $dbh->prepare('SELECT * FROM events WHERE id = :id');
            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();
            $reservation = $stmt->fetch();
            
            $courts = $dbh->query('SELECT * FROM resources');
		?>
        <form id="f" action="delete.php" style="padding:20px;">
            <input type="hidden" name="id" value="<?php print $_GET['id'] ?>" />
            <h1>Edit Reservation</h1>
            <div>Start:</div>
            <div><input type="text" id="start" name="start" value="<?php print $reservation['start'] ?>" /></div>
            <div>End:</div>
            <div><input type="text" id="end" name="end" value="<?php print $reservation['end'] ?>" /></div>
			<div class="space" >
				<div>Futsal Id:</div>
				<?php 
					$vhid=$_SESSION['vhid'];
					$sql = "SELECT addfutsal.id as bid from addfutsal where addfutsal.id=:vhid";
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
					<div><input id="vhid" name="vhid"  value="<?php echo htmlentities($result->bid);}}?>" /></div>
			</div>
            <div>Court:</div>
            <div>
                <select id="room" name="room" disabled>
                    <?php 
                        foreach ($courts as $court) {
                            $selected = $reservation['resource_id'] == $court['id'] ? ' selected="selected"' : '';
                            $id = $court['id'];
                            $name = $court['name'];
                            print "<option value='$id' $selected>$name</option>";
						}
					?>
				</select>
                
			</div>
            <div>Name: </div>
            <div><input type="text" id="name" name="name" value="<?php print $reservation['name'] ?>" /></div>
            
            <div class="space"><input type="submit" value="Delete" /> <a href="javascript:close();">Cancel</a></div>
		</form>
        
        <script type="text/javascript">
			function close(result) {
				if (parent && parent.DayPilot && parent.DayPilot.ModalStatic) {
					parent.DayPilot.ModalStatic.close(result);
				}
			}
			
			$("#f").submit(function () {
				var f = $("#f");
				$.post(f.attr("action"), f.serialize(), function (result) {
					close(eval(result));
				});
				return false;
			});
			
			$(document).ready(function () {
				$("#name").focus();
			});
			
		</script>
	</body>
</html>
