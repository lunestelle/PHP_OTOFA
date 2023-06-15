<div class="col-lg-12">
  <form class="default-form custom-form" id="sign-up-form" method="POST" action="">
    <div class="row">
      <div class="col-12">
        <div class="form-group mb-3">
          <input class="form-control" autocomplete="email" type="email" name="email" id="email" placeholder="EMAIL" autofocus required>
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
        <div class="form-group password-toggle">
          <input class="form-control" autocomplete="off" type="password" name="password" id="password" placeholder="PASSWORD" autofocus required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
        </div>
      </div>
      <div class="col-12 mb-3">
        <div class="form-group password-toggle">
          <input class="form-control" autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" placeholder="PASSWORD CONFIRMATION" autofocus required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
        </div>
      </div>
      <div class="col-12 mb-1">
        <p class="text-center text-uppercase pass-validation">
          Your password must be over 8 characters long and include at least 1 upper-case letter, 1 lower-case letter, 1 number and 1 special character.
        </p>
      </div>
      <div class="col-12">
        <button class="btn auth-btn" type="submit" id="submit">SIGN UP</button>
      </div>
    </div>
  </form>
</div>  