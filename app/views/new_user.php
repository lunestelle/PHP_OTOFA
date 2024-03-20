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
                <div class="content-container mt-2 pb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">User Information</h6>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="row mt-3 p-2">
                          <div class="col-6 px-5 pb-2">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control w-100" id="first_name" name="first_name" value="<?php echo isset($first_name) ? $first_name : ''; ?>" required>
                          </div>
                          <div class="col-6 px-5 pb-2">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control w-100" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3 p-2">
                          <div class="col-6 px-5 pb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control w-100" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                          </div>
                          <div class="col-6 px-5 pb-2">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control w-100" id="address" name="address" value="<?php echo isset($address) ? $address : ''; ?>" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3 p-2">
                          <div class="col-6 px-5 pb-2">
                            <label for="phone_no" class="form-label">Phone Number</label>
                            <div class="input-group w-100">
                              <span class="input-group-text">+63</span>
                              <input type="text" class="form-control phone-no" id="phone_no" name="phone_no" placeholder="e.g., 9123456789" value="<?php echo isset($phone_no) ? $phone_no : ''; ?>" required>
                            </div>
                          </div>
                          <div class="col-6 px-5 pb-2">
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
                    </div>
                  </div>
                </div>

                <div class="content-container mt-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">User Permissions</h6>
                  </div>
                  <div class="row justify-content-evenly px-5 p-4 m-1">
                    <div class="col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="appointment" id="permissionAppointment" name="permissions[]">
                        <label class="form-check-label" for="permissionAppointment">
                          Appointment
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="approved" id="permissionApproved" name="permissions[]">
                        <label class="form-check-label" for="permissionApproved">
                          Approved
                        </label>
                      </div>
                      <!-- Add more permissions here -->
                    </div>
                    <div class="col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="reject" id="permissionReject" name="permissions[]">
                        <label class="form-check-label" for="permissionReject">
                          Reject
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="on_process" id="permissionOnProcess" name="permissions[]">
                        <label class="form-check-label" for="permissionOnProcess">
                          On Process
                        </label>
                      </div>
                      <!-- Add more permissions here -->
                    </div>
                    <div class="col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="completed_status_update" id="permissionCompletedStatusUpdate" name="permissions[]">
                        <label class="form-check-label" for="permissionCompletedStatusUpdate">
                          Completed Status Update
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="inquiry_view_page" id="permissionInquiryViewPage" name="permissions[]">
                        <label class="form-check-label" for="permissionInquiryViewPage">
                          Inquiry: View Page
                        </label>
                      </div>
                      <!-- Add more permissions here -->
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent">Log Maintenance Expenses</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    const driverNameInput = $('#driver_name');

    $('#tricycle_cin_number').change(function () {
      let selectedCinId = $(this).val();

      if (selectedCinId) {
        $.post('driver_data', { tricycle_cin_number_id: selectedCinId }, function (response) {
          if (response.success) {
            let driverData = response.data.driverData;

            if (driverData) {
              let driver = driverData[0];
              $('#driver_id').val(driver.driver_id);
              driverNameInput.val(driver.first_name + ' ' + driver.middle_name + ' ' + driver.last_name);
              driverNameInput.tooltip('hide').attr('data-bs-original-title', '');
            } else {
              $('#driver_id').val('');
              driverNameInput.val('Selected CIN has no driver');
            }
          } else {
            console.error('Error fetching driver data');
          }
        }, 'json');
      } else {
        $('#driver_id').val('');
        driverNameInput.val('Select CIN first');
        driverNameInput.tooltip('hide').attr('data-bs-original-title', 'Please choose a Tricycle CIN to determine the Driver Name');
      }

      driverNameInput.tooltip('dispose');
      driverNameInput.tooltip({
        placement: 'right',
        trigger: 'hover',
      });
    });
  });
</script>