<div class="sidebar">
  <div class="d-flex flex-column h-100">
    <div class="logo-container">
      <div class="d-flex align-items-center">
        <a href="<?=ROOT?>" class="d-flex align-items-center">
          <img src="<?=ROOT?>/assets/images/logo.png" alt="Sakaycle Logo" class="logo-image">
          <h3 class="ml-2 logo-text">Sakay<span>cle</span></h3>
        </a>
      </div>
    </div>
    <hr>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="<?=ROOT?>"><i class="fa-solid fa-house"></i><span class="ms-3">Home</span></a>
      </li>
      <li class="nav-item">
        <a href="dashboard" class="nav-link"><i class="fa-solid fa-list"></i><span class="ms-3">Dashboard</span></a>
      </li>
      
      <?php if ($user_role === 'operator') { ?>
      <li class="nav-item">
        <a class="nav-link" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-3">Tricycles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="drivers"><i class="fa-regular fa-id-card"></i><span class="ms-3">Drivers</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documents"><i class="fa-solid fa-folder"></i><span class="ms-3">Documents</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="appointment"><i class="fa-solid fa-calendar-days"></i><span class="ms-3">Appointments</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="maintenance_log"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-3">Maintenance Logs</span></a>
      </li>

      <?php } elseif ($user_role === 'admin') { ?>
      <li class="nav-item">
        <a class="nav-link" href="operator"><i class="fa-regular fa-id-card"></i><span class="ms-3">Operators</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-3">Tricycles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="registration_approval"><i class="fa-solid fa-person-circle-check"></i><span class="ms-3">Registration Applications</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="appointment"><i class="fa-solid fa-calendar-days"></i><span class="ms-3">Appointment Approval</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="maintenance_log"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-3">Maintenance Log Monitoring</span></a>
      </li>
      <?php } ?>
    </ul>

    <div class="mt-auto">
      <div class="dropdown">
        <button class="btn color dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          <?= $first_name ?> &nbsp;
          <i class="fa-solid fa-caret-up"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
    </div>
  </div>
</div>