<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Edit Maintenance Log</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12">
          <div class="container">
            <div id="mainteanceLogForm">
              <form class="default-form" method="POST" action="" enctype="multipart/form-data">
                <div class="content-container mx-1 mt-3 pb-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Maintenance Log Information</h6>
                  </div>
                  <div class="container">
                    <div class="d-flex justify-content-center">
                      <div class="row px-3">
                        <div class="col-12">
                          <div class="row mt-3">
                          <?php if (!empty($tricycleCinNumbers)): ?>
                              <div class="col-4">
                                <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                                <select class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" required>
                                  <option value="" disabled <?= empty($selectedCinNumberId) ? 'selected' : ''; ?>>Please Select Here</option>
                                  <?php foreach ($tricycleCinNumbers as $cinNumberId => $cinData): ?>
                                    <option value="<?= $cinNumberId ?>" <?= ($cinNumberId == $selectedCinNumberId) ? 'selected' : ''; ?>>
                                      <?= $cinData['cin_number'] ?>
                                    </option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                            <?php else: ?>
                              <div class="col-4">
                                <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                                <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                              </div>
                            <?php endif; ?>
                            <div class="col-4">
                              <label for="driver_name" class="form-label">Name of Driver</label>
                              <input type="text" class="form-control" style="cursor: pointer;" id="driver_name" name="driver_name" placeholder="Select CIN first" readonly data-toggle="tooltip" data-bs-placement="right" value="" title="Please choose a Tricycle CIN to determine the Driver Name">
                              <input type="hidden" id="driver_id" name="driver_id" value="">
                            </div>
                            <div class="col-4">
                              <label for="expense_date" class="form-label">Expense Date</label>
                              <input type="expense_date" class="form-control" id="expense_date" name="expense_date" value="<?php echo isset($maintenanceLogData['expense_date']) ? $maintenanceLogData['expense_date'] : ''; ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="row mt-3">
                            <div class="col-4">
                              <label for="total_expenses" class="form-label">Total Expenses</label>
                              <input type="text" class="form-control" id="total_expenses" name="total_expenses" value="<?php echo isset($maintenanceLogData['total_expenses']) ? $maintenanceLogData['total_expenses'] : ''; ?>" required>
                            </div>
                            <div class="col-4">
                              <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" value="<?php echo isset($maintenanceLogData['description']) ? $maintenanceLogData['description'] : ''; ?>" required>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="content-container mt-4">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Expenses Receipt Image</h6>
                  </div>
                  <div class="row justify-content-evenly px-3 p-3">
                    <div class="col-12 d-flex justify-content-evenly">
                      <div class="text-center">
                        <label for="expenses_receipt_image" class="form-label">Receipt</label>
                        <?php
                          if (isset($maintenanceLogData['expenses_receipt_image_path']) && $maintenanceLogData['expenses_receipt_image_path']) {
                            echo '<div class="image-container position-relative">';
                            echo '<img src="' . $maintenanceLogData['expenses_receipt_image_path'] . '" class="img-fluid rounded fixed-height-image" id="expenses_receipt_image" alt="Maintenance Log Receipt">';
                            echo '<button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-image-btn" data-bs-toggle="modal" data-bs-target="#deleteImageModal" data-image-type="front" data-original-image="' . $maintenanceLogData['expenses_receipt_image_path'] . '"></button>';
                            echo '</div>';
                          } else {
                            echo '<div class="image-container">';
                            echo '<input class="form-control" type="file" name="expenses_receipt_image" id="expenses_receipt_image-input" accept="image/*" required>';
                            echo '</div>';
                          }
                        ?>
                        <?php
                          echo '<input type="hidden" name="original_expenses_receipt_image" value="' . ($maintenanceLogData['expenses_receipt_image_path'] ?? '') . '">';
                        ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" name="update_maintenance_log">Update</button>
                  <a href="maintenance_logs" class="cancel-btn">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- Confirmation Modal -->
<div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteImageModalLabel">Delete Image Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this image?
      </div>
      <div class="modal-footer">
        <form method="POST" action="">
          <input type="hidden" name="image_type" id="imageTypeInput">
          <input type="hidden" name="original_image_path" id="originalImagePathInput">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" name="confirm_delete_image">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $(".remove-image-btn").click(function () {
      let imageType = $(this).data("image-type");
      let originalImagePath = $(this).data("original-image");
      
      $("#imageTypeInput").val(imageType);
      $("#originalImagePathInput").val(originalImagePath);
    });
  });

  $(document).ready(function () {
    const tricycleCinSelect = $('#tricycle_cin_number_id');
    const driverNameInput = $('#driver_name');
    const driverIdInput = $('#driver_id');

    function updateDriverName() {
      let selectedCinId = tricycleCinSelect.val();

      if (selectedCinId) {
        $.post('driver_data', { tricycle_cin_number_id: selectedCinId }, function (response) {
          if (response.success) {
            let driverData = response.data.driverData;

            if (driverData) {
              let driver = driverData[0];
              driverIdInput.val(driver.driver_id);
              driverNameInput.val(driver.first_name + ' ' + driver.middle_name + ' ' + driver.last_name);
              driverNameInput.tooltip('hide').attr('data-bs-original-title', '');
            } else {
              driverIdInput.val(''); // Reset the driver_id input value
              driverNameInput.val('Selected CIN has no driver');
              driverNameInput.tooltip('hide').attr('data-bs-original-title', 'Selected CIN has no driver');
            }
          } else {
            console.error('Error fetching driver data');
          }
        }, 'json');
      } else {
        driverIdInput.val('');
        driverNameInput.val('Select CIN first');
        driverNameInput.tooltip('hide').attr('data-bs-original-title', 'Please choose a Tricycle CIN to determine the Driver Name');
      }

      driverNameInput.tooltip('dispose');
      driverNameInput.tooltip({
        placement: 'right',
        trigger: 'hover',
      });
    }

    tricycleCinSelect.change(function () {
      updateDriverName();
    });

    updateDriverName();
  });
</script>