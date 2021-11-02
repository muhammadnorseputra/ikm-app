<div class="row">
	<div class="col-xl-4">
		<div class="card">
			<div class="card-header">Reset Password</div>
			<div class="card-body">
				<?= form_open(base_url('backend/users/resspwd_aksi'), ['class' => 'form-horizontal', 'autocomplete' => 'off'], ['uid' => $uid]); ?>
					<div class="form-group">
						<label for="username">Username</label>
				    	<input type="text" class="form-control" id="username" disabled>
					</div>
					<div class="form-group">
						<label for="password">New Password</label>
				    	<input name="newpwd" type="password" class="form-control" id="password">
					</div>
					<div class="form-group">
						<label for="re-password">Re-type Password</label>
				    	<input name="newpwd_confirm" type="password" class="form-control" id="re-password">
					</div>
					
					<div class="p-4 bg-secondary mb-3 border border-warning rounded">
						<label for="re-user" class="small">Silahkan masukan username anda untuk mereset password user. Hal ini memastikan bahwa anda dapat wewenang untuk merubah privacy akun pengguna</label>
					    <input name="username_confirm" type="text" id="re-user" class="form-control form-control-alternative" placeholder="Username Anda ...">
					</div>

					<button class="btn btn-primary" type="submit">Simpan</button>
					<button type="button" class="btn btn-link" onclick="window.location.href='<?= base_url('users') ?>'">Batal</button>
				<?= form_close(); ?>
			</div>
		</div>
	</div>
</div>