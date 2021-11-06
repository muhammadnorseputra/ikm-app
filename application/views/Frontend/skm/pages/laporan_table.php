<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="fw-bold fs-2 my-3">Rekapitulasi</div>
			<div class="table-responsive">
			<table class="table table-bordered">
				<thead class="bg-primary text-white">
					<tr>
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-danger" width="30">No <br> Responden</th>
						<th scope="col" colspan="<?= $total_unsur ?>" class="text-center align-middle">
							NILAI UNSUR PERLAYANAN
						<th scope="col" rowspan="2" class="text-center align-middle bg-white text-success">*) <br> **)</th>
						</th>
						<tr>
							<?php foreach($unsur->result() as $r): ?>
								<th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $r->jdl_unsur ?>">U<?= $r->id ?></th>
							<?php endforeach; ?>
						</tr>
					</tr>
				</thead>
				<tbody>
					<?php  
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
							<td class="text-center fw-bold text-danger"><?= $no ?></td>
							<?php 
								$total_responden = $responden->num_rows();
								foreach ($poin as $key => $value):
							?>
								<td class="text-center"><?= $poin[$key] ?></td>
							<?php endforeach; ?>
						</tr>
					<?php $no++; endforeach; ?>
				</tbody>
				<tr class="t-foot">
					<tr>
						<td class="text-secondary fw-bold">Nilai/Unsur</td>
						<?php 
							$acc = array_shift($u);
							foreach ($u as $val) {
							    foreach ($val as $key => $val) {
							        $acc[$key] += $val;
							    }
							}
							foreach($unsur->result() as $k => $r): 
							$valid = $acc[$k];
							$cari_nrr[] = $acc[$k]; 
						?>
							<td class="text-center"><?= $valid ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<td class="text-secondary fw-bold">NRR/Unsur</td>
						<?php  
							foreach ($cari_nrr as $key => $value):
							$nrr = $value/$total_responden;
							$cari_nrr_t[] = $value/$total_responden;
						?>
							<td class="text-center"><?= number_format($nrr,3) ?></td>
						<?php endforeach; ?>
					</tr>
					<tr>
						<td class="text-secondary fw-bold">
							NRR Tertimbang <br>/ Unsur
						</td>
						<?php  
							foreach ($cari_nrr_t as $key => $value):
							$nrr_t = $value*$bobot;
							$nrr_t_total[] = $value*$bobot;
						?>
							<td class="text-center align-middle"><?= number_format($nrr_t,2) ?></td>
						<?php endforeach; ?>
						<td class="text-center align-middle text-success fw-bold fs-4">
							<?php 
								$nrr_total = array_sum($nrr_t_total);
							?>
							<?= $nrr_total; ?>
						</td>
					</tr>
					<tr>
						<?php  
						$ikm = number_format($nrr_total*25,2);
						?>
						<td colspan="<?= $total_unsur+1 ?>" class="text-dark fw-bold align-middle">IKM Unit Layanan</td>
						<td class="text-center text-success fw-bold fs-4"><?= $ikm ?></td>
					</tr>
				</tr>
			</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xl-6">
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
				</tbody>
			</table>
			<div class="card">
				<div class="card-body bg-success text-white">
					<div class="row">
					<div class="col-xl-5">
						<span class="fw-bold h-3">IKM Unit Pelayanan :</span>
					</div>
					<div class="col-xl-6">
						<span class="fw-bold"><?= $ikm ?></span> = <?= $this->skm->nilai_predikat($ikm)['x'] ?> (<?= $this->skm->nilai_predikat($ikm)['y'] ?>)
					</div>
					</div>
				</div>
			</div>
			<table class="table table-bordered my-3">
				<thead class="bg-dark text-white">
					<tr>
						<th class="fw-bold" colspan="2">Mutu Unit Layanan</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="fw-bold" width="200">A (Sangat Baik)</td>
						<td class="text-center" width="30">:</td>
						<td class="text-center">83,31 - 100,00 </td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">B (Baik)</td>
						<td class="text-center" width="30">:</td>
						<td class="text-center">76,61 - 88,30</td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">C (Kurang Baik)</td>
						<td class="text-center" width="30">:</td>
						<td class="text-center">65,00 - 76,60</td>
					</tr>
					<tr>
						<td class="fw-bold" width="200">D (Tidak Baik)</td>
						<td class="text-center" width="30">:</td>
						<td class="text-center">25,00 - 64,99</td>
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
					?>
						<tr>
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
		</div>
	</div>
</div>