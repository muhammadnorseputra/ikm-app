<?php
if($this->session->userdata('user_id') == ""):
	$this->load->view('Frontend/skm/pages/restricted');
	return false;
endif;
$periode = $this->skm->skm_periode();
$year = $periode->num_rows() != 0 ? $periode->row()->tahun : 0;
$tahun_skr = !empty($year) ? $year : '-';
$periode_skr = $periode->num_rows() != 0 ? $periode->row()->id : 0;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahun_skr;
$periode = isset($_GET['periode']) ? $_GET['periode'] : $periode_skr;
// ARGS = tahun,periode
$total_responden =$this->lap->total_responden_by_tahun_periode($tahun,$periode);
$total_responden_tahun =$this->lap->total_responden_by_tahun($tahun);
?>
<section>
	<div class="container my-3">
		<div class="row mb-4">
			<div class="col">
				<div class="fw-bold fs-2">Laporan</div>
				<div class="fw-bold fs-3 text-muted">
					<?php
					$periode_mulai = @$this->skm->skm_periode_by_id($periode)->tgl_mulai;
					$periode_selesai = @$this->skm->skm_periode_by_id($periode)->tgl_selesai;
					$bulan_mulai = explode('-', $periode_mulai);
					$bulan_selesai = explode('-', $periode_selesai);
					$bn = @$bulan_mulai['1'];
					$bs = @$bulan_selesai['1'];
					?>
					<?= $tahun  ?> &bull; <?= bulan($bn) ?> - <?= bulan($bs) ?>
				</div>
			</div>
			<div class="col align-self-center">
				<div class="btn-group float-end" role="group" aria-label="Basic example">
					<button class="btn btn-primary disabled" type="button">
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
					</svg>
					</button>
					<button class="btn btn-primary text-uppercase" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSetting" aria-controls="offcanvasSetting">SETTING</button>
				</div>
				<div class="dropdown float-end me-3">
					<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
						<path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0h-13zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1zm9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0l-.396-.396zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
					</svg>
					</button>
					<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
						<li><a class="dropdown-item active" href="#ikm-unsur">IKM Unsur Layanan</a></li>
						<li><a class="dropdown-item" href="#ikm-unit">IKM Unit Layanan</a></li>
						<li><a class="dropdown-item" href="#ikm-responden">Karakter Responden</a></li>
						<li><a class="dropdown-item" href="#ikm-rekap">Perbandingan Pertahun</a></li>
						<li><a class="dropdown-item" href="#ikm-persepsi">Uji Frekuensi Unsur</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<div class="col">
				<div class="card">
					<div class="row g-0">
						<div class="col-md-4 bg-light">
							
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">Total Responden</h5>
								<p class="card-text fw-bold fs-3 text-muted">
									<?= nominal($total_responden); ?>
								</p>
								<p class="card-text"><small class="text-muted"><b>Last updated</b> <br> <?= longdate_indo(date('d-m-Y')) ?></small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<?php
						$target = $this->lap->target_by_tahun($tahun)->row();
						$t = !empty($target->target_tahunan) ? $target->target_tahunan : 0;
					?>
					<div class="row g-0">
						<div class="col-md-4 bg-warning">
							
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">Target/Tahun</h5>
								<p class="card-text fw-bold fs-3 text-muted">
									<?= $t ?>/<?= @number_format(($total_responden_tahun/$t) * 100, 2) ?> %
								</p>
								<p class="card-text"><small class="text-muted"><b>Last updated</b> <br> <?= longdate_indo(date('d-m-Y')) ?></small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="row g-0">
						<?php
							$target1 = $this->lap->responden_by_tahun_periode_jenis_akun($tahun,$periode,'demo')->row();
							$tr = !empty($target1->target) ? $target1->target : 0;
							$ts = !empty($target1->total_responden) ? $target1->total_responden : 0;
							$cr = !empty($target1->card_responden) ? $target1->card_responden : 0;
							// var_dump($target1);die();
						?>
						<div class="col-md-4 bg-success">
							
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">Target/Periode</h5>
								<p class="card-text fw-bold fs-3 text-muted">
									<?= $tr ?>/<?= @number_format(($ts/$tr) * 100, 2) ?> %
								</p>
								<p class="card-text"><small class="text-muted"><b>Target</b> <br> <?= $cr ?> </small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="ikm-unsur">
			<div class="fw-bold fs-4">#Nilai IKM Berdasarkan Unsur Layanan</div>
			<div class="table-responsive">
				<?php
					$unsur = $this->skm->skm_unsur_layanan();
					$rowspan = $unsur->num_rows() + 2;
				?>
				<table class="table table-hover table-bordered">
					<caption class="text-uppercase">Nilai IKM Berdasarkan Unsur Layanan</caption>
					<thead>
						<tr>
							<th scope="col" rowspan="2" class="align-middle text-center">#</th>
							<th scope="col" rowspan="2" class="align-middle">Unsur Pelayanan</th>
							<th colspan="3" class="text-center">Mutu Unit Layanan</th>
							<tr>
								<th scope="col" class="text-center">Nilai Interval (NI)</th>
								<th scope="col" class="text-center">Nilai  Interval Konversi (NIK)</th>
								<th scope="col" class="text-center">Mutu</th>
							</tr>
							<!-- <th scope="col" class="align-middle text-center">
															STANDAR DAN NILAI IKM UNIT PELAYANAN
							</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$responden_unsur = $this->lap->responden_by_tahun_periode($tahun,$periode);
							$total_unsur = $unsur->num_rows();
							$bobot_nilai = $this->skm->skm_bobot_nilai();
							// if($responden_unsur->num_rows() > 0):
								$total_poin_responden_unsur = [];
								foreach($responden_unsur->result() as $r):
									$get_jawaban = $this->skm->_get_jawaban_responden($r->id);
									$poin = [];
									foreach($get_jawaban as $j):
									$poin[] = $this->skm->_get_poin_responden_per_unsur($j);
									endforeach;
									// POIN PER UNSUR
									$u1[] = $poin[0];
									$u2[] = $poin[1];
									$u3[] = $poin[2];
									$u4[] = $poin[3];
									$u5[] = $poin[4];
									$u6[] = $poin[5];
									$u7[] = $poin[6];
									$u8[] = $poin[7];
									$u9[] = $poin[8];
									
									// TOTAL NI PER UNSUR
									$total_u1 = array_sum($u1)/$total_responden;
									$total_u2 = array_sum($u2)/$total_responden;
									$total_u3 = array_sum($u3)/$total_responden;
									$total_u4 = array_sum($u4)/$total_responden;
									$total_u5 = array_sum($u5)/$total_responden;
									$total_u6 = array_sum($u6)/$total_responden;
									$total_u7 = array_sum($u7)/$total_responden;
									$total_u8 = array_sum($u8)/$total_responden;
									$total_u9 = array_sum($u9)/$total_responden;
								endforeach;
								// var_dump($u1);
								$nrr_unsur = ['1' => @$total_u1, '2' => @$total_u2, '3' => @$total_u3, '4' => @$total_u4,'5' => @$total_u5,'6' => @$total_u6,'7' => @$total_u7,'8' => @$total_u8,'9' => @$total_u9];
							// endif;
							foreach ($unsur->result() as $u):
							$nrr_tertimbang = @number_format($nrr_unsur[$u->id], 2);
							$nrr_tertimbang_sum[] = ($nrr_unsur[$u->id] * $bobot_nilai);
							$ikm_unsur = @number_format($nrr_tertimbang * 25, 2);
							$ikm_unsur_arr[] = @number_format($nrr_tertimbang * 25, 2);
							// $ikm_unsur_sum[] = $nrr_tertimbang * $bobot_nilai;
							// var_dump($nrr_tertimbang)
						?>
						<tr>
							<td class="text-center">U<?= $u->id ?></td>
							<td><?= $u->jdl_unsur ?></td>
							<td class="text-center"><?= $nrr_tertimbang ?></td>
							<td class="text-center"><?= $ikm_unsur ?></td>
							<td class="text-center"><?= $this->skm->nilai_predikat($ikm_unsur)['x'] ?></td>
						</tr>
						<?php $no++; endforeach; ?>
						<tr>
							<?php
							$ikm_konversi = (array_sum($nrr_tertimbang_sum) * 25);
							$total_ikm = $ikm_konversi;

							// var_dump($total_ikm);
							?>
							<td colspan="2" class="text-end fw-bold align-middle">IKM</td>
							<td colspan="3" class="text-center fw-bold fs-3"><?= number_format($total_ikm, 2); ?></td>
						</tr>
						<tr>
							<td colspan="2" class="text-end fw-bold align-middle">MUTU UNIT LAYANAN</td>
							<td colspan="3" class="text-center fw-bold fs-3">(<?= $this->skm->nilai_predikat($total_ikm)['x']; ?>)</td>
						</tr>
						<tr>
							<td colspan="2" class="text-end fw-bold align-middle">KINERJA</td>
							<td colspan="3" class="text-center fw-bold fs-3 text-<?= $this->skm->nilai_predikat($total_ikm)['c'] ?>"><?= $this->skm->nilai_predikat($total_ikm)['y']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="ikm-unit">
			<div class="fw-bold fs-4">#Nilai IKM Berdasarkan Unit Layanan</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Jenis Layanan</th>
							<th scope="col">Jumlah Responden</th>
							<th scope="col">Persentase</th>
							<th scope="col">Total Persepsi</th>
							<th scope="col">Nilai Interval Konversi</th>
							<th scope="col">Mutu Layanan</th>
							<th scope="col">Kinerja</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$jenis_layanan = $this->skm->skm_jenis_layanan();
						$count = $jenis_layanan->num_rows();
						$bobot = $this->skm->skm_bobot_nilai();
						$no=1;
						foreach($jenis_layanan->result() as $jl):
							$jml_responden = $this->lap->responden_by_jenis_layanan($tahun,$periode,$jl->id);
							$responden = $this->lap->responden_by_tahun_periode_layanan($tahun,$periode,$jl->id);
							if($jenis_layanan->num_rows() > 0):
								$total_poin_responden = [];
								foreach($responden->result() as $r):
									$get_jawaban = $this->skm->_get_jawaban_responden($r->id);
									$poin = [];
									foreach($get_jawaban as $j):
									$poin[] = $this->skm->_get_poin_responden_per_unsur($j);
									endforeach;
									$total_poin_responden[] = array_sum($poin);
								endforeach;
							endif;
							$total_persepsi = array_sum($total_poin_responden);
							$ikm = @number_format(($total_persepsi/$jml_responden) * $bobot * 25,2);
							$persentase = @number_format((($jml_responden/$total_responden) * 100), 2);
							$predikat = $this->skm->nilai_predikat($ikm);
						?>
						<tr class="table-<?= $predikat['c'] ?>">
							<td scope="row" class="text-center"><?= $no ?></td>
							<td><?= ucwords($jl->nama_jenis_layanan) ?></td>
							<td><?= $jml_responden ?></td>
							<td><?= $persentase ?> %</td>
							<td><?= $total_persepsi ?></td>
							<td><?= $ikm ?></td>
							<td class="text-center"><?= $predikat['x'] ?></td>
							<td><?= $predikat['y'] ?></td>
						</tr>
						<?php $no++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="ikm-persepsi">
			<?php  
			$unsur_layanan_all = $this->lap->unsur_layanan_all();
			$first_unsur = $unsur_layanan_all->row()->id;
			$unsur_id = isset($_GET['uid']) ? decrypt_url($_GET['uid']) : $first_unsur;
			$unsur_layanan = $this->lap->unsur_layanan($unsur_id)->row();
			$pertanyaan = $this->lap->pertanyaan($unsur_id)->row();
			$jawaban = $this->lap->jawaban($unsur_id)->result();
			$responden_detail = $this->lap->responden_by_tahun_periode($tahun,$periode)->result();
			$responden_count = $this->lap->responden_by_tahun_periode($tahun,$periode)->num_rows();
			?>
			<div class="fw-bold fs-4">#Uji Frekuensi Unsur Layanan</div>
			<?= form_open(base_url('laporan'), ['method' => 'GET']); ?>
			<div class="form-inline text-center">
				<label for="pilih-layanan">Pilih Unsur</label>
				<select name="uid" id="pilih-layanan">
					<option value="">Pilih Unsur</option>
					<?php 
						foreach ($unsur_layanan_all->result() as $unsur): 
						$selected = $unsur->id === $unsur_id ? 'selected' : '';
					?>
						<option value="<?= encrypt_url($unsur->id) ?>" <?= $selected ?>><?= $unsur->jdl_unsur ?></option>
					<?php endforeach; ?>
				</select>
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
			<?= form_close(); ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th class="text-center fw-bold fs-5 text-primary"><?= $unsur_layanan->jdl_unsur ?></th>
						</tr>
						<tr>
							<!-- <th class="text-center fw-bold fs-5 text-success"><?= $pertanyaan->jdl_pertanyaan ?> ?</th> -->
						</tr>
					</thead>
				</table>
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th>Frequency</th>
							<th>Percent</th>
							<th>Valid Percent</th>
							<th>Cumulative Percent</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							// Jawaban Responden
							$jawaban_pecah = [];
							foreach($responden_detail as $key => $val):
								$jawaban_pecah[] = explode(",",$val->jawaban_responden);
							endforeach;
							$marge = array_merge([], ...$jawaban_pecah);
							$total = array_count_values($marge);
							$no=1;
							foreach($jawaban as $key => $val):
							$responden = @$total[$val->id] != 0 ? @$total[$val->id] : 0; 
							$valid_percent[] = @number_format(($responden/$responden_count) * 100, 2);
							$cumulative[] = $valid_percent[$key];
							$cum_1 = $cumulative[0];
							$cum_2 = @array_sum([$cum_1,$cumulative[1]]);
							$cum_3 = @array_sum([$cum_2,$cumulative[2]]);
							$cum_4 = @array_sum([$cum_3,$cumulative[3]]);
						?>
							<tr>
								<?php if($no == 1): ?>
									<td>Sangat Tidak Setuju</td>
								<?php elseif($no == 2): ?>
									<td>Tidak Setuju</td>
								<?php elseif($no == 3): ?>
									<td>Setuju</td>
								<?php elseif($no == 4): ?>
									<td>Sangat Setuju</td>
								<?php else: ?>
									<td>0</td>
								<?php endif; ?>
								<td><?= $responden; ?></td>
								<td><?= @number_format(($responden/$responden_count) * 100, 2) ?>%</td>
								<td><?= $valid_percent[$key] ?></td>
								<?php if($no == 1): ?>
									<td><?= $cum_1 ?>%</td>
								<?php elseif($no == 2): ?>
									<td><?= $cum_2 ?>%</td>
								<?php elseif($no == 3): ?>
									<td><?= $cum_3 ?>%</td>
								<?php elseif($no == 4): ?>
									<td><?= $cum_4 ?>%</td>
								<?php else: ?>
									<td>0</td>
								<?php endif; ?>
							</tr>
						<?php $no++; endforeach; ?>

					</tbody>
					<tfoot>
						<tr>
							<th class="font-weight-bold">
								Total
							</th>
							<th>
								<?= $responden_count ?>
							</th>
							<th colspan="3">
								100%
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row" id="ikm-responden">
			<div class="fw-bold fs-4">#Karakteristik Responden</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Karakteristik</th>
							<th scope="col">Indikator</th>
							<th scope="col">Responden</th>
							<th scope="col">Persentase</th>
						</tr>
					</thead>
					<tbody>
						<!-- Umur -->
						<?php
							
							// Total
							// ARGS = tahun,periode,umur_min,umur_max,operator
							$down_20 = $this->lap->responden_by_umur($tahun,$periode,20,null,'<');
							$between_2030 = $this->lap->responden_by_umur($tahun,$periode,20,30,'<>');
							$between_3140 = $this->lap->responden_by_umur($tahun,$periode,31,40,'<>');
							$between_4150 = $this->lap->responden_by_umur($tahun,$periode,41,50,'<>');
							$up_50 = $this->lap->responden_by_umur($tahun,$periode,50,null,'>');
						?>
						<tr>
							<th rowspan="6">1</th>
							<th rowspan="6">Umur</th>
							<th>Rentang Tahun</th>
							<th class="text-end">Total</th>
							<th class="text-end">%</th>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>< 20</span> <span>Tahun</span></td>
							<td class="text-end"><?= $down_20 ?></td>
							<td class="text-end"><?= cekValue(@number_format(($down_20/$total_responden)*100, 2), '0'); ?> %</td>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>20 - 30</span> <span>Tahun</span></td>
							<td class="text-end"><?= $between_2030 ?></td>
							<td class="text-end"><?= cekValue(@number_format(($between_2030/$total_responden)*100, 2), '0'); ?> %</td>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>31 - 40</span> <span>Tahun</span></td>
							<td class="text-end"><?= $between_3140 ?></td>
							<td class="text-end"><?= @number_format(($between_3140/$total_responden)*100, 2); ?> %</td>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>41 - 50</span> <span>Tahun</span></td>
							<td class="text-end"><?= $between_4150 ?></td>
							<td class="text-end"><?= @number_format(($between_4150/$total_responden)*100, 2); ?> %</td>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span> > 50</span> <span>Tahun</span></td>
							<td class="text-end"><?= $up_50 ?></td>
							<td class="text-end"><?= @number_format(($up_50/$total_responden)*100, 2); ?> %</td>
						</tr>
						<!-- Jenis Kelamin -->
						<?php
							$l = $this->lap->responden_by_gender($tahun,$periode,'L');
							$p = $this->lap->responden_by_gender($tahun,$periode,'P');
						?>
						<tr>
							<th scope="row" rowspan="3">2</th>
							<th rowspan="3">Jenis Kelamin</th>
							<th>Gender</th>
							<th class="text-end">Total</th>
							<th class="text-end">%</th>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>Laki - Laki</span> <span>(L)</span></td>
							<td class="text-end"><?= $l ?></td>
							<td class="text-end"><?= @number_format(($l/$total_responden)*100, 2); ?> %</td>
						</tr>
						<tr>
							<td class="d-flex justify-content-between"><span>Perempuan</span> <span>(P)</span></td>
							<td class="text-end"><?= $p ?></td>
							<td class="text-end"><?= @number_format(($p/$total_responden)*100, 2); ?> %</td>
						</tr>
						<!-- Pendidikan -->
						<?php
						$total_tingakat_pendidikan = $pendidikan->num_rows() + 1;
						?>
						<tr>
							<th scope="row" rowspan="<?= $total_tingakat_pendidikan ?>">3</th>
							<th rowspan="<?= $total_tingakat_pendidikan ?>">Pendidikan</th>
							<th>Jenjang Pendidikan</th>
							<th class="text-end">Total</th>
							<th class="text-end">%</th>
						</tr>
						<?php
							foreach($pendidikan->result() as $p):
							$total_responden_pendidikan = $this->lap->responden_by_pendidikan($tahun,$periode,$p->id);
						?>
						<tr>
							<td scope="row"><?= $p->tingkat_pendidikan ?></td>
							<td class="text-end"><?= $total_responden_pendidikan ?></td>
							<td class="text-end"><?= @number_format(($total_responden_pendidikan/$total_responden)*100, 2); ?> %</td>
						</tr>
						<?php endforeach; ?>
						<!-- Pekerjaan -->
						<?php
						$total_jenis_pekerjaan = $pekerjaan->num_rows() + 1;
						?>
						<tr>
							<th scope="row" rowspan="<?= $total_jenis_pekerjaan ?>">4</th>
							<th rowspan="<?= $total_jenis_pekerjaan ?>">Pekerjaan</th>
							<th>Jenis Pekerjaan</th>
							<th class="text-end">Total</th>
							<th class="text-end">%</th>
						</tr>
						<?php
							foreach($pekerjaan->result() as $p):
							$total_responden_pekerjaan = $this->lap->responden_by_pekerjaan($tahun,$periode,$p->id);
						?>
						<tr>
							<td scope="row"><?= $p->jenis_pekerjaan ?></td>
							<td class="text-end"><?= $total_responden_pekerjaan ?></td>
							<td class="text-end"><?=
							@number_format(($total_responden_pekerjaan/$total_responden)*100, 2); ?> %</td>
						</tr>
						<?php endforeach; ?>
						<?php
						$jenis_akun = $this->lap->responden_by_jenis_akun($tahun,$periode);
						$total_jenis_akun = $jenis_akun->num_rows() + 1;
						?>
						<tr>
							<th scope="row" rowspan="<?= $total_jenis_akun ?>">5</th>
							<th rowspan="<?= $total_jenis_akun ?>">ASN/NON/DEMO</th>
							<th>Jenis Formulir</th>
							<th class="text-end">Total</th>
							<th class="text-end">%</th>
						</tr>
						<?php
						foreach($jenis_akun->result() as $ja):
						$persentase = @number_format(($ja->total_responden/$total_responden_tahun) * 100, 2);
						?>
						<tr>
							<td><?= strtoupper($ja->card_responden) ?></td>
							<td class="text-end"><?= $ja->total_responden ?></td>
							<td class="text-end"><?= $persentase ?> %</td>
						</tr>
						<?php endforeach; ?>
						<tr class="table-warning fw-lighter">
							<th scope="row"></th>
							<th class="text-uppercase">total responden</th>
							<th colspan="2" class="text-end text-uppercase"><?= nominal($total_responden) ?> Orang</th>
							<th></th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row" id="ikm-rekap">
			<?php
				$tahun_list = $this->lap->tahun_list();
				$total_tahun = $tahun_list->num_rows();
				$result_tahun = $tahun_list->result();
				$unsur_tahun = $this->skm->skm_unsur_layanan();
				$total_unsur_tahun = $unsur_tahun->num_rows();
			?>
			<div class="fw-bold fs-4">#Perbandingan IKM Dalam <?= $total_tahun ?> Tahun Terakhir</div>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th scope="col" rowspan="2" class="align-middle text-center">Tahun</th>
							<th scope="col" rowspan="2" class="align-middle text-center">Total <br>Responden</th>
							<th scope="col" colspan="<?= $total_unsur_tahun ?>" class="text-center">IKM Unsur Layanan</th>
							<th rowspan="2" class="align-middle text-center">IKM</th>
							<th rowspan="2" class="align-middle text-center">MUTU</th>
							<tr>
								<?php foreach($unsur_tahun->result() as $r): ?>
									<th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $r->jdl_unsur ?>">U<?= $r->id ?></th>
								<?php endforeach; ?>
							</tr>
						</tr>
					</thead>
					<tbody>
						<?php  
							$bobot_nilai_tahun = $this->skm->skm_bobot_nilai();
							foreach($result_tahun as $t):
							$responden_unsur_tahun = $this->lap->responden_by_tahun($t->tahun);
							$u1_tahun = []; $u2_tahun = []; $u3_tahun = []; $u4_tahun = []; $u5_tahun = [];
							$u6_tahun = []; $u7_tahun = []; $u8_tahun = []; $u9_tahun = [];
							foreach($responden_unsur_tahun->result() as $s):
								
								$get_jawaban_tahun = $this->skm->_get_jawaban_responden($s->id);
								
								$poin_tahun = [];
								foreach($get_jawaban_tahun as $q):
									$poin_tahun[] = $this->skm->_get_poin_responden_per_unsur($q);
								endforeach;
								$total_responden_by_tahun = $this->lap->total_responden_by_tahun($t->tahun);
								// POIN PER UNSUR
								$u1_tahun[] = $poin_tahun[0];
								$u2_tahun[] = $poin_tahun[1];
								$u3_tahun[] = $poin_tahun[2];
								$u4_tahun[] = $poin_tahun[3];
								$u5_tahun[] = $poin_tahun[4];
								$u6_tahun[] = $poin_tahun[5];
								$u7_tahun[] = $poin_tahun[6];
								$u8_tahun[] = $poin_tahun[7];
								$u9_tahun[] = $poin_tahun[8];
								
								// TOTAL NI PER UNSUR
								$total_u1_tahun = array_sum($u1_tahun)/$total_responden_by_tahun;
								$total_u2_tahun = array_sum($u2_tahun)/$total_responden_by_tahun;
								$total_u3_tahun = array_sum($u3_tahun)/$total_responden_by_tahun;
								$total_u4_tahun = array_sum($u4_tahun)/$total_responden_by_tahun;
								$total_u5_tahun = array_sum($u5_tahun)/$total_responden_by_tahun;
								$total_u6_tahun = array_sum($u6_tahun)/$total_responden_by_tahun;
								$total_u7_tahun = array_sum($u7_tahun)/$total_responden_by_tahun;
								$total_u8_tahun = array_sum($u8_tahun)/$total_responden_by_tahun;
								$total_u9_tahun = array_sum($u9_tahun)/$total_responden_by_tahun;
							endforeach;
						?>
						<tr>
							<td class="fw-bold text-center"><?= $t->tahun ?></td>
							<td class="fw-bold text-center"><?= !empty($total_responden_by_tahun) ? $total_responden_by_tahun : 0; ?></td>
							<?php 
								$nrr_unsur_tahun = ['1' => @$total_u1_tahun, '2' => @$total_u2_tahun, '3' => @$total_u3_tahun, '4' => @$total_u4_tahun,'5' => @$total_u5_tahun,'6' => @$total_u6_tahun,'7' => @$total_u7_tahun,'8' => @$total_u8_tahun,'9' => @$total_u9_tahun];
								$nrr_tertimbang_sum_tahun = [];
								foreach($unsur_tahun->result() as $u):
									$nrr_tertimbang_tahun = @number_format($nrr_unsur_tahun[$u->id], 2);
									$nrr_tertimbang_sum_tahun[] = ($nrr_unsur_tahun[$u->id] * $bobot_nilai);
									$ikm_unsur_tahun = @number_format($nrr_tertimbang_tahun * 25, 2);
									// $ikm_unsur_arr[] = @number_format($nrr_tertimbang * 25, 2);
							?>
								<td class="text-end"><?= $ikm_unsur_tahun; ?></td>
							<?php 
								endforeach; 
								// var_dump($nrr_tertimbang_sum_tahun);
								$ikm_tahunan = array_sum($nrr_tertimbang_sum_tahun) * 25;
								$ikm_tahunan_konversi = number_format($ikm_tahunan,2);
							?>
							<td class="fw-bold text-center"><?= $ikm_tahunan_konversi ?></td>
							<td class="fw-bold text-center"><?= $this->skm->nilai_predikat($ikm_tahunan_konversi)['x'] ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</section>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSetting" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title fw-bold" id="offcanvasExampleLabel">SETTING</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body bg-light">
		<?= form_open(base_url('laporan'), ['method' => 'GET']); ?>
		<div class="text-muted mb-3 pb-3 border-bottom fw-lighter">
			Pengaturan ini hanya berpengaruh pada laporan.
		</div>
		<div>
			<div class="form-floating">
				<select class="form-select mb-3" name="tahun" aria-label=".form-select-lg" id="example_tahun" required=>
					<option value="">Pilih tahun</option>
					<?php foreach($this->skm->skm_all_tahun()->result() as $jl): ?>
					<?php $selected = $tahun === $jl->tahun ? 'selected' : ''; ?>
					<option value="<?= $jl->tahun ?>" <?= $selected ?>><?= strtoupper($jl->tahun) ?></option>
					<?php endforeach; ?>
				</select>
				<label for="example_tahun">Atur Berdasarkan Tahun</label>
			</div>
		</div>
		<hr>
		<div>
			<div class="form-floating">
				<select class="form-select mb-3" name="periode" aria-label=".form-select-lg" id="example_periode">
					<option value="">Pilih Periode</option>
					<?php foreach($this->skm->skm_all_periode()->result() as $jl): ?>
					<?php $selected = $periode === $jl->id ? 'selected' : ''; ?>
					<option value="<?= $jl->id ?>" <?= $selected ?>><?= mediumdate_indo($jl->tgl_mulai) ?> - <?= mediumdate_indo($jl->tgl_selesai) ?></option>
					<?php endforeach; ?>
				</select>
				<label for="example_periode">Atur Berdasarkan Periode</label>
			</div>
		</div>
		<div class="btn-group" role="group" aria-label="Basic example">
			<button class="btn btn-primary disabled" type="button">
			<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
				<path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z"/>
			</svg>
			</button>
			<button class="btn btn-primary text-uppercase" type="submit">terapkan</button>
		</div>
		<?= form_close(); ?>
	</div>
</div>