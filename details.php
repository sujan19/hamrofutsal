<?php 
	session_start();
	include('db_connection.php');
	error_reporting(0);
	
?>


<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<title>hamrofutsal | Futsal Details</title>
		<!--Bootstrap -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
		<!--Custome Style -->
		<link rel="stylesheet" href="assets/css/style.css" type="text/css">
		<!--OWL Carousel slider-->
		<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
		<!--slick-slider -->
		<link href="assets/css/slick.css" rel="stylesheet">
		<!--bootstrap-slider -->
		<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<!--FontAwesome Font Style -->
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" data-default-color="true" />
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="jQuery-Seat-Charts/jquery.seat-charts.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<!-- demo stylesheet -->
    	<link type="text/css" rel="stylesheet" href="media/layout.css" />
		
		<!-- helper libraries -->
		<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
		
		<!-- daypilot libraries -->
        <script src="js/daypilot/daypilot-all.min.js" type="text/javascript"></script>
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="bootstrap/html5shiv.js"></script>
			<script src="bootstrap/respond.min.js"></script>
		<![endif]-->
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="bootstrap/js/jquery-1.9.0.min.js"></script>
		<script src="raty/jquery.raty.js" type="text/javascript"></script>
	</head>
	<body>
		
		
		<!--Header-->
		<?php include('includes/header.php');?>
		<!-- /Header --> 
		<!-- Navigation -->
		<nav id="navigation_bar" class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				</div>
				<div class="header_wrap">
					<div class="user_login">
						<ul>
							<li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
								<?php 
									$email=$_SESSION['login'];
									$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
									$query= $dbh -> prepare($sql);
									$query-> bindParam(':email', $email, PDO::PARAM_STR);
									$query-> execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									if($query->rowCount() > 0)
									{
										foreach($results as $result)
										{
											
										echo htmlentities($result->FullName); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
										<ul class="dropdown-menu">
											<?php if($_SESSION['login']){?>
												<li><a href="profile.php">Profile Settings</a></li>
												<li><a href="update-password.php">Update Password</a></li>
												<li><a href="my-booking.php">My Booking</a></li>
												<li><a href="post-testimonial.php">Post a Testimonial</a></li>
												<li><a href="my-testimonials.php">My Testimonial</a></li>
												<li><a href="logout.php">Sign Out</a></li>
												<?php } else { ?>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Profile Settings</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Post a Testimonial</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Testimonial</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li>
											<?php } ?>
										</ul>
							</li>
						</ul>
					</div>
					<div class="header_search">
						<div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
						<form action="searchfutsal.php" method="get" id="header-search-form">
							<input type="text" placeholder="Search..." class="form-control">
							<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>
				<div class="collapse navbar-collapse" id="navigation">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a>    </li>
						<li><a href="my-booking.php">My Booking</a></li>
						<li><a href="contact-us.php">Contact Us</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navigation end --> 
		<!--Page Header-->
		<section class="page-header contactus_page">
			<div class="container">
				<div class="page-header_wrap">
					<div class="page-heading">
						<h1>Futsal Detail</h1>
					</div>
					<ul class="coustom-breadcrumb">
						<li><a href="list.php">Back</a></li>
						<li>Futsal Detail</li>
					</ul>
				</div>
			</div>
			<!-- Dark Overlay-->
			<div class="dark-overlay"></div>
		</section>
		
		<!--Listing-Image-Slider-->
		
		<?php 
			$vhid=intval($_GET['vhid']);
			$sql = "SELECT addfutsal.*,location.Name,location.id as bid  from addfutsal join location on location.id=addfutsal.Brand where addfutsal.id=:vhid";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
				foreach($results as $result)
				{  
					$_SESSION['brndid']=$result->bid;  
				?>  
				
				<section id="listing_img_slider">
					<div><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
					<div><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive" alt="image" width="900" height="560"></div>
					
				</section>
				<!--/Listing-Image-Slider-->
				
				<!--Listing-detail-->
				<section class="listing-detail">
					<div class="container">
						<div class="listing_detail_head row">
							<div class="col-md-9">
								<h2><?php echo htmlentities($result->Title);?>,<?php echo htmlentities($result->Name);?> </h2>
							</div>
							<div class="col-md-3">
								<div class="price_info">
									<p>Rs<?php echo htmlentities($result->PricePerDay);?> </p>Per Hour
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<div class="main_features">
									<ul>
										<li> <i class="fa fa-phone" aria-hidden="true"></i>
											<h5><?php echo htmlentities($result->Contact);?></h5>
											<p>Contact No.</p>
										</li>
										<li> <i class="fa fa-table" aria-hidden="true"></i>
											<h5><?php echo htmlentities($result->Type);?></h5>
											<p>Court Type</p>
										</li>
										<li> <i class="fa fa-user" aria-hidden="true"></i>
											<h5><?php echo htmlentities($result->Address);?></h5>
											<p>Address</p>
											
										</li>
									</ul>
								</div>
								<div class="listing_more_info">
									<div class="listing_detail_wrap"> 
										<!-- Nav tabs -->
										<ul class="nav nav-tabs gray-bg" role="tablist">
											<li role="presentation" class="active" ><a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab">Detail </a></li>
											<li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">Availability</a></li>
										</ul>
										
										<!-- Tab panes -->
										<div class="tab-content"> 
											<!---overview -->
											<div role="tabpanel" class="tab-pane active " id="vehicle-overview">
												
												<p><?php echo htmlentities($result->Overview);?></p>
											</div>
											
											<!-- Accessories -->
											<div role="tabpanel" class="tab-pane" id="accessories"> 
												<!--Accessories-->
												<table>
													<thead>
														<tr>
															<th colspan="2">Availabilty</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Shower</td>
															<?php if($result->Shower==Yes)
																{
																?>
																<td><i class="fa fa-check" aria-hidden="true"></i></td>
																<?php } else { ?> 
																<td><i class="fa fa-close" aria-hidden="true"></i></td>
															<?php } ?> </tr>
															
															<tr>
																<td>Wifi</td>
																<?php if($result->Wifi==1)
																	{
																	?>
																	<td><i class="fa fa-check" aria-hidden="true"></i></td>
																	<?php } else {?>
																	<td><i class="fa fa-close" aria-hidden="true"></i></td>
																<?php } ?>
															</tr>
															
															<tr>
																<td>Parking</td>
																<?php if($result->Parking==Yes)
																	{
																	?>
																	<td><i class="fa fa-check" aria-hidden="true"></i></td>
																	<?php } else { ?>
																	<td><i class="fa fa-close" aria-hidden="true"></i></td>
																<?php } ?>
															</tr>
															
															<tr>
																<td>First Aid</td>
																<?php if($result->Firstaid==Yes)
																	{
																	?>
																	<td><i class="fa fa-check" aria-hidden="true"></i></td>
																	<?php } else { ?>
																	<td><i class="fa fa-close" aria-hidden="true"></i></td>
																<?php } ?>
															</tr>
															
													</tbody>
												</table>
											</div>
										</div>
										
									</div>
									
									<?php  ?>
									
								</div>
								
								
							</div>
							
							<div class="space-20"></div>
							<div class="divider"></div>
							
							<!--Booking-->
							<div>
								<div class="row">
									<?php 
										$vhid=intval($_GET['vhid']);
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
												$_SESSION['vhid'] =$result->id;
											?> 
											
											<div class="col-md-9"><div><h2>Book Now</h2></div>
											<h2><a href="news.php?vhid=<?php echo htmlentities($result->id);?>"></a><?php echo htmlentities($result->Title);}}?></h2></div>	
								</div>
								<div class="shadow"></div>
								<div class="hideSkipLink">
								</div>
								<div class="main">
									
									<div style="float:left; width:150px;" >
										<div id="navigator"></div>
									</div>
									<div style="margin-left: 150px;" >
										<div id="scheduler"></div>
									</div>
									
									<script type="text/javascript">
										var nav = new DayPilot.Navigator("navigator");
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
										
										
										var dp = new DayPilot.Scheduler("scheduler");
										
										dp.treeEnabled = true;
										
										dp.heightSpec = "Max";
										dp.height = 300;
										
										dp.scale = "Hour";
										dp.startDate = DayPilot.Date.today().firstDayOfMonth();
										dp.days = DayPilot.Date.today().daysInMonth();
										dp.cellWidth = 55;
										
										dp.eventHeight = 60;
										dp.durationBarVisible = false;
										
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
											var text = "Available";
											args.cell.html = "<div style='cursor: default; position: absolute; left: 0px; top:0px; right: 0px; bottom: 0px; padding-left: 3px; text-align: center; background-color: " + color + "; color:white; opacity: " + opacity + ";'>" + text + "</div>";
										};
										
										dp.timeHeaders = [
										
										{ groupBy: "Day", format: "dddd, MMMM d"},
										{ groupBy: "Hour", format: "h tt"}
										];
										
										dp.businessBeginsHour = 6;
										dp.businessEndsHour = 23;
										dp.businessWeekends = true;
										dp.showNonBusiness = false;
										
										dp.allowEventOverlap = false;
										
										//dp.cellWidthSpec = "Auto";
										dp.bubble = new DayPilot.Bubble();
										
										dp.onTimeRangeSelecting = function(args) {
											if (args.start < new DayPilot.Date()) {
												args.right.enabled = true;
												args.right.html = "You can't create a reservation in the past";
												args.allowed = false;
											}
											else if (args.duration.totalHours() > 4) {
												args.right.enabled = true;
												args.right.html = "You can only book up to 4 hours";
												args.allowed = false;
											}
										};
										
										// event creating
										// http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
										dp.onTimeRangeSelected = function (args) {
											var modal = new DayPilot.Modal();
											modal.onClosed = function(args) {
												dp.clearSelection();
												loadEvents();
											};
											modal.showUrl("news.php?start=" + args.start + "&end=" + args.end + "&resource=" + args.resource);
										};
										
										dp.init();
										
										var scrollTo = DayPilot.Date.today();
										if (new DayPilot.Date().getHours() > 12) {
											scrollTo = scrollTo.addHours(12);
										}
										dp.scrollTo(scrollTo);
										
										loadResources();
										loadEvents();
										
										function loadResources() {
											dp.rows.load("backend_resources.php");
										}
										
										function loadEvents() {
											dp.events.load("backend_events_busy.php");  // POST request with "start" and "end" JSON parameters
										}
									</script>
									
									
								</div>
								<div class="clear">
								</div><?php }}?>
					</div>
				</div>
				<!--/Booking--> 
				
				<div class="space-20"></div>
				<div class="divider"></div>
				
				<!--Reviews-->
				<h3>Reviews</h3>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
										<th>Reviews</th>
										<th>Email Id</th>
										<th>Posted Date</th>
										</tr>
										</thead>
										<tbody>
										
										<?php
										$vhid=intval($_GET['vhid']);
										$sql = "SELECT * from tbltestimonial where FutsalId=:vhid";
										$query = $dbh -> prepare($sql);
										$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0)
										{
										foreach($results as $result)
										{				?>	
										<tr>
										<td><?php echo htmlentities($cnt);?></td>
										<td><?php echo htmlentities($result->Testimonial);?></td>
										<td><?php echo htmlentities($result->UserEmail);?></td>
										<td><?php echo htmlentities($result->PostingDate);?></td>
										
										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
										</tbody>
										</table>	
										
										</div>
										</div>	
										</div>
										</div>
										
										</div>
										</div>
										<!--/Reviews--> 	
										
										<div class="space-20"></div>
										<div class="divider"></div>
										</section>
										<!--/Listing-detail--> 
										
										<!--Footer -->
										<?php include('includes/footer.php');?>
										<!-- /Footer--> 
										
										<!--Back to top-->
										<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
										<!--/Back to top--> 
										
										<!--Login-Form -->
										<?php include('includes/login.php');?>
										<!--/Login-Form --> 
										
										<!--Register-Form -->
										<?php include('includes/registration.php');?>
										
										<!--/Register-Form --> 
										
										<!--Forgot-password-Form -->
										<?php include('includes/forgotpassword.php');?>
										
										<script src="assets/js/jquery.min.js"></script>
										<script src="assets/js/bootstrap.min.js"></script> 
										<script src="assets/js/interface.js"></script> 
										<script src="assets/switcher/js/switcher.js"></script>
										<script src="assets/js/bootstrap-slider.min.js"></script> 
										<script src="assets/js/slick.min.js"></script> 
										<script src="assets/js/owl.carousel.min.js"></script>
										
										</body>
										</html>																									