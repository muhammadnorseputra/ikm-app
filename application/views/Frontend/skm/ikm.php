<section class="bg-dark">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-6">
				<div class="text-light py-md-5 pt-5 text-center text-md-start">
					<div class="display-3">IKM</div>
					<div class="fs-3">(Indeks Kepuasan Masyarakat)</div>
					<?php
						$bulan_mulai = explode('-', $periode->tgl_mulai);
						$bulan_selesai = explode('-', $periode->tgl_selesai);
						$bn = $bulan_mulai['1'];
						$bs = $bulan_selesai['1'];
					?>
					<p class="fs-3 text-muted">Periode <?= bulan($bn) ?> - <?= bulan($bs) ?> <?= $periode->tahun ?></p>
				</div>
			</div>
			<div class="col-12 col-md-6">
				<div class="d-flex justify-content-around align-items-center my-5 my-2 gap-4">
					<div class="text-center">
						<p class="fw-bold text-light">Nilai IKM</p>
						<div class="display-1 text-<?= $hasil['nilai_konversi']['c'] ?> countTo" data-from="0" data-to="<?= $hasil['nilai_ikm'] ?>" data-decimals="2" data-speed="300" data-refresh-interval="50">
							0
						</div>
					</div>
					<div class="text-center bg-light p-3 rounded-3 shadow-lg border border-secondary">
						<p class="fw-bold text-dark">Mutu Unit Pelayanan</p>
						<div class="display-1 text-<?= $hasil['nilai_konversi']['c'] ?>">
							<?= $hasil['nilai_konversi']['x'] ?>
						</div>
						<span class="text-muted">(<?= $hasil['nilai_konversi']['y'] ?>)</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="waves"></div>
</section>
<div>
<svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 100" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(33, 37, 41, 1)" offset="0%"></stop><stop stop-color="rgba(33, 37, 41, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,60L10,61.7C20,63,40,67,60,65C80,63,100,57,120,60C140,63,160,77,180,73.3C200,70,220,50,240,43.3C260,37,280,43,300,46.7C320,50,340,50,360,43.3C380,37,400,23,420,25C440,27,460,43,480,51.7C500,60,520,60,540,58.3C560,57,580,53,600,43.3C620,33,640,17,660,8.3C680,0,700,0,720,11.7C740,23,760,47,780,53.3C800,60,820,50,840,48.3C860,47,880,53,900,51.7C920,50,940,40,960,33.3C980,27,1000,23,1020,28.3C1040,33,1060,47,1080,55C1100,63,1120,67,1140,56.7C1160,47,1180,23,1200,16.7C1220,10,1240,20,1260,35C1280,50,1300,70,1320,80C1340,90,1360,90,1380,78.3C1400,67,1420,43,1430,31.7L1440,20L1440,100L1430,100C1420,100,1400,100,1380,100C1360,100,1340,100,1320,100C1300,100,1280,100,1260,100C1240,100,1220,100,1200,100C1180,100,1160,100,1140,100C1120,100,1100,100,1080,100C1060,100,1040,100,1020,100C1000,100,980,100,960,100C940,100,920,100,900,100C880,100,860,100,840,100C820,100,800,100,780,100C760,100,740,100,720,100C700,100,680,100,660,100C640,100,620,100,600,100C580,100,560,100,540,100C520,100,500,100,480,100C460,100,440,100,420,100C400,100,380,100,360,100C340,100,320,100,300,100C280,100,260,100,240,100C220,100,200,100,180,100C160,100,140,100,120,100C100,100,80,100,60,100C40,100,20,100,10,100L0,100Z"></path></svg>
</div>
<section>
<div class="container">
	<div class="row">
		<div class="col-md-8 py-4 d-flex justify-content-start gap-3">
			<svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-chat-left-quote" viewBox="0 0 16 16">
				<path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
				<path d="M7.066 4.76A1.665 1.665 0 0 0 4 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112zm4 0A1.665 1.665 0 0 0 8 5.668a1.667 1.667 0 0 0 2.561 1.406c-.131.389-.375.804-.777 1.22a.417.417 0 1 0 .6.58c1.486-1.54 1.293-3.214.682-4.112z"/>
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
							<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
							<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
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
							<path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
							<path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
							<path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
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
							<path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2z"/>
							<path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0z"/>
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
	<div class="row">
		<div class="col-12 col-xl-6">
			<div id="piechart_3d" class="shadow-sm" style="width: 100%; height: 400px;"></div>
		</div>
		<div class="col-12 col-xl-6">
			<div id="columnchart_values" class="shadow-sm"  style="width: 100%; height: 400px;"></div>
		</div>
	</div>
</div>
</section>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['x', 'y'],
          ['Laki - Laki', <?= $total_responden_l ?>],
          ['Perempuan', <?= $total_responden_p  ?>],
        ]);

        var options = {
          title: 'Trend Responden Berdasarkan Gender'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

        chart.draw(data, options);
      }

      // Col Chart
        google.charts.setOnLoadCallback(colChart);
	    function colChart() {
	      var data = google.visualization.arrayToDataTable([
	        ["Element", "Density", { role: "style" } ],
	        ["Copper", 8.94, "#b87333"],
	        ["Silver", 10.49, "silver"],
	        ["Gold", 19.30, "gold"],
	        ["Platinum", 21.45, "color: #e5e4e2"]
	      ]);

	      var view = new google.visualization.DataView(data);
	      view.setColumns([0, 1,
	                       { calc: "stringify",
	                         sourceColumn: 1,
	                         type: "string",
	                         role: "annotation" },
	                       2]);

	      var options = {
	        title: "Trend Responden Berdasarkan Jenis Pekerjaan",
	        bar: {groupWidth: "30%"},
	        legend: { position: "none" },
	      };
	      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
	      chart.draw(view, options);
	  }
    </script>