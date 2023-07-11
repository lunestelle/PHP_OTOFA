<div class="row">
  <div class="col-12">
    <h5 class="modal-title text-center text-uppercase">
      Manage Account
    </h5>
  </div>
  <div class="col-lg-12">
    <form class="default-form custom-form" id="manage-account-form" method="POST" action="">
      <div class="row">
        <div class="col-12">
          <div class="form-group mb-3">
            <input class="form-control" autocomplete="email" type="email" name="email" id="email" placeholder="EMAIL" required value="<?php echo isset($email) ? $email : '' ?>">
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-group">
            <input type="text" id="first_name" name="first_name" placeholder="FIRST NAME" autocomplete="first_name" class="form-control" required value="<?php echo isset($first_name) ? $first_name : '' ?>">
          </div>
        </div>
        <div class="col-6 mb-3">
          <div class="form-group">
            <input type="text" id="last_name" name="last_name" placeholder="LAST NAME" autocomplete="last_name" class="form-control" required value="<?php echo isset($last_name) ? $last_name : '' ?>">
          </div>
        </div>
        <div class="col-12 mb-3">
          <div class="form-group password-toggle">
            <input class="form-control" type="password" name="old-password" id="old-password" placeholder="OLD PASSWORD" value="">
            <i id="old-password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('old-password')"></i>
          </div>
        </div>
        <div class="col-12 mb-3">
          <div class="form-group password-toggle">
            <input class="form-control" type="password" name="new-password" id="new-password" placeholder="NEW PASSWORD" value="">
            <i id="new-password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('new-password')"></i>
          </div>
        </div>
        <div class="col-12 mb-1">
          <p class="text-center text-uppercase pass-validation">
            Leave the old and new password field blank if you don't want to update your password.
          </p>
        </div>
        <div class="col-12">
          <button class="btn auth-btn" type="submit" id="submit">Update</button>
        </div>
      </div>
    </form>
  </div>  
</div>
