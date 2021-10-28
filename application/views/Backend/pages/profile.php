<div class="row">
        <div class="col-xl-4 order-xl-2">
          <div class="card card-profile">
            <img src="<?= base_url('template/argon/img/theme/img-1-1000x600.jpg') ?>" alt="Image placeholder" class="card-img-top">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="<?= base_url('assets/images/pic/'.$this->session->userdata('pic')) ?>" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <!-- <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div> -->
            </div>
            <div class="card-body pt-0">
              <div>
                <h5 class="h3 text-center">
                  <?= $this->session->userdata('nama'); ?><span class="font-weight-light"> (<?= $this->session->userdata('user_name'); ?>) </span>
                </h5>
                Privileges
                <hr>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i><?= $this->session->userdata('role'); ?> - e-Survei
                </div>
                <div>
                  <?php  
                  $check_in_tgl = date("Y-m-d", strtotime($this->session->userdata('check_in')));
                  $check_in_time = date("H:i", strtotime($this->session->userdata('check_in')));
                  ?>
                  <i class="ni education_hat mr-2"></i>Check in: <?= longdate_indo($check_in_tgl) ?> - <?= $check_in_time ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile </h3>
                </div>
                <!-- <div class="col-4 text-right">
                  <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                </div> -->
              </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">User information</h6>
                <div class="pl-lg-4">
                  <?= form_open(base_url('backend/users/update_profile_basic'), ['id' => 'f_profile']); ?>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-nama">Nama Panggilan</label>
                        <input type="text" name="nama" id="input-nama" class="form-control" value="<?= $this->session->userdata('nama') ?>">
                      </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                          <label for="img_pic" class="form-control-label">Photo Profile</label>
                      <div class="form-group d-flex align-items-center">
                          <span class="mr-3">
                            <img src="<?= base_url('assets/images/pic/'.$this->session->userdata('pic')) ?>" class="rounded-circle">
                          </span>
                          <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                    </div>
                  </div>
                  <?= form_close(); ?>
                </div>
                <hr class="my-4" />
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">Akun information</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Username</label>
                        <input type="text" id="input-username" class="form-control" placeholder="Username" value="<?= $this->session->userdata('user_name') ?>" disabled>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-old-pwd">Old Password</label>
                        <input type="password" name="old_pwd" id="input-old-pwd" class="form-control" placeholder="Masukan Password Lama">
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="form-control-label" for="input-old-pwd">New Password</label>
                        <input type="password" name="new_pwd" id="input-old-pwd" class="form-control" placeholder="Masukan Password Baru">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript">
    $(document).ready(function(){
      var $form = $("#f_profile");

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
                 console.log(res) ;
               }
             });
        });
    });
</script>