
<header>
	<div class="default-header">
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-2">
					
				</div>
				<div class="col-sm-9 col-md-10">
					<div class="header_info">
						<div class="header_widgets">
							<div class="circle_icon"> <i class="fa fa-envelope" aria-hidden="true"></i> </div>
							<p class="uppercase_text"> Mail us : </p>
						<a href="mailto:hamrofutsal@gmail.com">hamrofutsal@gmail.com</a> </div>
						<div class="header_widgets">
							<div class="circle_icon"> <i class="fa fa-phone" aria-hidden="true"></i> </div>
							<p class="uppercase_text"> For Inquiry: </p>
						<a href="tel:01544326">+01544326,9813629134</a> </div>
						<div class="social-follow">
							<ul>
								<li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<?php   if(strlen($_SESSION['login'])==0)
							{	
							?>
							<div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Register</a> </div>
							<?php }
							else{ 
								
								echo "Welcome To hamrofutsal";
							} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</header>