<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTOFA | Ormoc Tricycle Online Franchise Appointment</title>
  <link rel="icon" href="public/assets/images/icon-logo.png" type="image/x-icon">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->

  <!-- OFFLINE CSS -->
  <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/assets/fontawesome/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="public/assets/css/flash_messages.css">
  <link rel="stylesheet" href="public/assets/css/authentication.css">
  {{css}}

  <!-- OFFLINE JS -->
  <script src="public/assets/bootstrap/js/jquery.min.js"></script>
  <script src="public/assets/bootstrap/js/popper.min.js"></script>
  <script src="public/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="public/assets/js/flash_messages.js"></script>
  <script src="public/assets/js/password_toggle.js"></script>
  <script src="public/assets/js/modal.js"></script>
  <script src="public/assets/js/modal_submission.js"></script>
  <script src="public/assets/js/active_links.js"></script>
  <script src="public/assets/js/tooltip.js"></script>
</head>
<style>
  .pop_msg {
    font-size: 9px !important;
    letter-spacing: 0.8px !important;
    line-height: 10px !important;
    color: #f8632c !important;
    text-transform: uppercase !important;
    margin-top: 5px !important;
    margin-bottom: 10px !important;
    text-align: left;
  }
</style>
<body>
  <?php
    checkInactivityTimeout();
    display_flash_message();
  ?>

  <div class="flash-message success" id="flashMessage" style="display: none; width: 200px;"></div>

  {{content}}

<!-- Modal Layout -->
  <div class="modal fade" id="uni_modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content authentication-modal">
        <div class="modal-header border border-bottom-0 pb-0">
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">X</span>
          </button>
        </div>
        <div class="modal-body pb-5"> 
          <div class="row">
            <div class="col-12 col-md-9 mx-auto">
              <div class="row authenticate">
                <div class="col-5 offset-1 text-start auth-sign-in">
                  <h5 class="auth-modal-title text-uppercase">
                    <a href="javascript:void(0)" id="sign_in_link">Sign In</a>
                  </h5>
                </div>
                <div class="col-5 text-end auth-sign-up">
                  <h5 class="auth-modal-title text-uppercase">
                  <a href="javascript:void(0)" id="sign_up_link" >Register</a>
                  </h5>
                </div>
                <div id="modalContent">
                  <!-- Insert the modal content here -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>-->
</body>
</html>