<div class="container">
	<div class="row">
		<div class="col-xl-8 offset-xl-2 my-5">
			<div class="card">
				<div class="card-header">
					<h5 class="mt-3">Restricted Area</h5>
				</div>
				<div class="card-body">
					<div class="alert alert-warning d-flex align-items-center" role="alert">
						<svg class="bi flex-shrink-0 me-4 text-danger" width="30" height="30" role="img" aria-label="Warning:">
							<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-exclamation-octagon" viewBox="0 0 16 16">
								<path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
								<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
							</svg>
						</svg>
						<div>
							Silahkan untuk login terlebih dahulu untuk mengakses laman laporan.
							<button class="btn btn-primary mt-2" onclick="window.location.href='<?= base_url('console?continue='.curPageURL()) ?>'">Masuk Console <i class="fas fa-arrow-right ms-2"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>