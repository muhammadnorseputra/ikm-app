<?php  
	$uri = $this->uri->segment(1);
	if($uri === 'ikm'):
		$nv = 'navbar-dark'; $bg = 'bg-dark bg-gradient';
	elseif($uri === 'skm'):
		$nv = 'navbar-dark'; $bg = 'bg-dark bg-gradient';
	else:
		$nv = 'navbar-light'; $bg = 'bg-light bg-gradient';
	endif;
?>
<nav class="navbar navbar-expand-lg <?= $nv." ".$bg ?> sticky-top shadow-sm" id="navbar">
	<div class="container">
		<a class="navbar-brand text-truncate d-block text-center" href="<?= base_url('skm') ?>">
			<!-- <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Survey SKM" width="40"> -->
			<span class="fw-bold">DEMO VERSION</span>
		</a>
		<?php if(empty($this->session->userdata('user_name'))): ?>
		<a class="btn btn-secondary btn-block ms-auto d-block d-sm-block d-md-block d-lg-none"  href="<?= base_url('console') ?>">
		Console</a>
		<?php endif; ?>
		<span class="text-secondary mx-2"></span>
		<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarScroll">
			<ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll gap-4" style="--bs-scroll-height: 100px;">
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('skm') ?>">Home</a>
				</li>
				<?php if($this->uri->segment(1) == 'skm'): ?>
				<li class="nav-item">
					<a class="nav-link fw-bold text-warning" href="#apa-itu-ikm" tabindex="-1" aria-disabled="true">Apa itu IKM ?
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#feedback" tabindex="-1" aria-disabled="true">Feedback</a>
				</li>
				<?php endif; ?>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('ikm') ?>">
						IKM
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="#cetak" tabindex="-1" aria-disabled="true" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasExample">Cetak Formulir</a>
				</li>
				<?php if(empty($this->session->userdata('user_name'))): ?>
				<a class="btn btn-secondary me-2 d-none d-md-block position-relative " href="<?= base_url('console') ?>">
					  Console
					<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle animate__animated animate__flash animate__infinite">
							<span class="visually-hidden">New alerts</span>
						</span>
				</a>
				<?php else: ?>
				<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" id="profile-detail" role="button" data-bs-toggle="dropdown" aria-expanded="true">
					    <img src="<?= base_url("assets/images/pic/".$this->session->userdata('pic')); ?>" width="30" height="30" class="rounded-circle" alt="<?= $this->session->userdata('nama'); ?>">
					</a>
					<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="profile-detail">
			            <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">
			            	<i class="bi bi-speedometer me-2"></i> Dahsboard</a></li>
			            <li><hr class="dropdown-divider"></li>
			            <li><h6 class="dropdown-header">Hasil IKM</h6></li>
			            <li><a class="dropdown-item" href="<?= base_url('laporan') ?>">Laporan</a></li>
			            <li><a class="dropdown-item" href="<?= base_url('laporan/m/table') ?>">Rekapitulasi</a></li>
			            <li><a class="dropdown-item" href="<?= base_url('report') ?>">Report Chart</a></li>
			            <li><hr class="dropdown-divider"></li>
			            <li><h6 class="dropdown-header">Akun Saya</h6></li>
			            <li><a class="dropdown-item" href="<?= base_url('profile/'.$this->session->userdata('user_name')) ?>">My Profile</a></li>
			            <li><a class="dropdown-item" href="<?= base_url('logout?continue='.curPageURL()) ?>">Logout</a></li>
			          </ul>
				</li>
				<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>