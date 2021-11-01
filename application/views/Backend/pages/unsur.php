<?php 
   if(privileges('priv_unsur') == false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row">
	<div class="col-xl-8">
		<?php if($this->session->flashdata('msg') <> '' ): ?>
		<div class="alert alert-<?= $this->session->flashdata('msg_type') ?> alert-dismissible fade show" role="alert">
			<span class="alert-icon"><i class="ni ni-bell-55"></i></span>
			<span class="alert-text"><?= $this->session->flashdata('msg') ?></span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php endif; ?>
		<div class="card" id="list_unsur">
			<div class="card-header">
				<div class="row">
					<div class="col-8 col-xl-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-search"></i></div>
							</div>
							<input type="text" class="form-control search" placeholder="Cari Unsur">
						</div>
					</div>
					<div class="col-4 col-xl-6 text-right">
						<?php 
				            if(sub_privilege('sub_unsur', 0) !== 'c'): 
				              echo '<button type="button" class="btn btn-primary" title="Fitur Tambah Di Nonaktifkan" disabled><i class="fas fa-plus mr-2"></i>Baru</button>';	
				            else:
				        ?>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#unsur"><i class="fas fa-plus mr-2"></i>Baru</button>
						<?php endif; ?>
						<?php if(isset($_GET['uid']) != null): ?>
						<a class="btn btn-link" href="<?= base_url('unsur') ?>"><i class="fas fa-retweet mr-2"></i>Reload</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th scope="col" width="10"></th>
								<th scope="col" class="sort" data-sort="unsur">Unsur</th>
							</tr>
						</thead>
						<tbody class="list">
							<?php 
					            if(sub_privilege('sub_unsur', 1) !== 'r'): 
					            echo "<tr><td colspan='2'>";
					               $this->load->view('Backend/pages/notif_mod_dibatasi');
					            echo "</td></tr>";
					            else:
					        ?>
							<?php if($list_unsur->num_rows() > 0): ?>
							<?php
								foreach($list_unsur->result() as $p):
							?>
							<tr>
								<td>
									<?php 
							            if(sub_privilege('sub_unsur', 2) !== 'u'): 
							              echo '<button id="edit-unsur" title="Disabled" class="btn btn-sm btn-icon-only text-light" role="button" disabled>
										<i class="fas fa-edit"></i>
										</button>';	
							            else:
							        ?>
										<button id="edit-unsur" class="btn btn-sm btn-icon-only text-light" data-href="<?= base_url('unsur/edit/'.encrypt_url($p->id)) ?>" role="button">
										<i class="fas fa-edit"></i>
										</button>
									<?php endif; ?>
								</td>
								<td class="unsur"><?= $p->jdl_unsur ?></td>
							</tr>
							<?php endforeach; ?>
							<?php endif; ?>
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
<!-- Unsur baru -->
<div class="modal fade" id="unsur" tabindex="-1" role="dialog" aria-labelledby="unsurLabel" aria-hidden="true" data-backdrop="static">
<div class="modal-dialog modal-dialog-centered" role="document">
	<div class="modal-content">
		<div class="modal-header border-bottom">
			<h5 class="modal-title" id="unsurLabel">Unsur Baru</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		
			<div class="modal-body">
				<?= form_open(base_url('backend/unsur/insert'), ['class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'f_unsur'], ['id' => null]); ?>
				<div class="form-group">
					<label for="nama_unsur">Nama Unsur</label>
					<input type="text" autocomplete="off" class="form-control form-control-alternative text-primary font-weight-bold" id="nama_unsur" name="nama_unsur" placeholder="Nama Unsur">
				</div>
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
				<?= form_close() ?>
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
		var $modal = $("#unsur");
		var $form = $("#f_unsur");
		// Edit
		$("button#edit-unsur").on("click", function(e) {
			e.preventDefault();
			var $this = $(this);
			var $url = $this.data('href');
			$.post($url, function(res) {
				$modal.modal('show');
				$modal.find('#unsurLabel').text('Update Unsur');
				$form.find('input[name="nama_unsur"]').val(res.jdl_unsur);
				$form.find('button[type="submit"]').text('Update');
				$form.attr('action', `${_uri}/backend/unsur/update`);
				$form.find('input[name="id"]').attr('value', res.id);
			}, 'json');
		});
		// Close modal edit
		$modal.on('hidden.bs.modal', function (e) {
		$modal.find('#unsurLabel').text('Unsur Baru');
		$form.find('button[type="submit"]').text('Simpan');
		$form.attr('action', `${_uri}/backend/unsur/insert`);
		$form.find('input[name="id"]').val('');
		$form.get(0).reset();
		})
		// List
		var options = {
			valueNames: [ 'unsur' ],
			searchColumns: ['unsur'],
			page: 6,
			pagination: [{
				item: "<li class='page-item'><a class='page page-link' href='#'></a></li>"
			}],
		};
		var perntanyaanList = new List('list_unsur', options);
});
</script>
<script src="<?= base_url('template/argon/vendor/list.js/dist/list.min.js') ?>"></script>