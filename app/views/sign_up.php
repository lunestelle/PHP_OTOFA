<div class="split-section">
  <div class="split-left d-flex">
    <div>
      <h1>Sign up</h1>
      <p>Already signed up? <a href="<?= ROOT ?>/sign_in">Log in</a></p>
      <form method="POST" action="">
        <div class="field">
          <input type="email" id="email" autofocus name="email" placeholder="EMAIL" autocomplete="email" class="email_field" required>
        </div>
        <div class="row">
          <div class="col">
            <div class="field">
              <input type="text" id="first_name" autofocus name="first_name" placeholder="FIRST NAME" autocomplete="given-name" class="name_field" required>
            </div>
          </div>
          <div class="col">
            <div class="field">
              <input type="text" id="last_name" autofocus name="last_name" placeholder="LAST NAME" autocomplete="family-name" class="name_field" required>
            </div>
          </div>
        </div>
        <div class="field password-toggle">
          <input type="password" id="password" autofocus name="password" placeholder="PASSWORD" autocomplete="password" class="password_field" required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
        </div>
        <div class="field password-toggle">
          <input type="password" id="password_confirmation" autofocus name="password_confirmation" placeholder="PASSWORD CONFIRMATION" class="password_field" required>
          <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
        </div>
        <div class="field">
          <p class="password_validation">Your password must be over 8 characters long and include at least <br> 1 upper-case letter, 1 lower-case letter, 1 number and 1 special <br> character.</small>
        </div>
        <div class="actions_devise">
          <button type="submit" class="btn btn-block">SIGN UP</button>
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