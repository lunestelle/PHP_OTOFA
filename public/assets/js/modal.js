window.uni_modal = function($title = '', $url = '', $size = "") {
  $.ajax({
    url: $url,
    error: err => {
      console.log()
      alert("An error occured")
    },
    success: function(resp) {
      if (resp) {
        $('#uni_modal .modal-title').html($title)
        $('#uni_modal #modalContent').html(resp)

        if ($url === 'forgot_password' || $url.includes('reset_password')) {
          $('#uni_modal .auth-sign-in').addClass('d-none');
          $('#uni_modal .auth-sign-up').addClass('d-none');
        } else if ($url === 'sign_in' || $url === 'sign_up')  {
          $('#uni_modal .auth-sign-in').removeClass('d-none');
          $('#uni_modal .auth-sign-up').removeClass('d-none');
        }

        $('#uni_modal .modal-dialog').removeClass('large')
        $('#uni_modal .modal-dialog').removeClass('mid-large')
        $('#uni_modal .modal-dialog').removeClass('modal-md')
        if ($size == '') {
            $('#uni_modal .modal-dialog').addClass('modal-md')
        } else {
            $('#uni_modal .modal-dialog').addClass($size)
        }
        setTimeout(function() {
          $('.modal-backdrop').remove();
        }, 100);
        $('#uni_modal').modal({
            backdrop: 'static',
            keyboard: true,
            focus: true
        })
        $('#uni_modal').modal('show')
      }
    }
  })
}

// Use for showing the modal
$(document).ready(function() {
  $(document).on('click', '#sign_in_btn, #sign_in_link', function(){
    uni_modal('Sign In', 'sign_in', 'modal-md');
    $('#sign_in_link').addClass('authentication-title-active');
    $('#sign_up_link').removeClass('authentication-title-active');
  });

  $(document).on('click', '#sign_up_link', function(){
    uni_modal('Sign Up', 'sign_up', 'modal-md');
    $('#sign_in_link').removeClass('authentication-title-active');
    $('#sign_up_link').addClass('authentication-title-active');
  });

  $(document).on('click', '#forgot_password_link', function(){
    uni_modal('Forgot Password', 'forgot_password', 'modal-md');
  });

  $(document).on('click', '#back_link', function(){
    uni_modal('Sign In', 'sign_in', 'modal-md');
  });
});


$(document).ready(function() {
  // Check if the reset password modal should be shown
  var urlParams = new URLSearchParams(window.location.search);
  var fromEmail = urlParams.get('reset');
  var email = urlParams.get('email');
  var token = urlParams.get('token');
  if (fromEmail === 'true') {
    uni_modal('Reset Password', 'reset_password?email=' + encodeURIComponent(email) + '&token=' + encodeURIComponent(token), 'modal-md', function(){
      var modalEmail = urlParams.get('email');
      var modalToken = urlParams.get('token');

      // Set the values in the hidden input fields
      document.getElementById('email').value = modalEmail;
      document.getElementById('token').value = modalToken;
    });
  }
});