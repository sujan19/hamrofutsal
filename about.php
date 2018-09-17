<?php
	session_start();
	error_reporting(0);
	include('db_connection.php');
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="keywords" content="">
		<meta name="description" content="">
		<title>hamrofutsal </title>
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
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
	</head>
	<body>
		<!--Header-->
		<?php include('includes/header.php');?>
		<!--Page Header-->
		<section class="page-header contactus_page">
			<div class="container">
				<div class="page-header_wrap">
					<div class="page-heading">
						<h1>About Us</h1>
					</div>
					<ul class="coustom-breadcrumb">
						<li><a href="/hamrofutsal">Home</a></li>
						<li>About Us</li>
					</ul>
				</div>
			</div>
			<!-- Dark Overlay-->
			<div class="dark-overlay"></div>
			
		</section>
		
		<section class="contact_us section-padding">
			<div class="container">
				<div  class="row">
					<div class="col-md-6">
						<h3>hamrofutsal</h3>
						<p>'hamrofutsal' is the first online booking site of Nepal.It is the one point futsal court booking platform for all the futsal enthuasists. It is mainly developed to make easier way to locating futsal courts, booking and cancelling. It is developed by four passionates as a startup. 
						It is kneen to provide its user to perform booking much easist and handy way.  </p>
						
						<h5>Purpose</h5>
						
						<ul>
							<li>To provide easy booking with all facilities.</li>
							<li>To provide daily booking schedule. </li>
							<li>To provide best futsal management </li>
							
						</ul>
						
					</div>
					
					<div class="col-md-6">
						<h3>Contact Info</h3>
						<div class="contact_detail">
							<?php 
								$sql = "SELECT Address,EmailId,ContactNo from tblcontactusinfo";
								$query = $dbh -> prepare($sql);;
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
									foreach($results as $result)
									{ ?>
									<ul>
										<li>
											<div class="icon_wrap"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
											<div class="contact_info_m"><?php   echo htmlentities($result->Address); ?></div>
										</li>
										<li>
											<div class="icon_wrap"><i class="fa fa-phone" aria-hidden="true"></i></div>
											<div class="contact_info_m"><a href="tel:61-1234-567-90"><?php   echo htmlentities($result->EmailId); ?></a></div>
										</li>
										<li>
											<div class="icon_wrap"><i class="fa fa-envelope-o" aria-hidden="true"></i></div>
											<div class="contact_info_m"><a href="mailto:contact@exampleurl.com"><?php   echo htmlentities($result->ContactNo); ?></a></div>
										</li>
									</ul>
								<?php }} ?>
						</div>
					</div>
				</div>
				<div>
				</div>
			</section>
			
			<!--Footer -->
			<?php include('includes/footer.php');?>
			<!-- /Footer--> 
			
			
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
				
			<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:26:12 GMT -->
	</html>						