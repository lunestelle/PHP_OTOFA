<style>
  .logos {
    width: 80px;
    height: 80px;
  }
  h1 {
    letter-spacing: 7px;
    margin-top: 30px;
    font-weight: 800;
  }
  .taripa-date {
    letter-spacing: 3px;
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
  .powered-by {
    position: absolute;
    bottom: 10px;
    left: 0;
    font-size: 12px;
  }
  .powered-by img {
    width: 200px;
  }
  .customer-service {
    font-size: 12px;
  }
  .customer-service .contacts {
    line-height: 2px;
  }

</style>
<div class="d-flex justify-content-center">
  <div class="col-2 logos d-flex mt-2 text-center">
    <img src="public/assets/images/oc_logo.png" alt="">
  </div>
  <div class="col-10 text-center">
    <span class="p-1" style="letter-spacing: 2px;">TRANSPORTATION DEVELOPMENT FRANCHISING AND REGULATORY OFFICE</span>
    <h1 class="m-0 p-0">TRICYCLE TARIPA <?php echo date('Y', strtotime($effective_date)); ?></h1>
    <p class="taripa-date">City Ordinance No. 121 S. <?php echo date('Y', strtotime($effective_date)); ?> (Effective Date: <?php echo $effective_date; ?>)</p>
  </div>
  <div class="col-2 logos d-flex mt-2 text-center">
    <img src="public/assets/images/tdfro-logo.jpg" alt="">
  </div>
</div>

<div class="d-flex">
  <div class="first-container">
    <table>
      <thead>
        <tr>
          <th>ROUTES</th>
          <th>Regular Fare</th>
          <th>20% (Discount)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($first_container_data as $row): ?>
          <tr>
            <td><?php echo $row['barangay']; ?></td>
            <td><?php echo number_format($row['regular_fare'], 2); ?></td>
            <td><?php echo number_format($row['discounted_fare'], 2); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="mt-4">
      <small>
        <p class="fw-bold text-start">Additional Fare:</p>
        <ol class="text-justify">
          <li>Children with a height of one meter(1 meter) and above shall pay the corresponding fare.</li>
          <li>Additional of <span class="fw-bold">P5.00</span> on top of regular fare for special trips (those entering private subdivision and private properties)</li>
          <li>Addtional of <span class="fw-bold">P5.00</span> on top of regular fare for night trips between 9:00 pm to 5:00 am within the 2.5km radius. (Brgy North, South, East, West, Alegria, Bantigue, Camp Downes, Can-adieng, Cogon, Don-Felipe Larrazabal, Linao, Punta & Toog)</li>
          <li>Addtional of <span class="fw-bold">P10.00</span> on top of regular fare for night trips between 9:00 pm to 5:00 am outside the 2.5k radius (For Brgys. not mention above)</li>
        </ol>
      </small>
      <div class="powered-by">
        <div>
          <p class="text-start fw-bold">Powered By:</p>
        </div>
        <img class="logo-home" src="public/assets/images/logo-email.png" alt="OTOFA Logo">
      </div>
    </div>
  </div>

  <div class="second-container">
    <table>
      <thead>
        <tr>
          <th>ROUTES</th>
          <th>Regular Fare</th>
          <th>20% (Discount)</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($second_container_data as $row): ?>
          <tr>
            <td><?php echo $row['barangay']; ?></td>
            <td><?php echo number_format($row['regular_fare'], 2); ?></td>
            <td><?php echo number_format($row['discounted_fare'], 2); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <div class="mt-2">
      <i>***20% discount for Senior Citizen, Student and PWD</i>
      <small>
        <p class="fw-bold text-start mt-3">Penal Provisions:</p>
        <ol class="text-justify">
          <li>Refusal to accept passenger w/out valid reason - <span class="fw-bold">P800.00</span></li>
          <li>Overcharging beyond the Taripa Fare - <span class="fw-bold">P800.00</span></li>
          <li>Failure to render passenger/trip cutting - <span class="fw-bold">P800.00</span></li>
          <li>Overloading/Unsafe cargoes - <span class="fw-bold">P800.00</span></li>
          <li>Overloading of Passenger (more than 6 passengers) - <span class="fw-bold">P800.00</span></li>
          <li>Non displaying of Taripa, Driver's ID, Mayor's Permit & Franchise - <span class="fw-bold">P800.00</span></li>
          <li>Out line of operation - <span class="fw-bold">P800.00</span></li>
          <li>Wearing of Shorts, Sleeveless shirt & Slippers while driving - <span class="fw-bold">P400.00</span></li>
          <li>Smoking while driving - <span class="fw-bold">P400.00</span></li>
        </ol>
      </small>
    </div>
    <div class="customer-service mt-5">
        <p class="text-uppercase text-start fw-bold">TDFRO <span class="p-1">Customer<span> <span class="p-1">Service</span> <span class="p-1">Contacts:</span></p>
        <div class="text-start contacts">
          <p>Tel. No.: (053) 255-7395 / 560-8140 local 1072</p>
          <p>Mobile No.: 09955755468</p>
          <p>Visit: https://www.wlccicte.com/otofa.com/</p>
        </div>
      </div>
  </div>
</div>