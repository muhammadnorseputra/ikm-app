<!-- <div class="container"> -->
<div class="row mb-2">
	<div class="col-xl-12">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text bg-gradient-warning text-white"><i class="fa fa-filter"></i></span>
			</div>
			<div class="input-group-prepend">
				<label class="input-group-text" for="filter-year"><i class="fa fa-layer-group"></i></label>
			</div>
			<select class="custom-select" id="filter-year" name="f_year">
				<option selected value="">Pilih Tahun</option>
				<?php foreach($ikm_tahun->result() as $t): ?>
				<option value="<?= $t->tahun ?>"><?= $t->tahun ?></option>
				<?php endforeach; ?>
			</select>
			<div class="input-group-prepend">
				<label class="input-group-text" for="filter-periode"><i class="fa fa-clipboard-list"></i></label>
			</div>
			<select class="custom-select" id="filter-periode" name="f_periode">
				<option selected value="">Pilih Periode</option>
				<?php foreach($ikm_periode->result() as $p): ?>
				<option value="<?= $p->id ?>"><?= mediumdate_indo($p->tgl_mulai) ?> - <?= mediumdate_indo($p->tgl_selesai) ?></option>
				<?php endforeach; ?>
			</select>
			<div class="input-group-prepend">
				<label class="input-group-text" for="filter-form"><i class="far fa-clipboard"></i></label>
			</div>
			<select class="custom-select" id="filter-form" name="f_form">
				<option selected value="">Pilih Form</option>
				<?php foreach($ikm_form->result() as $f): ?>
				<option value="<?= $f->card_responden ?>"><?= $f->card_responden ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
<!-- </div> -->
<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-xl-5 px-0">
						<div class="input-daterange input-group rounded" id="datepicker">
							<div class="input-group-prepend">
								<label class="input-group-text bg-secondary" for="filter-form"><i class="far fa-calendar-alt"></i></label>
							</div>
							<input type="text" class="input-sm form-control" placeholder="Start Date" size="5" name="start" />
							<input type="text" class="input-sm form-control" placeholder="To Date" size="5" name="end" />
							<span class="input-group-addon"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body px-0 py-4">
				<!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
				<div class="table-responsive">
					<table class="table align-items-center dt-responsive nowrap table-hover" id="table-responden">
						<thead class="bg-gradient-primary text-white">
							<tr>
								<th scope="col" class="text-center">No</th>
								<th scope="col">NIP/NIK</th>
								<th scope="col">Nama</th>
								<th scope="col">Umur</th>
								<th scope="col">JK</th>
								<th scope="col">Pendidikan</th>
								<th scope="col">Pekerjaan</th>
								<th scope="col">Form</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<link rel="stylesheet" href="<?= base_url('template/argon/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatable/inc_tablesold.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css') ?>">
<script>
	$(function() {
		/*Date Range*/
		$('.input-daterange').datepicker({
			todayBtn: "linked",
			format: "yyyy-mm-dd",
			clearBtn: true
		});
		// Filters
		$("select[name='f_year'],select[name='f_periode'],select[name='f_form']").on('change', function(e) {
			e.preventDefault();
			tableResponden.draw();
		});
		$("input[name='start'],input[name='end']").on('change', function(e) {
			e.preventDefault();
			tableResponden.draw();
		});
		// Tabels
		let order_date = urlParams.get('date');
		var tableResponden = $("#table-responden").DataTable({
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
			"url": `${_uri}/backend/responden/ajax_responden`,
			"type": "POST",
			"data": function(q) {
					q.filter_tahun = $("select[name='f_year']").val(),
					q.filter_periode = $("select[name='f_periode']").val(),
					q.filter_form = $("select[name='f_form']").val(),
					q.filter_start = $("input[name='start']").val(),
					q.order_date = order_date,
					q.filter_end = $("input[name='end']").val()
			},
		},
		"columnDefs": [{
			"targets": [0],
			"orderable": false,
			"className": "text-center"
		}, {
			"targets": [1],
			"orderable": true
		}, {
			"targets": [2],
			"orderable": true
		}, {
			"targets": [3],
			"orderable": false
		}, {
			"targets": [4],
			"orderable": false
		}, {
			"targets": [5],
			"orderable": false,
		}, {
			"targets": [6],
			"orderable": false,
		}, {
			"targets": [7],
			"orderable": false,
		}],
		"language": {
			"lengthMenu": "_MENU_ Data per halaman",
			"zeroRecords": "Belum Ada Responden",
			"info": "Showing page _PAGE_ of _PAGES_",
			"infoEmpty": "Belum Ada Responden",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Pencarian",
			"paginate": {
					"previous": `<i class="ni ni-bold-left"></i>`,
					"next": `<i class="ni ni-bold-right"></i>`
				},
			"emptyTable": "No matching records found, please filter this data"
		}
	});
	})
</script>
<script src="<?= base_url('template/argon/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js') ?>"></script>