<div class="row">
	<?php if(isset($_GET['msg']) == 'galat'): ?>
	<div class="col-xl-12">
		<div class="alert alert-danger" role="alert">
		    <strong>Galat,</strong> Form pertanyaan invalid !
		</div>
	</div>
	<?php endif; ?>
	<div class="col-12 col-xl-6 offset-xl-3">
		<div class="card">
			<?= form_open(base_url('backend/pertanyaan/insert'), ['class' => 'form-horizontal']); ?>
			<div class="card-header d-flex justify-content-between align-items-center">
				<div>				
					<h3>Tambah Pertanyaan</h3>
				</div>
				<div>
					<button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" onclick="window.location.href= '<?= base_url('pertanyaan') ?>'" class="btn btn-link rounded">Batal</button>
				</div>
			</div>
			 <?php 
	            if(sub_privilege('sub_pertanyaan', 'c') === false): 
	              $this->load->view('Backend/pages/notif_mod_dibatasi');
	            else:
	          ?>
			<div class="card-body">
				<div class="form-group">
				    <label for="unsur">Pilih Unsur</label>
				    <select name="unsur_id" class="form-control" id="unsur" data-toggle="select" title="Pilih Unsur" data-live-search="true" data-live-search-placeholder="Search ...">
				      <option value="">Pilih Unsur</option>
				      <?php foreach($list_unsur->result() as $u): ?>
				      	<option value="<?= $u->id ?>"><?= $u->jdl_unsur ?></option>
				      <?php endforeach; ?>
				    </select>
				  </div>
				  <div class="form-group">
				  	<label for="jdl_pertanyaan">Pertanyaan</label>
				  	<input type="text" name="jdl_pertanyaan" id="jdl_pertanyaan" class="form-control form-control-lg" placeholder="Masukan Pertanyaan Disini...">
				  </div>
				  <label for="status">Status</label>
				  <div class="form-group">
						<div class="custom-control custom-radio custom-control-inline">
						  <input type="radio" id="status_1" name="status" class="custom-control-input" value="Y">
						  <label class="custom-control-label" for="status_1">Aktif</label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
						  <input type="radio" id="status_2" name="status" class="custom-control-input" value="N">
						  <label class="custom-control-label" for="status_2">Non Aktif</label>
						</div>
				  </div>
			</div>
			<?php endif; ?>
		<?= form_close(); ?>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?= base_url('template/argon/vendor/select2/dist/css/select2.min.css') ?>">
<script>
	$(function() {
		$("select[name='unsur_id']").select2();
	});
</script>
<script src="<?= base_url('template/argon/vendor/select2/dist/js/select2.full.min.js') ?>"></script>