<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Tricycle</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row">
        <div class="col-12 pt-2">
          <div id="newTricycleForm">
            <?php
              if ($appointmentType === 'New Franchise') {
                include 'app/views/partials/new_franchise_form.php';
              }
            ?>

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

            <div id="taripaTableContainer" class="content-container mt-4">
              <div class="bckgrnd pt-2">
                <?php
                  $taripaTitle = isset($tricycleApplicationData->route_area) ? $tricycleApplicationData->route_area : '';
                  $taripaTitle .= isset($recentYear) ? ' &mdash; ' . $recentYear . ' TARIPA' : '';
                ?>
                <h6 class="pl-2 text-uppercase text-center text-dark fs-6">
                  <?php echo $taripaTitle; ?>
                </h6>
              </div>
              <div class="row px-3 p-4">
                <table class="table-bordered table-hover text-center" id="systemTable">
                  <thead>
                    <tr>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Barangay</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Regular Rate</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Student Rate</th>
                      <th class="text-white text-center" style="background-color:#090C1B !important;">Senior Citizen & PWD Rate</th>
                    </tr>
                </thead>
                  <tbody>
                    <?php foreach ($recentTaripaData as $taripa): ?>
                      <tr>
                        <td><?php echo $taripa['barangay']; ?></td>
                        <td><?php echo '₱' . number_format($taripa['regular_rate'], 2); ?></td>
                        <td><?php echo '₱' . number_format($taripa['student_rate'], 2); ?></td>
                        <td><?php echo '₱' . number_format($taripa['senior_and_pwd_rate'], 2); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="text-end my-3">
              <a href="./tricycles"><button class="sidebar-btnContent">Back</button></a>
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