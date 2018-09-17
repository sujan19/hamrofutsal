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
		<title>Search Futsal</title>
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
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" data-default-color="true"  />
		
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
							<?php $sql = "SELECT * from  addfutsal ";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
									{       ?>  
								<?php }} ?>
								<input type="text" name="text" placeholder="Search..." class="form-control">
								<button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
						</form>
					</div>
				</div>
				<div class="collapse navbar-collapse" id="navigation">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a>    </li>
						
						<li><a href="my-booking.php?type=aboutus">My Booking</a></li>
						<li><a href="list.php">Listing</a>
							<li><a href="contact-us.php">Contact Us</a></li>
							
						</ul>
					</div>
				</div>
			</nav>
			<!-- Navigation end --> 
			<!--Page Header-->
			<section class="page-header listing_page">
				<div class="container">
					<div class="page-header_wrap">
						<div class="page-heading">
							<h1>Search Result</h1>
						</div>
						<ul class="coustom-breadcrumb">
							<li><a href="list.php">Futsal Listing</a></li>
							<li>Search Resutlt</li>
						</ul>
					</div>
				</div>
				<!-- Dark Overlay-->
				<div class="dark-overlay"></div>
			</section>
			<!-- /Page Header--> 
			
			<!--Listing-->
			<section class="listing-page">
				<div class="container">
					<div class="row">
						<div class="col-md-9 col-md-push-3">
							<div class="result-sorting-wrapper">
								<div class="sorting-count">
									<?php 
										//Query for Listing count
										$title=$_GET['text'];								
										$sql = "SELECT addfutsal.*,location.* WHERE (addfutsal.Title LIKE '%".$title."%') OR (location.Name LIKE '%".$title."%')";
										$query = $dbh -> prepare($sql);
										$query -> bindParam(':title',$title, PDO::PARAM_STR);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=$query->rowCount();
									?>
									<p><span> Listings</span></p>
								</div>
							</div>
							
							<?php 
								$sql = "SELECT addfutsal.*,location.Name,location.id as bid  from addfutsal join location on addfutsal.Brand=location.id  where (addfutsal.Title LIKE '%".$title."%') or (location.Name LIKE '%".$title."%')";
								$query = $dbh -> prepare($sql);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
									{  ?>
									<div class="product-listing-m gray-bg">
										<div class="product-listing-img"><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="Image" /> </a> 
									</div>
									<div class="product-listing-content">
										<h5><a href="details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Title);?> ,<?php echo htmlentities($result->Name);?>  </a></h5>
										<p class="list-price">Rs<?php echo htmlentities($result->PricePerDay);?> Per Hour</p>
										<ul>  
											<li><i class="fa fa-desktop" aria-hidden="true"></i><?php echo htmlentities($result->Type);?></li>
											<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->Address);?> </li>
											<li><i class="fa fa-phone" aria-hidden="true"></i><?php echo htmlentities($result->Contact);?> </li>
										</ul>
										<a href="details.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">Details <span><i  aria-hidden="true"></i></span></a>
										<a href="src/ratings.php?vhid=<?php echo htmlentities($result->id);?>" class="btn">Ratings<span><i  aria-hidden="true"></i></span></a>
									</div>
								</div>
							<?php }} ?>
					</div>
					
					<!--Side-Bar-->
					<aside class="col-md-3 col-md-pull-9">
						
						
						<div class="sidebar_widget">
							<div class="widget_heading">
								<h5><i class="fa fa-search" aria-hidden="true"></i> Recently Listed Futsal</h5>
							</div>
							<div class="recent_addedcars">
								<ul>
								<?php $sql = "SELECT addfutsal.*,location.Name,location.id as bid  from addfutsal join location on location.id=addfutsal.Brand order by id desc limit 4";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
										foreach($results as $result)
										{  ?>
										
										<li class="gray-bg">
										<div class="recent_post_img"> <a href="details.php?vhid=<?php echo htmlentities($result->id);?>"><img src="admin/img/futsalimages/<?php echo htmlentities($result->Vimage2);?>" alt="image"></a> </div>
										<div class="recent_post_title"> <a href="details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Title);?> , <?php echo htmlentities($result->Name);?></a>
										<p class="widget_price">Rs<?php echo htmlentities($result->PricePerDay);?> Per Hour</p>
										</div>
										</li>
									<?php }} ?>
									
									</ul>
									</div>
									</div>
									</aside>
									<!--/Side-Bar--> 
									</div>
									</div>
							</section>
							<!-- /Listing--> 
							
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
		