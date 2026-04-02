<section class="bg-success hero-overlay">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="text-light py-md-5 pt-5 text-center text-md-start">
					<div class="display-3">IKM</div>
					<div class="fs-3">(Indeks Kepuasan Masyarakat)</div>
					<?php
					$bulan_mulai = date('m', strtotime($periode->tgl_mulai));
					$bulan_selesai = date('m', strtotime($periode->tgl_selesai));
					?>
					<p class="fs-3 text-warning">Periode <span class="text-glow-white">Live</span> <?= bulan($bulan_mulai) ?> - <?= bulan($bulan_selesai) ?> <?= $periode->tahun ?></p>
				</div>
				<a href="<?= base_url('survei') ?>" class="btn btn-warning btn-lg px-4 shadow d-block d-md-inline">
					<i class="bi bi-ui-checks me-2"></i>
					Isi Survei Sekarang
					<i class="bi bi-arrow-right"></i>
				</a>
			</div>
			<div class="col-12 col-md-6">
				<form action="#" method="post" id="FormFilterChange">
				<div class="form-group d-flex justify-content-start mt-2 mt-md-5 gap-1">
					<div class="form-floating">
						<select name="periode" class="form-select" id="periodeFilter" aria-label="Floating label select example">
							<?php
							foreach ($periode_all->result() as $v) :
								$selected = $v->id == $_GET['periode'] ? 'selected' : '';
							?>
								<option value="<?= $v->id ?>" <?= $selected ?>><?= $v->tahun . " (" . bulan(date('m', strtotime($v->tgl_mulai))) . " - " . bulan(date('m', strtotime($v->tgl_selesai))) . ")" ?></option>
							<?php endforeach; ?>
						</select>
						<label for="periodeFilter">PERIODE/SEMESTER</label>
					</div>
					<div class="form-floating">
						<select name="layanan_id" class="form-select" id="layananFilter" aria-label="Floating label select example">
							<option value="" selected>UNIT ORGANISASI</option>
							<?php  
								foreach($layanan->result() as $l):
								$selected = $l->id === $_GET['layanan_id'] ? 'selected' : '';
							?>
							<option value="<?= $l->id ?>" <?= $selected ?>><?= strtoupper($l->nama_jenis_layanan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="layananFilter">Layanan</label>
					</div>
					<button type="submit" class="btn btn-warning"><i class="bi bi-send"></i></button>
				</div>
				
				</form>
				<div class="d-flex justify-content-around align-items-center my-3 gap-4  bg-white p-3 rounded-3 shadow-lg">
					<div class="text-center">
						<p class="fw-bold pb-3">Nilai IKM</p>
						<div class="display-1 countTo pb-1" data-from="0" data-to="<?= $hasil['nilai_ikm'] ?>" data-decimals="2" data-speed="300" data-refresh-interval="50">
							0
						</div>
					</div>
					<div class="vr bg-dark border border-dark border-opacity-25" style="height: 150px;"></div>
					<div class="text-center">
						<p class="fw-bold text-dark">Mutu Unit Pelayanan</p>
						<div class="display-1 text-<?= $hasil['nilai_konversi']['c'] ?>">
							<?= $hasil['nilai_konversi']['x'] ?>
						</div>
						<span class="text-dark">(<?= $hasil['nilai_konversi']['y'] ?>)</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="waves"></div>
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

<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8 py-4 d-flex justify-content-start gap-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-chat-left-quote" viewBox="0 0 16 16">
					<path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
					<path d="M7.066 4.76A1.665 1.665 0 0 0 4 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z" />
				</svg>
				<h4 id="tx"></h4>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<div class="card mb-3 bg-light shadow-sm">
					<div class="d-flex justify-content-start align-items-center gap-3">
						<div class="mx-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-person-circle text-danger" viewBox="0 0 16 16">
								<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
								<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
							</svg>
						</div>
						<div>
							<div class="card-body">
								<h5 class="card-title fw-bold">Total Responden</h5>
								<span class="card-text display-2 countTo" data-from="0" data-to="<?= nominal($total_responden) ?>" data-speed="300" data-refresh-interval="50">0</span>
								<!-- <div class="card-text"><small class="text-muted">Jumlah Keseluruhan Responden</small></div> -->
								<div class="card-text"><small class="text-dark">Periode Sekarang</small></div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card mb-3 bg-light shadow-sm">
					<div class="d-flex justify-content-start align-items-center gap-3">
						<div class="mx-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-journal-check text-warning" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
								<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
								<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
							</svg>
						</div>
						<div>
							<div class="card-body">
								<h5 class="card-title fw-bold">Total Layanan</h5>
								<span class="card-text display-2 countTo" data-from="0" data-to="<?= nominal($total_layanan) ?>" data-speed="300" data-refresh-interval="50">0</span>
								<div class="card-text"><small class="text-dark">Jumlah Layanan</small></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card mb-3 bg-light shadow-sm">
					<div class="d-flex justify-content-start align-items-center gap-3">
						<div class="mx-3">
							<svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-journals text-info" viewBox="0 0 16 16">
								<path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z" />
								<path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z" />
							</svg>
						</div>
						<div>
							<div class="card-body">
								<h5 class="card-title fw-bold">Total Indikator</h5>
								<span class="card-text display-2 countTo" data-from="0" data-to="<?= nominal($total_indikator) ?>" data-speed="300" data-refresh-interval="50"><?= $total_indikator ?></span>
								<div class="card-text"><small class="text-dark">Jumlah Indikator</small></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col-12 col-xl-6">
				<div id="piechart_3d" class="shadow-sm border rounded overflow-hidden" style="width: 100%; height: 300px;"></div>
			</div>
			<div class="col-12 col-xl-6">
				<div id="columnchart_values" class="shadow-sm border rounded overflow-hidden" style="width: 100%; height: 300px;"></div>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/plugins/canvajs/canvasjs.min.js') ?>"></script>
<script type="text/javascript">
	let $filter = $("form#FormFilterChange");
	$filter.on("submit", function(e) {
		e.preventDefault();
		let _ = $(this);
		let periode = _.find("select[name='periode']").val();
		let jnslayanan = _.find("select[name='layanan_id']").val();
		if(periode != "" || jnslayanan != "") {
			window.location.replace(`${_uri}/ikm?periode=${periode}&layanan_id=${jnslayanan}`)
		}
	})
	$(function() {
		// Canva By Gender
		$.getJSON(`${_uri}/api/chart/CH_GENDER?API_KEY=bkpsdm6811`, {
			periode: urlParams.get('periode'),
			layanan: urlParams.get('layanan_id')
		}, function(res) {
			var ch1 = new CanvasJS.Chart("piechart_3d", {
				theme: "light2", // "light1", "light2", "dark1", "dark2"
				exportEnabled: false,
				animationEnabled: true,
				exportFileName: "Responden By Gender",
				title: {
					text: "Trend Berdasarkan Jenis Kelamin",
					verticalAlign: "top", // "top", "center", "bottom"
					horizontalAlign: "left", // "left", "right", "center"
					fontSize: 18,
					margin: 0,
					padding: 10,
					fontWeight: 'normal',
					fontStyle: 'normal'
				},
				data: [{
					type: "pie",
					startAngle: 25,
					toolTipContent: "<b>{label}</b>: {p}% <br> <b>Jumlah</b>: {y}",
					showInLegend: "true",
					legendText: "{label}",
					indexLabelFontSize: 14,
					indexLabel: "{label} - ({y}) {p}%",
					dataPoints: res
				}]
			});
			ch1.render();
		});

		// Canva By Pendidikan
		$.getJSON(`${_uri}/api/chart/CH_TINGPEN?API_KEY=bkpsdm6811`, {
			periode: urlParams.get('periode'),
			layanan: urlParams.get('layanan_id')
		}, function(res) {
			var ch2 = new CanvasJS.Chart("columnchart_values", {
				animationEnabled: true,
				exportEnabled: false,
				theme: "light2", // "light1", "light2", "dark1", "dark2"
				exportFileName: "Responden Berdasarkan Tingkat Pendidikan",
				title: {
					text: "Trend Berdasarkan Tingkat Pendidikan",
					verticalAlign: "top", // "top", "center", "bottom"
					horizontalAlign: "left", // "left", "right", "center"
					fontSize: 18,
					margin: 0,
					padding: 10,
					fontWeight: 'normal',
					fontStyle: 'normal'
				},
				dataPointWidth: 20,
				legend: {
					horizontalAlign: "center", // "center" , "right"
					verticalAlign: "bottom", // "top" , "bottom"
				},
				data: [{
					type: "column",
					showInLegend: true,
					indexLabel: "{y}",
					indexLabelPlacement: "outside",
					legendMarkerColor: "white",
					legendText: "Tingkat Pendidikan",
					dataPoints: res
				}]
			});
			ch2.render();
		});
	})
</script>