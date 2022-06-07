<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasSetting" aria-labelledby="offcanvasExampleLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title fw-bold" id="offcanvasExampleLabel">SETTING</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body bg-light">
		<?= form_open(curPageURL(), ['method' => 'GET']); ?>
		<div class="text-muted mb-3 pb-3 border-bottom fw-lighter">
			Pengaturan ini hanya berpengaruh pada laporan.
		</div>
		<div>
			<div class="form-floating">
				<select class="form-select mb-3" name="tahun" aria-label=".form-select-lg" id="example_tahun" required=>
					<option value="">Pilih tahun</option>
					<?php foreach($this->skm->skm_all_tahun()->result() as $jl): ?>
					<?php $selected = isset($tahun) === $jl->tahun ? 'selected' : ''; ?>
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