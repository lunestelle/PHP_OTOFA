$(document).ready(function() {
  modal_submission();
});

function modal_submission() {
  $(document).on('submit', '.custom-form', function(e) {
    e.preventDefault();
    $('.pop_msg').remove();
    var _this = $(this);
    var _el = $('<div>');
    var originalButtonText = $('#uni_modal button[type="submit"]').text();
    _el.addClass('pop_msg');
    $('#uni_modal button').attr('disabled', true);
    

    var formId = _this.attr('id');
    var url;

    if (formId === 'sign-in-form') {
      url = 'sign_in';
      $('#uni_modal button[type="submit"]').text('Signing in...');
    } else if (formId === 'sign-up-form') {
      url = 'sign_up';
      $('#uni_modal button[type="submit"]').text('Signing up...');
    } else if (formId === 'forgot-password-form') {
      url = 'forgot_password';
      $('#uni_modal button[type="submit"]').text('Resetting...');
    } else if (formId === 'reset-password-form') {
      url = 'reset_password';
      $('#uni_modal button[type="submit"]').text('Resetting...');
    }

    $.ajax({
      url: url,
      method: 'POST',
      data: _this.serialize(),
      dataType: 'JSON',
      error: function(err) {
        console.log(err);
        _el.text("An error occurred.");
        _this.prepend(_el);
        _el.show('slow');
        $('#uni_modal button').attr('disabled', false);
        $('#uni_modal button[type="submit"]').text(originalButtonText);
        setTimeout(function() {
          _el.hide('slow', function() {
            $(this).remove();
          });
        }, 3000);
      },
      success: function(resp) {
        if (resp.status === 'success') {
          _el.addClass('alert alert-success');
          _el.text(resp.msg);
          _el.hide();
          _this.prepend(_el);
          _el.show('6000');
          $('#uni_modal button').attr('disabled', false);
          $('#uni_modal button[type="submit"]').text(originalButtonText);
          sessionStorage.setItem('flashMessage', resp.msg);
          console.log('Before redirect'); // Add this line
          window.location.href = resp.redirect_url;
          console.log('After redirect'); // Add this line
        } else {
          _el.text(resp.msg);
          _el.hide();
          _this.prepend(_el);
          _el.show('slow');
          $('#uni_modal button').attr('disabled', false);
          $('#uni_modal button[type="submit"]').text(originalButtonText);
          setTimeout(function() {
            _el.hide('slow', function() {
              $(this).remove();
            });
          }, 4000);
        }
      }
    });
  });
}

// Modal Flash message
$(document).ready(function() {
  var flashMessageContainer = $('#flashMessage');
  var flashMessage = sessionStorage.getItem('flashMessage');

  if (flashMessage) {
    flashMessageContainer.text(flashMessage);
    sessionStorage.removeItem('flashMessage');
    flashMessageContainer.show(); 

    // Hide the flash message after 3 seconds
    setTimeout(function() {
      flashMessageContainer.hide();
    }, 3000);
  }
});