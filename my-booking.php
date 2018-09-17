<?php
	session_start();
	error_reporting(0);
	include('db_connection.php');
	if(strlen($_SESSION['login'])==0)
	{ 
		header('location:index.php');
	}
	else{
		if(isset($_REQUEST['del']))
		{
			$delid=intval($_GET['del']);
			$sql = "delete from events WHERE  id=:delid";
			$query = $dbh->prepare($sql);
			$query -> bindParam(':delid',$delid, PDO::PARAM_STR);
			$query -> execute();
			$msg="Futsal  record deleted successfully";
		}
		
	?>
	<!DOCTYPE HTML>
	<html lang="en">
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<meta name="keywords" content="">
			<meta name="description" content="">
			<title>hamrofutsal</title>
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
			
			<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
		</head>
		<body>
			
			
			<!--Header-->
			<?php include('includes/header.php');?>
			<!--Page Header-->
			<!-- /Header --> 
			<!--Page Header-->
			<section class="page-header profile_page">
				<div class="container">
					<div class="page-header_wrap">
						<div class="page-heading">
							<h1>My Booking</h1>
						</div>
						<ul class="coustom-breadcrumb">
							<li><a href="list.php">Home</a></li>
							<li>My Booking</li>
						</ul>
					</div>
				</div>
				<!-- Dark Overlay-->
				<div class="dark-overlay"></div>
			</section>
			<!-- /Page Header--> 
			
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
					<section class="user_profile inner_pages">
						<div class="container">
							<div class="user_profile_info gray-bg padding_4x4_40">
								<div class="upload_user_logo"> <img src="assets/images/user.jpg" alt="image">
								</div>
								
								<div class="dealer_info">
									<h5><?php echo htmlentities($result->FullName);?></h5>
									<p><?php echo htmlentities($result->Address);?><br>
									<?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country); }}?></p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3 col-sm-3">
							<?php include('includes/sidebar.php');?>
							
							<div class="col-md-6 col-sm-8">
								<div class="profile_wrap">
									<h5 class="uppercase underline">My Bookings </h5>
									<div class="my_vehicles_list">
										<ul class="vehicle_listing">
											<?php 
												$useremail=$_SESSION['login'];
												$sql = "SELECT addfutsal.Vimage2 as Vimage2,addfutsal.Title,addfutsal.id as vid,location.Name,events.start,events.end,events.Status,events.id as eid from events join addfutsal on events.FutsalId=addfutsal.id join location on location.id=addfutsal.Brand where events.name=:useremail";
												$query = $dbh -> prepare($sql);
												$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
												$query->execute();
												$results=$query->fetchAll(PDO::FETCH_OBJ);
												$cnt=1;
												if($query->rowCount() > 0)
												{
													foreach($results as $result)
													{  ?>
													
													<li>
														<div class="vehicle_img"> <a href="details.php?vhid=<?php echo htmlentities($result->vid);?>""><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage2);?>" alt="image"></a> </div>
														<div class="vehicle_title">
															<h6><a href="details.php?vhid=<?php echo htmlentities($result->vid);?>""> <?php echo htmlentities($result->Name);?> , <?php echo htmlentities($result->Title);?></a></h6>
																<p><b>From Date:</b> <?php echo htmlentities($result->start);?><br /> <b>To Date:</b> <?php echo htmlentities($result->end);?></p>
																</div>
																<?php if($result->Status==1)
																	{ ?>
																	<div class="vehicle_status"> <a href="#" class="btn outline btn-xs active-btn">Confirmed</a>
																		<div class="clearfix"></div>
																	</div>
																	
																	<?php } else if($result->Status==2) { ?>
																	<div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Cancelled</a>
																		<div class="clearfix"></div>
																	</div>
																<a href="my-booking.php?del=<?php echo $result->eid;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
																
																<?php } else { ?>
																<div class="vehicle_status"> <a href="#" class="btn outline btn-xs">Not Confirm yet</a>
																	<div class="clearfix"></div>
																	
																</div>
															<a href="my-booking.php?del=<?php echo $result->eid;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
														<?php } ?>
													<?php }} ?>
													
													
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!--/my-vehicles--> 
					<?php include('includes/footer.php');?>
					
					<!-- Scripts --> 
					<script src="assets/js/jquery.min.js"></script>
						<script src="assets/js/bootstrap.min.js"></script> 
						<script src="assets/js/interface.js"></script> 
						<!--Switcher-->
						<script src="assets/switcher/js/switcher.js"></script>
						<!--bootstrap-slider-JS--> 
						<script src="assets/js/bootstrap-slider.min.js"></script> 
						<!--Slider-JS--> 
						<script src="assets/js/slick.min.js"></script> 
						<script src="assets/js/owl.carousel.min.js"></script>
					</body>
				</html>
			<?php } ?>																