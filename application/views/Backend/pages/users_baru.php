<div class="container">
	<div class="row">
		<div class="col-xl-8 offset-lg-2">
			<div class="card">
				<div class="card-header">
					<div class="title font-weight-bold">Buat User</div>
				</div>
				<div class="card-body">
					<div id="galat"></div>
					<?= form_open_multipart(base_url('backend/users/insert'), ['id' => 'f_users', 'class' => 'form-horizontal']); ?>
					<div class="row">
						<div class="col-lg-8 align-self-center">
	                      <label for="img_pic" class="form-control-label">Upload Photo</label>
	                      <div class="form-group d-flex align-items-center">
	                          <div class="custom-file">
	                            <input type="file" name="photo" class="custom-file-input" id="customFile">
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
	                        <label class="form-control-label" for="pilih-role">Pilih Role</label>
	                		<select class="custom-select custom-select-lg mb-3" name="role" id="pilih-role">
							  <option selected value="">Pilih Level</option>
							  <option value="SUPER_USER">SUPER USER</option>
							  <option value="ADMIN">ADMIN</option>
							  <option value="USER">USER</option>
							  <option value="TAMU">TAMU</option>
							</select>
	                	</div>
	                	<div class="col-lg-6"></div>
	                </div>
	                <button type="submit" class="btn btn-primary">Simpan</button>
	                <?= form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$form = $("#f_users");
		$container_galat = $("#galat");
		$form.submit(function(e){
          e.preventDefault();
          var $this = $(this); 
          var $url = $this.attr('action');
           $.ajax({
             url: $url,
             type:"post",
             data:new FormData(this),
             dataType: 'json',
             processData:false,
             contentType:false,
             cache:false,
             async:false,
             success: function(res) {
               if(res.valid == true) {
               	alert(res.pesan);
                window.location.href = `${res.redirectTo}`
               	return false;
               }
               $container_galat.html(`<div class="alert alert-warning" role="alert">
								    <strong>Galat!</strong> ${res.pesan}
								</div>`);
             }
          });
      });
	})
</script>