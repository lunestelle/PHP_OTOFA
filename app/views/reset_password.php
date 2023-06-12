<div class="split-section">
  <div class="split-left d-flex">
    <div>
      <h1>Reset your password</h1>
      <p>Enter your new password.</p>
      <form method="post" action="reset_password">
        <div class="field password-toggle">
          <input type="password" id="new_password" autofocus name="new_password" placeholder="New Password" autocomplete="new-password" class="password_field" required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('new_password')"></i>
        </div>
        <div class="field password-toggle">
          <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" autocomplete="confirm-password" class="password_field" required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('confirm_password')"></i>
        </div>
        <div class="field">
          <p class="password_validation">Your password must be over 8 characters long and include at least <br> 1 upper-case letter, 1 lower-case letter, 1 number and 1 special <br> character.</small>
        </div>
        <div class="actions_devise">
          <button type="submit" class="btn btn-block" name="reset_password">RESET PASSWORD</button>
        </div>
      </form>
    </div>
  </div>
  <div class="split-right d-flex">
    <div class="text-center">
      <img src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo">
      <h1>Sakay<span>cle.</span></h1>
    </div>
  </div>
</div>