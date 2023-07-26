<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>Edit Taripa</h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <form method="POST" action="">
                <?php if (isset($taripa->taripa_id)): ?>
                  <input type="hidden" name="taripa_id" value="<?php echo $taripa->taripa_id; ?>">
                <?php endif; ?>

                <div class="row mt-2">
                  <div class="col-6">
                    <label for="routeAreaFilter">Select Route Area:</label>
                    <select id="routeAreaFilter" name="route_area" class="form-select">
                    <option value="All">All</option>
                      <option value="Freezone & Zone 1" <?php echo ($selectedRoute === "Freezone & Zone 1") ? "selected" : ""; ?>>Freezone & Zone 1</option>
                      <option value="Freezone & Zone 2" <?php echo ($selectedRoute === "Freezone & Zone 2") ? "selected" : ""; ?>>Freezone & Zone 2</option>
                      <option value="Freezone & Zone 3" <?php echo ($selectedRoute === "Freezone & Zone 3") ? "selected" : ""; ?>>Freezone & Zone 3</option>
                      <option value="Freezone & Zone 4" <?php echo ($selectedRoute === "Freezone & Zone 4") ? "selected" : ""; ?>>Freezone & Zone 4</option>
                      <option value="Freezone" <?php echo ($selectedRoute === "Freezone") ? "selected" : ""; ?>>Freezone</option>
                    </select>
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-6">
                    <label for="barangay">Barangay:</label>
                    <input type="text" id="barangay" name="barangay" class="form-control" value="<?php echo isset($taripa->barangay) ? $taripa->barangay : ''; ?>">
                  </div>

                  <div class="col-6">
                    <label for="regularRate">Regular Rate:</label>
                    <input type="text" id="regularRate" name="regular_rate" class="form-control" value="<?php echo isset($taripa->regular_rate) ? $taripa->regular_rate : ''; ?>">
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-6">
                    <label for="discountedRate">Senior Citizen, PWD & Student Rate:</label>
                    <input type="text" id="discountedRate" name="discounted_rate" class="form-control" value="<?php echo isset($taripa->discounted_rate) ? $taripa->discounted_rate : ''; ?>">
                  </div>
                  <div class="col-6">
                    <div class="mt-3">
                      <button type="submit" class="text-uppercase sidebar-btnContent">Update</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
