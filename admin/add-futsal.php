<?php
	session_start();
	error_reporting(0);
	include('database/db_connection.php');
	if(strlen($_SESSION['alogin'])==0)
	{	
		header('location:index.php');
	}
	else{ 
		
		if(isset($_POST['submit']))
		{
			$username=$_SESSION['alogin'];
			$title=$_POST['title'];
			$brand=$_POST['brandname'];
			$overview=$_POST['orcview'];
			$priceperday=$_POST['priceperday'];
			$type=$_POST['type'];
			$address=$_POST['address'];
			$contact=$_POST['contact'];
			$vimage2=$_FILES["img2"]["name"];
			$vimage3=$_FILES["img3"]["name"];
			$vimage4=$_FILES["img4"]["name"];
			$shower=$_POST['shower'];
			$wifi=$_POST['wifi'];
			$parking=$_POST['parking'];
			$firstaid=$_POST['firstaid'];
			move_uploaded_file($_FILES["img2"]["tmp_name"],"img/futsalimages/".$_FILES["img2"]["name"]);
			move_uploaded_file($_FILES["img3"]["tmp_name"],"img/futsalimages/".$_FILES["img3"]["name"]);
			move_uploaded_file($_FILES["img4"]["tmp_name"],"img/futsalimages/".$_FILES["img4"]["name"]);
			$sql="INSERT INTO addfutsal(UserName,Title,Brand,Overview,PricePerDay,Type,Address,Contact,Vimage2,Vimage3,Vimage4,Shower,Wifi,Parking,Firstaid) VALUES(:username,:title,:brand,:overview,:priceperday,:type,:address,:contact,:vimage2,:vimage3,:vimage4,:shower,:wifi,:parking,:firstaid)";
			$query = $dbh->prepare($sql);
			$query-> bindParam(':username', $username, PDO::PARAM_STR);
			$query->bindParam(':title',$title,PDO::PARAM_STR);
			$query->bindParam(':brand',$brand,PDO::PARAM_STR);
			$query->bindParam(':overview',$overview,PDO::PARAM_STR);
			$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
			$query->bindParam(':type',$type,PDO::PARAM_STR);
			$query->bindParam(':address',$address,PDO::PARAM_STR);
			$query->bindParam(':contact',$contact,PDO::PARAM_STR);
			$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
			$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
			$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
			$query->bindParam(':shower',$shower,PDO::PARAM_STR);
			$query->bindParam(':wifi',$wifi,PDO::PARAM_STR);
			$query->bindParam(':parking',$parking,PDO::PARAM_STR);
			$query->bindParam(':firstaid',$firstaid,PDO::PARAM_STR);
			$query->execute();
			$lastInsertId = $dbh->lastInsertId();
			if($lastInsertId)
			{
				$msg="Futsal posted successfully";
			}
			else 
			{
				$error="Something went wrong. Please try again";
			}
			
		}
		
		
	?>
	<!doctype html>
	<html lang="en" class="no-js">
		
		<head>
			<meta charset="UTF-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
			<meta name="description" content="">
			<meta name="author" content="">
			<meta name="theme-color" content="#3e454c">
			
			<title>Welcome to hamrofutsal</title>
			
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
								
								<h2 class="page-title">Add Futsal</h2>
								
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Basic Info</div>
											<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
											else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
											<div class="panel-body">
												<form method="post" class="form-horizontal" enctype="multipart/form-data">
													<div class="form-group">
														<label class="col-sm-2 control-label"> Futsal Name<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" name="title" class="form-control" required>
														</div>
														<label class="col-sm-2 control-label">Location<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<select class="selectpicker" name="brandname" required>
																<option value=""> Select </option>
																<?php $ret="select id,Name from location";
																	$query= $dbh -> prepare($ret);
																	//$query->bindParam(':id',$id, PDO::PARAM_STR);
																	$query-> execute();
																	$results = $query -> fetchAll(PDO::FETCH_OBJ);
																	if($query -> rowCount() > 0)
																	{
																		foreach($results as $result)
																		{
																		?>
																		<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->Name);?></option>
																	<?php }} ?>
																	
															</select>
														</div>
													</div>
													
													<div class="hr-dashed"></div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Futsal Detail<span style="color:red">*</span></label>
														<div class="col-sm-10">
															<textarea class="form-control" name="orcview" rows="3" required></textarea>
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-sm-2 control-label">Price Per Hour<span style="color:red">*</span></label>
														<div class="col-sm-4">
															<input type="text" name="priceperday" class="form-control" required>
															</div>
															<label class="col-sm-2 control-label">Select Court <span style="color:red">*</span></label>
															<div class="col-sm-4">
																<select class="selectpicker" name="type" required>
																	<option value=""> Select </option>
																	
																	<option value="Court 1">1-Court</option>
																	<option value="Court 2">2-Court</option>
																</select>
															</div>
														</div>
														<div class="form-group">
															<label class="col-sm-2 control-label">Address<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="address" class="form-control" required>
															</div>
															<label class="col-sm-2 control-label">Contact No.<span style="color:red">*</span></label>
															<div class="col-sm-4">
																<input type="text" name="contact" class="form-control" maxlength="10" required>
															</div>
														</div>
														
														<div class="hr-dashed"></div>
														<div class="form-group">
															<div class="col-sm-12">
																<h4><b>Upload Images</b></h4>
															</div>
														</div>
														
														
														<div class="form-group">
															<div class="col-sm-4">
																Image 1 <span style="color:red">*</span><input type="file" name="img2" required>
															</div>
															<div class="col-sm-4">
																Image 2<span style="color:red">*</span><input type="file" name="img3" required>
															</div>
															<div class="col-sm-4">
																Image 3<span style="color:red">*</span><input type="file" name="img4" required>
															</div>
														</div>
														
														<div class="row">
															<div class="col-md-12">
																<div class="panel panel-default">
																	<div class="panel-heading">Availability</div>
																	<div class="panel-body">
																		
																		
																		<div class="form-group">
																			<div class="col-sm-3">
																				<div class="checkbox checkbox-inline">
																					<input type="checkbox" id="shower" name="shower" value="Yes">
																					<label for="shower"> Shower </label>
																				</div>
																			</div>
																			<div class="col-sm-3">
																				<div class="checkbox checkbox-inline">
																					<input type="checkbox" id="wifi" name="wifi" value="Yes">
																					<label for="wifi"> Wifi </label>
																				</div></div>
																				<div class="col-sm-3">
																					<div class="checkbox checkbox-inline">
																						<input type="checkbox" id="parking" name="parking" value="Yes">
																						<label for="parking"> Parking </label>
																					</div></div>
																					<div class="col-sm-3">
																						<div class="checkbox checkbox-inline">
																							<input type="checkbox" id="firstaid" name="firstaid" value="Yes">
																							<label for="firstaid"> First Aid </label>
																						</div>
																					</div>
																					
																					<div class="form-group">
																						<div class="col-sm-8 col-sm-offset-2">
																							<button class="btn btn-default" type="reset">Cancel</button>
																							<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
																						</div>
																					</div>
																					
																		</form>
																	</div>
																</div>
															</div>
														</div>
														
														
														
													</div>
												</div>
												
												
												
											</div>
										</div>
									</div>
									
									<!-- Loading Scripts -->
									<script src="js/jquery.min.js"></script>
									<script src="js/bootstrap-select.min.js"></script>
									<script src="js/bootstrap.min.js"></script>
									<script src="js/jquery.dataTables.min.js"></script>
									<script src="js/dataTables.bootstrap.min.js"></script>
									<script src="js/Chart.min.js"></script>
									<script src="js/fileinput.js"></script>
									<script src="js/chartData.js"></script>
									<script src="js/main.js"></script>
								</body>
							</html>
						<?php } ?>																												