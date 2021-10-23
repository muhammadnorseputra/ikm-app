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
<nav class="navbar navbar-expand-lg <?= $nv." ".$bg ?>" id="navbar">
	<div class="container">
		<a class="navbar-brand text-truncate d-block text-center" href="<?= base_url('skm') ?>">
			<!-- <img src="<?= base_url('assets/images/logo.png'); ?>" alt="Survey SKM" width="40"> -->
			<span class="fw-bold">DEMO VERSION</span>
		</a>
		<a class="btn btn-secondary btn-block ms-auto d-block d-sm-block d-md-block d-lg-none"  href="<?= base_url('console') ?>">
		Masuk Console</a>
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
				<?php if(!empty($this->session->userdata('user_name'))): ?>
				<li class="nav-item">
					<a class="nav-link fw-bold" href="<?= base_url('laporan'); ?>" tabindex="-1" aria-disabled="true">Laporan</a>
				</li>
				<?php endif ?>
				<?php if(empty($this->session->userdata('user_name'))): ?>
				<a class="btn btn-secondary me-2 d-none d-md-block position-relative " href="<?= base_url('console') ?>">
					  Masuk Console
					<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger rounded-circle animate__animated animate__flash animate__infinite">
							<span class="visually-hidden">New alerts</span>
						</span>
				</a>
				<?php else: ?>
					<a href="<?= base_url('console') ?>">
					    <img src="<?= base_url("assets/images/pic/".$this->session->userdata('pic')); ?>" width="40" class="rounded-circle" alt="<?= $this->session->userdata('nama'); ?>">		
					</a>
				<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>