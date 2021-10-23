<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?= $title ?></title>
		<link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap-4/css/bootstrap.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/b_login.css') ?>">
		<link rel="stylesheet" href="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/theme-default.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('template/argon/vendor/@fortawesome/fontawesome-free/css/all.min.css') ?>">
	</head>
	<body>
		<section class="login-block px-md-0 px-3">
			<div class="container">
				<div class="row">
					<div class="col-md-4 login-sec">
						<h2 class="text-center">
							<i class="fas fa-project-diagram fa-2x text-primary"></i> e-Survei</h2>
						<?php  
							$urlRef = isset($_GET['continue']) ? $_GET['continue'] : ''; 
						?>
						<?= form_open(base_url('backend/login/cek_akun'), ['autocomplete' => 'off', 'id' => 'f_login'], ['token' => encrypt_url('esurvei@#123'.date('d')), 'continue' => $urlRef]); ?>
							<div class="form-group">
								<label for="username" class="text-uppercase">Username</label>
								<input type="text" name="username" class="form-control" placeholder="User Akun" data-sanitize="trim" required="required" id="username">
							</div>
							<div class="form-group">
								<label for="password-field" class="text-uppercase">Password</label>
								<input type="password" name="pwd" autocomplete="off" id="password-field" class="form-control" placeholder="Password" data-sanitize="trim" required="required">
							</div>							
							<div class="form-check show_pass">
								<label class="form-check-label">
									<span toggle="#password-field" class="fa fa-fw fa-eye-slash toggle-password"></span>
									<small class="text_pw">Show Password</small>
								</label>
								<button type="submit" class="btn btn-login float-right">Masuk</button>
							</div>
							
						<?= form_close(); ?>
						<div class="copy-text">Created with <i class="fa fa-heart"></i> by Laptop</div>
					</div>
					<div class="col-md-8 banner-sec d-none d-md-block">
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
								<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img class="d-block img-fluid" src="<?= base_url('assets/images/bg/pexels-photo.jpg'); ?>" alt="Second slide">
									<div class="carousel-caption d-none d-md-block">
										<div class="banner-text">
											<h2>Akses Data Otomatis dan Real-time</h2>
											<p>esponden memasukan data mereka, dan saat itu juga secara otomatis akan disimpan ke dalam software dalam bentuk data elektronik. Dengan demikian analisis data menjadi lebih mudah dan efisien karena data langsung tersedia.</p>
										</div>
									</div>
								</div>
								<div class="carousel-item">
									<img class="d-block img-fluid" src="<?= base_url('assets/images/bg/people-coffee-tea-meeting.jpg') ?>" alt="First slide">
									<div class="carousel-caption d-none d-md-block">
										<div class="banner-text">
											<h2>Waktu yang Cepat</h2>
											<p>Pendistribusian kuesioner dan feed back data online dilakukan sedemikian cepat. Hal ini tidak bisa dilakukan dengan menggunakan model survey konvensional. Dalam banyak kasus, pengiriman kertas kuesioner baik pendistribusian maupun kirim kembali ke pusat data sering mengalami kendala.</p>
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
			<script src="<?= base_url('assets/plugins/blockUI/jquery.blockUI.js') ?>"></script>
			<script src="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>"></script>
			<script src="<?= base_url('assets/js/route.js') ?>"></script>
			<script src="<?= base_url('assets/js/console_login.js') ?>"></script>
		</body>
	</html>