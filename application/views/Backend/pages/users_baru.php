<div class="container">
	<div class="row">
		<div class="col-xl-8 offset-lg-2">
			<div class="card">
				<div class="card-header">
					<div class="title font-weight-bold">Buat User</div>
				</div>
				<div class="card-body">
					<?= form_open(base_url('backend/users/insert'), ['id' => 'f_users', 'class' => 'form-horizontal']); ?>
					<div class="row">
						<div class="col-lg-8 align-self-center">
	                      <label for="img_pic" class="form-control-label">Upload Photo</label>
	                      <div class="form-group d-flex align-items-center">
	                          <div class="custom-file">
	                            <input type="file" name="file" class="custom-file-input" id="customFile">
	                            <label class="custom-file-label" for="customFile">Choose file</label>
	                          </div>
	                      </div>
	                    </div>
	                    <div class="col-lg-4">
	                      <div class="form-group">
	                        <label class="form-control-label" for="input-nama">Nama Panggilan</label>
	                        <input type="text" name="nama" id="input-nama" class="form-control">
	                      </div>
	                    </div>
	                  </div>
	                <div class="row">
	                	<div class="col-lg-6">
	                	  <div class="form-group">
	                        <label class="form-control-label" for="input-username">Username</label>
	                        <input type="text" name="username" id="input-username" class="form-control">
	                      </div>
	                	</div>
	                	<div class="col-lg-6">
	                	  <div class="form-group">
	                        <label class="form-control-label" for="input-pwd">Password</label>
	                        <input type="password" name="pwd" id="input-pwd" class="form-control">
	                      </div>
	                	</div>
	                </div>
	                <div class="row">
	                	<div class="col-lg-6">
	                		
	                	</div>
	                	<div class="col-lg-6"></div>
	                </div>
					<?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>