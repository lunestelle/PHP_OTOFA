<div class="row">
  <div class="col-12">
    <h5 class="modal-title text-center text-uppercase">
      Reset your password
    </h5>
  </div>
  <div class="col-12 text-end">
    <p class="text-center directions px-2 mb-4">
      Enter your new password.
    </p>
  </div>
  <div class="col-lg-12">
    <form class="default-form custom-form" id="reset-password-form" method="POST">
      <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
      <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>">
      <div class="row">
        <div class="col-12 mb-3">
          <div class="form-group password-toggle">
            <input class="form-control" autocomplete="off" type="password" name="new_password" id="new_password" placeholder="NEW PASSWORD" autofocus required>
            <i id="new_password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('new_password')"></i>
          </div>
        </div>
        <div class="col-12 mb-3">
          <div class="form-group password-toggle">
            <input class="form-control" autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" placeholder="PASSWORD CONFIRMATION" autofocus required>
            <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
          </div>
        </div>
      </div>
      <div class="col-12 mb-2">
        <p class="text-center text-uppercase pass-validation">
          Your password must be over 8 characters long and include at least 1 upper-case letter, 1 lower-case letter, 1 number and 1 special character.
        </p>
      </div>
      <div class="col-12 mt-1">
        <button class="btn auth-btn" type="submit" id="submit" onclick="$('#uni_modal form').submit()">RESET MY PASSWORD</button>
      </div>
    </form>
  </div>
</div>