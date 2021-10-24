<div class="row">
	<div class="col-12 col-xl-6">
		<div class="card">
			<?= form_open(base_url('backend/periode/update'), ['id' => "f_periode", 'class' => 'toggle-disabled'], ['id' => encrypt_url($d->id)]); ?>
			<div class="card-header rounded-top">
				<span class="font-weight-bold"><?= $d->tahun ?> (<?= date('F', strtotime($d->tgl_mulai)) ?> / <?= date('F', strtotime($d->tgl_selesai)) ?>)</span>
			</div>
			<div class="card-body">
				<div class="row">
                <div class="col-4">
                  <div class="form-group">
                     <label for="tahun">Tahun</label>
                     <input type="text" name="tahun" class="form-control form-control-alternative font-weight-bold" value="<?= $d->tahun ?>" readonly>
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                     <label for="target">Target</label>
                     <input type="number" name="target" data-validation="number" required="required" class="form-control" placeholder="Target" value="<?= $d->target ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                 <div class="col">
                  <label for="month">Bulan Periode</label>
                    <div class="input-daterange input-group rounded" id="datepicker">
                        <div class="input-group-prepend">
                           <label class="input-group-text bg-red text-white" for="filter-form"><i class="far fa-calendar-alt"></i></label>
                        </div>
                        <input type="text" id="month" data-validation="date" required data-validation-format="dd/mm/yyyy" class="input-sm form-control" placeholder="Start Date" size="5" name="start" value="<?= $d->tgl_mulai ?>" />
                        <input type="text" class="input-sm form-control" required data-validation="date" data-validation-format="dd/mm/yyyy" placeholder="To Date" size="5" name="end" value="<?= $d->tgl_selesai ?>"/>
                        <span class="input-group-addon"></span>
                     </div>
                 </div>
              </div>
              <div class="row mt-3">
                 <div class="col">
                 	<?php  
                 	$status_check = $d->status === 'ON' ? 'checked' : '';
                 	?>
                 <label for="aktif">Status</label>
                    <div class="form-group">
                        <label class="custom-toggle">
                            <input type="checkbox" id="togBtn" name="aktif" value="<?= $d->status ?>" <?= $status_check ?>>
                            <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                        </label>
                    </div>
                 </div>
              </div>
              <div class="row">
                 <div class="col">
                 	<div class="alert bg-white border-danger" role="alert">
					    <strong>Hapus Periode</strong> 
					    <p class="mt-3"> Apakah anda yakin akan menghapus periode ini ? semua responden yang terkait akan ikut terhapus.</p>
					    <p>
					    	<button class="btn btn-icon btn-danger shadow" type="button" data-toggle="modal" data-target="#modal-notification">
								<span class="btn-inner--icon"><i class="ni ni-basket"></i></span>
							    <span class="btn-inner--text">Hapus Sekarang</span>
							</button>
					    </p>
					</div>
                 </div>
              </div>
			</div>
			<div class="card-footer d-flex rounded-bottom">
				<div class="w-75 mr-3">
	               <button type="submit" class="btn btn-primary rounded-pill btn-block">Update</button>
	            </div>
	            <div>
	               <button type="button" class="btn btn-link ml-auto rounded-pill" onclick="window.history.back(-1)">Batal</button>
	            </div>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>
<div class="modal" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
        	
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <div class="modal-body">
            	
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">Perhatian!</h4>
                    <p>Jika anda menghapus periode, mungkin data responden yang terkait akan ikut terhapus semua. silahkan cek pada <b><a class="font-weight-bold text-white" href="<?= base_url('dashboard') ?>" target="_blank"><u>Dashboard</u></a></b> apakah periode ini memiliki responden.</p>
                </div>
					<div class="p-4 bg-secondary rounded">
						 <label for="alert" class="text-default small">Silahkan masukan username untuk melanjutkan.</label>
					    <input type="text" name="confirm" id="alert" class="form-control form-control-alternative" placeholder="Username">
					</div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnConfirm" class="btn btn-white rounded-pill btn-block" disabled>Ok, Hapus Sekarang</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css') ?>">
<script>
	$(function() {
		// Cek Confirm
		var $confirm_input = $("input[name='confirm']");
		var $confirm_btn = $("#btnConfirm");
		$confirm_input.on("keyup", function() {
			if($(this).val().length > 3) {
				$confirm_btn.prop('disabled', false);
				return false;
			}
			$confirm_btn.prop('disabled', true); 
		});
		// Proses hapus
		var is_disabled = $confirm_btn;
		var periode_id  = "<?= $this->uri->segment(3) ?>";
		if(is_disabled.get(0).disabled == true) {
			is_disabled.on("click", function(e) {
				e.preventDefault();
				var username = "<?= $this->session->userdata('user_name') ?>";
				if(username == $confirm_input.val()) {
					$.getJSON(`${_uri}/backend/periode/hapus`, {id: periode_id}, function(res) {
						if(res.valid == true) {
							alert('Periode Telah Dihapus');
							window.location.href = res.rediract;		
						}
					});
					return false;
				}
				alert('Username Is Invalid !');
			});
		}
		/*Date Range*/
      $('.input-daterange').datepicker({
             todayBtn: "linked",
             format: "yyyy-mm-dd",
             clearBtn: true
      });
      // Change Status
      $("#togBtn").on('change', function() {
           if ($(this).is(':checked')) {
               $(this).attr('value', 'ON');
           } else {
              $(this).attr('value', 'OFF');
           }
       });
	})
</script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js') ?>"></script>