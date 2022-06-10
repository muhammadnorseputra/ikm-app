<section class="hero bg-primary hero-overlay">
	<div class="p-md-5 py-3 px-2">
		<div class="container py-md-3">
			<div class="d-flex justify-content-between align-items-md-center align-items-start flex-lg-row flex-column overflow-y-hidden">
				<div class="order-last order-md-first col-md-6">
					<!-- <img src="<?= base_url('assets/images/logo.png') ?>" class="d-none d-md-block mt--5" width="80" alt="Logo Kabupaten Balangan - BKPSDM Kab. Balangan"> -->
					<h1 class="display-4 fw-bold text-white" data-aos="fade-up" data-aos-delay="50">Selamat Datang</h1>
					<p class="fs-4 text-white" data-aos="fade-up" data-aos-delay="100">Di Survei IKM BKPSDM Kabupaten Balangan</p>
					
					<a data-aos="fade-up" data-aos-delay="150" href="<?= base_url('survei') ?>" class="btn btn-warning btn-lg px-4 shadow">
						<i class="bi bi-ui-checks me-2"></i>
						Isi Survei Sekarang
						<i class="bi bi-arrow-right"></i>
					</a>
					<a data-aos="fade" data-aos-delay="250" target="_blank" href="//bit.ly/3q22H7Q" class="btn btn-secondary rounded shadow" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Panduan Penggunaan e-Survei">
						<i class="bi bi-book-half fs-4"></i>
					</a>
					<div class="mt-4">
						<span class="display-1 fw-bold text-warning countTo" data-from="0" data-to="<?= nominal($total_responden) ?>"
						data-speed="300" data-refresh-interval="50" data-aos="fade-up" data-aos-delay="200">0</span>
						<p class="text-light" data-aos="fade-up" data-aos-delay="250" data-aos-once="true">Total Responden sampai saat ini.</p>
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
<svg style="pointer-events: none;" class="wave" width="100%" height="50px" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
    <defs>
        <style>
            .a {
                fill: none;
            }

            .b {
                clip-path: url(#a);
            }

            .c,
            .d {
                fill: #ffffff;
            }

            .d {
                opacity: 0.5;
                isolation: isolate;
            }
        </style>
        <clipPath id="a">
            <rect class="a" width="1920" height="75"></rect>
        </clipPath>
    </defs>
    <title>wave</title>
    <g class="b">
        <path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"></path>
    </g>
    <g class="b">
        <path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"></path>
    </g>
    <g class="b">
        <path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"></path>
    </g>
    <g class="b">
        <path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"></path>
    </g>
</svg>
</section>

<section class="pedoman-ikm mb-5">
<div class="container">
	<div class="row align-items-center">
		<div class="col-12">
			<div class="d-flex justify-content-between align-items-start flex-lg-row flex-column gap-3 shadow-sm p-3 rounded-3 bg-white">
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
					<h5 class="card-title text-primary fw-bold">Apa sih IKM itu ?</h5>
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
						<a  class="btn btn-primary btn-lg px-4 shadow" href="<?= base_url('survei') ?>">
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
<svg id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(33, 37, 41, 1)" offset="0%"></stop><stop stop-color="rgba(33, 37, 41, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,10L16,20C32,30,64,50,96,50C128,50,160,30,192,23.3C224,17,256,23,288,33.3C320,43,352,57,384,61.7C416,67,448,63,480,65C512,67,544,73,576,78.3C608,83,640,87,672,86.7C704,87,736,83,768,73.3C800,63,832,47,864,41.7C896,37,928,43,960,43.3C992,43,1024,37,1056,40C1088,43,1120,57,1152,56.7C1184,57,1216,43,1248,33.3C1280,23,1312,17,1344,11.7C1376,7,1408,3,1440,11.7C1472,20,1504,40,1536,45C1568,50,1600,40,1632,35C1664,30,1696,30,1728,31.7C1760,33,1792,37,1824,31.7C1856,27,1888,13,1920,21.7C1952,30,1984,60,2016,63.3C2048,67,2080,43,2112,36.7C2144,30,2176,40,2208,51.7C2240,63,2272,77,2288,83.3L2304,90L2304,100L2288,100C2272,100,2240,100,2208,100C2176,100,2144,100,2112,100C2080,100,2048,100,2016,100C1984,100,1952,100,1920,100C1888,100,1856,100,1824,100C1792,100,1760,100,1728,100C1696,100,1664,100,1632,100C1600,100,1568,100,1536,100C1504,100,1472,100,1440,100C1408,100,1376,100,1344,100C1312,100,1280,100,1248,100C1216,100,1184,100,1152,100C1120,100,1088,100,1056,100C1024,100,992,100,960,100C928,100,896,100,864,100C832,100,800,100,768,100C736,100,704,100,672,100C640,100,608,100,576,100C544,100,512,100,480,100C448,100,416,100,384,100C352,100,320,100,288,100C256,100,224,100,192,100C160,100,128,100,96,100C64,100,32,100,16,100L0,100Z"></path></svg>
<div class="bg-dark"  id="feedback">
<div class="container">
	<div class="row mb-md-5">
		<div class="col">
			<div class="fw-bold display-6 text-primary"> Apasih Untungnya Responden Anda Bagi Kami</div>
		</div>
	</div>
	<div class="row">
		<div class="col my-5 text-light">
			<img  class="animated bounce img-fluid shadow-lg rounded mb-5" src="<?= base_url('assets/images/bg/bg-hero-function-1.png') ?>"  alt="Survei BKPPD">
			<h5 class="d-flex"><span class="text-primary me-3">&bull;</span> Sebagai Indikator Untuk Meningkatkan Layanan</h5>
			<h5 class="d-flex"><span class="text-primary me-3">&bull;</span> Cara yang efektif dan efisien untuk melakukan sebuah pengamatan atau observasi terhadap suatu kegiatan.</h5>
		</div>
		<div class="col my-5 text-light">
			<img class="animated bounce img-fluid shadow-lg rounded mb-5" src="<?= base_url('assets/images/bg/bg-hero-function-2.png') ?>" alt="Survei BKPPD">
			<h5 class="d-flex"><span class="text-primary me-3">&bull;</span> Motivasi Kami Untuk Lebih Maju Lagi</h5>
			<h5 class="d-flex"><span class="text-primary me-3">&bull;</span> Sebagai indikator dalam mengetahui Kualitas dan Kuantitas suatu layanan. </h5>
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
		<img src="<?= base_url('assets/images/qr-web-ikm.png') ?>" class="img-fluid" alt="qr-code-ikm-bkpsdm-balangan">
	</div>
	<div class="col-12 col-md-6">
		<div class="fs-4 fw-bold text-primary mb-2">Tinjau Perkembangan IKM</div>
		<p class="text-muted">
			Silahkan pindai QR-Code untuk meninjau secara langsung hasil dari penilaian Indeks Kepuasan Masyarakat (IKM) atau dengan mengunjungi alamat url (<a href="<?= base_url('ikm') ?>"><badge>https://www.bkpsdm.balangankab.go.id/ikm</badge></a>)
		</p>
		<p class="text-muted">
			Kami selaku unit pelayanan mengucapkan terimakasih atas partisipasi anda dalam pelaksanaan penilaian IKM secara Online maupun Offline.
		</p>
	</div>
</div>
</div>
</footer>
<?php $this->load->view('Frontend/skm/pages/print_modal'); ?>