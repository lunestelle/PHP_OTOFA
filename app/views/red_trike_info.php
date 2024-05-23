<style>
  .route-content {
    border-radius: 10px;
    border: 1px solid #d8d8d8c9;
    background: #FFF;
    box-shadow: -1px 4px 10px 0px rgba(0, 0, 0, 0.25);
    margin-left: 100px !important;
  }

  .route-header {
    background-color: rgb(255, 82, 82);
    color: white;
    border-radius: 10px 10px 0 0;
  }

  .back-button {
    padding: 7px 75px;
    color: white;
    background-color: #090C1B;
    border-radius: 15px;
  }

  .back-button:hover {
    padding: 7px 75px;
    color: #090C1B;
    background-color: white;
    border: inset 1px #090C1B;
    border-radius: 15px;
  }

  .button {
    margin-top: 40px;
  }
</style>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
  <div class="row">
    <div class="lh-1">
      <h4 class="mt-2 text-uppercase fw-bold text-danger"><?= $zone ?></h4>
      <p class="text-uppercase">COLOR CODE: <span class="text-danger fw-bold">Red</span></p>
    </div>
  </div>
  <div class="d-flex">
    <div class="col-lg-5">
      <div class="row">
        <div class="col-12">
          <div class="d-block container-code mt-3">
            <div class="mx-5 mr-5">
              <img src="public/assets/images/red-trike-dashboard.png" style="height: 350px; width: 350px;" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="col-12">
        <div class="main-content mx-5 ms-5 route-content mt-3">
          <p class="text-uppercase fw-bolder p-1 route-header text-center">Route Areas</p>
          <div class="d-flex">
            <ul class="me-5">
              <?php $half = ceil(count($routeAreas) / 2); ?>
              <?php foreach ($routeAreas as $index => $barangay): ?>
                <li><?= $barangay ?></li>
                <?php if ($index + 1 == $half): ?>
              </ul>
              <ul>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="button">
        <a href="dashboard" class="back-button text-decoration-none">Back</a>
      </div>
    </div>
  </div>
</main>