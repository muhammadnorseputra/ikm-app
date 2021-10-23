<?php  
$card = isset($_GET['card']) ? $_GET['card'] : '';
?>
<section class="survei-non-asn bg-light">
	<div class="py-3 bg-success bg-gradient text-center sticky-top">
		<h4 class="text-light">Formulir Survei IKM</h4>
	</div>
	<?php  
	$hidden = ['token_' => encrypt_url('@270599bkppd_balangan_'.date('dmYH')), 'nomor' => encrypt_url($nomor), 'card' => $_GET['card'], 'periode' => encrypt_url($periode->id)];
	echo form_open(base_url('frontend/skm/skmProses'), ['id' => 'f-survei', 'class' => 'toggle-disabled', 'autocomplete' => 'off'], $hidden);
	?>
	<div class="container">
		<div class="card mt-3 bg-light border-0">
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<h5 class="card-title fw-bold">I. Data Responden</h5>
						<p class="card-subtitle text-muted">Sebelum memulai survei, silahkan isi data diri responden</p>
					</div>
					<div>
						<h5 class="text-muted d-none d-md-block"><abbr title="Ini adalah kode formulir anda.">F-<?= strtoupper($nomor) ?></abbr></h5>
					</div>
				</div>
				<hr>
				<?php if(($card === 'asn_balangan')): ?>
				<div class="row mb-md-4 mb-3">
					<div class="col-md-4">
						<div class="form-floating">
							<input type="text" name="cek_nipnik" class="form-control form-control-lg" id="nipnik" placeholder="NIP/NIK" data-validation-param-name="nipnik" data-validation="server required number length" data-validation-length="16-18" data-validation-url="<?= base_url('frontend/skm/skmIndex/cekNipNik') ?>">
							<label for="nipnik" class="form-label fw-bold">NIP/NIK</label>
						</div>					
					</div>
					<div class="col col-md-4">
						<!-- <div id="msg-asn-data" class="align-self-middle"></div> -->
					</div>					
				</div>
				<?php endif; ?>
				<div class="row mb-md-4 mb-3 g-3">
					<div class="col-md-4">
						<div class="form-floating">
							<input type="text" name="nama_lengkap" class="form-control" id="namalengkap" placeholder="Nama Lengkap" data-validation="required letternumeric" data-validation-allowing="'.A-Z ">
							<label for="namalengkap" class="form-label fw-bold">Nama Lengkap</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<input type="text" data-validation="number" data-validation-allowing="range[18;60]" name="umur" data-validation-help="Batasan umur 18 - 60 tahun." class="form-control" id="umur" placeholder="Umur - only number" data-validation="required">
						<label for="umur" class="form-label fw-bold">Umur</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
							<select name="jns_kelamin" class="form-select" id="jk" aria-label=".form-select-lg" data-validation="required">
								<option value="" selected>Pilih Jenis Kelamin</option>
								<option value="L">Laki - Laki (L)</option>
								<option value="P">Perempuan (P)</option>
							</select>
							<label for="jk" class="form-label fw-bold">Jenis Kelamin</label>
						</div>
					</div>
				</div>
				<div class="row mb-4 g-3">
					<div class="col-md-4">
						<div class="form-floating">
						<select name="jns_layanan" class="form-select" id="jenis-layanan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Layanan</option>
							<?php foreach($jenis_layanan->result() as $jl): ?>
								<option value="<?= $jl->id ?>"><?= strtoupper($jl->nama_jenis_layanan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="jenis-layanan" class="form-label fw-bold">Jenis Layanan</label>
					</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<select name="pendidikan" class="form-select" id="pendidikan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Tingkat Pendidikan</option>
							<?php foreach($pendidikan->result() as $p): ?>
								<option value="<?= $p->id ?>"><?= strtoupper($p->tingkat_pendidikan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="pendidikan" class="form-label fw-bold">Pendidikan Terakhir</label>
					</div>
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<select name="pekerjaan" class="form-select" id="pekerjaan" aria-label=".form-select-lg" data-validation="required">
							<option value="" selected>Pilih Pekerjaan</option>
							<?php foreach($pekerjaan->result() as $pj): ?>
								<option value="<?= $pj->id ?>"><?= strtoupper($pj->jenis_pekerjaan) ?></option>
							<?php endforeach; ?>
						</select>
						<label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
					</div>
					</div>
				</div>
				<h5 class="card-title fw-bold">II. Pendapat Responden Tentang Pelayanan</h5>
				<p class="card-subtitle text-muted">Silahkan pilih jawaban yang tersedia.</p>
				<hr>
				<ul class="list-group list-group-flush rounded-3">
					<?php foreach($pertanyaan->result() as $p): ?>
					<li class="list-group-item py-4">
						<p class="fw-bold user-select-none"><?= ucwords($p->jdl_pertanyaan) ?> ?</p>
						<?php foreach($this->skm->skm_jawaban_pertanyaan($p->id)->result() as $j):  ?>
						<div id="msg-check-<?= $j->fid_pertanyaan  ?>"></div>
						<div class="d-flex justify-content-start gap-3 my-2 align-items-center">
							<input class="shadow-sm" type="radio" name="jawaban_id[<?= $j->fid_pertanyaan ?>]" id="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>" value="<?= $j->id ?>" data-validation="required" data-validation-error-msg-container="#msg-check-<?= $j->fid_pertanyaan ?>" data-validation-error-msg="Silahkan pilih salahsatu jawaban yang tersedia!">
							<label class="form-check-label text-muted" for="<?= $j->fid_pertanyaan ?>-<?= $j->id ?>">
								<?= $j->jdl_jawaban ?> 
							</label>
						</div>
						<?php endforeach; ?>
					</li>
					<?php endforeach; ?>
				</ul>
				<hr>
				<p>
				    <!-- <input data-validation="recaptcha" data-validation-recaptcha-sitekey="6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_"> -->
				</p>
				<div class="form-group form-check mb-3">
				    <input type="checkbox" class="form-check-input" data-validation="required" name="disclimer" id="exampleCheck1">
				    <label class="form-check-label" for="exampleCheck1">Penilaian yang saya berikan merupakan benar-benar hasil dari pelayanan BKPPD Balangan.</label>
				 </div>
				
				<button type="submit" class="btn btn-primary btn-lg px-5">Kirim Survei</button>
			</div>
		</div>
		<!-- <div class="card mb-3 bg-light border-top border-danger">
			<div class="card-body">
				<div class="alert alert-default d-flex align-items-start gap-3" role="alert">
				<svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-exclamation-circle-fill text-warning" viewBox="0 0 16 16">
					<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
				</svg>
					<div class="text-muted">
						<strong class="text-dark">Perhatian!</strong> 
						<br>
							Jika terjadi kendala dalam pengisian survei, silahkan hubungi developer (Wa: <a href="https://wa.me/+6282151815132" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Kontak Developer">
							0821-5181-5132
						</a>) 
						dengan menyertakan hasil capture/screenshoot.					
					</div>
				</div>
			</div>
		</div> -->
	</div>
	<?= form_close(); ?>
</section>
<script src="<?= base_url('template/v1/js/route.js') ?>"></script>