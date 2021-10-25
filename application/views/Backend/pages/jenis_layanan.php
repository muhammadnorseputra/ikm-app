<div class="row">
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
<link rel="stylesheet" href="<?= base_url('template/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<script>
	$(function() {
$.fn.dataTable.ext.buttons.reload = {
    text: 'Reload',
    action: function ( e, dt, node, config ) {
        dt.ajax.reload();
    }
};

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
		buttons: [
	        'reload'
	    ],
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