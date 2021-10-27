<div class="row">
	<div class="col-xl-6">
		<div class="card" id="list_pendidikan">
			<div class="card-header">
				<div class="row">
					<div class="col-8 col-xl-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-search"></i></div>
							</div>
							<input type="text" class="form-control search" placeholder="Cari Pendidikan">
						</div>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table">
						<thead class="thead-light">
							<tr>
								<th scope="col" width="10"></th>
								<th scope="col" width="10"></th>
								<th scope="col" class="sort" data-sort="jdl_pendidikan">Tingkat Pendidikan</th>
							</tr>
						</thead>
						<tbody class="list">
							<?php if($list_pendidikan->num_rows() > 0): ?>
							<?php
								foreach($list_pendidikan->result() as $p):
							?>
							<tr>
								<td class="id d-none"><?= encrypt_url($p->id) ?></td>
								<td>
									<button id="edit-pendidikan" class="btn btn-sm btn-icon-only text-primary" role="button" type="button" data-href="<?= base_url('backend/pendidikan/detail/'.encrypt_url($p->id)) ?>">
									<i class="fas fa-edit"></i>
									</button>
								</td>
								<td><button id="hapus-pendidikan" class="btn btn-sm btn-icon-only text-danger" data-href="<?= base_url('backend/pendidikan/delete/'.encrypt_url($p->id)) ?>"><i class="fas fa-trash"></i></button></td>
								<td class="jdl_pendidikan"><?= $p->tingkat_pendidikan ?></td>
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
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header font-weight-bold text-primary">
				Tambah
			</div>
			<div class="card-body">
				<div class="form-group">
					<label for="tp" class="small">Tingkat Pendidikan</label>
					<input type="text" id="tp" name="tp" class="form-control form-control-muted" placeholder="Masukan Tingkat Pendidikan Disini ...">
				</div>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="model-default" tabindex="-1" role="dialog" aria-labelledby="editLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom">
				<h5 class="modal-title" id="editLabel">Update</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?= form_open(base_url('backend/pendidikan/update'), ['class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'f_pendidikan'], ['id' => null]); ?>
				<div class="form-group">
					<label for="tp">Tingkat Pendidikan</label>
					<input type="text" autocomplete="off" class="form-control form-control-alternative text-primary font-weight-bold" id="tp" name="tp" placeholder="Tingkat Pendidikan">
				</div>
				<button type="submit" class="btn btn-primary">Update</button>
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

		var nameField = $("input[name='tp']");
		var btnAdd = $("#simpan");
		btnAdd.click(function() {
			var data = {tp: nameField.val()};
			$.post(`${_uri}/backend/pendidikan/insert`, data, response, 'json');
		});

		function response(res) {
			if(res.valid == true) {
			  alert(res.msg);
			  pendidikanList.add({
			    id: Math.floor(Math.random()*110000),
			    jdl_pendidikan: nameField.val(),
			  });	
			  clearFields();
			  window.location.reload();
			}
		}

		function clearFields() {
		  nameField.val('');
		}

		let removeBtns = $("button#hapus-pendidikan");
		removeBtns.click(function() {
		    // let itemId = $(this).closest('tr').find('.id').text();
			let $this = $(this);
			let $url = $this.data('href');
			if(confirm("Apakah anda yakin akan menghapus pendidikan tersebut ?")) {
				$.getJSON($url, act_delete);
			}
		});

		function act_delete(res) {
			if(res.valid == true)
			{
				alert(res.msg);
		    	pendidikanList.remove('id', res.item.id);
			}
		}

		var btnEdit = $("button#edit-pendidikan");
		var modalEdit = $("#model-default");
		var form = $("#f_pendidikan");

		btnEdit.on("click", function(e) {
			e.preventDefault();
			modalEdit.modal('show');
			var $this = $(this);
			var $url = $this.data('href');
			$.getJSON($url, function(res) {
				form.find('input[name="id"]').val(res.id);
				form.find('input[name="tp"]').val(res.tp);
			})
		});

		form.submit(function(e) {
			e.preventDefault();
			var $this = $(this);
			var $url = $this.attr('action');
			var $field = $this.serialize();
			$.post($url, $field, act_update, 'json');
		})

		function act_update(res) {
    		var item = pendidikanList.get('id', res.data.id)[0];
			if(res.valid == true)
			{
				alert(res.msg);
				item.values({
				    id: res.data.id,
				    jdl_pendidikan: res.data.tp
				  });
				setTimeout(function(){
					modalEdit.modal('hide');
				}, 400);
			}
		}
		// List
		var options = {
			valueNames: [ 'id','jdl_pendidikan' ],
			searchColumns: ['jdl_pendidikan'],
			page: 4,
			pagination: true
		};
		var pendidikanList = new List('list_pendidikan', options);
	});
</script>
<script src="<?= base_url('template/argon/vendor/list.js/dist/list.min.js') ?>"></script>