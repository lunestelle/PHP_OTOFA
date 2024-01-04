<main class="background-container col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">View Calculations</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($calculationData)): ?>
            <h3><?php echo $selectedYear; ?> Total Maintenance Expenses for Tricycle CIN Number <?php echo isset($tricycleCIN) ? $tricycleCIN : ''; ?>:</h3>

            <?php
            $totalExpenses = 0;
            foreach ($calculationData as $calculation):
              $description = isset($calculation->description) ? $calculation->description : '';
              $expenses = isset($calculation->total_expenses) ? $calculation->total_expenses : 0;

              echo "<p>{$description} - ₱" . number_format($expenses, 2) . "</p>";

              $totalExpenses += $expenses;
            endforeach;
            ?>

            <hr>

            <p class="fw-bold">TOTAL = ₱<?php echo number_format($totalExpenses, 2); ?></p>
          <?php endif; ?>

          <a href="maintenance_tracker">Back to Maintenance Tracker</a>
        </div>
      </div>
    </div>
  </div>
</main>