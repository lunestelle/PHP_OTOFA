<nav class="navbar navbar-expand">
  <div class="container navbar-container d-flex justify-content-between align-items-center">
    <a class="navbar-brand" href="<?=ROOT?>">
      <img src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo" width="30" height="30" class="d-inline-block align-text-top">
      <span class="sakay-text">Sakay</span><span class="cle-text">cle</span>
    </a>
      
    <div class="d-flex align-items-center">
      <a href="dashboard" class="nav-link me-3">DASHBOARD</a>
      <div class="dropdown mr-3">
        <a class="nav-link" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?= $profile_photo ?>" alt="Profile Photo" width="30" height="30" class="rounded-circle">
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li><h6 class="dropdown-header">Manage Account</h6></li>
          <li><a class="dropdown-item" href="manage_account"><i class="fa-solid fa-gear"></i> Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li>
          <form action="<?= ROOT ?>/sign_out" method="post" id="sign-out-form">
            <input type="hidden" name="sign_out" value="1">
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
              <i class="fa-solid fa-right-from-bracket"></i> Log Out
              </a>
          </form>
        </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

<div class="profile-header-bg mb-4 py-1">
  <div class="mx-4">
    <div class="row">
      <div class="col">
        <h4 class="my-2">Profile</h4>
      </div>
    </div>
  </div>
</div>

<div class="m-3">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 col-12 card-details">
        <h6>Profile Information</h6>
        <p>Update your account's profile information and email address.</p>
      </div>
      <div class="col-md-8 col-12">
        <div class="card card-container">
          <div class="card-body card-col">
            <form method="POST" action="" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 col-12">
                  <label for="new-profile-photo" class="form-label">Photo</label>
                  <div class="mb-2">
                    <img src="<?= $profile_photo ?>" alt="Profile Photo" class="profile-photo">
                  </div>
                  <div class="mb-3">
                    <input type="hidden" id="selected-profile-photo" name="selected-profile-photo">
                    <button type="button" class="btn select-photo-btn">Select a new photo</button>
                    <?php if (strpos($profile_photo, 'uploaded_profile') !== false) { ?>
                      <button type="submit" class="btn remove-photo-btn" name="remove_profile">Remove photo</button>
                    <?php } ?>
                
                  </div>
                </div>
                <div class="col-md-12 col-12">
                  <div class="col-md-8 mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : '' ?>" required>
                  </div>
                  <div class="col-md-8 mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : '' ?>" required>
                  </div>

                  <div class="col-md-8">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" required>
                  </div>
                </div>
              </div>
              <div class="text-end mt-1">
                <button type="submit" class="btn manage-save-btn" name="profile_info_save_btn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-none d-lg-block">
  <div class="py-3 mx-3">
    <div class="divider"></div>
  </div>
</div>

<div class="m-3">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 col-sm-12 card-details">
        <h6>Update Password</h6>
        <p>Ensure your account is using a long, random password to stay secure.</p>
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="card card-container">
          <div class="card-body card-col">
            <form method="POST" action="">  
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-8 mb-3 password-toggle">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                    <i id="current_password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('current_password')"></i>
                  </div>
                  <div class="col-md-8 mb-3 password-toggle">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                    <i id="new_password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('new_password')"></i>
                  </div>
                  <div class="col-md-8 password-toggle">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
                  </div>
                </div>
              </div>
              <div class="text-end mt-1">
                <button type="submit" class="btn manage-save-btn" name="update_password_save_btn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-none d-lg-block">
  <div class="py-3 mx-3">
    <div class="divider"></div>
  </div>
</div>

<div class="m-3">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 col-sm-12 card-details">
        <h6>Two Factor Authentication</h6>
        <p>Add additional security to your account using two factor authentication.</p>
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="card card-container">
          <div class="card-body card-col">
            <form>
              <div class="row">
                <div class="col-10">
                  <h6>You have not enabled two factor authentication.</h6>
                  <p class="mt-2">When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone's Google Authenticator application.</p>
                </div>
              </div>
              <div class="text-start mt-1">
                <button type="submit" class="btn manage-save-btn">Enable</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-none d-lg-block">
  <div class="py-3 mx-3">
    <div class="divider"></div>
  </div>
</div>

<div class="m-3">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 col-sm-12 card-details">
        <h6>Browser Sessions</h6>
        <p>Manage and log out your active sessions on other browsers and devices.</p>
      </div>
      <div class="col-md-8 col-sm-12">
        <div class="card card-container">
          <div class="card-body card-col">
            <form>
              <div class="row">
                <div class="col-10">
                  <p>If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.</p>
                </div>
                <div class="col-4">
                  <div class="flex items-center">
                    <div>
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="desktop-svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"></path>
                      </svg>
                    </div>

                    <div class="ml-3 mb-2">
                      <p>
                        Windows - Chrome <br>
                        <span>127.0.0.1,<span> Last active 1 hour ago</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-start mt-1">
                <button type="submit" class="btn manage-save-btn">Log out other browser session</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelector('.select-photo-btn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.onchange = function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.querySelector('.profile-photo');
          img.src = e.target.result;
          document.querySelector('#selected-profile-photo').value = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };
    input.click();
  }); 
</script>

