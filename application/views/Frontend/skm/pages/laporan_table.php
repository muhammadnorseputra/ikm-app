<div class="container">
<?php if($responden->num_rows() > 0): ?>
	<div class="row">
		<div class="col">
			<?php  
				$periode = $this->skm->skm_periode();
				$year = $periode->num_rows() != 0 ? $periode->row()->tahun : 0;
				$tahun_skr = !empty($year) ? $year : '-';
				$periode_skr = $periode->num_rows() != 0 ? $periode->row()->id : 0;
				$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahun_skr;
				$periode_id = isset($_GET['periode']) ? $_GET['periode'] : $periode_skr;
				$periode_mulai = @$this->skm->skm_periode_by_id($periode_id)->tgl_mulai;
				$periode_selesai = @$this->skm->skm_periode_by_id($periode_id)->tgl_selesai;
				$bulan_mulai = date("F", strtotime($periode_mulai));
				$bulan_selesai = date("F", strtotime($periode_selesai));
			?>
			<div class="fw-bold fs-2 mt-3">Rekapitulasi</div>
			<div class="fw-bold fs-3 text-muted mb-3">
				<?= $tahun  ?> &bull; <?= $bulan_mulai ?> - <?= $bulan_selesai ?>
			</div>
		</div>
		<div class="col align-self-center">
			<div class="btn-group float-end" role="group" aria-label="Basic example">
					<button class="btn btn-primary disabled" type="button">
					<i class="bi bi-sliders"></i>
					</button>
					<button class="btn btn-primary text-uppercase" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetting" aria-controls="offcanvasSetting">SETTING</button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="table-responsive">
			<table class="table table-sm table-bordered">
				<thead class="bg-primary bg-gradient text-white">
					<tr>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-dark" width="30">No <br> Responden</th>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-dark" width="30">JK</th>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-dark" width="30">USIA</th>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-dark">PENDIDIKAN</th>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-dark">PEKERJAAN</th>
						<th scope="col" colspan="<?= $total_unsur ?>" class="text-center align-middle">
							NILAI UNSUR PERLAYANAN
						</th>
						<th scope="col" rowspan="<?= $responden->num_rows() + 2 ?>" class="text-center align-middle bg-white text-success"></th>
						<tr>
							<?php foreach($unsur->result() as $r): ?>
								<th scope="col" class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $r->jdl_unsur ?>">U<?= $r->id ?></th>
							<?php endforeach; ?>
						</tr>
					</tr>
				</thead>
				<tbody>
					<?php  
					if($responden->num_rows() > 0):
						$no=1;
						foreach ($responden->result() as $k => $v):
						$jawaban = $this->skm->_get_jawaban_responden($v->id);
						$poin = [];
						foreach($jawaban as $j):
							$poin[] = $this->skm->_get_poin_responden_per_unsur($j);
						endforeach;
						$u[] = array_merge([], $poin);
					?>
						<tr>
							<th scope="row" class="text-center fw-bold"><?= $no ?></th>
							<th class="text-center"><?= $v->jns_kelamin ?></th>
							<th class="text-center"><?= $v->umur ?></th>
							<th class="text-center"><?= $v->tingkat_pendidikan ?></th>
							<th class="text-center"><?= $v->jenis_pekerjaan ?></th>
							<?php 
								$total_responden = $responden->num_rows();
								foreach ($poin as $key => $value):
									$poin_unsur = isset($poin[$key]) ? $poin[$key] : 0;
							?>
								<td class="text-center"><?= $poin_unsur ?></td>
							<?php endforeach; ?>
							<td><?= strtoupper($v->nama_jenis_layanan) ?></td>
						</tr>
					<?php $no++; endforeach; endif;?>
				</tbody>
				<tfoot>
					<tr>
						<td class="text-secondary fw-bold" colspan="5">Nilai/Unsur</td>
						<?php 
							$acc = array_shift($u);
							foreach ($u as $val) {
							    foreach ($val as $key => $val) {
							        $acc[$key] += $val;
							    }
							}
							foreach($unsur->result() as $k => $r): 
							$valid = !empty($acc[$k]) ? $acc[$k] : 0;
							$cari_nrr[] = !empty($acc[$k]) ? $acc[$k] : 0; 
						?>
							<td class="text-center"><?= $valid ?></td>
						<?php endforeach; ?>
						<td></td>
					</tr>
					<tr>
						<td class="text-secondary fw-bold" colspan="5">NRR/Unsur</td>
						<?php  
							foreach ($cari_nrr as $key => $value):
							$nrr = $value/$total_responden;
							$cari_nrr_t[] = $value/$total_responden;
						?>
							<td class="text-center"><?= number_format($nrr,3) ?></td>
						<?php endforeach; ?>
						<td></td>
					</tr>
					<tr>
						<td class="text-secondary fw-bold" colspan="5">
							NRR Tertimbang <br>/ Unsur
						</td>
						<?php  
							foreach ($cari_nrr_t as $key => $value):
							$nrr_t = $value*$bobot;
							$nrr_t_total[] = $value*$bobot;
						?>
							<td class="text-center align-middle"><?= number_format($nrr_t,2) ?></td>
						<?php endforeach; ?>
						<td class="text-success" colspan="5">
							<?php 
								$nrr_total = array_sum($nrr_t_total);
							?>
							<div class="small">*)</div>
							<div class="text-center"><?= decimal($nrr_total, 3); ?></div>
						</td>
					</tr>
					<tr>
						<?php  
						$ikm = number_format($nrr_total*25,2);
						?>
						<td colspan="<?= $total_unsur+5 ?>" class="text-dark fw-bold align-middle">IKM Unit Layanan</td>
						<td class="text-success">
							<div class="small">**)</div>  
							<div class="text-center"><?= $ikm ?></div>
						</td>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6">
			<div class="card">
				<div class="card-body bg-<?= $this->skm->nilai_predikat($ikm)['c'] ?> text-white">
					<div class="row">
					<div class="col-xl-5">
						<span class="fw-bold h-3">IKM Unit Pelayanan :</span>
					</div>
					<div class="col-xl-6">
						<span class="fw-bold"><?= $ikm ?></span> 
						= 
						<?= $this->skm->nilai_predikat($ikm)['x'] ?> (<?= $this->skm->nilai_predikat($ikm)['y'] ?>)
					</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered my-3">
				<thead class="bg-dark text-white">
					<tr>
						<th class="fw-bold">Mutu Unit Layanan</th>
						<th class="text-center">Kode</th>
						<th class="text-center">NI</th>
						<th class="text-center">NIK</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="fw-bold" width="200">A (Sangat Baik)</td>
						<td class="text-center"><span class="bg-success">&nbsp;&nbsp;</span></td>
						<td class="text-center">3,5324 – 4,00 </td>
						<td class="text-center">83,31 - 100,00 </td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">B (Baik)</td>
						<td class="text-center"><span class="bg-info">&nbsp;&nbsp;</span></td>
						<td class="text-center">3,0644 – 3,532</td>
						<td class="text-center">76,61 - 88,30</td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">C (Kurang Baik)</td>
						<td class="text-center"><span class="bg-warning">&nbsp;&nbsp;</span></td>
						<td class="text-center">2,60 – 3,064</td>
						<td class="text-center">65,00 - 76,60</td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">D (Tidak Baik)</td>
						<td class="text-center"><span class="bg-danger">&nbsp;&nbsp;</span></td>
						<td class="text-center">1,00 – 2,5996</td>
						<td class="text-center">25,00 - 64,99</td>
					</tr>
				</tbody>
			</table>
			<div class="fw-bold fs-2 my-3">Keterangan</div>
			<table class="table table-borderless">
				<tbody>
					<tr>
						<td>- </td>
						<td class="text-primary">U1 s.d. U14 </td>
						<td>=</td>
						<td>Unsur - Unsur Layanan</td>
					</tr>
					<tr>
						<td>- </td>
						<td>NRR </td>
						<td>=</td>
						<td>Nilai Rata-Rata</td>
					</tr>
					<tr>
						<td>- </td>
						<td>IKM </td>
						<td>=</td>
						<td>Indeks Kepuasan Masyarakat</td>
					</tr>
					<tr>
						<td>- </td>
						<td class="text-success">*) </td>
						<td>=</td>
						<td>Jumlah NRR IKM Tertimbang</td>
					</tr>	
					<tr>
						<td>- </td>
						<td class="text-success">**) </td>
						<td>=</td>
						<td>Jumlah NRR IKM Tertimbang x 25</td>
					</tr>	
					<tr>
						<td>- </td>
						<td>NRR Per Unsur </td>
						<td>=</td>
						<td>Jumlah nilai per unsur dibagi Jumlah kuesioner yang terisi </td>
					</tr>		
					<tr>
						<td>- </td>
						<td>NRR tertimbang </td>
						<td>=</td>
						<td>NRR per unsur x <?= $bobot ?> per unsur </td>
					</tr>	
					<tr>
						<td>- </td>
						<td>NI </td>
						<td>=</td>
						<td>Nilai Interval </td>
					</tr>					
					<tr>
						<td>- </td>
						<td>NIK </td>
						<td>=</td>
						<td>Nilai Interval Konversi </td>
					</tr>																			
				</tbody>
			</table>
		</div>
		<div class="col-xl-6">
			<table class="table table-bordered">
				<thead class="bg-dark text-white">
					<tr>
						<th class="text-center">No</th>
						<th class="text-center">Unsur Pelayanan</th>
						<th class="text-center">Nilai Rata-Rata</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$no=1;
						foreach($unsur->result() as $k => $r): 
						$note = $this->skm->predikat($cari_nrr_t[$k])['c'];
					?>
						<tr class="bg-<?= $note ?> text-white">
							<td class="text-center">
								<?= $no ?>	
							</td>
							<td>
								<?= $r->jdl_unsur ?>
							</td>
							<td class="text-center">
								<?=  
									number_format($cari_nrr_t[$k],3);
								?>
							</td>
						</tr>
					<?php $no++; endforeach; ?>
				</tbody>
			</table>
			<hr>
			<div id="piechart_3d" class="shadow-sm border rounded overflow-hidden" style="width: 100%; height: 300px;"></div>
		</div>
	</div>
<?php else: ?>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card my-3">
				<div class="card-body d-flex justify-content-center">
					<div class="alert alert-primary d-flex align-items-center" role="alert">
					  <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-3"></i>
					  <div>
					   	Nilai IKM tidak tersedia, responden belum ada untuk periode saat ini.
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
</div>
<?php

?>

<script src="<?= base_url('assets/js/route.js') ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/plugins/canvajs/canvasjs.min.js') ?>"></script>
<script>
	$.getJSON(`${_uri}/api/ikm_by_layananid?API_KEY=bkpsdm6811&periode_id=${ urlParams.get('periode')}&layanan_id=${urlParams.get('layanan_id')}`, function(res) {
      	var ch1 = new CanvasJS.Chart("piechart_3d", {
			theme: "light2", // "light1", "light2", "dark1", "dark2"
			exportEnabled: false,
			animationEnabled: true,
			exportFileName: "Responden By Gender",
			title: {
				text: "Grafik Frekuensi",
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
				toolTipContent: "<b>{label}</b>: {p}%",
				showInLegend: "true",
				legendText: "{label}",
				indexLabelFontSize: 14,
				indexLabel: "{label} - {p}%",
				dataPoints: res
			}]
		});
		ch1.render();
	});
</script>