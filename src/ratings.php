<?php 
	session_start();
	include('../db_connection.php');
    require_once('test.php');
	error_reporting(0);
	if(isset($_POST['send']))
	{
		$testimonoial=$_POST['testimonial'];
		$email=$_SESSION['login'];
		$vhid=$_GET['vhid'];
		$sql="INSERT INTO  tbltestimonial(UserEmail,FutsalId,Testimonial) VALUES(:email,:vhid,:testimonoial)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':testimonoial',$testimonoial,PDO::PARAM_STR);
		$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
		$query->bindParam(':email',$email,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			$msg="Review submitted successfully";
		}
		else 
		{
			$error="Something went wrong. Please try again";
		}
		
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
		<title>hamrofutsal | Futsal Rating</title>
		<!--Bootstrap -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css">
		<!--Custome Style -->
		<link rel="stylesheet" href="../assets/css/style.css" type="text/css">
		<!--OWL Carousel slider-->
		<link rel="stylesheet" href="../assets/css/owl.carousel.css" type="text/css">
		<link rel="stylesheet" href="../assets/css/owl.transitions.css" type="text/css">
		<!--slick-slider -->
		<link href="../assets/css/slick.css" rel="stylesheet">
		<!--bootstrap-slider -->
		<link href="../assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<!--FontAwesome Font Style -->
		<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
		<link rel="alternate stylesheet" type="text/css" href="../assets/switcher/css/green.css" title="green" media="all" data-default-color="true" />
		<link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		<!-- demo stylesheet -->
		<link type="text/css" rel="stylesheet" href="../media/layout.css" />
		
		<!-- helper libraries -->
		<script src="../js/jquery-1.9.1.min.js" type="text/javascript"></script>
		
		<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
		<script src="../bootstrap/js/jquery-1.9.0.min.js"></script>
		<script src="../raty/jquery.raty.js" type="text/javascript"></script>
		<style type="text/css">
			body{
			overflow:hidden;
		</style>
	</head>
	<body>
		<?php include('../includes/header.php');?>
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
											
										echo htmlentities($result->FullName); }}?> </a>
										
							</li>
						</ul>
					</div>
				</div>
				<div class="collapse navbar-collapse" id="navigation">
					<ul class="nav navbar-nav">
						<li><a href="../list.php">Home</a>    </li>
						<li><a href="../my-booking.php">My Booking</a></li>
						<li><a href="../contact-us.php">Contact Us</a></li>
						
					</ul>
				</div>
			</div>
		</nav>
		<!-- Navigation end --> 
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
				}}?>
				<div class="panel panel-primary">
					<div class="panel-body">
						
						<?php
							// fetch product details
							$sql = "SELECT * FROM addfutsal WHERE 1 AND id = :vhid";
							try {
								$stmt = $dbh->prepare($sql);
								$stmt->bindValue(":vhid", intval($_GET["vhid"]));
								$stmt->execute();
								// fetching products details
								$results = $stmt->fetchAll();
								} catch (Exception $ex) {
								echo $ex->getMessage();
							}
							
							// fetching ratings for specific product
							$ratings_sql = "SELECT count(*) as count, AVG(ratings_score) as score FROM `tblratings` WHERE 1 AND FutsalId= :vhid";
							$stmt2 = $dbh->prepare($ratings_sql);
							
							try {
								$stmt2->bindValue(":vhid", $_GET["vhid"]);
								$stmt2->execute();
								$rating = $stmt2->fetchAll();
								} catch (Exception $ex) {
								// you can turn it off in production mode.
								echo $ex->getMessage();
							}
							
							if (isset($email)) {
								$email= $_SESSION['login'];
								$user_rating_sql = "SELECT count(*) as count FROM `tblratings` WHERE 1 AND FutsalId = :vhid AND Email= :email";
								$stmt3 = $dbh->prepare($user_rating_sql);
								
								try {
									$stmt3->bindValue(":vhid", $_GET["vhid"]);
									$stmt3->bindParam(':email', $email, PDO::PARAM_STR);
									$stmt3->execute();
									
									$user_product_rating = $stmt3->fetchAll();
									} catch (Exception $ex) {
									// you can turn it off in production mode.
									echo $ex->getMessage();
								}
							}
						?>
						
						<div class="col-sm-12">
							<div class="row">
								
								<?php
									if (count($results) > 0) {
									?>
									<div class="col-sm-4">
										<a >
											<img src="../admin/img/futsalimages/<?php echo $results[0]["Vimage2"]?>"  class="img-thumbnail" width="500px" height="500px">
										</a>
									</div>
									<div class="col-sm-8">
										<div class="padding10 ntp">
											<h3 class="ntm"><?php echo $results[0]["Title"] ?></h3>
											<h3>RS:<?php echo $results[0]["PricePerDay"] ?></h3>
											
											<div id="avg_ratings">
												<?php
													// display the ratings for this product
													if ($rating[0]["count"] > 0) {
														echo "Average rating <strong>" . round($rating[0]["score"], 2) . "</strong> based on <strong>" . $rating[0]["count"] . "</strong> users";
														} else {
														echo 'No ratings for this futsal';
													}
												?>
											</div>
											
											<?php
												// if user has not rated this product then show the ratings button
												if ($user_product_rating[0]["count"] == 0) {
												?>  
												<div class=" padding10 clearfix"></div>
												<div id="rating_zone">
													
													<div class="pull-left">
														<!-- ratings will display here, make sure u bind #prd in the javascrript below -->
														<div id="prd"></div>
													</div>
													<div class="pull-left">
														<button class="btn btn-primary btn-sm" id="submitt" type="button">submit</button>
													</div>
												</div>
												<div class="clearfix"></div>
												<?php
													} else {
													echo '<div class="padding20 nlp"><p><strike>You have already rated this Futsal</strike></p></div>';
												}
											?>
											<div role="tabpanel" class="tab-pane" id="message">
												<div class="form-group">
													<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
													else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
													<form  method="post">
														<div class="form-group">
															<textarea class="form-control white_bg" name="testimonial" rows="4" required=""></textarea>
														</div>
														<div class="form-group">
															<button type="send" name="send" class="btn">Post Review <span><i aria-hidden="true"></i></span></button>
														</div>
													</form>
													
													
												</div>
											</div>
											<div class="padding10 clearfix"></div>
											<a class="btn" href="../list.php"><span></span> Back to lists</a>
										</div>
										
										<?php } else { ?>
										<div class="col-sm-12">
											<div class="padding20 nlp"><p><strike>No Futsal found</strike></p></div>
										<?php } ?>
										<!--Sentiment-->
										
										<div id="result">
											<?php
												if (isset($_POST['sentence']) || isset($_POST['location']))
												{
													$value = (isset($_POST['sentence'])) ? $_POST['sentence'] : $_POST['location'];
													$type = (isset($_POST['sentence'])) ? 'sentence' : 'location';
													if ($type == 'sentence')
													{
														$result = $sat->analyzeSentence($value);
													}
													else
													{
														$result = $sat->analyzeDocument($value);
													}
												}
												else
												{
													$result = array('sentiment'=>null, 'accuracy'=>array('positivity'=>null, 'negativity'=>null));
												}
											?>
											<div class="padding10 clearfix"></div>
											<h3> Feedback: <?php echo $result['sentiment']; ?></h3>
											<p> Prob. of Being Positive: <?php echo $result['accuracy']['positivity'];?></p>
											<p> Prob. of Being Negative: <?php echo $result['accuracy']['negativity'];?></p>
										</div>
									</div>
									<!--/Sentiment-->
								</div>
							</div>
							
						</div>
						
					</div>
				</div>
	</div>
	
	<script>
		$(function() {
			$('#prd').raty({
				number: 5, starOff: '../raty/img/star-off-big.png', starOn: '../raty/img/star-on-big.png', width: 180, scoreName: "score",
			});
		});
	</script>
	
	<script>
		$(document).on('click', '#submitt', function() {
			<?php
				if (!isset($email)) {
				?>
				alert("You need to have a account to rate this Futsal?");
				return false;
				<?php } else { ?>
				
				var score = $("#score").val();
				if (score.length > 0) {
					$("#rating_zone").html('Rated');
					$.post("update_ratings.php", {
						vhid: "<?php echo $_GET["vhid"]; ?>",
						email: "<?php echo $_SESSION['login']; ?>",
						score: score
						}, function(data) {
						if (!data.error) {
							// success message
							$("#avg_ratings").html(data.updated_rating);
							$("#rating_zone").html(data.message).show();
							} else {
							// failure message
							$("#rating_zone").html(data.message).show();
						}
					}, 'json'
					);
					} else {
					alert("select the ratings.");
				}
				
			<?php } ?>
		});
	</script>
</body>




<div class="space-20"></div>
<div class="divider"></div>
<div id="test">
	<form  id="form1" method='post'>
		<?php 
			$vhid=intval($_GET['vhid']);
			$sql = "SELECT * from tbltestimonial where FutsalId=:vhid ";
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
				<div><input name='sentence' value="<?php echo ($result->Testimonial);?>" />
					<?php if(!isset($_POST['submit'])) { ?>
						<script>
							window.onload =  function ()
							{
								document.getElementById('btn').click();     
							}
						</script>
					<?php } ?>
				<?php $cnt=$cnt+1;}}?></div>
				<input type="submit" name="submit"  id='btn' ></input>
	</form>
</div>
