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
	<div class="col-xl-12">
		<div class="card" id="list_pertanyaan">
			<div class="card-header">
				<div class="row">
					<div class="col-xl-3">
					<div class="input-group">
						<div class="input-group-prepend">
					      <div class="input-group-text"><i class="fas fa-search"></i></div>
					    </div>	
						<input type="text" class="form-control search" placeholder="Cari Pertanyaan">
					</div>
					</div>
					<div class="col-xl-3">
						<div class="btn-group btn-group-toggle border rounded" data-toggle="buttons">
			                <label class="btn btn-secondary shadow-none">
			                  <input type="radio" class="sort" data-sort="unsur" name="options" id="option1" autocomplete="off"> Unsur
			                </label>
			                <label class="btn btn-secondary active shadow-none">
			                  <input type="radio" class="sort" data-sort="pertanyaan" name="options" id="option2" autocomplete="off" checked> Pertanyaan
			                </label>
			              </div>
					</div>
					<div class="col-xl-6 text-right">
						<a href="<?= base_url('pertanyaan/baru') ?>" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Baru</a>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table align-items-center">
				        <thead class="thead-light">
				            <tr>
				                <th scope="col"></th>
				                <th scope="col" class="sort" data-sort="unsur">Unsur</th>
				                <th scope="col" class="sort" data-sort="pertanyaan">Pertanyaan</th>
				            </tr>
				        </thead>
				        <tbody class="list">
				        	<?php if($list_pertanyaan->num_rows() > 0): ?>
				        		<?php 
				        			foreach($list_pertanyaan->result() as $p): 
				        			$active = $p->status == 'N' ? 'bg-gradient-danger text-white' : '';
				        		?>
				        			<tr class="<?= $active ?>">
				        					<td>
				        						<!-- Default dropright button -->
												<div class="dropdown">
							                        <a class="btn btn-sm btn-icon-only text-light bg-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							                          <i class="fas fa-ellipsis-v"></i>
							                        </a>
							                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
							                          <a class="dropdown-item" href="<?= base_url('pertanyaan/edit/'.encrypt_url($p->id)) ?>">Edit</a>
							                          <a class="dropdown-item disabled" href="#">Hapus</a>
							                        </div>
							                    </div>
				        					</td>
					        				<td class="unsur"><a class="btn btn-link" href="<?= base_url('unsur?uid='.encrypt_url($p->unsur_id)) ?>"><?= $p->jdl_unsur ?></a></td>
					        				<td class="pertanyaan"><?= $p->jdl_pertanyaan ?></td>
				        			</tr>
				        		<?php endforeach; ?>
				        	<?php endif; ?>
				        </tbody>
				    </table>
				</div>
			</div>
			<div class="card-footer">
				<nav aria-label="pagination">
					<ul class="pagination"></ul>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
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
					<h4 class="heading mt-4">Mohon Perhatian !</h4>
					<p>Untuk menjaga kreadibilitas data, fitur hapus tidak tersedia dikarnakan adanya keterkaitan dengan tabel lain. Maka fitur tersebut kami gantikan dengan <b>Non Aktif</b></p>
				</div>
				
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white ml-auto" data-dismiss="modal">Ok, lanjutkan</button>
			</div>
			
		</div>
	</div>
</div>
<style>
.pagination li a {
    line-height: 1.25;
	position: relative;
	display: block;
	margin-left: -1px;
	padding: .75rem .75rem;
	color: #8898aa;
	border: 1px solid #dee2e6;
	background-color: #fff;
}
.pagination li.active a {
	background-color: #5e72e4;
	color: #fff;
}
</style>
<script>
	$(function() {
		// List
		var options = {
		  valueNames: [ 'pertanyaan', 'unsur' ],
		  searchColumns: ['pertanyaan'],
		  page: 4,
  		  pagination: [{
  		  	item: "<li class='page-item'><a class='page page-link' href='#'></a></li>"
  		  }],
		};

		var perntanyaanList = new List('list_pertanyaan', options);
		// notif
        if (!$.cookie("notif")) {
            $("#modal-notification").modal('show');
            $.cookie("notif", 1, {
                expires: 60 / 1440,
                path: '/'
            });
        }
    });
</script>
<script src="<?= base_url('template/argon/vendor/list.js/dist/list.min.js') ?>"></script>