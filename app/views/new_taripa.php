<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6><?php echo isset($taripa->taripa_id) ? 'Edit Taripa' : 'New Taripa'; ?></h6> <!-- Use object notation -> instead of ['id'] -->
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <form method="POST" action=""> <!-- Use object notation -> instead of ['id'] -->
                <?php if (isset($taripa->taripa_id)): ?> <!-- Use object notation -> instead of ['id'] -->
                  <input type="hidden" name="id" value="<?php echo $taripa->taripa_id; ?>"> <!-- Use object notation -> instead of ['id'] -->
                <?php endif; ?>

                <div class="row mt-2">
                <div class="col-6">
                  <label for="routeAreaFilter">Select Route Area:</label>
                  <select id="routeAreaFilter" name="route_area" class="form-select">
                    <option value="All" <?php echo isset($taripa->route_area) && $taripa->route_area === 'All' ? 'selected' : ''; ?>>All</option>
                    <option value="Freezone & Zone 1" <?php echo isset($taripa->route_area) && $taripa->route_area === 'Freezone & Zone 1' ? 'selected' : ''; ?>>Freezone & Zone 1</option>
                    <option value="Freezone & Zone 2" <?php echo isset($taripa->route_area) && $taripa->route_area === 'Freezone & Zone 2' ? 'selected' : ''; ?>>Freezone & Zone 2</option>
                    <option value="Freezone & Zone 3" <?php echo isset($taripa->route_area) && $taripa->route_area === 'Freezone & Zone 3' ? 'selected' : ''; ?>>Freezone & Zone 3</option>
                    <option value="Freezone & Zone 4" <?php echo isset($taripa->route_area) && $taripa->route_area === 'Freezone & Zone 4' ? 'selected' : ''; ?>>Freezone & Zone 4</option>
                    <option value="Freezone" <?php echo isset($taripa->route_area) && $taripa->route_area === 'Freezone' ? 'selected' : ''; ?>>Freezone</option>
                  </select>
                </div>
                </div>

                <div class="row mt-4">
                  <div class="col-6">
                    <label for="barangay">Barangay:</label>
                    <input type="text" id="barangay" name="barangay" class="form-control" value="<?php echo isset($taripa->barangay) ? $taripa->barangay : ''; ?>"> <!-- Use object notation -> instead of ['barangay'] -->
                  </div>

                  <div class="col-6">
                    <label for="regularRate">Regular Rate:</label>
                    <input type="text" id="regularRate" name="regular_rate" class="form-control" value="<?php echo isset($taripa->regular_rate) ? $taripa->regular_rate : ''; ?>"> <!-- Use object notation -> instead of ['regular_rate'] -->
                  </div>
                </div>

                <div class="row mt-4">
                  <div class="col-6">
                    <label for="discountedRate">Senior Citizen, PWD & Student:</label>
                    <input type="text" id="discountedRate" name="discounted_rate" class="form-control" value="<?php echo isset($taripa->discounted_rate) ? $taripa->discounted_rate : ''; ?>"> <!-- Use object notation -> instead of ['discounted_rate'] -->
                  </div>
                  <div class="col-6">
                    <div class="mt-3">
                      <button type="submit" class="text-uppercase sidebar-btnContent">
                        <?php echo isset($taripa->taripa_id) ? 'Update' : 'Save'; ?>
                      </button>
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