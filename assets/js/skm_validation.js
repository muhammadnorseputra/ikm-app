$(document).ready(function() {
    // $("input[name='nama_lengkap'], input[name='umur'], select[name='jns_kelamin']").prop('disabled', true);
    $("input[name='cek_nipnik']").on('blur', function() {
        // let value = $("input[name='cek_nipnik']").val();
        let value = $(this).val();
        $("#msg-asn-data").removeClass('text-success text-danger');
        $.getJSON(`${_uri}/frontend/skm/skmIndex/getAsn/${value}`, function(res) {
            let r = res[0];
            console.log(res);
            if (value != '') {
                if (r.kind == true) {
                    $("input[name='nama_lengkap'], input[name='umur'], select[name='jns_kelamin']").prop('disabled', false);
                    $("input[name='nama_lengkap']").val(r.nama)
                        .removeClass('error')
                        .addClass('valid')
                        .parent()
                        .removeClass('has-error')
                        .addClass('has-success');
                    $("input[name='umur']").val(r.umur)
                        .removeClass('error')
                        .addClass('valid')
                        .parent()
                        .removeClass('has-error')
                        .addClass('has-success');
                    $("select[name='jns_kelamin']").val(r.jk)
                        .removeClass('error')
                        .addClass('valid')
                        .parent()
                        .removeClass('has-error')
                        .addClass('has-success');
                    // $("#msg-asn-data").html(`${r.message}`).addClass('text-success');
                }
                if (r.kind == false) {
                    $("input[name='umur']").val('').addClass('error').removeClass('valid');
                    $("input[name='nama_lengkap']").val('').addClass('error').removeClass('valid');
                    $("select[name='jns_kelamin']").val('').addClass('error').removeClass('valid');
                    // $("#msg-asn-data").html(`${r.message}`).addClass('text-danger');
                    $("input[name='nama_lengkap'], input[name='umur'], select[name='jns_kelamin']").prop('disabled', false);
                }
            } else {
                $("input[name='nama_lengkap']").val('').addClass('error').removeClass('valid');
                $("input[name='umur']").val('').addClass('error').removeClass('valid');
                $("select[name='jns_kelamin']").val('').addClass('error').removeClass('valid');
                $("input[name='nama_lengkap'], input[name='umur'], select[name='jns_kelamin']").prop('disabled', true);
                // $("#msg-asn-data").html('');
            }
        });
    });
    // Add validator
    // $.formUtils.addValidator({
    //     name: 'cek_asn',
    //     validatorFunction: function(value, $el, config, language, $form) {

    //     },
    //     errorMessage: 'NIP/NIK Invalid',
    //     errorMessageKey: 'NIP/NIK Tidak Ditemukan'
    // });

    $.validate({
        form: '#f-survei',
        modules: 'date, security, html5, sanitize',
        showErrorDialogs: true,
        // disabledFormFilter: 'form.toggle-disabled',
        reCaptchaSiteKey: '6LfiM08bAAAAAJkf5geIEBau6f9-kMOEzxkxw06_',
        reCaptchaTheme: 'light',
        onError: function($form) {
            $.notify({
                icon: `fas fa-times`,
                title: '<strong>Gagal!</strong>',
                message: 'Formulir ' + $form.attr('id') + ' gagal, cek kembali kelengkapan survei!',
            }, {
                type: 'danger'
            });
        },
        onSuccess: function($form) {
            var _action = $form.attr('action');
            var _method = $form.attr('method');
            var _data = $form.serialize();
            $.ajax({
                url: _action,
                method: _method,
                data: _data,
                beforeSend: function() {
                    $.notify({
                        message: '<strong>Processing</strong>, Mohon tunggu mengirim data...',
                    }, {
                        type: 'warning',
                        allow_dismiss: false,
                        showProgressbar: true,
                        position: 'fixed',
                        offset: 0,
                        placement: {
                            from: "center",
                            align: "center"
                        },
                    });
                    $('.main').addClass('blured');
                    $('button[type=submit]').prop('disabled', true).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`);
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status == false) {
                        return setTimeout(() => {
                            $.notify({
                                icon: 'fas fa-times',
                                title: '<strong>Invalid!</strong>',
                                message: response.msg,
                            }, {
                                type: 'danger',
                                position: 'fixed',
                                placement: {
                                    from: "top",
                                    align: "center"
                                },
                            });
                            if(response.redirectTo) {
                                window.location.replace(response.redirectTo);
                            }
                        }, 5000);
                    }
                    if (response.status == true) {
                        return setTimeout(function() {
                            // window.location.replace("<?= base_url('frontend/v1/daftar/') ?>");
                            $.notify({
                                'icon': 'far fa-check-circle',
                                'message': '<strong>Success</strong> Your survei has been saved!',
                            }, {
                                type: 'success',
                                allow_dismiss: false,
                                placement: {
                                    from: "top",
                                    align: "center"
                                },
                                onClose: function() {
                                    window.location.replace(response.redirectTo);
                                    $('.main').removeClass('blured');
                                }
                            });
                            $.notify({
                                // 'icon': 'fas fa-external-link-alt',
                                'message': `<div class="d-flex align-items-center">
                                      <strong>Please wait rediracting...</strong>
                                      <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                                    </div>`
                            }, {
                                type: 'info',
                                allow_dismiss: false,
                                placement: {
                                    from: "top",
                                    align: "center"
                                },
                            });
                            $form.get(0).reset();
                            $('button[type=submit]').prop('disabled', true).html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...`);
                        }, 5000);
                    } 
                },
                error: function(error) {
                    $('button[type=submit]').prop('disabled', false).html('Kirim Survei');
                    $.notify({
                        icon: 'fas fa-times',
                        title: '<strong>Error!</strong>',
                        message: error.responseText,
                    }, {
                        type: 'danger'
                    });
                }
            });
            return false; // Will stop the submission of the form
        },
    });
});