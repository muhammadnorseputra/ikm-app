<?php 
   if(privileges('priv_daftar_jawaban') === false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row">
	<div class="col-xl-12">
		<?php if($this->session->flashdata('msg') <> '' ): ?>
	      <div class="alert alert-<?= $this->session->flashdata('msg_type') ?> alert-dismissible fade show" role="alert">
	          <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
	          <span class="alert-text"><?= $this->session->flashdata('msg') ?></span>
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	          </button>
	      </div>
	      <?php endif; ?>
	</div>
		<?php 
            if(sub_privilege('sub_jawaban', 'r') === false): 
              $this->load->view('Backend/pages/notif_mod_dibatasi');
            else:
        ?>
	<div class="card bg-transparent">
			<div class="card-body">
				<div class="row">
					<div class="card-columns">
						<?php foreach ($list_pertanyaan->result() as $p):?>
							<div class="card card-stats shadow-lg">
								<!-- Card body -->
								<div class="card-body">
									<div class="row">
										<div class="col">
											<!-- <h5 class="card-title text-uppercase text-muted mb-0">New users</h5> -->
											<span class="h2 font-weight-bold mb-0"><?= $p->jdl_pertanyaan ?></span>
										</div>
									</div>

									<ol class="mb-0 mt-3 ml-0 pl-4" type="A">
										<?php 
											$jawabans = $this->jawaban->skm_all_jawaban($p->id);
											foreach ($jawabans->result() as $j): 
										?>
											<li class="text-orange mr-2 font-weight-bold">
												<?= $j->jdl_jawaban ?>
											</li>
										<?php endforeach; ?>
									</ol>
								</div>
								<div class="card-footer d-flex justify-content-between align-items-center">
									<a class="btn btn-block btn-primary" href="<?= base_url('jawaban/edit/'.encrypt_url($p->id)) ?>">
										<div  data-toggle="tooltip" data-placement="top" title="Edit Jawaban" class="text-white rounded shadow">
											<i class="fas fa-pen-square"></i>
										</div>
									</a>
									<button type="button" class="btn btn-success text-white icon icon-shape rounded shadow" id="btn-tambah-jawaban" data-uid="<?= encrypt_url($p->id) ?>">
											<i class="fas fa-plus"></i>
									</button>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
	</div>
		<?php endif; ?>
</div>
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	    	
	        <div class="modal-header">
	            <h6 class="modal-title" id="modal-title-default">Tambah Jawaban</h6>
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>
	        </div>
	        <?php 
	            if(sub_privilege('sub_jawaban', 'c') === false): 
	              $this->load->view('Backend/pages/notif_mod_dibatasi');
	            else:
	          ?>
	        <div class="modal-body bg-secondary">
	        	<?= form_open(base_url('backend/jawaban/insert'), ['class' => 'form-horizontal', 'id' => 'f_jawaban']); ?>
	        		<div class="form-group">
	        			<input type="text" name="jdl_jawaban" class="form-control form-control-alternative" placeholder="Jawaban">
	        		</div>
	        		<div class="form-group">
	        			<input type="number" name="poin" class="form-control form-control-alternative" placeholder="Poin/Persepsi">
	        		</div>
	        		<button type="submit" class="btn btn-block btn-primary rounded-pill">Simpan</button>
	        	<?= form_close(); ?>
	        </div>
	   		<?php endif; ?>
	    </div>
	</div>
</div>
<script>
	$(function () {
	  var $btn_add = $("button#btn-tambah-jawaban");
	  var $modal = $("#modal-default");
	  var $form = $("#f_jawaban");
	  $btn_add.on("click", function(e) {
	  	$modal.modal('show');
	  	var $this = $(this);
	  	var pertanyaan_id = $this.data('uid');
	  	$form.on("submit", function(e) {
	  		e.preventDefault();
	  		if($form.find('input[name="jdl_jawaban"]').val() == ''){
	  			alert('Jawaban Tidak Boleh Kosong');
	  			return false; 
	  		}
	  		if($form.find('input[name="poin"]').val() == ''){
	  			alert('Poin Tidak Boleh Kosong');
	  			return false; 
	  		}
		  	var data = $form.serializeArray();
		  	data.push({name: 'id', value: pertanyaan_id});
		  	$.post($form.attr('action'), data, function(res) {
		  		if(res.valid == true) {
		  			alert(res.msg);
		  			window.location.reload();
		  		}
		  	}, 'json');
	  	})
	  })
	})
</script>