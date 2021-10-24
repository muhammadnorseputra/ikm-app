<div class="row">
	<div class="col-xl-8 offset-xl-2">
		<div class="card" id="list_unsur">
			<div class="card-header">
				<div class="row">
					<div class="col-xl-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="fas fa-search"></i></div>
							</div>
							<input type="text" class="form-control search" placeholder="Cari Unsur">
						</div>
					</div>
					<div class="col-xl-6 text-right">
						<a href="<?= base_url('unsur/baru') ?>" type="button" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Baru</a>
					</div>
				</div>
			</div>
			<div class="card-body p-0">
				<div class="table-responsive">
					<table class="table align-items-center">
				        <thead class="thead-light">
				            <tr>
				                <th scope="col" width="10"></th>
				                <th scope="col" class="sort" data-sort="unsur">Unsur</th>
				            </tr>
				        </thead>
				        <tbody class="list">
				        	<?php if($list_unsur->num_rows() > 0): ?>
				        		<?php 
				        			foreach($list_unsur->result() as $p): 
				        		?>
				        			<tr>
				        					<td>
				        						<a class="btn btn-sm btn-icon-only text-light" href="#" role="button">
							                          <i class="fas fa-edit"></i>
							                    </a>
				        					</td>
					        				<td class="unsur"><?= $p->jdl_unsur ?></td>
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