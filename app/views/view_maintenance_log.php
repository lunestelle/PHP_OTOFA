<?php
$_SESSION['prev_page'] = $_SERVER['HTTP_REFERER'];

$backUrl = isset($_SESSION['prev_page']) ? $_SESSION['prev_page'] : './maintenance_log';
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Maintenance Log</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newMaintenanceLog">
              <div class="content-container mt-2 pb-3">
                <div class="bckgrnd pt-2">
                  <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Maintenance Log Information</h6>
                </div>
                <div class="container">
                  <div class="d-flex">
                    <div class="row px-3">
                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <p class="form-label">Tricycle CIN</p>
                            <div class="form-control">
                              <?php echo isset($cin) ? $cin : ''; ?>
                            </div>
                          </div>
                          <div class="col-4 px-5">
                            <p class="form-label">Name of Driver</p>
                            <div class="form-control">
                              <?php echo !empty($driver_name) ? $driver_name : 'No Driver'; ?>
                            </div>
                          </div>
                          <div class="col-4 px-5">
                            <p class="form-label">Expense Date</p>
                            <div class="form-control">
                              <?php echo isset($expense_date) ? $expense_date : ''; ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="row mt-3">
                          <div class="col-4 px-5">
                            <p class="form-label">Total Expenses</p>
                            <div class="form-control">
                              <?php echo isset($total_expenses) ? $total_expenses : ''; ?>
                            </div>
                          </div>
                          <div class="col-4 px-5">
                            <div class="form-group">
                              <p class="form-label">Description</p>
                              <div class="form-control">
                                <?php echo isset($description) ? $description : ''; ?>
                              </div>
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
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">Expenses Receipt Image</h6>
              </div>

              <div class="row justify-content-evenly px-3 p-3">
                <?php
                  function displayImage($imagePath, $imageAlt) {
                    if ($imagePath) {
                      echo '<div class="col-md-4 text-center">';
                      echo '<p class="form-label fw-semibold fs-6">' . $imageAlt . '</p>';
                      echo '<div class="image-container position-relative" data-bs-toggle="modal" data-bs-target="#exampleModal">';
                      echo '<img src="' . $imagePath . '" class="img-fluid rounded fixed-height-image" alt="' . $imageAlt . '">';
                      echo '</div>';
                      echo '</div>';
                    } else {
                      echo '<div class="col-md-4 text-center">';
                      echo '<p class="form-label">' . $imageAlt . ' Image not available</p>';
                      echo '</div>';
                    }
                  }

                  displayImage($expenses_receipt_image_path, 'Expenses Receipt Image');
                ?>
              </div>
            </div>

            <!-- Bootstrap Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body mx-auto">
                    <img src="" class="img-fluid" id="modalImage" alt="Enlarged Image">
                  </div>
                </div>
              </div>
            </div>

              <div class="text-end my-3">
                <a href="<?php echo $backUrl; ?>"><button class="sidebar-btnContent">Back</button></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  document.querySelectorAll('.image-container').forEach(function (container) {
    container.addEventListener('click', function () {
      var imageSrc = this.querySelector('img').src;
      document.getElementById('modalImage').src = imageSrc;
    });
  });
</script>