<section class="survei bg-light">
	<div class="py-3 px-2 bg-dark bg-gradient text-center">
		<h3 class="text-light">Pilih Formulir Responden</h3>
	</div>
	<div class="container">
		<?php if($this->input->get('msg') === 'NotFound'): ?>
		<div class="row justify-content-md-center">
			<div class="col col-lg-8">
				<div class="alert alert-warning alert-dismissible fade show mt-4 d-flex gap-3 align-items-center" role="alert">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-square" viewBox="0 0 16 16">
							<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
							<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
						</svg>
					</div>
					<div>
						<strong>Error!</strong> <br> Sepertinya TOKEN tidak ditemukan
					</div>
					<div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		</div>
		<?php elseif($this->input->get('msg') === 'closed'): ?>
			<div class="row justify-content-md-center">
			<div class="col col-lg-8">
				<div class="alert alert-warning alert-dismissible fade show mt-4 d-flex gap-3 align-items-center" role="alert">
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-square" viewBox="0 0 16 16">
							<path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
							<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
						</svg>
					</div>
					<div>
						<strong>Tutup!</strong> <br> Survei IKM Telah Ditutup
					</div>
					<div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="row justify-content-md-center">
			<div class="col col-lg-12">
				<div class="alert alert-info alert-dismissible fade show mt-4 d-flex gap-3 align-items-center" role="alert">
					<div class="d-none d-md-block">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
							<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
						</svg>
					</div>
					<div>
						<strong>Perhatian!</strong> <br> Waktu dalam pengisian survei dibatasi, TOKEN akan direfresh setelah pergantian Hour (JAM). Untuk pengisian survey disarankan dalam rentang waktu atar Hour (JAM). <br><code>Contoh: 18:00 - 18:59</code>
					</div>
					<div>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<div class="row justify-content-md-center my-5 gap-5 text-center">
			<!-- <div class="col-12 col-lg-4 shadow-lg bg-white p-md-5 p-3 rounded border-bottom border-3 border-success">
				<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-person-badge text-success" viewBox="0 0 16 16">
					<path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
				</svg>
				<h3 class="my-4 fw-bold">ASN Balangan</h3>
				<a href="<?= base_url('survei?card=asn_balangan') ?>" class="btn btn-success btn-lg px-4 shadow">
					Lanjutkan
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
				</a>
			</div>
			<div class="col-12 col-lg-4 shadow-lg bg-white p-md-5 p-3 rounded border-bottom border-3 border-info">
				<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-person-badge-fill text-info" viewBox="0 0 16 16">
					<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
				</svg>
				<h3 class="my-4 fw-bold">NON ASN Balangan</h3>
				<a href="<?= base_url('survei?card=non_asn_balangan') ?>" class="btn btn-block btn-info btn-lg px-4 shadow">
					Lanjutkan
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
				</a>
			</div> -->
			<div class="col-12 col-lg-3">
				<svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-person-badge-fill text-secondary" viewBox="0 0 16 16">
					<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
				</svg>
				<h3 class="my-4 fw-bold">DEMO</h3>
				<p class="text-muted">Survei Ini Hanya Demonstrasi</p>
				<a href="<?= base_url('survei?card=demo') ?>" class="btn btn-block btn-secondary btn-lg px-4 shadow">
					Lanjutkan
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
					</svg>
				</a>
			</div>
			
		</div>
	</div>
</section>