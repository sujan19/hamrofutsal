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
			$title=$_POST['title'];
			$brand=$_POST['brandname'];
			$overview=$_POST['orcview'];
			$priceperday=$_POST['priceperday'];
			$type=$_POST['type'];
			$shower=$_POST['shower'];
			$wifi=$_POST['wifi'];
			$parking=$_POST['parking'];
			$firstaid=$_POST['firstaid'];
			$id=intval($_GET['id']);
			$sql="update addfutsal set Title=:title,Brand=:brand,Overview=:overview,PricePerDay=:priceperday,Type=:type,Shower=:shower,Wifi=:wifi,Parking=:parking,Firstaid=:firstaid where id=:id ";
			$query = $dbh->prepare($sql);
			$query->bindParam(':title',$title,PDO::PARAM_STR);
			$query->bindParam(':brand',$brand,PDO::PARAM_STR);
			$query->bindParam(':overview',$overview,PDO::PARAM_STR);
			$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
			$query->bindParam(':type',$type,PDO::PARAM_STR);
			$query->bindParam(':shower',$shower,PDO::PARAM_STR);
			$query->bindParam(':wifi',$wifi,PDO::PARAM_STR);
			$query->bindParam(':parking',$parking,PDO::PARAM_STR);
			$query->bindParam(':firstaid',$firstaid,PDO::PARAM_STR);
			$query->bindParam(':id',$id,PDO::PARAM_STR);
			$query->execute();
			
			$msg="Data updated successfully";
			
			
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
			
			<title>hamrofutsal| Admin Edit</title>
			
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
								
								<h2 class="page-title">Edit Futsal</h2>
								
								<div class="row">
									<div class="col-md-12">
										<div class="panel panel-default">
											<div class="panel-heading">Basic Info</div>
											<div class="panel-body">
												<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
												<?php 
													$id=intval($_GET['id']);
													$sql ="SELECT addfutsal.*,location.Name,location.id as bid from addfutsal join location on location.id=addfutsal.Brand where addfutsal.id=:id";
													$query = $dbh -> prepare($sql);
													$query-> bindParam(':id', $id, PDO::PARAM_STR);
													$query->execute();
													$results=$query->fetchAll(PDO::FETCH_OBJ);
													$cnt=1;
													if($query->rowCount() > 0)
													{
														foreach($results as $result)
														{	?>
														
														<form method="post" class="form-horizontal" enctype="multipart/form-data">
															<div class="form-group">
																<label class="col-sm-2 control-label">Futsal Name<span style="color:red">*</span></label>
																<div class="col-sm-4">
																	<input type="text" name="title" class="form-control" value="<?php echo htmlentities($result->Title)?>" required>
																</div>
																<label class="col-sm-2 control-label">Location<span style="color:red">*</span></label>
																<div class="col-sm-4">
																	<select class="selectpicker" name="brandname" required>
																		<option value="<?php echo htmlentities($result->bid);?>"><?php echo htmlentities($bdname=$result->Name); ?> </option>
																		<?php $ret="select id,Name from location";
																			$query= $dbh -> prepare($ret);
																			//$query->bindParam(':id',$id, PDO::PARAM_STR);
																			$query-> execute();
																			$resultss = $query -> fetchAll(PDO::FETCH_OBJ);
																			if($query -> rowCount() > 0)
																			{
																				foreach($resultss as $results)
																				{
																					if($results->Name==$bdname)
																					{
																						continue;
																						} else{
																					?>
																					<option value="<?php echo htmlentities($results->id);?>"><?php echo htmlentities($results->Name);?></option>
																				<?php }}} ?>
																				
																	</select>
																</div>
															</div>
															
															<div class="hr-dashed"></div>
															<div class="form-group">
																<label class="col-sm-2 control-label"> Overview<span style="color:red">*</span></label>
																<div class="col-sm-10">
																	<textarea class="form-control" name="orcview" rows="3" required><?php echo htmlentities($result->Overview);?></textarea>
																</div>
															</div>
															
															<div class="form-group">
																<label class="col-sm-2 control-label">Price Per hour<span style="color:red">*</span></label>
																<div class="col-sm-4">
																	<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result->PricePerDay);?>" required>
																</div>
																<label class="col-sm-2 control-label">Court Type<span style="color:red">*</span></label>
																<div class="col-sm-4">
																	<select class="selectpicker" name="type" required>
																		<option value="<?php echo htmlentities($results->Type);?>"> <?php echo htmlentities($result->Type);?> </option>
																		
																		<option value="Court 1">1-Court</option>
																		<option value="Court 2">2-Court</option>
																		
																	</select>
																</div>
															</div>
															
															<div class="hr-dashed"></div>								
															<div class="form-group">
																<div class="col-sm-12">
																	<h4><b> Images</b></h4>
																</div>
															</div>
															
															
															<div class="form-group">
																<div class="col-sm-4">
																	Image 1<img src="img/futsalimages/<?php echo htmlentities($result->Vimage2);?>" width="300" height="200" style="border:solid 1px #000">
																	<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 1</a>
																</div>
																<div class="col-sm-4">
																	Image 2<img src="img/futsalimages/<?php echo htmlentities($result->Vimage3);?>" width="300" height="200" style="border:solid 1px #000">
																	<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 2</a>
																</div>
																<div class="col-sm-4">
																	Image 3 <img src="img/futsalimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
																	<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 3</a>
																</div>
															</div>
															
															<div class="hr-dashed"></div>									
														</div>
													</div>
												</div>
											</div>
											
											
											
											<div class="row">
												<div class="col-md-12">
													<div class="panel panel-default">
														<div class="panel-heading">Availability</div>
														<div class="panel-body">
														
														
														<div class="form-group">
														<div class="col-sm-3">
														<?php if($result->Shower==Yes)
														{?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="shower" checked value="Yes">
														<label for="inlineCheckbox1"> Shower </label>
														</div>
														<?php } else { ?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="shower" value="Yes">
														<label for="inlineCheckbox1"> Shower </label>
														</div>
														<?php } ?>
														</div>
														<div class="col-sm-3">
														<?php if($result->Wifi==Yes)
														{?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="wifi" checked value="Yes">
														<label for="inlineCheckbox2"> Wifi </label>
														</div>
														<?php } else {?>
														<div class="checkbox checkbox-success checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="wifi" value="Yes">
														<label for="inlineCheckbox2"> Wifi</label>
														</div>
														<?php }?>
														</div>
														<div class="col-sm-3">
														<?php if($result->Parking==Yes)
														{?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="parking" checked value="Yes">
														<label for="inlineCheckbox3"> Parking</label>
														</div>
														<?php } else {?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="parking" value="Yes">
														<label for="inlineCheckbox3"> Parking </label>
														</div>
														<?php } ?>
														</div>
														<div class="col-sm-3">
														<?php if($result->Firstaid==Yes)
														{
														?>
														<div class="checkbox checkbox-inline">
														<input type="checkbox" id="inlineCheckbox1" name="firstaid" checked value="Yes">
														<label for="inlineCheckbox3"> Firstaid </label>
														</div>
														<?php } else {?>
														<?php } ?>
														</div>
														</div>
														
														<?php }} ?>
														
														
														<div class="form-group">
														<div class="col-sm-8 col-sm-offset-2" >
														
														<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
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