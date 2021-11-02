<?php 
   if(privileges('priv_periode') === false): 
      $this->load->view('Backend/pages/notif_page_dibatasi', ['pesan' => 'Anda tidak dapat mengakses halaman ini']);
      return false;
   endif;
?>
<div class="row align-content-center">
   <div class="col-xl-12">
      <?php if($this->session->flashdata('msg') <> '' ): ?>
      <div class="alert alert-<?= $this->session->flashdata('msg_type') ?> alert-dismissible fade show" role="alert">
          <span class="alert-icon"><i class="ni ni-bell-55"></i></span>
          <span class="alert-text"><?= $this->session->flashdata('msg') ?></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <?php endif; ?>
   </div>
   <?php 
      foreach($list_periode->result() as $p): 
      $status = $p->status == 'ON' ? 'bg-white' : 'bg-default'; 
      $text_color = $p->status == 'ON' ? 'text-default' : 'text-white';
   ?>
   <div class="col-xl-4">
      <div class="card card-stats <?= $status ?>">
         <!-- Card body -->
         <div class="card-body">
            <div class="row">
              <?php  
                if(sub_privilege('sub_periode', 'r') === false): 
                  $this->load->view('Backend/pages/notif_mod_dibatasi');
                else: 
              ?>
               <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Target/Realisasi</h5>
                  <?php  
                  $total_responden_periode = $this->skm->skm_total_responden($p->id);
                  $persentase = ($total_responden_periode/$p->target) * 100;
                  ?>
                  <span class="h2 font-weight-bold mb-0 <?= $text_color ?>"><?= $p->target ?>/<?= number_format($persentase, 1); ?>%</span>
               </div>
              <?php endif; ?>
               <div class="col-auto">
                  <a href="<?= base_url('periode/edit/'.encrypt_url($p->id)) ?>" class="btn btn-icon btn-primary d-flex justify-content-center align-items-center h-100" type="button">
                  <span class="btn-inner--icon"><i class="ni ni-settings"></i></span>
                  </a>
               </div>
            </div>
            <p class="mt-3 mb-0 text-sm border-top pt-3">
               <span class="text-success mr-2"><i class="fa fa-check-circle"></i> <?= $p->tahun ?></span>
               <span class="text-nowrap"><?= date("F", strtotime($p->tgl_mulai)) ?>/<?= date("F", strtotime($p->tgl_selesai)) ?></span>
            </p>
         </div>
      </div>
   </div>
   <?php endforeach; ?>

   <div class="col-xl-3">
      <div class="card bg-default">
         <div class="card-body align-self-center">
            <button class="btn btn-icon btn-default rounded-pill" type="button" data-toggle="modal" data-target="#modal-periode">
            <span class="btn-inner--icon"><i class="fas fa-plus fa-3x"></i></span>
            <br>
            Tambah Periode
            </button>
         </div>
      </div>
   </div>
</div>
<!-- Modal Periode -->
<div class="modal fade" id="modal-periode" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true" data-backdrop="static">
   <div class="modal-dialog modal- modal-dialog-centered" role="document">
      <div class="modal-content bg-secondary">
         <?= form_open(base_url('backend/periode/baru'), ['id' => "f_periode", 'class' => 'toggle-disabled']); ?>
         <div class="modal-header">
            <h6 class="modal-title" id="modal-title-default">Tambah Periode Baru</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <?php 
            if(sub_privilege('sub_periode', 'c') === false): 
              $this->load->view('Backend/pages/notif_mod_dibatasi');
            else:
          ?>
         <div class="modal-body">
            <div class="row mt--4">
                <div class="col-4">
                  <div class="form-group">
                     <label for="tahun">Tahun</label>
                     <input type="text" name="tahun" class="form-control form-control-alternative font-weight-bold" value="<?= date('Y') ?>" readonly>
                  </div>
                </div>
                <div class="col-8">
                  <div class="form-group">
                     <label for="target">Target</label>
                     <input type="number" name="target" data-validation="number" required="required" class="form-control" placeholder="Target">
                  </div>
                </div>
              </div>
              <div class="row">
                 <div class="col">
                  <label for="month">Bulan Periode</label>
                    <div class="input-daterange input-group rounded" id="datepicker">
                        <div class="input-group-prepend">
                           <label class="input-group-text bg-red text-white" for="filter-form"><i class="far fa-calendar-alt"></i></label>
                        </div>
                        <input type="text" id="month" data-validation="date" required data-validation-format="dd/mm/yyyy" class="input-sm form-control" placeholder="Start Date" size="5" name="start" />
                        <input type="text" class="input-sm form-control" required data-validation="date,required" data-validation-format="dd/mm/yyyy" placeholder="To Date" size="5" name="end" />
                        <span class="input-group-addon"></span>
                     </div>
                 </div>
              </div>
              <div class="row mt-3">
                 <div class="col">
                 <label for="aktif">Status</label>
                    <div class="form-group">
                        <label class="custom-toggle">
                            <input type="checkbox" id="togBtn" name="aktif" value="OFF">
                            <span class="custom-toggle-slider rounded-circle" data-label-off="OFF" data-label-on="ON"></span>
                        </label>
                    </div>
                 </div>
              </div>
         </div>
          <?php 
            endif;
          ?>
         <div class="modal-footer d-flex justify-content-around">
            <div class="w-75">
               <button type="submit" class="btn btn-primary rounded-pill btn-block">Simpan</button>
            </div>
            <div>
               <button type="button" class="btn btn-link ml-auto rounded-pill" data-dismiss="modal">Batal</button>
            </div>
         </div>
         <?= form_close(); ?>
      </div>
   </div>
</div>
<link rel="stylesheet" href="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker3.standalone.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/theme-default.min.css') ?>">
<script>
   $(function() {
      // Modal Methods
      $('#modal-periode').on('hidden.bs.modal', function (e) {
        $("#f_periode").get(0).reset();
      })
      // $('#modal-periode').on('shown.bs.modal', function (e) {
      //    $("input[name='target']").focus();
      // })
      /*Date Range*/
      $('.input-daterange').datepicker({
             todayBtn: "linked",
             format: "dd/mm/yyyy",
             clearBtn: true
      });
      // Change Status
      $("#togBtn").on('change', function() {
           if ($(this).is(':checked')) {
               $(this).attr('value', 'ON');
           } else {
              $(this).attr('value', 'OFF');
           }
       });
      // Form Validator
      $.validate({
         form: '#f_periode',
         lang: 'en',
         showErrorDialogs: true,
         modules: 'toggleDisabled, security, html5, sanitize, date',
         disabledFormFilter: 'form.toggle-disabled',
         onError: function($form) {
             alert('Form Invalid');
             $('button[type="submit"]').html('Simpan');
         },
         onSuccess: function($form) {
             var _action = $form.attr('action');
             var _method = $form.attr('method');
             var _data = $form.serialize();
             $.ajax({
                 url: _action,
                 method: _method,
                 data: _data,
                 dataType: 'json',
                 beforeSend: function() {
                     $('button[type="submit"]').html(`<center><img width="20" src="${_uri}/assets/images/loader/oval.svg"></center>`);
                 },
                 success: function(result) {
                  $('button[type="submit"]').html('<i class="fas fa-check-circle mr-2"></i> Berhasil');
                 },
                 complete: function(){
                  $('button[type="submit"]').html('Simpan');
                  window.location.reload();
                  setTimeout(() => {
                     $("#modal-periode").modal('hide');
                  }, 1500)
                 },
                 error: function(error) {
                  alert(error.statusText);
                  $('button[type="submit"]').html('Simpan');
                 },
             });
             return false; // Will stop the submission of the form
             // $form.removeClass('toggle-disabled');
             $form.get(0).reset();
         }
     });
   });
</script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
<script src="<?= base_url('template/argon/vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.id.min.js') ?>"></script>
<script src="<?= base_url('template/v1/plugin/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>"></script>