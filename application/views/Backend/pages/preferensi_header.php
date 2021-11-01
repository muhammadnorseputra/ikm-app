<div class="header pb-0 d-flex align-items-start pt-4" style="min-height: calc(100vh - 78px); background-image: url(<?= base_url('template/argon/img/theme/img-1-1000x600.jpg') ?>); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-dark opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center justify-content-start">
    <div class="row">
      <div class="col-lg-7 col-md-8">
        <h1 class="display-2 text-white"><?= ucwords($this->uri->segment(1)); ?></h1>
        <p class="text-white mt-0 mb-5">Halaman preferensi kamu bisa sesuaikan dengan keinginan mu, dengan warna yang telah tersedia.</p>
        <a href="<?= base_url('profile/'.$this->session->userdata('user_name')) ?>" class="btn btn-neutral"><i class="ni ni-single-02 mr-2"></i> Profile</a>
      </div>
      <div class="col-lg-5 col-md-4">
        <h1 class="display-2 text-white">Theme</h1>
        <?= form_open(base_url('preferensi/'.$this->session->userdata('user_name').'/update'), ['id' => 'f_theme']); ?>
        <!-- <b class="text-white pb-2 border-bottom d-block mb-2">Theme</b> -->
        <ul class="list-unstyled d-flex justify-content-between flex-wrap">
          <?php  
          $theme_base = $list_theme->theme_base;
          $theme_base_current = $list_theme->theme;
          $is_theme = explode(",", $theme_base);
          foreach ($is_theme as $key => $value):
          $color = $value;
          $is_active = $color == $theme_base_current ? 'checked' : '';
          ?>
            <li class="d-flex flex-column align-items-center mb-3">
              <label data-toggle="tooltip" title="<?= ucwords($color) ?>" for="<?= $color ?>" class="bg-<?= $color ?> p-4 mb-2 rounded" style="cursor: pointer;"></label>
              <div class="form-check">
                <input name="theme[]" class="form-check-input position-static" type="radio" id="<?= $color ?>" value="<?= $color ?>" aria-label="Theme Base" <?= $is_active ?>>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
        <button type="submit" class="btn btn-primary"><i class="ni ni-palette mr-2"></i>Simpan Perubahan</button>
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
      console.log(res);
      alert(res.pesan);
      if(res.valid == true) {
        window.location.reload();
      }
    }
  })
</script>