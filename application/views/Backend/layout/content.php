<!-- Main content -->
<div class="main-content" id="panel">
  <!-- Topnav -->
  <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Search form -->
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
          <div class="form-group mb-0">
            <div class="input-group input-group-alternative input-group-merge">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
              </div>
              <input class="form-control" placeholder="Search" type="text">
            </div>
          </div>
          <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </form>
        <!-- Navbar links -->
        <ul class="navbar-nav align-items-center  ml-md-auto ">
          <li class="nav-item d-xl-none">
            <!-- Sidenav toggler -->
            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </div>
          </li>
          <li class="nav-item d-sm-none">
            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
              <i class="ni ni-zoom-split-in"></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-bell-55"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
              <!-- Dropdown header -->
              <div class="px-3 py-3">
                <h6 class="text-sm text-muted m-0">Daftar responden hari ini, ada <strong class="text-primary"><?= $this->skm->jml_list_responden(); ?></strong> orang.</h6>
              </div>
              <!-- List group -->
              <div class="list-group list-group-flush">
                <?php foreach($this->skm->list_responden() as $r): ?>
                  <a href="#!" class="list-group-item list-group-item-action">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <i class="ni ni-satisfied"></i>
                      </div>
                      <div class="col ml--2">
                        <div class="d-flex justify-content-between align-items-center">
                          <div>
                            <h4 class="mb-0 text-sm"><?= sensor(ucwords($r->nama_lengkap)); ?></h4>
                          </div>
                          <div class="text-right text-muted">
                            <small><?= longdate_indo($r->created_at); ?></small>
                          </div>
                        </div>
                        <p class="text-sm mb-0">Form <span class="font-weight-bold"><?= ucwords($r->card_responden); ?></span></p>
                      </div>
                    </div>
                  </a>
                <?php endforeach; ?>
              </div>
              <!-- View all -->
              <a href="<?= base_url('responden?date='.date('Y-m-d')) ?>" class="dropdown-item text-center text-primary font-weight-bold py-3">Lihat Semua</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ni ni-ungroup"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
              <div class="row shortcuts px-4">
                <a href="<?= base_url('skm') ?>" target="_blank" class="col-4 shortcut-item">
                  <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                    <i class="ni ni-calendar-grid-58"></i>
                  </span>
                  <small>Situs</small>
                </a>
                <a href="<?= base_url('laporan') ?>" target="_blank" class="col-4 shortcut-item">
                  <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                    <i class="ni ni-email-83"></i>
                  </span>
                  <small>Laporan</small>
                </a>
              </div>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url('assets/images/pic/'.$this->session->userdata('pic')) ?>">
                </span>
                <div class="media-body  ml-2  d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucwords($this->session->userdata('nama')) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu  dropdown-menu-right ">
              <div class="dropdown-header noti-title">
                <h6 class="text-overflow m-0">Welcome!</h6>
              </div>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-single-02"></i>
                <span>My profile</span>
              </a>
              <a href="#!" class="dropdown-item">
                <i class="ni ni-settings-gear-65"></i>
                <span>Settings</span>
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url('logout'); ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <?php if($this->uri->segment(1) == 'dashboard'): ?>
    <?php $this->load->view('Backend/pages/dashboard_header'); ?>
  <?php else: ?>
  <div class="header bg-primary pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0"><?= ucwords($this->uri->segment(1)) ?></h6>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- Page content -->
  <div class="container-fluid mt--6">
    <?php  
      if ($content) {
        $this->load->view($content);
      }
    ?>
    <!-- Footer -->
    <footer class="footer pt-0">
      <div class="row align-items-center justify-content-lg-between">
        <div class="col-lg-6">
          <div class="copyright text-center  text-lg-left  text-muted">
            &copy; <?= date('Y') ?> <a href="/web.bkppd-balangankab.info/" class="font-weight-bold ml-1" target="_blank">e-Survei</a>
          </div>
        </div>
        <div class="col-lg-6">
          <ul class="nav nav-footer justify-content-center justify-content-lg-end">
            <li class="nav-item">
              <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
            </li>
            <li class="nav-item">
              <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
            </li>
            <li class="nav-item">
              <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
            </li>
            <li class="nav-item">
              <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>