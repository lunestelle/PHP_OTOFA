<div class="col-lg-12">
  <form class="default-form custom-form" id="sign-in-form" method="POST" action="">
    <div class="form-group mb-4">
      <input class="form-control" autocomplete="email" type="text" name="email_or_phone" id="email_or_phone" placeholder="EMAIL OR PHONE NUMBER" value="<?php if(isset($_COOKIE['email_or_phone'])){echo $_COOKIE['email_or_phone'];}?>" autofocus required>
    </div>
    <div class="form-group password-toggle mb-2">
      <input class="form-control" autocomplete="off" type="password" name="password" id="password" placeholder="PASSWORD" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>"autofocus required>
      <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
    </div>
    <div class="form-group remember-me text-start p-0 mb-3">
      <label class="form-check-label p-0">
        <input class="form-check-input" type="checkbox" value="" name="rememberMe" id="rememberMe" <?php if(isset($_COOKIE['email_or_phone'])){echo 'checked';}?>>
        Remember me
      </label>
    </div>
    <button class="btn auth-btn" type="submit" id="submit">SIGN IN</button>
  </form>
</div>
<div class="col-lg-12 text-uppercase text-center mt-3">
  <a href="javascript:void(0)" id="forgot_password_link" class="footer-link">forgot your password?</a>
</div>