<?php
$current_page = $_SERVER['REQUEST_URI'];
$current_page_is_maintenance = strpos($current_page, 'taripa') !== false || strpos($current_page, 'maintenance_regulation_tracker') !== false || strpos($current_page, 'export') !== false;

$profilePhoto = $_SESSION['USER']->uploaded_profile_photo_path ?: $_SESSION['USER']->generated_profile_photo_path;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SAKAYCLE | A Web-based Tricycle Management</title>
  <link rel="icon" href="public/assets/images/logo.png" type="image/x-icon">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->

  <!-- OFFLINE CSS -->
  <link rel="stylesheet" href="public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/assets/fontawesome/css/all.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="public/assets/DataTables/css/bootstrap.min.css">
  <link rel="stylesheet" href="public/assets/DataTables/css/bootstrap5.min.css">
  <link rel="stylesheet" href="public/assets/css/flash_messages.css">
  {{css}}

  <!-- OFFLINE JS -->
  <script src="public/assets/bootstrap/js/jquery.min.js"></script>
  <script src="public/assets/bootstrap/js/popper.min.js"></script>
  <script src="public/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="public/assets/DataTables/js/jquery-3.7.0.js"></script>
  <script src="public/assets/DataTables/js/js_jquery.dataTables.min.js"></script>
  <script src="public/assets/DataTables/js/js_dataTables.bootstrap5.min.js"></script>
  <script src="public/assets/DataTables/js/datatableInitializer.js"></script>
  <script src="public/assets/js/flash_messages.js"></script>
  <script src="public/assets/js/password_toggle.js"></script>
  <script src="public/assets/js/tooltip.js"></script>
  <script src="public/assets/js/modal.js"></script>
  <script src="public/assets/js/modal_submission.js"></script>
  <script src="public/assets/js/active_links.js"></script>
</head>
<style>
  .pop_msg {
    font-size: 9px !important;
    letter-spacing: 0.8px !important;
    line-height: 10px !important;
    color: #f8632c !important;
    text-transform: uppercase !important;
    margin-top: 5px !important;
    margin-bottom: 10px !important;
    text-align: left;
  }

  .pdf-scrollable {
    overflow-y: auto;
    max-height: 80vh;
  }

  .error-field {
    border-color: red;
  }
</style>
<body>
  <?php
    checkInactivityTimeout();
    display_flash_message();
  ?>

  <div class="flash-message success" id="flashMessage" style="display: none; width: 200px;"></div>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar">
          <div class="position-sticky">
            <div class="mt-auto">
              <div class="dropdown">
                <div class="dropdown-toggle" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <div class="profile-center">
                    <img src="<?= $profilePhoto ?>" alt="Profile Photo" class="rounded-circle profile-photo">
                    <p class="profile-name text-uppercase"><?= $firstName ?></p>
                    <!-- <i id="profileIcon" class="fa-solid fa-angle-right fa-xs dropdown-fa" style="color: #ffffff;"></i> -->
                  </div>      
                </div>
                <ul class="dropdown-menu shadow" aria-labelledby="accountDropdown">
                  <li><h6 class="dropdown-header text-white text-start fs-6">Manage Account</h6></li>
                  <li><a class="dropdown-item  mt-2" href="manage_account"><i class="fa-solid fa-gear"></i>Profile</a></li>
                  <li><a class="dropdown-item  mt-2" href="notification"><i class="fa-solid fa-bell"></i>Notifications</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form action="<?= ROOT ?>/sign_out" method="post" id="sign-out-form">
                      <input type="hidden" name="sign_out" value="1">
                      <a href="#" class="dropdown-item mb-2" onclick="event.preventDefault(); document.getElementById('sign-out-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>Log Out
                        </a>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
            <hr>
            <ul class="nav flex-column justify-content-evenly">
              <li class="nav-item">
                <a href="home" class="nav-link text-white"><i class="fa-solid fa-house"></i><span class="ms-2">Home</span></a>
              </li>
              <li class="nav-item">
                <a href="dashboard" class="nav-link text-white"><i class="fa-solid fa-list"></i><span class="ms-2">Dashboard</span></a>
              </li>
              <?php if ($userRole === 'operator') { ?>
                <li class="nav-item">
                  <a class="nav-link text-white" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="drivers"><i class="fa-regular fa-id-card"></i><span class="ms-2">Drivers</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="appointments"><i class="fa-solid fa-calendar-days"></i><span class="ms-2">Appointments</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="maintenance_log"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-2">Maintenance Logs</span></a>
                </li>
              <?php } elseif ($userRole === 'admin') { ?>
                <li class="nav-item">
                  <a class="nav-link text-white" href="operators"><i class="fa-regular fa-id-card"></i><span class="ms-2">Operators</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="appointments"><i class="fa-solid fa-calendar-days"></i><span class="ms-2">Appointment Approval</span></a>
                </li>
                <li class="nav-item" id="maintenanceDropdown">
                  <a class="nav-link text-white d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#maintenanceSubMenu" aria-expanded="false" aria-controls="maintenanceSubMenu"><i class="fa-solid fa-screwdriver-wrench text-white"></i><span class="ms-2 text-white">Maintenance</span><i id="maintenanceIcon" class="fa-solid fa-angle-right fa-xs maintenance-fa" style="color: #ffffff;"></i></a>
                  <ul id="maintenanceSubMenu" class="nav flex-column ms-4 collapse rounded bg-warning <?php if ($current_page_is_maintenance) echo 'show'; ?>">
                  <div>
                      <li class="nav-item mt-2 pt-1 px-2">
                        <a class="nav-link text-white fw-bold" href="taripa">Taripa</a>
                      </li>
                      <li class="nav-item mb-2 pb-1 px-2">
                        <a class="nav-link text-white fw-bold" href="export">Export</a>
                      </li>
                  </div>
                  </ul>     
                </li>
              <?php } ?>
            </ul><br><br>
          </nav>
        </div>
        <div class="flex-grow-1"></div>
        <br>
        {{content}}
      </div>
    </div>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->
</body>

  <script>
    // Add an event listener to the account dropdown toggle
    document.getElementById('accountDropdown').addEventListener('click', function() {
      var icon = document.getElementById('profileIcon');
      icon.classList.toggle('rotated');
    });

    // Add an event listener to the maintenance dropdown toggle
    document.getElementById('maintenanceDropdown').addEventListener('click', function() {
      var icon = document.getElementById('maintenanceIcon');
      icon.classList.toggle('rotateMaintenance');
    });

    // Add an event listener to the maintenance links
    var maintenanceLinks = document.querySelectorAll('#maintenanceSubMenu a');
    maintenanceLinks.forEach(function(link) {
      link.addEventListener('click', function() {
        var icon = document.getElementById('maintenanceIcon');
        icon.classList.toggle('rotateMaintenance');
      });
    });
  </script>
</html>