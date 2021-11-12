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
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#212529" fill-opacity="1" d="M0,192L26.7,165.3C53.3,139,107,85,160,53.3C213.3,21,267,11,320,10.7C373.3,11,427,21,480,42.7C533.3,64,587,96,640,106.7C693.3,117,747,107,800,90.7C853.3,75,907,53,960,58.7C1013.3,64,1067,96,1120,122.7C1173.3,149,1227,171,1280,176C1333.3,181,1387,171,1413,165.3L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
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
							<div class="card-text"><small class="text-muted">Pria : <b> <?= $total_responden_l ?></b> | Wanita : <b><?= $total_responden_p  ?></b> </small></div>
							
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
							<div class="card-text"><small class="text-dark">Jumlah Keseluruhan Layanan</small></div>
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
			<div id="piechart_3d" style="width: 100%; height: 500px;"></div>
		</div>
		<div class="col-12 col-xl-6">
			<div id="columnchart_values" style="width: 100%; height: 500px;"></div>
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
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
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
	        title: "Density of Precious Metals, in g/cm^3",
	        width: '100%',
	        height: 500,
	        bar: {groupWidth: "30%"},
	        legend: { position: "none" },
	      };
	      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
	      chart.draw(view, options);
	  }
    </script>