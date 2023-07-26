<?php
$current_page = $_SERVER['REQUEST_URI'];
$current_page_is_maintenance = strpos($current_page, 'taripa') !== false || strpos($current_page, 'maintenance_regulation_tracker') !== false || strpos($current_page, 'export') !== false;
?>

<nav class="col-md-3 col-lg-2 d-md-block sidebar">
  <div class="position-sticky">
    <div class="text-center mb-3 logo-container">
      <a href="dashboard" class="d-flex align-items-center">
        <img src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo" class="logo-image">
        <h3 class="logo-text">Sakay<span>cle</span></h3>
      </a>
    </div><hr>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="dashboard" class="nav-link"><i class="fa-solid fa-list"></i><span class="ms-2">Dashboard</span></a>
      </li>
      <?php if ($user_role === 'operator') { ?>
      <li class="nav-item">
        <a class="nav-link" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="drivers"><i class="fa-regular fa-id-card"></i><span class="ms-2">Drivers</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documents"><i class="fa-solid fa-folder"></i><span class="ms-2">Documents</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="appointment"><i class="fa-solid fa-calendar-days"></i><span class="ms-2">Appointments</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="maintenance_log"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-2">Maintenance Logs</span></a>
      </li>
      <?php } elseif ($user_role === 'admin') { ?>
      <li class="nav-item">
        <a class="nav-link" href="operator"><i class="fa-regular fa-id-card"></i><span class="ms-2">Operators</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registration_approval"><i class="fa-solid fa-person-circle-check"></i><span class="ms-2">Registration Applications</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="appointment"><i class="fa-solid fa-calendar-days"></i><span class="ms-2">Appointment Approval</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#maintenanceSubMenu" aria-expanded="false" aria-controls="maintenanceSubMenu"><i class="fa-solid fa-screwdriver-wrench text-white"></i><span class="ms-2 text-white">Maintenance</span></a>
        <ul id="maintenanceSubMenu" class="nav flex-column ms-4 collapse <?php if ($current_page_is_maintenance) echo 'show'; ?>">
          <li class="nav-item my-2">
            <a class="nav-link" href="taripa">Taripa</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link" href="#">Export</a>
          </li>
          <li class="nav-item mb-2">
            <a class="nav-link" href="#">Sample</a>
          </li>
        </ul>
      </li>
      <?php } ?>
    </ul><br><br>
  </div>
  <div class="flex-grow-1"></div>
  <div class="mt-auto">
    <div class="dropdown">
      <button class="btn color dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <?= $firstName ?> &nbsp;
        <i class="fa-solid fa-caret-up"></i>
      </button>
      <ul class="dropdown-menu" aria-labelledby="accountDropdown">
        <li><a class="dropdown-item" href="javascript:void(0)" id="manage_account_link"><i class="fa-solid fa-gear"></i>Account</a></li>
        <li>
          <form action="<?= ROOT ?>/sign_out" method="post" id="sign-out-form">
            <input type="hidden" name="sign_out" value="1">
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
              <i class="fa-solid fa-right-from-bracket"></i>Logout
              </a>
          </form>
        </li>
      </ul>
    </div>
  </div><br>
</nav>