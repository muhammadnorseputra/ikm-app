<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(<?= base_url('template/argon/img/theme/img-1-1000x600.jpg') ?>); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-dark opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Hello <?= $this->session->userdata('nama'); ?></h1>
        <p class="text-white mt-0 mb-5">Ini adalah halaman profile anda. Kamu bisa melihat role akses dan meupdate profile mu. Kamu juga dapat merubah preferensi sesuai keinginan kamu.</p>
        <a href="<?= base_url('preferensi/'.$this->session->userdata('user_name')) ?>" class="btn btn-neutral"><i class="ni ni-settings-gear-65 mr-2"></i> Pengaturan Preferensi</a>
      </div>
    </div>
  </div>
</div>