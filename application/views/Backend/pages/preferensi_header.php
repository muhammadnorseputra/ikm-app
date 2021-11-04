<div class="header pb-0 d-flex align-items-start pt-4" style="min-height: calc(100vh - 78px); background-image: url(<?= base_url('template/argon/img/theme/img-1-1000x600.jpg') ?>); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-dark opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center justify-content-start">
    <div class="row">
      <div class="col-xl-5 col-lg-7 col-md-8">
        <h1 class="display-2 text-white"><?= ucwords($this->uri->segment(1)); ?></h1>
        <p class="text-white mt-0 mb-md-5 mb-3">Halaman preferensi kamu bisa sesuaikan dengan keinginan mu, dengan warna yang telah tersedia.</p>
        <a href="<?= base_url('profile/'.$this->session->userdata('user_name')) ?>" class="btn btn-neutral"><i class="ni ni-single-02 mr-2"></i> Profile</a>
      </div>
      <div class="col-xl-7 col-lg-5 col-md-4">
        <h1 class="display-2 text-white mt-4 mt-md-0">Themes</h1>
          <?php  
            $theme_base = $list_theme->theme_base;
            $theme_base_current = $list_theme->theme;
            $theme_base_current_top = $list_theme->top_bar;
            $theme_base_current_main = $list_theme->main_bg;
            $is_theme = explode(",", $theme_base);
          ?>
          <?= form_open(base_url('preferensi/'.$this->session->userdata('user_name').'/update'), ['id' => 'f_theme']); ?>

            <div class="form-inline">
              <label class="mr-2 text-white" for="theme">Theme : </label>
              <select name="theme[]" class="custom-select mr-2" id="theme">
                <?php  
                foreach ($is_theme as $key => $value):
                $color = $value;
                $is_active = $color == $theme_base_current ? 'selected' : '';
                ?>
                <option value="<?= $color ?>" <?= $is_active ?>><?= $color ?></option>
                <?php endforeach; ?>
              </select>

              <label class="mr-2 mt-3 mt-md-0 text-white" for="theme">Top Bar : </label>
              <select name="theme[]" class="custom-select mr-2" id="theme">
                <?php  
                foreach ($is_theme as $key => $value):
                $color = $value;
                $is_active = $color == $theme_base_current_top ? 'selected' : '';
                ?>
                <option value="<?= $color ?>" <?= $is_active ?>><?= $color ?></option>
                <?php endforeach; ?>
              </select>

              <label class="mr-2 mt-3 mt-md-0 text-white" for="theme">Main BG : </label>
              <select name="theme[]" class="custom-select mr-2" id="theme">
                <?php  
                foreach ($is_theme as $key => $value):
                $color = $value;
                $is_active = $color == $theme_base_current_main ? 'selected' : '';
                ?>
                <option value="<?= $color ?>" <?= $is_active ?>><?= $color ?></option>
                <?php endforeach; ?>
              </select>
              <button type="submit" class="btn btn-primary mt-3 ml-xl-3"><i class="ni ni-palette mr-2"></i>Simpan Perubahan</button>
            </div>
          
          <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<script>
  $(function() {
    $form = $("#f_theme");
    $form.submit(function(e) {
      e.preventDefault();
      $this = $(this);
      $url = $this.attr('action');
      $data = $this.serialize();
      $.post($url,$data,response, 'json');
    });

    function response(res)
    {
      if(res.valid == true) {
        let timerInterval;
        Swal.fire({
          icon: 'success',
          title: 'Preferensi Update',
          html: res.pesan,
          timer: 3000,
          showConfirmButton: false,
          allowOutsideClick:false,
          allowEscapeKey:false,
          timerProgressBar: true,
          toast: true,
          width: '33rem',
          position: 'top',
          willClose: () => {
            clearInterval(timerInterval)
          }
        }).then((result) => {
          /* Read more about handling dismissals below */
          if (result.dismiss === Swal.DismissReason.timer) {
            window.location.reload();
          }
        });
        return false;
      }
      Swal.fire({
        icon: 'info',
        title: 'Oops...',
        text: res.pesan,
        toast: true,
        position: 'top-end',
      })
    }
  })
</script>