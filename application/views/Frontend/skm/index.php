<section class="hero">
	<div class="p-md-4 py-3 px-2 bg-dark">
		<div class="container py-md-5">
			<div class="d-flex justify-content-between align-items-md-center align-items-start flex-lg-row flex-column">
				<div class="order-last order-md-first col-md-6">
					<h1 class="display-4 fw-bold text-white">Selamat Datang</h1>
					<p class="fs-4 text-white">Di e-Survei Demo Version</p>
					
					<a href="<?= base_url('survei') ?>" class="btn btn-warning btn-lg px-4 shadow">
						Isi Survei Sekarang
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
							<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
						</svg>
					</a>
					<div class="mt-4">
						<span class="display-1 fw-bold text-warning countTo" data-from="0" data-to="<?= nominal($total_responden) ?>"
						data-speed="300" data-refresh-interval="50">0</span>
						<p class="text-light">Total Responden sampai saat ini.</p>
					</div>
				</div>
				<div>
					<div>
						<img src="<?= base_url('assets/images/bg/illustration_hero_banner.svg') ?>" class="animated bounce img-fluid" alt="Survey BKPPD">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="pedoman-ikm mb-5" style="margin-top: -5%;">
<div class="container">
	<div class="row align-items-center">
		<div class="col-12">
			<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column gap-3 shadow p-3 rounded-3 border  bg-white">
				<div>
					<img src="<?= base_url('assets/images/skm_menpan.png') ?>" alt="SKM - BKPPD BALANGAN" class="w-auto img-fluid">
				</div>
				<div class="ps-md-4">
					<div class="fw-bold fs-4">Pedoman Penyusunan Survei IKM</div>
					<p>
						Peraturan MENPAN Nomor 14 Tahun 2017 merupakan pedoman dalam penysunan SKM (Survei Kepuasan Masyarakat) untuk Unit Penyelenggara Pelayanan Publik. <br>
						Detail :
						<a href="https://peraturan.bpk.go.id/Home/Details/132600/permen-pan-rb-no-14-tahun-2017" target="_blank">Permenpan RB NO.14 Tahun 2017</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="apa-ikm" id="apa-itu-ikm">
<div class="container">
	<div class="row align-items-center">
		<div class="col-12 col-md-6 order-first">
			<img src="<?= base_url('assets/images/bg/bg-hero-responden.webp') ?>" class="animated bounce img-responsive w-100" alt="Survey BKPPD">
		</div>
		<div class="col-12 col-md-6">
			<div class="card border-0">
				<div class="card-body lead">
					<h5 class="card-title text-success fw-bold">Apa sih IKM itu ?</h5>
					<!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
					<div class="card-text">
						<p>
							Indeks Kepuasan Masyarakat (IKM) adalah data dan informasi tentang tingkat kepuasan masyarakat yang diperoleh dari hasil pengukuran secara kuantitatif dan kualitatif atas pendapat masyarakat dalam memperoleh pelayanan dari aparatur penyelenggara pelayanan publik dengan membandingkan antara harapan dan kebutuhannya.
						</p>
						<p>
							Mengingat fungsi utama pemerintah adalah melayani masyarakat maka pemerintah perlu terus berupaya meningkatkan kualitas pelayanan. Ukuran keberhasilan penyelenggaraan pelayanan ditentukan oleh tingkat kepuasan penerima pelayanan. Kepuasan penerima pelayanan dicapai apabila penerima pelayanan memperoleh pelayanan sesuai dengan yang dibutuhkan dan diharapkan.
						</p>
						<p>
							Dengan adanya survey IKM ini diharapkan kami dapat selalu meningkatkan layanan kami terhadap masyarakat.
						</p>
						<a  class="btn btn-success btn-lg px-4 shadow" href="<?= base_url('survei') ?>">
							Isi Survei Sekarang
							<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
								<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
							</svg>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<section class="function">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#212529" fill-opacity="1" d="M0,32L30,69.3C60,107,120,181,180,192C240,203,300,149,360,138.7C420,128,480,160,540,170.7C600,181,660,171,720,170.7C780,171,840,181,900,170.7C960,160,1020,128,1080,122.7C1140,117,1200,139,1260,170.7C1320,203,1380,245,1410,266.7L1440,288L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path></svg>
<div class="bg-dark"  id="feedback">
<div class="container">
	<div class="row mb-md-5">
		<div class="col">
			<div class="fw-bold display-6 text-success"> Apasih Untungnya Responden Anda Bagi Kami</div>
		</div>
	</div>
	<div class="row">
		<div class="col my-5 text-light">
			<img  class="animated bounce img-fluid shadow-lg rounded mb-5" src="<?= base_url('assets/images/bg/bg-hero-function-1.png') ?>"  alt="Survei BKPPD">
			<h5 class="d-flex"><span class="text-success me-3">&bull;</span> Sebagai Indikator Untuk Meningkatkan Layanan</h5>
			<h5 class="d-flex"><span class="text-success me-3">&bull;</span> Cara yang efektif dan efisien untuk melakukan sebuah pengamatan atau observasi terhadap suatu kegiatan.</h5>
		</div>
		<div class="col my-5 text-light">
			<img class="animated bounce img-fluid shadow-lg rounded mb-5" src="<?= base_url('assets/images/bg/bg-hero-function-2.png') ?>" alt="Survei BKPPD">
			<h5 class="d-flex"><span class="text-success me-3">&bull;</span> Motivasi Kami Untuk Lebih Maju Lagi</h5>
			<h5 class="d-flex"><span class="text-success me-3">&bull;</span> Sebagai indikator dalam mengetahui Kualitas dan Kuantitas suatu layanan. </h5>
		</div>
	</div>
</div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 210"><path fill="#212529" fill-opacity="1" d="M0,192L26.7,165.3C53.3,139,107,85,160,53.3C213.3,21,267,11,320,10.7C373.3,11,427,21,480,42.7C533.3,64,587,96,640,106.7C693.3,117,747,107,800,90.7C853.3,75,907,53,960,58.7C1013.3,64,1067,96,1120,122.7C1173.3,149,1227,171,1280,176C1333.3,181,1387,171,1413,165.3L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
</section>
<footer class="pb-5">
<div class="container">
<div class="row gap-5 py-5">
	<div class="col-12 col-md-2 offset-md-2">
		<img src="<?= base_url('assets/images/ikm-bkppd-balangan.png') ?>" class="img-fluid" alt="qr-code-ikm-bkppd-balangan">
	</div>
	<div class="col-12 col-md-6">
		<div class="fs-4 fw-bold text-success mb-2">Tinjau Perkembangan IKM</div>
		<p class="text-muted">
			Silahkan pindai QR-Code untuk meninjau secara langsung hasil dari penilaian Indeks Kepuasan Masyarakat (IKM) atau dengan mengunjungi alamat url (<code>https://qrco.de/ikm-bkppd-balangan</code>)
		</p>
		<p class="text-muted">
			Kami selaku unit pelayanan mengucapkan terimakasih atas partisipasi anda dalam pelaksanaan penilaian IKM secara Online maupun Offline.
		</p>
	</div>
</div>
</div>
</footer>
<?php $this->load->view('Frontend/skm/pages/print_modal'); ?>