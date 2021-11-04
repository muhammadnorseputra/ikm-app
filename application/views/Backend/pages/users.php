<?php 
   if(privileges('priv_users') == false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-body px-0 pt-3 pb-0">
				<div class="table-responsive">
					<table class="table" id="table-users">
						<thead class="bg-secondary">
							<tr>
								<th scope="col">Photo</th>
								<th scope="col">Nama</th>
								<th scope="col">Role</th>
								<th scope="col">Is Block</th>
								<th scope="col">Is Restricted</th>
								<th scope="col">Check In</th>
								<th scope="col">Check Out</th>
								<th scope="col"></th>
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
<script>
	$(function() {
		var tableUsers = $("#table-users").DataTable({
			"processing": true,
			"serverSide": true,
			"paging": true,
			"ordering": true,
			"info": true,
			"searching": true,
			// "pagingType": "full_numbers",
			"responsive": true,
			"datatype": "json",
			// "scrollY": "800px",
			"scrollCollapse": true,
			"lengthMenu": [
				[10, 25, 50, -1],
				[10, 25, 50, "All"]
			],
			"order": [],
			"ajax": {
				"url": `${_uri}/backend/users/ajax_users`,
				"type": "POST"
			},
			"columnDefs": [{
				"targets": [0,1,2,3,4,5,6,7],
				"orderable": false,
				"className": "text-left"
			}],
			"language": {
				"lengthMenu": "_MENU_ Data per halaman",
				"zeroRecords": "Belum Ada Users",
				"info": "Showing page _PAGE_ of _PAGES_",
				"infoEmpty": "Belum Ada Users",
				"infoFiltered": "(filtered from _MAX_ total records)",
				"search": "Cari Users",
				"paginate": {
						"previous": `<i class="ni ni-bold-left"></i>`,
						"next": `<i class="ni ni-bold-right"></i>`
					},
				"emptyTable": "No matching records found, please filter this data"
			},
		});

		$(document).on("click", "a#btn-restricted", function(event){
			event.preventDefault();
			var $this = this;
			var $uid = $this.dataset.uid;
			var $url = $this.dataset.href;
			var $val = $this.dataset.val;
			var $data = {status: $val, uid: $uid};
			$.post($url,$data,is_status,'json');
			// console.log($val);
		});

		$(document).on("click", "a#btn-block", function(event){
			event.preventDefault();
			var $this = this;
			var $uid = $this.dataset.uid;
			var $url = $this.dataset.href;
			var $val = $this.dataset.val;
			var $data = {status: $val, uid: $uid};
			$.post($url,$data,is_status,'json');
			// console.log($val);
		});

		function is_status(res)
		{
			if(res.valid === true)
			{
				tableUsers.ajax.reload();
			}
		}

		$(document).on("click", "a#resspwd", function(event){
			event.preventDefault();
			var $this = this;
			var $uid = $this.dataset.uid;
			var $url = `${_uri}/backend/users/resspwd_act`;
			var $data = {uid: $uid};
			$.post($url,$data,response,'json');
		});

		function response(res) {
			window.location.href = res.redirectTo;
			console.log(res);
		}
	})
</script>
<script src="<?= base_url('template/argon/vendor/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>