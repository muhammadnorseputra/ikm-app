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
	<div class="col-xl-10">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-nowrap table-hover" id="table-jenis-layanan">
						<thead class="bg-secondary">
							<tr>
								<th scope="col">No</th>
								<th scope="col">Jenis Layanan</th>
								<th scope="col">Aksi</th>
							</tr>
						</thead>
						<tfoot class="bg-secondary">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Jenis Layanan</th>
							<th scope="col">Aksi</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
		<div class="modal-content">
			<?= form_open(base_url('backend/jenis_layanan/update'), ['class' => 'form-horizontal', 'id' => 'f_jenis_layanan'], ['id' => null]); ?>
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title-default"></h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
				</button>
			</div>
			
			<div class="modal-body bg-secondary">
					<div class="form-group">
						<label for="layanan">Jenis Layanan</label>
						<input type="text" id="layanan" name="nama_jenis_layanan" class="form-control">
					</div>
			</div>
			
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Update</button>
				<button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Batal</button>
			</div>
			<?= form_close(); ?>
			
		</div>
	</div>
</div>
	<link rel="stylesheet" href="<?= base_url('template/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
	<script>
	$(function() {
	
	var $modal = $("#modal-default");
	var $form = $("#f_jenis_layanan");

	var $btnEdit = $(document).on("click", "#edit-layanan", function(e) {
		e.preventDefault();
		var $this = $(this);
		var $uid = $this.data('uid');
		$.post(`${_uri}/backend/jenis_layanan/detail`, {id: $uid}, function(res) {
			$modal.modal('show');
			$modal.find("#modal-title-default").text('Update');
			$form.find("input[name='id']").val(res.id);
			$form.find("input[name='nama_jenis_layanan']").val(res.nama_jenis_layanan);
		}, 'json');
		// alert($uid);
	});

	$form.on("submit", function(e) {
		e.preventDefault();
		var data = $form.serialize();
		var url = $form.attr('action');
		$.post(url, data, response, 'json');
	});

	var $btnHapus = $(document).on("click", "#hapus-layanan", function(e) {
		e.preventDefault();
		
		let $this = $(this);
		let $id = $this.data('uid');
		if(confirm('Apakah anda akan menghapus layanan tersebut ?')) {
			$.getJSON(`${_uri}/backend/jenis_layanan/delete`, {id: $id}, response);
		}
	}) 

	function response(res)
	{
		alert(res.msg);
		if(res.valid == true)
		{
			tableJenisLayanan.ajax.reload();
			if($modal.length > 0) {
				setTimeout(function() {
					$modal.modal('hide');
				}, 600);
			}
		}
	}

	var tableJenisLayanan = $("#table-jenis-layanan").DataTable({
			"processing": true,
			"serverSide": true,
			"paging": true,
			"ordering": true,
			"info": true,
			"searching": true,
			// "pagingType": "full_numbers",
			"responsive": true,
			"datatype": "json",
			"scrollY": "400px",
			"scrollCollapse": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			"order": [],
			"ajax": {
				"url": `${_uri}/backend/jenis_layanan/ajax_jenis_layanan`,
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0,2],
				"orderable": false,
				"className": "text-center"
			}, {
				"targets": [1],
				"orderable": true
			}],
			"language": {
				"lengthMenu": "_MENU_ Data per halaman",
				"zeroRecords": "Belum Ada Jenis Layanan",
				"info": "Showing page _PAGE_ of _PAGES_",
				"infoEmpty": "Belum Ada Jenis Layanan",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"search": "Cari Nama Layanan",
				"paginate": {
						"previous": `<i class="ni ni-bold-left"></i>`,
						"next": `<i class="ni ni-bold-right"></i>`
					},
				"emptyTable": "No matching records found, please filter this data"
			},
		});
	});
	</script>
	<script src="<?= base_url('template/argon/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('template/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>