<div class="row">
	<div class="col-xl-8">
		<div class="card">
			<?= form_open(base_url('backend/users/privileges_update'), ['id' => 'f_privilege'], ['f_type'] => 'privilege'); ?>
			<div class="card-header">
				<span class="h3">Set Privileges</span>
			</div>
			<div class="card-body">
				<?php 
					$cek_priv = $this->users->cek_privilege($uid); 
					$priv_responden = isset($cek_priv->priv_responden) == 'Y' ? 'checked' : '';
					$priv_periode = isset($cek_priv->priv_periode) == 'Y' ? 'checked' : '';
					$priv_unsur = isset($cek_priv->priv_unsur) == 'Y' ? 'checked' : '';
					$priv_daftar_pertanyaan = isset($cek_priv->priv_daftar_pertanyaan) == 'Y' ? 'checked' : '';
					$priv_daftar_jawaban = isset($cek_priv->priv_daftar_jawaban) == 'Y' ? 'checked' : '';
					$priv_jenis_layanan = isset($cek_priv->priv_jenis_layanan) == 'Y' ? 'checked' : '';
					$priv_pendidikan = isset($cek_priv->priv_pendidikan) == 'Y' ? 'checked' : '';
					$priv_pekerjaan = isset($cek_priv->priv_pekerjaan) == 'Y' ? 'checked' : '';
				?>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_responden" <?= $priv_responden ?>>
				  <label class="custom-control-label" for="priv_responden">Responden</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_periode" <?= $priv_periode ?>>
				  <label class="custom-control-label" for="priv_periode">Periode</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_unsur" <?= $priv_unsur ?>>
				  <label class="custom-control-label" for="priv_unsur">Unsur</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_daftar_pertanyaan" <?= $priv_daftar_pertanyaan ?>>
				  <label class="custom-control-label" for="priv_daftar_pertanyaan">Daftar Pertanyaan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_daftar_jawaban" <?= $priv_daftar_jawaban ?>>
				  <label class="custom-control-label" for="priv_daftar_jawaban">Daftar Jawaban</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_jenis_layanan" <?= $priv_jenis_layanan ?>>
				  <label class="custom-control-label" for="priv_jenis_layanan">Jenis Layanan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_pendidikan" <?= $priv_pendidikan ?>>
				  <label class="custom-control-label" for="priv_pendidikan">Pendidikan</label>
				</div>
				<div class="custom-control custom-checkbox custom-control-inline mb-3">
				  <input type="checkbox" name="priv[]" class="custom-control-input" value="Y" id="priv_pekerjaan" <?= $priv_pekerjaan ?>>
				  <label class="custom-control-label" for="priv_pekerjaan">Pekerjaan</label>
				</div>
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-info">Simpan</button>
				<button type="button" class="btn btn-link" onclick="window.location.href='<?= base_url('users') ?>'">Batal</button>
			</div>
			<?= form_close(); ?>
		</div>
		<div class="card">
			<?= form_open(base_url('backend/users/privileges_update'), ['id' => 'f_sub_privilege'], ['f_type'] => 'sub_privilege'); ?>
			<div class="card-header">
				<span class="h3">Sub Privileges</span>
			</div>
			<div class="card-body">
				<?php  
				$sub_responden = $this->users->list_sub_privilege($uid, 'sub_responden');
				$sub_periode = $this->users->list_sub_privilege($uid, 'sub_periode');
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_r ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_periode ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_pertanyaan ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_jawaban ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_jenis_layanan ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_pendidikan ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
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
							  <input type="checkbox" name="sub_priv[]" class="custom-control-input" value="<?= $val ?>" id="<?= $val ?>" <?= $cek_sub_pekerjaan ?>>
							  <label class="custom-control-label" for="<?= $val ?>"><?= $val ?></label>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="col-xl-6"></div>
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