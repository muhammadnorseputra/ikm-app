<div class="row">
			<div class="card-body bg-transparent border rounded pb-0">
				<div class="row">
					<div class="card-columns">
						<?php foreach ($list_pertanyaan->result() as $p):?>

							<div class="card card-stats shadow-none">
								<!-- Card body -->
								<div class="card-body">
									<div class="row">
										<div class="col">
											<!-- <h5 class="card-title text-uppercase text-muted mb-0">New users</h5> -->
											<span class="h2 font-weight-bold mb-0"><?= $p->jdl_pertanyaan ?></span>
										</div>
										<div class="col-2 text-center">
											<a href="<?= base_url('jawaban/edit/'.encrypt_url($p->id)) ?>">
												<div  data-toggle="tooltip" data-placement="top" title="Edit Jawaban" class="icon icon-shape bg-orange text-white rounded-circle shadow mb-3">
													<i class="fas fa-pen-square"></i>
												</div>
											</a>
											<button type="button" class="btn btn-sm btn-icon-only text-white icon icon-shape bg-success rounded-circle shadow" id="btn-tambah-jawaban" data-uid="<?= encrypt_url($p->id) ?>">
													<i class="fas fa-plus"></i>
											</button>
										</div>
									</div>

									<ol class="mb-0 ml-0 pl-4" type="A">
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
							</div>
						<?php endforeach ?>
					</div>
				</div>
	</div>
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