  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs <?= theme(['navbar','bg'], 'theme') ?>" id="sidenav-main">
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

            <?php 
              $primary = $this->users->get_menus('PRIMARY'); 
              foreach ($primary->result() as $m):
            ?>
            <?php if(privileges($m->privilege)): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == $m->url ? "active" : ""; ?>" href="<?= base_url($m->url) ?>">
                  <i class="<?= $m->icon ?> <?= $m->icon_class ?>"></i>
                  <span class="nav-link-text"><?= ucwords($m->nama_menu) ?></span>
                </a>
              </li>
          <?php endif; ?>
          <?php endforeach; ?>
          </ul>
          <!-- Divider -->
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
          <span class="docs-normal">MASTER DATA IKM</span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
            <?php 
              $secondary = $this->users->get_menus('SECONDARY'); 
              foreach ($secondary->result() as $m):
            ?>
            <?php if(privileges($m->privilege)): ?>
              <li class="nav-item">
                <a class="nav-link <?= $this->uri->segment(1) == $m->url ? "active" : ""; ?>" href="<?= base_url($m->url) ?>">
                  <i class="<?= $m->icon ?> <?= $m->icon_class ?>"></i>
                  <span class="nav-link-text"><?= ucwords($m->nama_menu) ?></span>
                </a>
              </li>  
            <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>