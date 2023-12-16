<div class="col-lg-12">
  <form class="default-form custom-form" id="sign-up-form" method="POST" action="">
  <input type="hidden" name="verification_token" value="<?= bin2hex(random_bytes(8)) ?>">
    <div class="row">
      <div class="col-12">
        <div class="form-group mb-3">
          <input class="form-control" autocomplete="email" type="text" name="email" id="email" placeholder="EMAIL ADDRESS" autofocus required/>
        </div>
      </div>
      <div class="col-12">
        <div class="form-group mb-3">
          <input class="form-control" autocomplete="phone_number" type="text" name="phone_number" id="phone_number" placeholder="PHONE NUMBER" autofocus required/>
        </div>
      </div>
      <div class="col-6 mb-3">
        <div class="form-group">
          <input type="text" id="first_name"  name="first_name" placeholder="FIRST NAME" autocomplete="first_name" class="form-control" autofocus required/>
        </div>
      </div>
      <div class="col-6 mb-3">
        <div class="form-group">
          <input type="text" id="last_name"  name="last_name" placeholder="LAST NAME" autocomplete="last_name" class="form-control" autofocus required/>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group">
          <input class="form-control" autocomplete="address" type="text" name="address" id="address" placeholder="ADDRESS" autofocus required/>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group password-toggle">
          <input class="form-control" autocomplete="off" type="password" name="password" id="password" placeholder="PASSWORD" autofocus required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group password-toggle">
          <input class="form-control" autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" placeholder="PASSWORD CONFIRMATION" autofocus required>
          <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
        </div>
      </div>
      <div class="col-12 mb-1">
        <p class="text-center text-uppercase pass-validation">
          Your password must be over 8 characters long and include at least 1 upper-case letter, 1 lower-case letter, 1 number and 1 special character.
        </p>
      </div>
      <div class="col-12">
        <button class="btn auth-btn" type="submit" id="submit">REGISTER</button>
      </div>
    </div>
  </form>
</div>  