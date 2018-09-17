<?php
	require_once("database/db_connection.php"); 
	$_SESSION['message']="";
	$_SESSION['error']="";
	session_start(); 
		if(isset($_SESSION['admin'])) {
	        header("location:admin/change-password.php");
		}else
             if(isset($_SESSION['user'])) {
	             header("location:admin/change-password.php");
			}
     if(isset($_POST['login'])){
    	$username=$_POST['username'];
    	$password=md5($_POST['password']);
    	$query="SELECT * FROM users WHERE username='$username' AND password='$password' AND status='0'";
    	$sql=mysqli_query($connection,$query);
    	if(mysqli_num_rows($sql)>0){
    		$_SESSION['admin']=$username;
    		header("location:admin/change-password.php");
    	}else
		$username=$_POST['username'];
    	$password=md5($_POST['password']);
		$query="SELECT * FROM users WHERE username='$username' AND password='$password' AND status='1'";
    	$sql=mysqli_query($connection,$query);
    	if(mysqli_num_rows($sql)>0){
    		$_SESSION['user']=$username;
		header("location:change-password.php");}
    		
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login Panel</title>
 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>


<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<a href="/hamrofutsal"><button class="btn btn-default btn-lg">Login</button></a>
				<div class="panel panel-login">
		
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								  <form id="login-form" action="" method="post" role="form" >
							 	
									<?php if (isset($_SESSION['error'])) {?>
										<p style="color: red;text-align: center;"><?php echo $_SESSION['error']; ?><?php session_unset(); ?></p>
									<?php }  ?>
									<?php if (isset($_SESSION['message'])) {?>
										<p style="color: green;text-align: center;"><?php echo $_SESSION['message']; ?><?php session_unset(); ?></p>
									<?php }  ?>
										<div class="wrap-input100 validate-input"  class="form-group">
										<input class="input100" type="text" required name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									<span class="focus-input100"></span>
						                <span class="symbol-input100">
							            <i class="fa fa-envelope" aria-hidden="true"></i>
						                </span>
									</div>
									<div class="wrap-input100 validate-input"  class="form-group">
										<input class="input100" type="password" required name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									<span class="focus-input100"></span>
						                <span class="symbol-input100">
							            <i class="fa fa-lock" aria-hidden="true"></i>
						                </span>
									</div>
									<div class="form-group">
										<div class="row">
											<div>
									<button class="login100-form-btn"  type="submit" name="login" id="login-submit">Login</button></a>
											</div>
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
	

	 <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/login.js"></script>
    
</body>

</html>
