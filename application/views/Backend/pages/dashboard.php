
<div class="row">
  <div class="col-xl-8">
    <div class="card bg-default">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
            <h5 class="h3 text-white mb-0">Total Responden</h5>
          </div>
          <div class="col">
            <ul class="nav nav-pills justify-content-end">
              <!-- <li class="nav-item mr-2 mr-md-0" data-toggle="chart" periode="bulan" data-target="#chart-sales-dark">
                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                  <span class="d-none d-md-block">Bulan</span>
                  <span class="d-md-none">M</span>
                </a>
              </li> -->
              <li class="nav-item" data-toggle="chart" periode="tahun" data-target="#chart-sales-dark">
                <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                  <span class="d-none d-md-block"><?= date('Y') ?></span>
                  <span class="d-md-none">W</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Chart -->
        <div class="chart">
          <!-- Chart wrapper -->
          <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header bg-transparent">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Total Responden</h6>
            <h5 class="h3 mb-0">Periode (<?= date('Y') ?>)</h5>
          </div>
        </div>
      </div>
      <div class="card-body">
        <!-- Chart -->
        <div class="chart">
          <canvas id="chart-bars" class="chart-canvas"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-8">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Daftar Pertanyaan</h3>
          </div>
          <div class="col text-right">
            <a href="<?= base_url('pertanyaan') ?>" class="btn btn-sm btn-primary">Liat semua</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Pertanyaan</th>
              <th scope="col">Total Persepsi</th>
              <th scope="col">Rata<sup>2</sup></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($responden_per_pertanyaan['pertanyaan'] as $rp): ?>
            <tr>
              <th scope="row">
                <?= $rp ?>
              </th>
              <td>
                340
              </td>
              <td>
                <i class="fas fa-arrow-up text-success mr-3"></i> 46,53%
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <div class="card">
      <div class="card-header border-0">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="mb-0">Rata-Rata Pilihan</h3>
          </div>
          <!-- <div class="col text-right">
            <a href="#!" class="btn btn-sm btn-primary">See all</a>
          </div> -->
        </div>
      </div>
      <div class="table-responsive">
        <!-- Projects table -->
        <table class="table align-items-center table-flush">
          <thead class="thead-light">
            <tr>
              <th scope="col">Jawaban</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if($ikm['data']['presentase'] != null): 
              foreach($ikm['data']['presentase'] as $key => $val): 
                if($key == 'A'): 
                  $col = 'success'; 
                elseif($key == 'B'): 
                  $col = 'info';
                elseif($key == 'C'): 
                  $col = 'warning'; 
                elseif($key == 'D'): 
                  $col = 'danger';
                endif; 
            ?>
            <tr>
              <th scope="row">
                <?= $key ?>
              </th>
              <td>
                <div class="d-flex align-items-center">
                  <span class="mr-2"><?= $val ?>%</span>
                  <div>
                    <div class="progress">
                      <div class="progress-bar bg-gradient-<?= $col ?>" role="progressbar" aria-valuenow="<?= $val ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $val ?>%;"></div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach; else: ?> 
              <div class="font-weight-bold d-flex justify-content-center align-items-center flex-column pb-5">
                <i class="fas fa-shapes fa-5x my-5 text-light"></i>
                <h3>Tidak ada data</h3>
              </div>
            <?php endif;?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>