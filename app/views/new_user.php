<style>
  /* ------ UPDATE PASSWORD  ------- */
  .password-toggle {
    position: relative;
  }

  .password-toggle .toggle-icon {
    position: absolute;
    top: 80%;
    bottom: 0%;
    right: 15px;
    transform: translateY(-100%);
    cursor: pointer;
    display: none;
  }

  .password-toggle input:valid + .toggle-icon {
    display: block;
  } 
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Add New User</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newMaintenancerForm">
              <form class="default-form" method="POST" action="" enctype="multipart/form-data">
                <!-- HIDDEN INPUTS TO OVERRIDE THE VERIFICATIONS -->
                <input type="hidden" name="verification_status" id="verification_status" value="verified">
                <input type="hidden" name="phone_number_status" id="phone_number_status" value="Verified">
                <div class="content-container mt-2 pb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">User Information</h6>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="row mt-1 p-2">
                          <div class="col-4 px-5">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control w-100" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                          </div>
                          <div class="col-4 px-5">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control w-100" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                          </div>
                          <div class="col-4 px-5">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                              <option value="" disabled selected>Please select a role</option>
                              <option value="operator" <?php echo isset($role) && $role === 'operator' ? 'selected' : ''; ?>>Operator</option>
                              <option value="personnel" <?php echo isset($role) && $role === 'personnel' ? 'selected' : ''; ?>>Personnel</option>
                              <option value="admin" <?php echo isset($role) && $role === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-1 p-2">
                          <div class="col-4 px-5">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control w-100 text-lowercase" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                          </div>
                          <div class="col-4 px-5">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control w-100" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                          </div>
                          <div class="col-4 px-5">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <div class="input-group w-100">
                              <span class="input-group-text">+63</span>
                              <input type="text" class="form-control phone-no" id="phone_number" name="phone_number" placeholder="e.g., 9123456789" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>" required>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-1 p-2">
                          <div class="col-4 px-5">
                            <div class="form-group password-toggle">
                              <label for="password" class="form-label">Password</label>
                              <input class="form-control w-100" autocomplete="off" type="password" name="password" id="password" style="text-transform: none;" value="<?php echo isset($password) ? $password : ''; ?>" autofocus required>
                              <i id="password-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password')"></i>
                            </div>
                          </div>
                          <div class="col-4 px-5">
                            <div class="form-group password-toggle">
                              <label for="password_confirmation" class="form-label">Confirm Password</label>
                              <input class="form-control w-100" autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" style="text-transform: none;" value="<?php echo isset($password_confirmation) ? $password_confirmation : ''; ?>" autofocus required>
                              <i id="password_confirmation-toggle-icon" class="toggle-icon fas fa-eye-slash" onclick="togglePassword('password_confirmation')"></i>
                            </div>
                          </div>
                          <div class="col-4 px-5">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">User Permissions</h6>
                  </div>
                  <div class="row justify-content-evenly px-5 p-3 m-1">
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Appointment</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointment_approved" id="permissionApproved" name="permissions[]">
                        <label class="form-check-label" for="permissionApproved">
                          Can approve appointment
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointment_reject" id="permissionReject" name="permissions[]">
                        <label class="form-check-label" for="permissionReject">
                          Can reject appointment
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointment_on_process" id="permissionOnProcess" name="permissions[]">
                        <label class="form-check-label" for="permissionOnProcess">
                          Can on process appointment
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointment_completed" id="permissionCompleted" name="permissions[]">
                        <label class="form-check-label" for="permissionCompleted">
                          Can completed appointment
                        </label>
                      </div>
                      <!-- Add more appointment permissions here -->
                    </div>
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Reports</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointments_reports" id="permissionAppointmentReports" name="permissions[]">
                        <label class="form-check-label" for="permissionAppointmentReports">
                          Can view appointments reports
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="tricycles_reports" id="permissionTricycleReports" name="permissions[]">
                        <label class="form-check-label" for="permissionTricycleReports">
                          Can view tricycles report
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="cin_reports" id="permissionCinReports" name="permissions[]">
                        <label class="form-check-label" for="permissionCinReports">
                          Can view cin report
                        </label>
                      </div>
                      <!-- Add more report permissions here -->
                    </div>
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Taripa</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="taripa_view" id="permissionTaripaView" name="permissions[]">
                        <label class="form-check-label" for="permissionTaripaView">
                          Can view taripa
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="taripa_generate" id="permissionTaripaGenerate" name="permissions[]">
                        <label class="form-check-label" for="permissionTaripaGenerate">
                          Can generate taripa
                        </label>
                      </div>
                      <!-- Add more taripa permissions here -->
                    </div>
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Inquiries</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="inquiry_view" id="permissionInquiryView" name="permissions[]">
                        <label class="form-check-label" for="permissionInquiryView">
                          Can view inquiries and read message
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="inquiry_respond" id="permissionInquiryRespond" name="permissions[]">
                        <label class="form-check-label" for="permissionInquiryRespond">
                          Can respond to inquiries
                        </label>
                      </div>
                      <!-- Add more inquiry permissions here -->
                    </div>
                  </div>

                  <div class="row justify-content-evenly px-5 p-3 m-1">
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Tricycles</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="tricycles_view" id="permissionTricyclesView" name="permissions[]">
                        <label class="form-check-label" for="permissionTricyclesView">
                          Can view List of Tricycles
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="tricycles_update_status" id="permissionTricyclesUpdate" name="permissions[]">
                        <label class="form-check-label" for="permissionTricyclesUpdate">
                          Can Update Tricycle status
                        </label>
                      </div>
                      <!-- Add more tricycles permissions here -->
                    </div>
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Operators</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="operators_view" id="permissionOperatorsView" name="permissions[]">
                        <label class="form-check-label" for="permissionOperatorsView">
                          Can view list of operators
                        </label>
                      </div>
                      <!-- Add more operators permissions here -->
                    </div>
                    <div class="col-md-3">
                      <h6 class="text-uppercase">Maintenance Tracker</h6>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="maintenance_tracker_view" id="permissionMaintenanceTrackerView" name="permissions[]">
                        <label class="form-check-label" for="permissionMaintenanceTrackerView">
                          Can view maintenance tracker
                        </label>
                      </div>
                      <!-- Add more maintenance tracker permissions here -->
                    </div>
                    <div class="col-md-3">
                      <!-- Add more permissions here -->
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Add New User</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>