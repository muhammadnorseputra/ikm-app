<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <style>
    .center {
    text-align: center;
    }
    .tabel {
    border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%;
    }
    .tabel td {
    font-family:Arial;font-size:14px;border-style:solid;padding:12px 12px;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;
    }
    .tabel .bot {
    font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;
    }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>
  <body>
    <p class="center" style="font-size: 20px; font-family: Arial, Helvetica, sans-serif; font-weight:bold;">SURVEY KEPUASAN MASYARAKAT PADA PELAYANAN DI BKPPD BALANGAN</p>
    <table class="tabel" width="100%">
      <tr>
        <td width="120">NIP/NIK</td>
        <td>
          <td width="120">Nama</td>
          <td></td>
        </td>
        <td class="center" rowspan="6" width="150">
          <img src="<?= base_url('assets/images/ikm-bkppd-balangan.png') ?>" alt="ikm-bkppd-balangan" width="100%">
        </td>
      </tr>
      <tr>
        <tr>
        <td>Periode</td>
        <td colspan="3">
          <?php
            $bulan_mulai = explode('-', $periode->tgl_mulai);
            $bulan_selesai = explode('-', $periode->tgl_selesai);
            $bn = $bulan_mulai['1'];
            $bs = $bulan_selesai['1'];
          ?>
          <?= bulan($bn) ?> - <?= bulan($bs) ?> <?= $periode->tahun ?>
        </td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td colspan="3">
          <i class="far fa-square"></i> Laki-Laki &nbsp;&nbsp;
          <i class="far fa-square"></i> Perempuan
        </td>
      </tr>
      <tr>
        <td>Pendidikan</td>
        <td colspan="3">
          <?php foreach($pendidikan->result() as $p): ?>
          <i class="far fa-square"></i>&nbsp; <?= strtoupper($p->tingkat_pendidikan) ?> &nbsp; 
          <?php endforeach; ?>
        </td>
      </tr>
      <tr>
        <td>Pekerjaan</td>
        <td colspan="3">
          <?php foreach($pekerjaan->result() as $pj): ?>
          <i class="far fa-square"></i> &nbsp; <?= strtoupper($pj->jenis_pekerjaan) ?> &nbsp;  
          <?php endforeach; ?>
        </td>
      </tr>
      <tr>
        <td>Jenis Layanan</td>
        <td colspan="4">
          <?php  
          echo !empty($jenis_layanan->nama_jenis_layanan) ? strtoupper($jenis_layanan->nama_jenis_layanan) : '-';
          ?>
        </td>
      </tr>
    </table>
    <br><br>
    <table class="tabel" border="1" width="100%">
      <tr>
        <td colspan="4">Daftar Pertanyaan</td>
      </tr>
      <?php foreach($pertanyaan->result() as $p): ?>
      <tr>
        <td colspan="4"><?= ucwords($p->jdl_pertanyaan) ?> ?</td>
      </tr>
      <tr>
        <?php foreach($this->skm->skm_jawaban_pertanyaan($p->id)->result() as $j):  ?>
        <td>
          <i class="far fa-square"></i> <?= $j->jdl_jawaban ?> 
        </td>
        <?php endforeach; ?>
      </tr>
      <?php endforeach; ?>
    </table>
  </body>
  <script>
  window.onload = function() { window.print(); }
  </script>
</html>