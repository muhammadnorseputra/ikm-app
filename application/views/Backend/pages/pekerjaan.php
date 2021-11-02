<?php 
   if(privileges('priv_pekerjaan') == false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row">
	<div class="col-xl-6">
		<div class="card" id="list_pekerjaan">
			<div class="card-header">
				<div class="row">
					<div class="col-8 col-xl-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-search"></i></div>
							</div>
							<input type="text" class="form-control search" placeholder="Cari Pekerjaan">
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
								<th scope="col" class="sort" data-sort="jns_pekerjaan">Pekerjaan</th>
							</tr>
						</thead>
						<tbody class="list">
						<?php 
				            if(sub_privilege('sub_pekerjaan', 'r') === false): 
				              echo "<tr><td colspan='4'>";
				              $this->load->view('Backend/pages/notif_mod_dibatasi');
				              echo "</td></tr>";
				            else:
				        ?>
							<?php if($list_pekerjaan->num_rows() > 0): ?>
							<?php
								foreach($list_pekerjaan->result() as $p):
							?>
							<tr>
								<td class="id d-none"><?= encrypt_url($p->id) ?></td>
								<td>
									<?php 
							            if(sub_privilege('sub_pekerjaan', 'u') === false): 
							              echo '<button class="btn btn-sm btn-icon-only text-primary" title="Disabled" role="button" type="button" disabled>
										<i class="fas fa-edit"></i>
										</button>';
							            else:
							        ?>	
									<button id="edit-pekerjaan" class="btn btn-sm btn-icon-only text-primary" role="button" type="button" data-href="<?= base_url('backend/pekerjaan/detail/'.encrypt_url($p->id)) ?>">
									<i class="fas fa-edit"></i>
									</button>
									<?php endif; ?>
								</td>
								<td>
								<?php 
						            if(sub_privilege('sub_pekerjaan', 'd') === false): 
						              echo '<button class="btn btn-sm btn-icon-only text-danger" title="Disabled" disabled><i class="fas fa-trash"></i></button>';
						            else:
						        ?>
									<button id="hapus-pekerjaan" class="btn btn-sm btn-icon-only text-danger" data-href="<?= base_url('backend/pekerjaan/delete/'.encrypt_url($p->id)) ?>"><i class="fas fa-trash"></i></button>
								<?php endif; ?>	
								</td>
								<td class="jns_pekerjaan"><?= $p->jenis_pekerjaan ?></td>
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
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header font-weight-bold text-primary">
				Tambah
			</div>
			<div class="card-body">
			<?php 
	            if(sub_privilege('sub_pekerjaan', 'c') === false): 
	              $this->load->view('Backend/pages/notif_mod_dibatasi');
	            else:
	        ?>
				<div class="form-group">
					<label for="jp" class="small">Jenis Pekerjaan</label>
					<input type="text" id="jp" name="jp" class="form-control form-control-muted" placeholder="Masukan Jenis Pekerjaan Disini ...">
				</div>
				<button type="button" class="btn btn-primary" id="simpan">Simpan</button>
			<?php endif; ?>
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
				<?= form_open(base_url('backend/pekerjaan/update'), ['class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'f_pekerjaan'], ['id' => null]); ?>
				<div class="form-group">
					<label for="jp">Jenis Pekerjaan</label>
					<input type="text" autocomplete="off" class="form-control form-control-alternative text-primary font-weight-bold" id="jp" name="jp" placeholder="Jenis Pekerjaan">
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

		// Method Add
		var nameField = $("input[name='jp']");
		var btnAdd = $("#simpan");
		btnAdd.click(function() {
			var data = {jp: nameField.val()};
			$.post(`${_uri}/backend/pekerjaan/insert`, data, response, 'json');
		});

		function response(res) {
			if(res.valid == true) {
			  alert(res.msg);
			  pekerjaanList.add({
			    id: Math.floor(Math.random()*110000),
			    jns_pekerjaan: nameField.val(),
			  });	
			  clearFields();
			  window.location.reload();
			}
		}

		function clearFields() {
		  nameField.val('');
		}

		// Method Remove
		let removeBtns = $("button#hapus-pekerjaan");
		removeBtns.click(function() {
		    // let itemId = $(this).closest('tr').find('.id').text();
			let $this = $(this);
			let $url = $this.data('href');
			if(confirm("Apakah anda yakin akan menghapus pekerjaan tersebut ?")) {
				$.getJSON($url, act_delete);
			}
		});

		function act_delete(res) {
			if(res.valid == true)
			{
				alert(res.msg);
		    	pekerjaanList.remove('id', res.item.id);
			}
		}

		// Method Edit
		var btnEdit = $("button#edit-pekerjaan");
		var modalEdit = $("#model-default");
		var form = $("#f_pekerjaan");

		btnEdit.on("click", function(e) {
			e.preventDefault();
			modalEdit.modal('show');
			var $this = $(this);
			var $url = $this.data('href');
			$.getJSON($url, function(res) {
				form.find('input[name="id"]').val(res.id);
				form.find('input[name="jp"]').val(res.jp);
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
    		var item = pekerjaanList.get('id', res.data.id)[0];
			if(res.valid == true)
			{
				alert(res.msg);
				item.values({
				    id: res.data.id,
				    jns_pekerjaan: res.data.jp
				  });
				setTimeout(function(){
					modalEdit.modal('hide');
				}, 400);
			}
		}
		// List
		var options = {
			valueNames: [ 'id','jns_pekerjaan' ],
			searchColumns: ['jns_pekerjaan'],
			page: 4,
			pagination: true
		};
		var pekerjaanList = new List('list_pekerjaan', options);
	});
</script>
<script src="<?= base_url('template/argon/vendor/list.js/dist/list.min.js') ?>"></script>