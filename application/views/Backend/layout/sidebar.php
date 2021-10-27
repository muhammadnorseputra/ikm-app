  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white shadow-xl" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <i class="fas fa-project-diagram mr-2 fa-2x text-primary"></i>e-<span class="text-primary">Survei</span>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">

            
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'dashboard' ? "active" : ""; ?>" href="<?= base_url('dashboard') ?>">
                  <i class="ni ni-tv-2 text-primary"></i>
                  <span class="nav-link-text">Dashboard</span>
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->uri->segment(1) == 'users' ? "active" : ""; ?>" href="<?= base_url('users') ?>">
                <i class="ni ni-satisfied text-warning"></i>
                <span class="nav-link-text">Users</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->uri->segment(1) == 'report' ? "active" : ""; ?>" href="<?= base_url('report') ?>">
                <i class="ni ni-single-copy-04 text-success"></i>
                <span class="nav-link-text">Report IKM</span>
              </a>
            </li>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">MASTER DATA IKM</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <?php if(privileges('priv_responden')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'responden' ? "active" : ""; ?>" href="<?= base_url('responden') ?>">
                  <i class="ni ni-circle-08"></i>
                  <span class="nav-link-text">Responden</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_periode')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'periode' ? "active" : ""; ?>" href="<?= base_url('periode') ?>">
                  <i class="ni ni-chart-bar-32"></i>
                  <span class="nav-link-text">Periode</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_unsur')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'unsur' ? "active" : ""; ?>" href="<?= base_url('unsur') ?>">
                  <i class="ni ni-atom"></i>
                  <span class="nav-link-text">Unsur</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_daftar_pertanyaan')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'pertanyaan' ? "active" : ""; ?>" href="<?= base_url('pertanyaan') ?>">
                  <i class="ni ni-books"></i>
                  <span class="nav-link-text">Daftar Pertanyaan</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_daftar_jawaban')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'jawaban' ? "active" : ""; ?>" href="<?= base_url('jawaban') ?>">
                  <i class="ni ni-ui-04"></i>
                  <span class="nav-link-text">Daftar Jawaban</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_jenis_layanan')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'jenis_layanan' ? "active" : ""; ?>" href="<?= base_url('jenis_layanan') ?>">
                  <i class="ni ni-book-bookmark"></i>
                  <span class="nav-link-text">Jenis Layanan</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_pendidikan')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'pendidikan' ? "active" : ""; ?>" href="<?= base_url('pendidikan') ?>">
                  <i class="ni ni-badge"></i>
                  <span class="nav-link-text">Pendidikan</span>
                </a>
              </li>
            <?php endif; ?>
            <?php if(privileges('priv_pekerjaan')): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == 'pekerjaan' ? "active" : ""; ?>" href="<?= base_url('pekerjaan') ?>">
                  <i class="ni ni-single-02"></i>
                  <span class="nav-link-text">Pekerjaan</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>