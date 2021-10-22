<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $title ?></title>
		<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/b_login.css') ?>">
	</head>
	<body>
			
		<section class="login-block px-md-0 px-3">
			<div class="container">
				<div class="row">
					<div class="col-md-4 login-sec">
						<h2 class="text-center">Console e-Survei</h2>
						<form class="login-form">
							<div class="form-group">
								<label for="exampleInputEmail1" class="text-uppercase">Username</label>
								<input type="text" class="form-control" placeholder="">
								
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1" class="text-uppercase">Password</label>
								<input type="password" class="form-control" placeholder="">
							</div>
							
							
							<div class="form-check">
								<label class="form-check-label">
									<input type="checkbox" class="form-check-input">
									<small>Remember Me</small>
								</label>
								<button type="submit" class="btn btn-login float-right">Submit</button>
							</div>
							
						</form>
						<div class="copy-text">Created with <i class="fa fa-heart"></i> by e-Survei</div>
					</div>
					<div class="col-md-8 banner-sec d-none d-md-block">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item">
									<img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
									<div class="carousel-caption d-none d-md-block">
										<div class="banner-text">
											<h2>This is Heaven</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
										</div>
									</div>
								</div>
								<div class="carousel-item active">
									<img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
									<div class="carousel-caption d-none d-md-block">
										<div class="banner-text">
											<h2>This is Heaven</h2>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation</p>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</section>
			<script src="<?= base_url('assets/js/jquery-3.3.1.min.js') ?>"></script>
			<script src="<?= base_url('assets/plugins/bootstrap-4/js/bootstrap.min.js') ?>"></script>
		</body>
	</html>