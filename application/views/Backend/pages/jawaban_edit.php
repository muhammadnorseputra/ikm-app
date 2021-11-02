<div class="row">
	<div class="col-xl-8 offset-md-2">
		<?php if($this->session->flashdata('msg') <> '' ): ?>
	      <div class="alert alert-<?= $this->session->flashdata('msg_type') ?> alert-dismissible fade show" role="alert">
	          <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
	          <span class="alert-text"><?= $this->session->flashdata('msg') ?></span>
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	          </button>
	      </div>
	    <?php endif; ?>
		<div class="card">
			<?php 
	            if(sub_privilege('sub_jawaban', 'u') === false): 
	              $this->load->view('Backend/pages/notif_mod_dibatasi');
	            else:
	        ?>
			<?= form_open(base_url('backend/jawaban/update_batch'),'', ['id' => $pertanyaan_id]); ?>
			<div class="card-header">
				<h6 class="h3">Ubah Jawaban</h6>
			</div>
			<div class="card-body">
				<div class="form-inline">
				<div class="container">
				<?php foreach($list_jawaban->result() as $j): ?>
					<div class="row justify-content-center align-items-center">
							<div class="input-group mb-2 mr-sm-2">
							 	<input type="text" name="jdl_jawaban[<?= $j->id ?>]" class="form-control" id="jdl_jawaban" value="<?= $j->jdl_jawaban ?>">
								<div class="input-group-prepend">
							      <div class="input-group-text border-left-0">=</div>
							    </div>
							 	<input type="text" name="poin[<?= $j->id ?>]" class="form-control" id="poin" value="<?= $j->poin ?>">
							</div>
						    <?php 
					            if(sub_privilege('sub_jawaban', 'd') === false): 
					              echo '<a class="btn btn-sm btn-secondary rounded text-gray mt--2" data-toggle="tooltip" title="Disabled" disabled><i class="fas fa-trash"></i></a>';
					            else:
				        	?>
						 	 <a onclick="return confirm('Apakah anda yakin akan menghapus pilihan tersebut ?')" href="<?= base_url('hapus/'.encrypt_url($j->id).'-'.$pertanyaan_id) ?>" class="btn btn-sm btn-secondary rounded text-danger mt--2" data-toggle="tooltip" title="Hapus Jawaban"><i class="fas fa-trash"></i></a>
							<?php endif; ?>
					</div>	
				<?php endforeach; ?>
				</div>
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary" type="submit">Update Batch</button>
				<button class="btn btn-link" type="button" onclick="window.location.href = '<?= base_url('jawaban') ?>'">Batal</button>
			</div>
			<?= form_close(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>