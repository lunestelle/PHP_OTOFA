<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>dashboard</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <?php if ($userRole === 'operator') { ?>
          <div class="col-12">
            <div class="container gap-5 px-5 mb-4 pb-3">
              <div class="overview-container mt-3">
                <img src="assets/images/tricycle.png" alt="Tricycle Image" class="mt-2">
                <h5>10</h5>
                <p>Tricycles</p>
              </div>
              <div class="overview-container mt-3">
                <img src="assets/images/Driver.png" alt="Driver Image" class="mt-2">
                <h5>10</h5>
                <p>Drivers</p>
              </div>
              <div class="overview-container mt-3">
                <img src="assets/images/Cash.png" alt="Boundary Image" class="mt-2">
                <h5>555</h5>
                <p>Boundaries</p>
              </div>
            </div>
          </div>
        <?php } elseif ($userRole === 'admin') { ?>
          <div class="col-12">
            <div class="container gap-5 px-5 mb-4 pb-3">
              <div class="overview-container mt-3">
                <img src="assets/images/tricycle.png" alt="Tricycle Image" class="mt-2">
                <h5>10</h5>
                <p>Tricycles</p>
              </div>
              <div class="overview-container mt-3">
                <img src="assets/images/Driver.png" alt="Driver Image" class="mt-2">
                <h5>10</h5>
                <p>Drivers</p>
              </div>
              <div class="overview-container mt-3">
                <img src="assets/images/approval.png" alt="Registration Image" class="mt-2">
                <h5>25</h5>
                <p>Registrations</p>
              </div>
              <div class="overview-container mt-3">
                <img src="assets/images/calendar.png" alt="Appointment Image" class="mt-2">
                <h5>20</h5>
                <p>Appointments</p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="col-12 title-head text-uppercase">
      <h6>Tricycle's Code </h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="container-code mt-3 mx-4 ">
            <div class="color-code-blue d-flex">
              <div class="center">
                <img src="assets/images/blue-trike.png" alt="Blue Trike Image">
                <p>Blue Trike</p>
              </div>
              <div class="description">
                <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit, Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
              </div>
            </div>
            <div class="color-code-green d-flex">
              <div>
                <img src="assets/images/green-trike.png" alt="Green Trike Image">
                <p>Green Trike</p>
              </div>
              <div class="description">
                <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
              </div>
            </div>
            <div class="color-code-red d-flex">
              <div>
                <img src="assets/images/red-trike.png" alt="Red Trike Image">
                <p>Red Trike</p>
              </div>
              <div class="description">
                <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
              </div>
            </div>
            <div class="color-code-yellow d-flex">
              <div>
                <img src="assets/images/yellow-trike.png" alt="Yellow Trike Image">
                <p>Yellow Trike</p>
              </div>
              <div class="description">
                <p class="truncate">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magnam voluptatum sunt ipsam, adipisicing elit. Magnam voluptatum sunt ipsam, laborum, tenetur exercitationem at illum odit expedita nemo, quasi soluta id in quaerat numquam molestias eum nihil placeat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>