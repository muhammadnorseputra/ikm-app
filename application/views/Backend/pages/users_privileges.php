<?php 
   if(privileges('priv_users') == false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row">
	<div class="col-xl-8">
		<?php if($this->session->flashdata('pesan') <> '' ): ?>
	      <div class="alert alert-<?= $this->session->flashdata('pesan_type') ?> alert-dismissible fade show" role="alert">
	          <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
	          <span class="alert-text"><?= $this->session->flashdata('pesan') ?></span>
	          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	              <span aria-hidden="true">&times;</span>
	          </button>
	      </div>
	    <?php endif; ?>
		<div class="card">
			<?= form_open(base_url('backend/users/privileges_update'), ['id' => 'f_privilege'], ['f_type' => 'privilege', 'uid' => encrypt_url($uid)]); ?>
			<div class="card-header">
				<span class="h3">Set Privileges (<?= ucwords($profile->nama) ?>::<?= $profile->username ?>)</span>
			</div>
			<div class="card-body">
				<?php 
					$cek_priv = $this->users->cek_privilege($uid); 
					$priv_default = !empty($cek_priv->priv_default) && $cek_priv->priv_default  == 'Y' ? 'checked' : '';
					$priv_responden = !empty($cek_priv->priv_responden) && $cek_priv->priv_responden  == 'Y' ? 'checked' : '';
					$priv_periode = !empty($cek_priv->priv_periode) && $cek_priv->priv_periode  == 'Y' ? 'checked' : '';
					$priv_unsur = !empty($cek_priv->priv_unsur) && $cek_priv->priv_unsur  == 'Y' ? 'checked' : '';
					$priv_daftar_pertanyaan = !empty($cek_priv->priv_daftar_pertanyaan) && $cek_priv->priv_daftar_pertanyaan  == 'Y' ? 'checked' : '';
					$priv_daftar_jawaban = !empty($cek_priv->priv_daftar_jawaban) && $cek_priv->priv_daftar_jawaban  == 'Y' ? 'checked' : '';
					$priv_jenis_layanan = !empty($cek_priv->priv_jenis_layanan) && $cek_priv->priv_jenis_layanan  == 'Y' ? 'checked' : '';
					$priv_pendidikan = !empty($cek_priv->priv_pendidikan) && $cek_priv->priv_pendidikan  == 'Y' ? 'checked' : '';
					$priv_pekerjaan = !empty($cek_priv->priv_pekerjaan) && $cek_priv->priv_pekerjaan  == 'Y' ? 'checked' : '';
					$priv_users = !empty($cek_priv->priv_users) && $cek_priv->priv_users  == 'Y' ? 'checked' : '';
					$priv_report = !empty($cek_priv->priv_report) && $cek_priv->priv_report  == 'Y' ? 'checked' : '';
				?>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_default" class="custom-control-input" value="Y" id="priv_default" <?= $priv_default ?>>
				  <label class="custom-control-label" for="priv_default">Default</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_responden" class="custom-control-input" value="Y" id="priv_responden" <?= $priv_responden ?>>
				  <label class="custom-control-label" for="priv_responden">Responden</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_periode" class="custom-control-input" value="Y" id="priv_periode" <?= $priv_periode ?>>
				  <label class="custom-control-label" for="priv_periode">Periode</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_unsur" class="custom-control-input" value="Y" id="priv_unsur" <?= $priv_unsur ?>>
				  <label class="custom-control-label" for="priv_unsur">Unsur</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_daftar_pertanyaan" class="custom-control-input" value="Y" id="priv_daftar_pertanyaan" <?= $priv_daftar_pertanyaan ?>>
				  <label class="custom-control-label" for="priv_daftar_pertanyaan">Daftar Pertanyaan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_daftar_jawaban" class="custom-control-input" value="Y" id="priv_daftar_jawaban" <?= $priv_daftar_jawaban ?>>
				  <label class="custom-control-label" for="priv_daftar_jawaban">Daftar Jawaban</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_jenis_layanan" class="custom-control-input" value="Y" id="priv_jenis_layanan" <?= $priv_jenis_layanan ?>>
				  <label class="custom-control-label" for="priv_jenis_layanan">Jenis Layanan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_pendidikan" class="custom-control-input" value="Y" id="priv_pendidikan" <?= $priv_pendidikan ?>>
				  <label class="custom-control-label" for="priv_pendidikan">Pendidikan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_pekerjaan" class="custom-control-input" value="Y" id="priv_pekerjaan" <?= $priv_pekerjaan ?>>
				  <label class="custom-control-label" for="priv_pekerjaan">Pekerjaan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_users" class="custom-control-input" value="Y" id="priv_users" <?= $priv_users ?>>
				  <label class="custom-control-label" for="priv_users">Users</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv_report" class="custom-control-input" value="Y" id="priv_report" <?= $priv_report ?>>
				  <label class="custom-control-label" for="priv_report">Report</label>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-info">Simpan</button>
				<button type="button" class="btn btn-link" onclick="window.location.href='<?= base_url('users') ?>'">Batal</button>
			</div>
			<?= form_close(); ?>
		</div>
		<div class="card">
			<?= form_open(base_url('backend/users/privileges_update'), ['id' => 'f_sub_privilege'], ['f_type' => 'sub_privilege', 'uid' => encrypt_url($uid)]); ?>
			<div class="card-header">
				<span class="h3">Sub Privileges (<?= ucwords($profile->nama) ?>::<?= $profile->username ?>)</span>
			</div>
			<div class="card-body">
				<?php  
				$sub_responden = $this->users->list_sub_privilege($uid, 'sub_responden');
				$sub_periode = $this->users->list_sub_privilege($uid, 'sub_periode');
				$sub_unsur = $this->users->list_sub_privilege($uid, 'sub_unsur');
				$sub_pertanyaan = $this->users->list_sub_privilege($uid, 'sub_pertanyaan');
				$sub_jawaban = $this->users->list_sub_privilege($uid, 'sub_jawaban');
				$sub_jenis_layanan = $this->users->list_sub_privilege($uid, 'sub_jenis_layanan');
				$sub_pendidikan = $this->users->list_sub_privilege($uid, 'sub_pendidikan');
				$sub_pekerjaan = $this->users->list_sub_privilege($uid, 'sub_pekerjaan');
				// var_dump($sub_responden);
				$act = ['c','r','u','d'];
				?>
				<div class="row">
					<div class="col-6">
						<u class="h4 d-block">1. Sub Responden</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_responden = array_search($val, $sub_responden);
							$cek_sub_r = $cek_sub_responden !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_responden[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-1" <?= $cek_sub_r ?>>
							  <label class="custom-control-label" for="<?= $val ?>-1"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="col-6">
						<u class="h4 d-block">2. Sub Periode</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_periode = array_search($val, $sub_periode) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_periode[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-2" <?= $cek_sub_periode ?>>
							  <label class="custom-control-label" for="<?= $val ?>-2"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-xl-6">
						<u class="h4 d-block">3. Sub Pertanyaan</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_pertanyaan = array_search($val, $sub_pertanyaan) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_pertanyaan[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-3" <?= $cek_sub_pertanyaan ?>>
							  <label class="custom-control-label" for="<?= $val ?>-3"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="col-6 col-xl-6">
						<u class="h4 d-block">3. Sub Jawaban</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_jawaban = array_search($val, $sub_jawaban) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_jawaban[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-4" <?= $cek_sub_jawaban ?>>
							  <label class="custom-control-label" for="<?= $val ?>-4"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-xl-6">
						<u class="h4 d-block">5. Sub Jenis Layanan</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_jenis_layanan = array_search($val, $sub_jenis_layanan) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_jenis_layanan[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-5" <?= $cek_sub_jenis_layanan ?>>
							  <label class="custom-control-label" for="<?= $val ?>-5"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="col-6 col-xl-6">
						<u class="h4 d-block">6. Sub Pendidikan</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_pendidikan = array_search($val, $sub_pendidikan) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_pendidikan[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-6" <?= $cek_sub_pendidikan ?>>
							  <label class="custom-control-label" for="<?= $val ?>-6"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-6 col-xl-6">
						<u class="h4 d-block">7. Sub Pekerjaan</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_pekerjaan = array_search($val, $sub_pekerjaan) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_pekerjaan[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-7" <?= $cek_sub_pekerjaan ?>>
							  <label class="custom-control-label" for="<?= $val ?>-7"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="col-xl-6">
						<u class="h4 d-block">8. Sub Unsur</u>
						<?php 
							foreach ($act as $key => $val): 
							$cek_sub_unsur = array_search($val, $sub_unsur) !== false ? 'checked' : '';
						?>
							<div class="custom-control custom-checkbox custom-control-inline mb-3">
							  <input type="checkbox" name="sub_priv_unsur[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>-8" <?= $cek_sub_unsur ?>>
							  <label class="custom-control-label" for="<?= $val ?>-8"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-info">Simpan</button>
				<button type="button" class="btn btn-link" onclick="window.location.href='<?= base_url('users') ?>'">Batal</button>
			</div>
			<?= form_close(); ?>
		</div>
	</div>
</div>