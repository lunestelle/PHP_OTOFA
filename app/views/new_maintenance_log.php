<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Add New Maintenance Log</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newMaintenancerForm">
              <form class="default-form" method="POST" action="" enctype="multipart/form-data">
                <div class="content-container mt-2 pb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Maintenance Log Information</h6>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="row mt-3">
                          <?php if (!empty($tricycleCinNumbers)): ?>
                            <div class="col-4 px-5">
                              <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                              <select class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" required>
                                <option selected disabled>Please Select Here</option>
                                <?php foreach ($tricycleCinNumbers as $cinNumberId => $cinData): ?>
                                  <option value="<?= $cinNumberId ?>"><?= $cinData['cin_number'] ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          <?php else: ?>
                            <div class="col-4 px-5">
                              <label for="tricycle_cin_number_id" class="form-label">Tricycle CIN</label>
                              <input type="text" class="form-control" id="tricycle_cin_number_id" name="tricycle_cin_number_id" value="" data-toggle="tooltip" data-bs-placement="top" title="No available Tricycle CIN numbers." readonly disabled>
                            </div>
                          <?php endif; ?>
                          <div class="col-4 px-5">
                            <label for="driver_id" class="form-label">Name of Driver</label>
                            <select class="form-control" id="driver_id" name="driver_id" required>
                            <option value="" disabled <?php echo (!isset($_POST['driver_id'])) ? 'selected' : ''; ?>>Please Select Here</option>
                              <?php foreach ($data['drivers'] as $driver): ?>
                                <option value="<?php echo $driver['driver_id']; ?>" <?php echo (isset($_POST['driver_id']) && $_POST['driver_id'] == $driver['driver_id']) ? 'selected' : ''; ?>>
                                  <?php echo $driver['name']; ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <div class="col-4 px-5">
                            <label for="date" class="form-label">Expense Date</label>
                            <input type="date" class="form-control text-uppercase" id="date" name="date" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <label for="total_expenses" class="form-label">Total Expenses</label>
                            <input type="text" class="form-control" id="total_expenses" name="total_expenses" value="<?php echo isset($total_expenses) ? $total_expenses : ''; ?>" required>
                          </div>
                          <div class="col-4 px-5">
                            <div class="form-group">
                              <label for="description" class="form-label">Description</label>
                              <div class="input-group">
                                <input type="text" class="form-control phone-no" id="description" name="description" value="<?php echo isset($description) ? $description : ''; ?>" required>
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
                        <input type="file" class="form-control" id="expenses_receipt_image" name="expenses_receipt_image" accept="image/*" />
                      </div>
                    </div>
                  </div>
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