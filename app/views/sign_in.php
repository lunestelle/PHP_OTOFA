<div class="split-section">
  <div class="split-left d-flex">
    <div>
      <h1>Log in</h1>
      <p>Don't have an account? <a href="<?= ROOT ?>/sign_up">Sign up</a></p>
      <form method="POST" class="sign_in">
        <div class="field">
          <input type="email" id="email" autofocus name="email" placeholder="EMAIL" class="email_field" required value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];}?>">
        </div>
        <div class="field password-toggle">
          <input type="password" id="password" autofocus name="password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>" placeholder="PASSWORD" autocomplete="password" class="password_field" required>
          <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
        </div>
        <div class="form-check">
          <input class="form-check-input me-2" style="border: 1px solid #828282" type="checkbox" value="" id="rememberMe" name="rememberMe"<?php if(isset($_COOKIE['email'])){echo 'checked';}?>/>
          <label class="form-check-label rememberMe p-0 mb-1" for="rememberMe" style="font-size: 12px; font-weight: 400;">REMEMBER ME</label>
        </div>
        <div class="actions_devise">
          <button class="btn btn-block" type="submit">SIGN IN</button>
        </div>
        <div class="forgot_password pb-2 text-center">
          <a href="<?= ROOT ?>/forgot_password">Forgot Your Password?</a>
          <p class="text-center mt-2"><a href="<?= ROOT ?>" class="back_btn">< Back</a></p>
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