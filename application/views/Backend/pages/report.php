<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body">
				<div id="chartByJenisLayanan" style="height: 400px; width: 100%;"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6">
		<div class="card">
			<div class="card-body">
				<div id="chartByUmur" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6">
		<div class="card">
			<div class="card-body">
				<div id="chartByGender" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6">
		<div class="card">
			<div class="card-body">
				<div id="chartByPdk" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6">
		<div class="card">
			<div class="card-body">
				<div id="chartByJenisPekerjaan" style="height: 300px; width: 100%;"></div>
			</div>
		</div>
	</div>
</div>

  <script type="text/javascript">
      window.onload = function () {
      	// Canva By Umur
      	$.getJSON(`${_uri}/backend/report/ch_umur`, function(res) {
	          var chart = new CanvasJS.Chart("chartByUmur", {
					theme: "light2", // "light1", "light2", "dark1", "dark2"
	          		animationEnabled: true,
	          		exportEnabled: true,
					exportFileName: "Responden By Umur",
	          		toolTip: {
				        shared: true  //disable here. 
				      },
		          	 title:{
					     text: "Trend Berdasarkan Umur",
					     verticalAlign: "top", // "top", "center", "bottom"
					     horizontalAlign: "left", // "left", "right", "center"
					     fontSize: 18,
					     margin: 0,
					     padding: 10,
					     fontWeight: 'normal',
					     fontStyle: 'normal'
					 },
		              data: [{
		                  type: "bar",
		                  name: "Jumlah",
		                  showInLegend: true, 
		                  indexLabel: "{y} ({p}%)",
						  legendMarkerColor: "white",
		                  legendText: "Jumlah Responden",
		                  dataPoints: res
		              }]
		          });
		          chart.render();
      	});

      	// Canva By Gender
      	$.getJSON(`${_uri}/backend/report/ch_gender`, function(res) {
	      	var chart2 = new CanvasJS.Chart("chartByGender", {
				theme: "light2", // "light1", "light2", "dark1", "dark2"
				exportEnabled: true,
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
			chart2.render();
		});

		// Canva By Pendidikan
		$.getJSON(`${_uri}/backend/report/ch_tingpen`, function(res) {
			var chart3 = new CanvasJS.Chart("chartByPdk", {
				animationEnabled: true,
		        exportEnabled: true,
				theme: "light2", // "light1", "light2", "dark1", "dark2"
				exportFileName: "Responden By Tingkat Pendidikan",
				title:{
				 text: "Trend By Tingkat Pendidikan",
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
			       verticalAlign: "bottom",  // "top" , "bottom"
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
			chart3.render();
		});

		// Canva By Jenis Pekerjaan
		$.getJSON(`${_uri}/backend/report/ch_jnspekerjaan`, function(res) {
			var chart4 = new CanvasJS.Chart("chartByJenisPekerjaan", {
				animationEnabled: true,
		        exportEnabled: true,
				exportFileName: "Responden By Jenis Pekerjaan",
				title:{
					text: "Trend Berdasarkan Jenis Pekerjaan",
					verticalAlign: "top", // "top", "center", "bottom"
				     horizontalAlign: "left", // "left", "right", "center"
				     fontSize: 18,
				     margin: 0,
				     padding: 0,
				     fontWeight: "lighter",
				     fontStyle: 'normal'
				},
				data: [{
					type: "doughnut",
					startAngle: 25,
					//innerRadius: 60,
					indexLabelFontSize: 14,
					indexLabel: "{label} - ({y}) #percent%",
					toolTipContent: "<b>{label}:</b> {y} (#percent%)",
					dataPoints: res
				}]
			});
			chart4.render();
		});

		$.getJSON(`${_uri}/backend/report/ch_jnslayanan`, function(res) {
		var chart5 = new CanvasJS.Chart("chartByJenisLayanan", {
			  theme: "light2", // "light1", "light2", "dark1"
			  animationEnabled: true,
			  exportEnabled: true,
			  title: {
			    text: "Trend Responden Berdasarkan Jenis Layanan",
			     fontSize: 24,
			     fontWeight: 'bold',
			     fontStyle: 'normal'
			  },
			  axisX: {
			    margin: 2,
			    labelPlacement: "inside",
			    tickPlacement: "inside"
			  },
			  data: [{
			    type: "spline",
			    axisYType: "secondary",
			    indexLabel: "{y} ({p}%)",
			    dataPoints: res
			  }]
			});
			chart5.render();
		});
     }
  </script>