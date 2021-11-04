<div class="row">
	<div class="col-xl-6">
		<div class="card">
			<div class="card-header font-weight-bold">Update Profile</div>
			<div class="card-body">
				<?= form_open(base_url('backend/users/update_profile_aksi'), ['id' => 'f_profile'], ['uid' => $uid]); ?>
				<div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama Panggilan</label>
                        <input type="text" name="nama" id="input-nama" class="form-control" value="<?= $profile->nama ?>">
                      </div>
                    </div>
                    <div class="col-lg-8 align-self-center">
                          <label for="img_pic" class="form-control-label">Photo Profile</label>
                      <div class="form-group d-flex align-items-center">
                          <span class="mr-3">
                            <img src="<?= base_url('assets/images/pic/'.$profile->pic) ?>" class="rounded-circle" width="50">
                          </span>
                          <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  	<div class="col-12 col-lg-4">
                  		<label class="form-control-label" for="pilih-role">Pilih Role</label>
                  			<?php  
                  				$is_role = $profile->role;
                  			?>
	                		<select class="custom-select custom-select-lg mb-3" name="role" id="pilih-role">
							  <option value="">Pilih Level</option>
							  <option value="SUPER_USER" <?= ($is_role == 'SUPER_USER') ? 'selected' : ''; ?>>SUPER USER</option>
							  <option value="ADMIN" <?= ($is_role == 'ADMIN') ? 'selected' : ''; ?>>ADMIN</option>
							  <option value="USER" <?= ($is_role == 'USER') ? 'selected' : ''; ?>>USER</option>
							  <option value="TAMU" <?= ($is_role == 'TAMU') ? 'selected' : ''; ?>>TAMU</option>
							</select>
                  	</div>
                  </div>
                        <button class="btn btn-primary" type="submit">Update</button>
	                	<button type="button" class="btn btn-link" onclick="window.location.href='<?= base_url('users') ?>'">Batal</button>

				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		$form = $("#f_profile");
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
               alert(res.pesan);
               if(res.valid == true) {
                window.location.href = `${res.redirectTo}`
               	return false;
               }
               // console.log(res);
             }
          });
      });
	})
</script>