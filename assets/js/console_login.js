$(document).ready(function() {
  $("input[name='username']").focus();
  $.validate({
      form: '#f_login',
      lang: 'en',
      showErrorDialogs: true,
      modules: 'security, html5, sanitize',
      // disabledFormFilter: 'form.toggle-disabled',
      onError: function($form) {
          $('html').block({ 
              message: '<h1>Error Login</h1>', 
              overlayCSS: { backgroundColor: '#fff' },
              timeout:   3000,
              onBlock: function() { 
                  alert('Auth access akun failed!'); 
                  $('button[type="submit"]').html(`Masuk`);
              },
              css: { 
                  padding:        10, 
                  margin:         10, 
                  fontSize:       20,
                  borderRadius:   8,
                  boxShadow: '0 6px 1em #444',
                  textAlign:      'center', 
                  color:          'red',  
                  backgroundColor:'#fff', 
                  border:        false, 
                  cursor:         'wait' 
              }, 
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
              dataType: 'json',
              beforeSend: function() {
                  $('button[type="submit"]').html(`<center><img width="15" src="${_uri}/assets/images/loader/oval.svg"></center>`);
              },
              success: call_success,
              error: call_error,
          });
          return false; // Will stop the submission of the form
          // $form.removeClass('toggle-disabled');
          $form.get(0).reset();
      }
  });

  function call_success(response) {  
        $('html').block({
          message: `${response.msg}`,
          overlayCSS: { backgroundColor: '#fff' },
          timeout: 2000,
          onBlock: function() { 
            if(response.valid == true) {
              window.location.href = response.redirect;
            }
            $('button[type="submit"]').html(`Masuk`);
          },
          css: { 
            padding:        10, 
            margin:         10, 
            fontSize:       20,
            borderRadius:   8,
            boxShadow: '0 6px 1em #444',
            textAlign:      'center', 
            color:          '#000',  
            backgroundColor:'#fff', 
            border:        false, 
            cursor:         'wait' 
        }
        }); 
  }

  function call_error(error) {
    console.log(error);
    $('html').block({ 
        message: 'Auth Failed 500 (Internal Server Error)', 
        overlayCSS: { backgroundColor: '#fff' },
        css: { 
            padding:        10, 
            margin:         10, 
            fontSize:       20,
            borderRadius:   8,
            boxShadow: '0 6px 1em #444',
            textAlign:      'center', 
            color:          'red',  
            backgroundColor:'#fff', 
            border:        false, 
            cursor:         'wait' 
        }, 
        timeout: 3000,
        onBlock: function() { 
            $('button[type="submit"]').html(`Masuk`);
        } 
    }); 
  }

	$(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      var textPw = $("small.text_pw");
      if (input.attr("type") == "password") {
          input.attr("type", "text");
          textPw.text('Hide Password');
      } else {
          input.attr("type", "password");
          textPw.text('Show Password');
      }
  });
});