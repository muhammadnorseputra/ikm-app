  <!-- Header -->
  <div class="header <?= theme(['bg'], 'main_bg') ?> pb-6">
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
          </div>
        </div>
        <!-- Card stats -->
        <div class="row">
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Responden</h5>
                    <span class="h2 font-weight-bold mb-0"><?= nominal($total_responden); ?> / <?= $_d->target ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                      <i class="ni ni-active-40"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <?php  
                    $percent_responden = @number_format(($total_responden_periode/$_d->target) * 100, 2);
                  ?>
                  <span class="text-success mr-2"><i class="fa fa-check"></i> <?= $percent_responden ?>%</span>
                  <span class="text-nowrap">Periode saat ini</span>
                </p>
              </div>
              <div class="card-footer">
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="<?= $percent_responden ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percent_responden ?>%;"></div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-muted mb-0">Form <?= ucwords($_card_responden) ?></h5>
                    <span class="h2 font-weight-bold mb-0"><?= @number_format(($total_responden_card/$_d->target) * 100, 2); ?>%</span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                      <i class="ni ni-money-coins"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> <?= $total_responden_card ?></span>
                  <span class="text-nowrap">Total Responden</span>
                </p>
              </div>
              <div class="card-footer">
                <?php  
                  $responden_tahun_ini = @$this->skm->skm_total_responden_per_tahun($_d->tahun);
                ?>
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?= $total_responden_card ?>" aria-valuemin="0" aria-valuemax="<?= $responden_tahun_ini ?>" style="width: <?= ($total_responden_card/$responden_tahun_ini)*100 ?>%;"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-muted mb-0">Total Periode</h5>
                    <span class="h2 font-weight-bold mb-0"><?= $total_periode; ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                      <i class="ni ni-chart-pie-35"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <?php  
                    $responden_tahun_ini = @$this->skm->skm_total_responden_per_tahun($_d->tahun);
                  ?>
                  <span class="text-success mr-2"><i class="fa fa-check-circle"></i> <?= !empty($_d->tahun) ? $_d->tahun : "-"; ?></span>
                  <span class="text-nowrap">(Sampel: <b class="font-weight-bold"><?= !empty($responden_tahun_ini) ? $responden_tahun_ini : 0; ?></b>)</span>
                </p>
              </div>
              <div class="card-footer">
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="<?= $total_periode ?>" aria-valuemin="0" aria-valuemax="12" style="width: <?= ($total_periode/12)*100 ?>%;"></div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
              <!-- Card body -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <h5 class="card-title text-uppercase text-muted mb-0">Kinerja</h5>
                    <span class="h2 font-weight-bold mb-0">IKM - <?= @number_format($ikm['data']['nilai_ikm'],2) ?></span>
                  </div>
                  <div class="col-auto">
                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                      <i class="ni ni-chart-bar-32"></i>
                    </div>
                  </div>
                </div>
                <p class="mt-3 mb-0 text-sm">
                  <span class="text-success mr-2">( <?= $ikm['data']['nilai_konversi']['x'] ?> )</span>
                  <span class="text-nowrap"><?= $ikm['data']['nilai_konversi']['y'] ?></span>
                </p>
              </div>
              <div class="card-footer">
                <div class="progress progress-xs mb-0">
                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="<?= @number_format($ikm['data']['nilai_ikm'],2) ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= @number_format($ikm['data']['nilai_ikm'],2) ?>%;"></div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>