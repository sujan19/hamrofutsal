<?php
	session_start();
	error_reporting(0);
	include('database/db_connection.php');
	if(strlen($_SESSION['alogin'])==0)
	{	
		header('location:index.php');
	}
?>
<!DOCTYPE html>

<html lang="en" class="no-js">
	
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">
		
		<title>hamrofutsal |Admin Manage Booking   </title>
		
		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
		<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="css/layout.css" />    
		
		<!-- helper libraries -->
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
		
		<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
        <!--<script src="js/daypilot/common.js" type="text/javascript"></script>
			<script src="js/daypilot/scheduler.js" type="text/javascript"></script>
		<script src="js/daypilot/bubble.js" type="text/javascript"></script>-->
		
		<style>
			.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			}
			.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			}
		</style>
		
	</head>
	
	<body>
		<?php include('includes/header.php');?>
		
		<div class="ts-main-content">
			<?php include('includes/leftbar.php');?>
			<div class="content-wrapper">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-12">
							
							<h2 class="page-title">Manage Bookings</h2>
								<?php 
										$vhid=$_SESSION['vhid'];
										$sql = "SELECT * from addfutsal where id=:vhid";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':vhid',$vhid);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
											foreach($results as $result)
											{ 
											?> 
											<h2></a><?php echo htmlentities($result->Title);}}?></h2></div>	
								</div>
							<div class="shadow"></div>
							<div class="hideSkipLink">
							</div>
							<div class="main">
								
								
								<div style="float:left; width:150px;" >
									<div id="nav"></div>
								</div>
								<div style="margin-left: 150px;" >
									<div id="dp"></div>
								</div>           
								
								
								
								<script type="text/javascript">
									var nav = new DayPilot.Navigator("nav");
									nav.onTimeRangeSelected = function(args) {
										var day = args.day;
										
										if (dp.visibleStart() <= day && day < dp.visibleEnd()) {
											dp.scrollTo(day, "fast");
										}
										else {
											var start = day.firstDayOfMonth();
											var days = day.daysInMonth();
											dp.startDate = start;
											dp.days = days;
											dp.update();
											dp.scrollTo(day, "fast");
											loadEvents();
										}
									};
									nav.init();
									
									
									var dp = new DayPilot.Scheduler("dp");
									
									dp.treeEnabled = true;
									
									dp.heightSpec = "Max";
									dp.height = 300;
									
									dp.scale = "Hour";
									dp.startDate = DayPilot.Date.today().firstDayOfMonth();
									dp.days = DayPilot.Date.today().daysInMonth();
									dp.cellWidth = 60;
									
									dp.eventHeight = 60;
									dp.durationBarVisible = false;
									
									//dp.rowMarginTop = 15;
									dp.treePreventParentUsage = true;
									
									dp.onBeforeEventRender = function(args) {
									};
									
									var slotPrices = {
										
									};
									
									dp.onBeforeCellRender = function(args) {
										
										if (args.cell.isParent) {
											return;
										}
										if (args.cell.start < new DayPilot.Date()) {  // past
								            return;
							            }
										if (args.cell.utilization() > 0) {
											return;
										}
										
										var color = "green";
										
										var slotId = args.cell.start.toString("HH:mm");
										var price = slotPrices[slotId];
										
										var min = 5;
										var max = 15;
										var opacity = (price - min)/max;
										var text = "" ;
										args.cell.html = "<div style='cursor: default; position: absolute; left: 0px; top:0px; right: 0px; bottom: 0px; padding-left: 3px; text-align: center; background-color: " + color + "; color:white; opacity: " + opacity + ";'>" + text + "</div>";
									};
									
									dp.timeHeaders = [
									{ groupBy: "Month", format: "MMMM yyyy" },
									{ groupBy: "Day", format: "dddd, MMMM d"},
									{ groupBy: "Hour", format: "h tt"}
									];
									
									dp.businessBeginsHour = 6;
									dp.businessEndsHour = 23;
									dp.businessWeekends = true;
									dp.showNonBusiness = false;
									
									dp.allowEventOverlap = false;
									
									dp.bubble = new DayPilot.Bubble();
									
									
									// http://api.daypilot.org/daypilot-scheduler-oneventresized/ 
									dp.onEventResized = function (args) {
										$.post("book/backend_resize.php", 
										{
											id: args.e.id(),
											newStart: args.newStart.toString(),
											newEnd: args.newEnd.toString()
										}, 
										function() {
											dp.message("Resized.");
										});
									};
									
									// event creating
									// http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
									dp.onTimeRangeSelected = function (args) {
										var name = prompt("Name of Booking person:", "Futsal");
										dp.clearSelection();
										if (!name) return;
										
										$.post("book/backend_create.php", 
										{	
											vhid: "<?php echo $_SESSION['vhid']; ?>",
											start: args.start.toString(),
											end: args.end.toString(),
											resource: args.resource,
											name: name
										}, 
										function(data) {
											var e = new DayPilot.Event({
												start: args.start,
												end: args.end,
												id: data.id,
												resource: args.resource,
												text: name
											});
											dp.events.add(e);
											
											dp.message(data.message);
										});
									};
									
									dp.onEventClicked = function(args) {
									new DayPilot.Modal({
											onClosed: function(args) {
											
												loadEvents();
											}
										}).showUrl("book/edit.php?id=" + args.e.id());
									};
									
									dp.init();
									dp.scrollTo(new DayPilot.Date());
									
									loadResources();
									loadEvents();
									
									function loadResources() {
										$.post("book/backend_resources.php", function(data) {
											dp.resources = data;
											dp.update();
										});
									}
									
									function loadEvents() {
										dp.events.load("book/backend_events.php");
									}
									
								</script>
								
							</div>
							<div class="clear">
							</div>
						</body>
					</html>
					
								