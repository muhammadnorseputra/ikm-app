<?php $this->load->view('Frontend/skm/pages/setting_modal'); ?>
<?php $this->load->view('Frontend/skm/pages/print_modal'); ?>
<footer class="bg-light border-top text-center text-muted py-4">
	<div class="container">
		<div class="row">
			<p>
				&copy; <?= date('Y') ?> e-Survey IKM BKPSDM Kab. Balangan. Semua hak dilindungi | Credit by <a href="https://www.mediadigitalcenter.my.id" target="_blank">MDCenter</a>
			</p>
			<p class="font-1 fw-light fst-italic">
				Make with <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill text-danger" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg> from south kalimantan, indonesia.
			</p>
		</div>
	</div>
</footer>
<a href="#top" id="btn-top" class="btn btn-lg btn-warning rounded-circle shadow-sm border border-light mb-5">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
</svg>
</a>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- BaseURI JS -->
<script src="<?= base_url('assets/js/route.js') ?>"></script>

<?php if($this->uri->segment(1) === 'skm' || $this->uri->segment(1) === 'ikm'): ?>
	<script src="<?= base_url('assets/plugins/jquery-countto/jquery.countTo.js') ?>"></script>
	<script>
		 $('.countTo').countTo();
	</script>
	<?php if($this->uri->segment(1) === 'ikm'): ?>
	<script src="<?= base_url('assets/js/skm_text_slide.js') ?>"></script>
	<?php endif; ?>
<?php endif; ?>

<?php if($this->uri->segment(1) === 'survei'): ?>
<script src="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>"></script>
<script src="<?= base_url('assets/lib/skm-validation.js') ?>"></script>
<?php endif; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?= base_url('assets/plugins/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>
<script src="<?= base_url('assets/lib/skm-production.js') ?>"></script>
</body>
</html>