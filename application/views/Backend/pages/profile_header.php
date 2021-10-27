<div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(<?= base_url('assets/images/pic/'.$this->session->userdata('pic')) ?>); background-size: cover; background-position: center top;">
  <!-- Mask -->
  <span class="mask bg-gradient-dark opacity-8"></span>
  <!-- Header container -->
  <div class="container-fluid d-flex align-items-center">
    <div class="row">
      <div class="col-lg-7 col-md-10">
        <h1 class="display-2 text-white">Hello <?= $this->session->userdata('nama'); ?></h1>
        <p class="text-white mt-0 mb-5">Ini adalah halaman profile anda. Kamu bisa melihat roles apa yang dapat kamu akses dan meupdate profile mu.</p>
        <a href="#!" class="btn btn-neutral">Edit profile</a>
      </div>
    </div>
  </div>
</div>