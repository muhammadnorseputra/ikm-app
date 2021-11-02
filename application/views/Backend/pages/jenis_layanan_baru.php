<div class="row">
	<div class="col-xl-6 offset-xl-3">
		<?php if(isset($_GET['msg']) == 'galat'): ?>
		<div class="col-xl-12">
			<div class="alert alert-danger" role="alert">
				<strong>Galat,</strong> Form jenis layanan invalid !
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="col-xl-6 offset-xl-3">
		<div class="card">
			<?= form_open(base_url('backend/jenis_layanan/insert')); ?>
			<div class="card-body">
			<?php 
                if(sub_privilege('sub_jenis_layanan', 'c') === false): 
                  $this->load->view('Backend/pages/notif_mod_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);	
                else:
            ?>
				<div class="form-group">
					<label for="jenis_layanan" class="small">Jenis Layanan</label>
					<input type="text" name="jenis_layanan" class="form-control form-control-flush" placeholder="Masukan nama jenis layanan ...">
				</div>
			</div>
            <?php endif; ?>
			<div class="card-footer">
				<div class="d-flex justify-content-between">
					<button type="button" class="btn btn-link rounded" onclick="window.location.href='<?= base_url('jenis_layanan') ?>'">Batal</button>
					<button type="submit" class="btn btn-primary rounded">Simpan</button>
				</div>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
	
</div>