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
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">MASTER DATA IKM</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <li class="nav-item">
              <a class="nav-link <?= $this->uri->segment(1) == 'responden' ? "active" : ""; ?>" href="<?= base_url('responden') ?>">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-text">Responden</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->uri->segment(1) == 'periode' ? "active" : ""; ?>" href="<?= base_url('periode') ?>">
                <i class="ni ni-chart-bar-32"></i>
                <span class="nav-link-text">Periode</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= $this->uri->segment(1) == 'pertanyaan' ? "active" : ""; ?>" href="<?= base_url('pertanyaan') ?>">
                <i class="ni ni-books"></i>
                <span class="nav-link-text">Daftar Pertanyaan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html" target="_blank">
                <i class="ni ni-palette"></i>
                <span class="nav-link-text">Jenis Layanan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html" target="_blank">
                <i class="ni ni-ui-04"></i>
                <span class="nav-link-text">Pekerjaan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="https://demos.creative-tim.com/argon-dashboard/docs/plugins/charts.html" target="_blank">
                <i class="ni ni-chart-pie-35"></i>
                <span class="nav-link-text">Pendidikan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active active-pro" href="examples/upgrade.html">
                <i class="ni ni-send text-dark"></i>
                <span class="nav-link-text">Hubungi Developer</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>