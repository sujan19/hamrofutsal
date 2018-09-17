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
		<title>hamrofutsal</title>
		<!--Bootstrap -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="assets/css/style.css" type="text/css">
		<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
		<link href="assets/css/slick.css" rel="stylesheet">
		<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" data-default-color="true"/>
		
		<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
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
							<li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users:<i class="fa fa-user-circle" aria-hidden="true"></i> 
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
												<li><a href="profile.php">Sign In</a></li>
												<li><a href="update-password.php">Update Password</a></li>
												<li><a href="my-booking.php">My Booking</a></li>
												<li><a href="my-testimonials.php">My Review</a></li>
												<li><a href="logout.php">Sign Out</a></li>
												<?php } else { ?>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign In</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Update Password</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Booking</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">My Review</a></li>
												<li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Sign Out</a></li>
											<?php } ?>
										</ul>
							</li>
						</ul>
					</div>
					<div class="header_search">
						<div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
						<form action="search-carresult.php" method="get" id="header-search-form">
							<input type="text" placeholder="Search..." class="form-control">
							<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
							
						</form>
					</div>
				</div>
				<div class="collapse navbar-collapse" id="navigation">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a>    </li>
						
						<li><a href="about.php?type=aboutus">About Us</a></li>
						<li><a href="contact-us.php">Contact Us</a></li>
						<li><a href="admin/index.php?type=faqs">Futsal Admin</a></li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navigation end --> 
		<!-- Banners -->
		<section id="banner" class="banner-section">
			<div class="container">
				<div class="div_zindex">
					<div class="row">
						<div class="col-md-5 col-md-push-7">
							<div class="banner_content">
								<h1>Find the best Futsal.</h1>
								<p>Futsal Review for you to choose.</p>
							<a href="about.php" class="btn">Read More <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a> </div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /Banners --> 
		
		
		<!-- Resent Cat-->
		<section class="section-padding gray-bg">
			<div class="container">
				<div class="section-header text-center">
					<h2>Find the Best <span>Futsal</span></h2>
					<p>There are many futsal to choose but choose according to user review.</p>
				</div>
				<div class="row"> 
					
					<!-- Nav tabs -->
					<div class="recent-tab">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#resentnewcar" role="tab" data-toggle="tab">Futsal</a></li>
						</ul>
					</div>
					<!-- Recently Listed New Cars -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="resentnewcar">
							
							<?php $sql = "SELECT addfutsal.*,location.Name,location.id as bid  from addfutsal join location on location.id=addfutsal.Brand order by id desc limit 4";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
									{  ?>
									
									<div class="col-list-3">
										<div class="recent-car-list">
											<div class="car-info-box"> <a href="#loginform" data-toggle="modal" data-dismiss="modal"><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image"></a>
												<ul>
													<li><i class="fa fa-table" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
												</ul>
											</div>
											<div class="car-title-m">
												<h6><a href="#loginform" data-toggle="modal" data-dismiss="modal"><?php echo htmlentities($result->Title);?>,<?php echo htmlentities($result->Name);?></a></h6>
												<span class="price">RS<?php echo htmlentities($result->PricePerDay);?> /hour</span> 
											</div>
										</div>
									</div>
								<?php }}?>
								
						</div>
					</div>
				</div>

			</section>
			<!-- /Resent Cat --> 
			
			
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
			<!--/Forgot-password-Form --> 
			
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
		
		<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:22:11 GMT -->
	</html>	