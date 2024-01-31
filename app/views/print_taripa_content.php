<style>
  .logos {
    width: 80px;
    height: 80px;
    margin-right: 130px;
  }
  h3 {
    letter-spacing: 3px;
    margin-top: 30px;
  }
  .cin-container {
    width: 120px;
    height: 100px;
    background-color: #eaeaea;
    margin: 1rem;
    border: 2px solid black;
    box-sizing: border-box;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 60px;
  }
  .first-container,
  .second-container {
    flex: 1;
    padding: 5px;
  }
  small {
    font-size: 13px;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  th {
    border: 2px solid #ddd;
    padding: 5px;
    text-align: left;
  }
  td {
    border: 2px solid #ddd;
    padding: 3px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
    font-size: 15px;
  }
  tbody {
    font-size: 12px;
    font-weight: 700;
  }
</style>

<div class="d-flex">
  <div class="logos d-flex mt-4">
    <img src="public/assets/images/oc_logo.png" alt="">
    <img src="public/assets/images/tdfro-logo.jpg" alt="">
  </div>
  <div class="">
    <h3><?php echo date('Y', strtotime($effective_date)); ?> TRICYCLE TARIPA</h3>
    <p>City Ordinance No. 121 S. <?php echo date('Y', strtotime($effective_date)); ?> (Effective Date: <?php echo $effective_date; ?>)</p>
  </div>
</div>

<div class="d-flex">
  <div class="first-container">
    <table>
      <thead>
        <tr>
          <th class="px-5">ROUTES</th>
          <th>Regular Fare</th>
          <th>Student Fare, Senior Citizen & PWD 20% (Discount)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($first_container_data as $row): ?>
          <tr>
            <td><?php echo $row->barangay; ?></td>
            <td><?php echo $row->regular_fare; ?></td>
            <td><?php echo $row->discounted_fare; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="mt-2">
      <small>
        <p class="fw-bold text-start">Additional Fare:</p>
        <ol class="text-justify">
          <li>Children with a height of one meter(1 meter) and above shall pay the corresponding fare.</li>
          <li>Additional of <span class="fw-bold">₱5.00</span> on top of regular fare for special trips (those entering private subdivision and private properties)</li>
          <li>Addtional of <span class="fw-bold">₱5.00</span> on top of regular fare for night trips between 9:00 pm to 5:00 am within the 2.5km radius. (Brgy North, South, East, West, Alegria, Bantigue, Camp Downes, Can-adieng, Cogon, Don-Felipe Larrazabal, Linao, Punta & Toog)</li>
          <li>Addtional of <span class="fw-bold">₱10.00</span> on top of regular fare for night trips between 9:00 pm to 5:00 am outside the 2.5k radius (For Brgys. not mention above)</li>
        </ol>
      </small>
    </div>
  </div>

  <div class="second-container">
    <table>
      <thead>
        <tr>
          <th class="px-5">ROUTES</th>
          <th>Regular Fare</th>
          <th>Student Fare, Senior Citizen & PWD 20% (Discount)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($second_container_data as $row): ?>
          <tr>
            <td><?php echo $row->barangay; ?></td>
            <td><?php echo $row->regular_fare; ?></td>
            <td><?php echo $row->discounted_fare; ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="mt-4">
      <small>
        <p class="fw-bold text-start">Penal Provisions:</p>
        <ol class="text-justify">
          <li>Refusal to accept passenger w/out valid reason - ₱800.00</li>
          <li>Overcharging beyond the Taripa Fare - ₱800.00</li>
          <li>Failure to render passenger/trip cutting - ₱800.00</li>
          <li>Overloading/Unsafe cargoes - ₱800.00</li>
          <li>Overloading of Passenger (more than 6 passengers) - ₱800.00</li>
          <li>Non displaying of Taripa, Driver's ID, Mayor's Permit & Franchise - ₱800.00</li>
          <li>Out line of operation - ₱800.00</li>
          <li>Wearing of Shorts, Sleeveless shirt & Slippers while driving - ₱400.00</li>
          <li>Smoking while driving - ₱400.00</li>
        </ol>
      </small>
    </div>
  </div>
</div>