<div class="offcanvas offcanvas-end" data-bs-backdrop="true" data-bs-scroll="true" tabindex="-1" id="cetak" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="offcanvasWithBothOptionsLabel">CETAK FORMULIR IKM</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <?php
    $jn = $this->skm->skm_jenis_layanan();
  ?>
  <div class="offcanvas-body bg-light">
    <form class="needs-validation" novalidate id="f_print_formulir">
      <div class="form-floating">
      <select class="form-select mb-3" data-url="<?= base_url() ?>" name="jns_layanan_print" aria-label=".form-select-lg" id="example">
        <option value="0">Pilih salahsatu layanan yang akan anda nilai.</option>
        <?php foreach($jn->result() as $jl): ?>
        <option value="<?= $jl->id ?>"><?= strtoupper($jl->nama_jenis_layanan) ?></option>
        <?php endforeach; ?>
      </select>
      <label for="example">Pilih Layanan</label>
      </div>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button class="btn btn-primary disabled" type="button">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
</svg>
        </button>
        <button class="btn btn-primary text-uppercase" type="submit">cetak formulir</button>
       </div>
    </form>
    <div class="flex flex-column">
      <div>
        <!-- <img src="<?= base_url('assets/images/qr-code-ikm.png') ?>" class="w-50" alt="SURVEI BKPPD BALANGAN"> -->
      </div>
    </div>
  </div>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#F8F9FA" fill-opacity="1" d="M0,192L26.7,165.3C53.3,139,107,85,160,53.3C213.3,21,267,11,320,10.7C373.3,11,427,21,480,42.7C533.3,64,587,96,640,106.7C693.3,117,747,107,800,90.7C853.3,75,907,53,960,58.7C1013.3,64,1067,96,1120,122.7C1173.3,149,1227,171,1280,176C1333.3,181,1387,171,1413,165.3L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path></svg>
</div>
