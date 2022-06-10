<?php
if($this->session->userdata('user_id') == ""):
	$this->load->view('Frontend/skm/pages/restricted');
	return false;
endif;
$periode_list = $this->skm->skm_periode();
$year = $periode_list->num_rows() != 0 ? $periode_list->row()->tahun : 0;
$tahun_skr = !empty($year) ? $year : '-';
$periode_skr = $periode_list->num_rows() != 0 ? $periode_list->row()->id : 0;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $tahun_skr;
$periode = isset($_GET['periode']) ? $_GET['periode'] : $periode_skr;
// ARGS = tahun,periode
$total_responden =$this->lap->total_responden_by_tahun_periode($tahun,$periode);
$total_responden_tahun =$this->lap->total_responden_by_tahun($tahun);
// Target Per Tahun
$target = $this->lap->target_by_tahun($tahun)->row();
$t = !empty($target->target_tahunan) ? $target->target_tahunan : 0;
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
							<div class="card-footer">
								<div class="progress" style="height: 7px;">
								  <div class="progress-bar" role="progressbar" style="width: <?= $total_responden ?>%" aria-valuenow="<?= $total_responden ?>" aria-valuemin="0" aria-valuemax="<?= $tstyle="height: 1px;" ?>"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="row g-0">
						<div class="col-md-4 bg-warning">
							
						</div>
						<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">Target/Tahun</h5>
								<?php  
									$t_tahun = @number_format(($total_responden_tahun/$t) * 100, 2);
								?>
								<p class="card-text fw-bold fs-3 text-muted">
									<?= $t ?>/<?= $t_tahun ?> %
								</p>
								<p class="card-text"><small class="text-muted"><b>Last updated</b> <br> <?= longdate_indo(date('d-m-Y')) ?></small></p>
							</div>
							<div class="card-footer">
								<div class="progress" style="height: 7px;">
								  <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $t_tahun ?>%" aria-valuenow="<?= $t_tahun ?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="row g-0">
						<?php
							$target1 = $this->lap->responden_by_tahun_periode_jenis_akun($tahun,$periode,'bkpsdm_balangan')->row();
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
									<?php  
									$t_card = @number_format(($ts/$tr) * 100, 2);
									?>
									<?= $tr ?>/<?= $t_card ?> %
								</p>
								<p class="card-text"><small class="text-muted"><b>Target</b> <br> <?= $cr ?> </small></p>
							</div>
							<div class="card-footer">
								<div class="progress" style="height: 7px;">
								  <div class="progress-bar bg-success" role="progressbar" style="width: <?= $t_card ?>%" aria-valuenow="<?= $t_card ?>" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
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
					<?php if($total_responden > 0): ?>
					<tbody>
						<?php
							$no = 1;
							$responden_unsur = $this->lap->responden_by_tahun_periode($tahun,$periode);
							$total_unsur = $unsur->num_rows();
							$bobot_nilai = $this->skm->skm_bobot_nilai();
							// if($responden_unsur->num_rows() > 0):
								foreach($responden_unsur->result() as $r):
									$get_jawaban = $this->skm->_get_jawaban_responden($r->id);
									$poin = [];
									foreach($get_jawaban as $j):
										$poin[] = $this->skm->_get_poin_responden_per_unsur($j);
									endforeach;
									// POIN PER UNSUR
									$u[] = array_merge([], $poin);
								endforeach;
								$acc = array_shift($u);
								foreach ($u as $val) {
								    foreach ($val as $key => $val) {
								        $acc[$key] += $val;
								    }
								}
							foreach ($unsur->result() as $k => $u):
								$nrr_tertimbang = @number_format($acc[$k]/$total_responden, 2);
								$nrr_tertimbang_sum[] = @(($acc[$k]/$total_responden) * $bobot_nilai);
								$ikm_unsur = @number_format($nrr_tertimbang * 25, 2);
								$ikm_unsur_arr[] = @number_format($nrr_tertimbang * 25, 2);
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
					<?php else: ?>
						<tbody>
							<tr>
								<td colspan="5">
									<div class="alert alert-primary d-flex align-items-center" role="alert">
									  <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-3"></i>
									  <div>
									   	Nilai IKM tidak tersedia, responden belum ada untuk periode saat ini.
									  </div>
									</div>
								</td>
							</tr>
						</tbody>	
					<?php endif; ?>
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
			<?= form_open(base_url('laporan'), ['class' => 'd-flex justify-content-start align-items-center' , 'method' => 'GET']); ?>
			<div class="row g-2 align-items-center">
				<div class="form-floating col-auto">
				<select name="uid" id="pilih-layanan" class="form-select" aria-label="Default select example">
					<option value="">Pilih Unsur</option>
					<?php 
						foreach ($unsur_layanan_all->result() as $unsur): 
						$selected = $unsur->id === $unsur_id ? 'selected' : '';
					?>
						<option value="<?= encrypt_url($unsur->id) ?>" <?= $selected ?>><?= $unsur->jdl_unsur ?></option>
					<?php endforeach; ?>
				</select>
				<label for="pilih-layanan">Pilih Unsur Layanan</label>
				</div>
				<div class="col-auto">
				<button type="submit" class="btn btn-link">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
					  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
					  <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
					  <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
					</svg></button>
				</div>
			</div>
			<div class="fw-bold fs-5 text-primary text-center ms-4"><?= $unsur_layanan->jdl_unsur ?></div>
			<?= form_close(); ?>
			<div class="table-responsive">
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
							$upoin=[];
							foreach($responden_unsur_tahun->result() as $s):
								$get_jawaban_tahun = $this->skm->_get_jawaban_responden($s->id);
								$poin_tahun = [];
								foreach($get_jawaban_tahun as $q):
									$poin_tahun[] = $this->skm->_get_poin_responden_per_unsur($q);
								endforeach;
								$total_responden_by_tahun = $this->lap->total_responden_by_tahun($t->tahun);
								// POIN PER UNSUR
								$upoin[] = array_merge([], $poin_tahun);
								
							endforeach;
							$acc = array_shift($upoin);
							foreach ($upoin as $val) {
							    foreach ($val as $key => $val) {
							        $acc[$key] += $val;
							    }
							}
						?>
						<tr>
							<td class="fw-bold text-center"><?= $t->tahun ?></td>
							<td class="fw-bold text-center"><?= !empty($total_responden_by_tahun) ? $total_responden_by_tahun : 0; ?></td>
							<?php 
								$nrr_tertimbang_sum_tahun = [];
								foreach($unsur_tahun->result() as $k => $u):
									$nrr_tertimbang_tahun = @number_format($acc[$k]/$total_responden_by_tahun, 2);
									$nrr_tertimbang_sum_tahun[] = ($acc[$k]/$total_responden_by_tahun) * $bobot_nilai_tahun;
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
