<?php
$current_page = $_SERVER['REQUEST_URI'];
$current_page_is_maintenance = strpos($current_page, 'appointments_reports') !== false || strpos($current_page, 'cin_reports') !== false || strpos($current_page, 'tricycles_reports') !== false;

$isCurrentPageInquiries = (basename($current_page) == 'inquiries' || isset($_GET['message_status']) || isset($_GET['response_status']));

$current_page_basename = basename(parse_url($current_page, PHP_URL_PATH));
$status_param_exists = isset($_GET['status']);

$isCurrentPageAppointments = (
  strpos($current_page_basename, 'appointments') !== false ||
  strpos($current_page_basename, 'view_appointment') !== false ||
  strpos($current_page_basename, 'edit_appointment') !== false ||
  strpos($current_page_basename, 'new_appointment') !== false ||
  strpos($current_page_basename, 'new_franchise') !== false ||
  strpos($current_page_basename, 'edit_new_franchise') !== false ||
  strpos($current_page_basename, 'renewal_of_franchise') !== false ||
  strpos($current_page_basename, 'edit_renewal_of_franchise') !== false ||
  strpos($current_page_basename, 'change_of_motorcycle') !== false ||
  strpos($current_page_basename, 'edit_change_of_motorcycle') !== false ||
  strpos($current_page_basename, 'transfer_of_ownership') !== false ||
  strpos($current_page_basename, 'edit_transfer_of_ownership') !== false ||
  strpos($current_page_basename, 'intent_of_transfer') !== false ||
  strpos($current_page_basename, 'edit_intent_of_transfer') !== false ||
  strpos($current_page_basename, 'ownership_transfer_from_deceased_owner') !== false ||
  strpos($current_page_basename, 'edit_ownership_transfer_from_deceased_owner') !== false 
) || $status_param_exists;

$profilePhoto = $_SESSION['USER']->uploaded_profile_photo_path ?: $_SESSION['USER']->generated_profile_photo_path;

$inquiryModel = new Inquiry();
$appointmentModel = new Appointment();

$unreadInquiriesCount = $inquiryModel->count(['message_status' => 'unread']);

if ($userRole === 'operator') {
  // Get the count of pending appointments for the current operator
  $pendingAppointmentsCount = method_exists($appointmentModel, 'count') ? $appointmentModel->count([
    'user_id' => $_SESSION['USER']->user_id,
    'status' => 'pending'
  ]) : 0;

  // Get the count of all pending appointments for admin or operator that have permissions
  $pendingAdminAppointmentsCount = method_exists($appointmentModel, 'count') ? $appointmentModel->count(['status' => 'pending']) : 0;
} elseif ($userRole === 'admin' || $userRole === 'personnel') {
  // Get the count of all pending appointments for admin
  $pendingAppointmentsCount = method_exists($appointmentModel, 'count') ? $appointmentModel->count(['status' => 'pending']) : 0;
}

$tricycleModel = new TricycleCinNumber();
$usedCINs = $tricycleModel->where(['is_used' => true]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>OTOFA | Ormoc Tricycle Online Franchise Appointment</title>
  <link rel="icon" href="public/assets/images/icon-logo.png" type="image/x-icon">
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

  <!-- FullCalendar.io CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" rel="stylesheet" />

  <!-- OFFLINE & ONLINE JS -->

  <!-- GSAP -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>

  <!-- ScrollMagic -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/debug.addIndicators.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.8/purify.min.js" integrity="sha512-5g2Nj3mqLOgClHi20oat1COW7jWvf7SyqnvwWUsMDwhjHeqeTl0C+uzjucLweruQxHbhDwiPLXlm8HBO0011pA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <!-- FullCalendar.io JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
</head>
<style>
   .collapsible {
    cursor: pointer;
    padding: 5px 15px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    box-shadow: 2px 4px 8px gray;
    text-align: left;
    outline: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #8dd06c;
    margin-bottom: 10px;
    border-radius: 10px;
  }

  .collapsible:hover {
    border: 1px solid #8dd06c;
    background-color: white;
  }

  .collapsible.active {
    background-color: #008A2E !important;
    color: white !important;
  }

  .collapsible-active-button {
    background-color: #008A2E !important;
    color: white !important;
  }

  .collapsible-inactive-button {
    background-color: #8dd06c;
    color: black;
  }

  .collapsible i {
    margin-left: auto;
  }

  .collapsible p {
    margin: 0;
  }

  .collapsible .icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
  }

  .content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
  }
  .content-form:first-child {
    display: block;
  }

  .active-content {
    display: block;
  }

  .collapsible-active {
    background-color: #008A2E;
    color: white;
  }

  /* --------------------------------------------- */

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

  div.tricycle-status-selection-modal input, div.tricycle-status-disabled-modal input {
    display: none;
  }

  div.tricycle-status-selection-modal label {
    cursor: pointer;
    padding: 10px 14px;
    display: block;
    background-color: #EBB803;
    border: 2px solid black;
    border-radius: 5px;
    margin-bottom: 8px;
    color: black;
    font-weight: 600;
    transition: background-color 0.2s ease-in-out;
  }

  div.tricycle-status-disabled-modal label {
    cursor: pointer;
    padding: 10px 14px;
    display: block;
    background-color: #999;
    border: 2px solid black;
    border-radius: 5px;
    margin-bottom: 8px;
    color: black;
    font-weight: 600;
    transition: background-color 0.2s ease-in-out;
  }

  div.tricycle-status-selection-modal:hover label {
    background-color: #ff4400;
    color: white;
  }

  div.tricycle-status-selection-modal input:checked + label {
    box-shadow: none;
    background-color: #ff4400;
    color: white;
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
                  <!-- <li><a class="dropdown-item  mt-2" href="notification"><i class="fa-solid fa-bell"></i>Notifications</a></li> -->
                  <!-- <li><hr class="dropdown-divider"></li> -->
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
                <?php
                  // Check if the user has a CIN number
                  $cinModel = new TricycleCinNumber();
                  $userHasCin = $cinModel->getCinNumberIdByUserId($_SESSION['USER']->user_id) !== null;
                ?>
                <?php if ($userHasCin) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="drivers"><i class="fa-regular fa-id-card"></i><span class="ms-2">Drivers</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="maintenance_logs"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-2">Maintenance Logs</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="maintenance_tracker"><i class="fa-solid fa-magnifying-glass-chart"></i></i><span class="ms-2">Maintenance Tracker</span></a>
                  </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link text-white" href="taripa"><i class="fa-solid fa-peso-sign"></i><span class="ms-2">Taripa</span></a>
                </li>

                <!-- OPTIONAL IF OPERATOR HAVE THE PERMISSIONS -->
                <?php if (hasPermission('Can create and edit users', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="users">
                      <i class="fas fa-users"></i>
                      <span class="ms-2">Users</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view and respond to inquiries', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="inquiries">
                      <i class="fas fa-envelope"></i>
                      <span class="ms-2">Inquiries</span>
                      <?php if ($unreadInquiriesCount > 0) { echo "<span class='badge ms-auto " . ($isCurrentPageInquiries ? 'bg-warning' : 'bg-danger') . "'>$unreadInquiriesCount</span>"; } ?>
                    </a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view list of operators', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="operators"><i class="fa-regular fa-id-card"></i><span class="ms-2">Operators</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view and update tricycle statuses', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
                  </li>
                <?php } ?>
                <?php
                  // Check if the user has at least one of the specified permissions
                  if (hasAnyPermission(['Can approve appointments', 'Can decline appointments', 'Can on process appointments', 'Can completed appointments'], $permissions)) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="appointments">
                      <i class="fa-solid fa-calendar-days me-2"></i>
                      <span>Appointment Approval</span>                    
                      <?php if ($pendingAdminAppointmentsCount > 0) { echo "<span class='badge ms-auto p-1 count-badge " . ($isCurrentPageAppointments ? 'bg-warning' : 'bg-danger') . "'>$pendingAdminAppointmentsCount</span>"; } ?>
                    </a>
                  </li>
                <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="appointments">
                      <i class="fa-solid fa-calendar-days"></i>
                      <span class="ms-2">Appointments</span>
                      <?php if ($pendingAppointmentsCount > 0) { echo "<span class='badge ms-auto " . ($isCurrentPageAppointments ? 'bg-warning' : 'bg-danger') . "'>$pendingAppointmentsCount</span>"; } ?>
                    </a>
                  </li>
                <?php }?>
                <?php if (hasPermission('Can view taripas', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="taripa"><i class="fa-solid fa-peso-sign"></i><span class="ms-2">Taripa</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view maintenance tracker', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="maintenance_tracker"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-2">Maintenance Tracker</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can manage CIN (Increase or Decrease)', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="cin_management"><i class="fas fa-cogs"></i><span class="ms-2">CIN Management</span>
                  </a>
                  </li>
                <?php } ?>
                <?php
                  // Check if the user has at least one of the specified permissions
                  if (hasAnyPermission(['Can view appointments reports', 'Can view tricycles reports', 'Can view cin reports'], $permissions)) {
                ?>
                  <li class="nav-item" id="maintenanceDropdown">
                    <a class="nav-link text-white d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#maintenanceSubMenu" aria-expanded="false" aria-controls="maintenanceSubMenu"><i class="fa-solid fa-file text-white"></i><span class="ms-2 text-white">Reports</span><i id="maintenanceIcon" class="fa-solid fa-angle-right fa-xs maintenance-fa" style="color: #ffffff;"></i></a>
                    <ul id="maintenanceSubMenu" class="nav flex-column ms-4 collapse rounded bg-warning <?php if ($current_page_is_maintenance) echo 'show'; ?>">
                    <div>
                      <?php if (hasPermission('Can view appointments reports', $permissions)) { ?>
                        <li class="nav-item mt-2 pt-1 px-2 mb-1">
                          <a class="nav-link text-white fw-bold reports" style="font-size: 11px;" href="appointments_reports">Appointments Reports</a>
                        </li>
                      <?php } ?>
                      <?php if (hasPermission('Can view tricycles reports', $permissions)) { ?>
                        <li class="nav-item pb-1 px-2">
                          <a class="nav-link text-white fw-bold" style="font-size: 11px; margin-bottom: 5px;" href="tricycles_reports">Tricycles Reports</a>
                        </li>
                      <?php } ?>
                      <?php if (!empty($usedCINs) && hasPermission('Can view cin reports', $permissions)) { ?>
                        <li class="nav-item mb-2 pb-1 px-2">
                          <a class="nav-link text-white fw-bold" style="font-size: 11px; margin-bottom: 5px;" href="cin_reports">CIN Reports</a>
                        </li>
                      <?php } ?>
                    </div>
                    </ul>     
                  </li>
                <?php } ?>

              <!-- add condition of permissions here that user will be able to access a certain page when they have permissions for it -->
              <?php } elseif ($userRole === 'admin' || $userRole === 'personnel') { ?>
                <?php if (hasPermission('Can create and edit users', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="users">
                      <i class="fas fa-users"></i>
                      <span class="ms-2">Users</span>
                    </a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view and respond to inquiries', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="inquiries">
                      <i class="fas fa-envelope"></i>
                      <span class="ms-2">Inquiries</span>
                      <?php if ($unreadInquiriesCount > 0) { echo "<span class='badge count-badge ms-auto " . ($isCurrentPageInquiries ? 'count-badge' : 'count-badge') . "'>$unreadInquiriesCount</span>"; } ?>
                    </a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view list of operators', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="operators"><i class="fa-regular fa-id-card"></i><span class="ms-2">Operators</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view and update tricycle statuses', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="tricycles"><i class="fa-solid fa-truck-pickup"></i><span class="ms-2">Tricycles</span></a>
                  </li>
                <?php } ?>
                <?php
                  // Check if the user has at least one of the specified permissions
                  if (hasAnyPermission(['Can approve appointments', 'Can decline appointments', 'Can on process appointments', 'Can completed appointments'], $permissions)) {
                ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="appointments">
                      <i class="fa-solid fa-calendar-days me-2"></i>
                      <span>Appointment Approval</span>                    
                      <?php if ($pendingAppointmentsCount > 0) { echo "<span class='badge count-badge ms-auto p-1 " . ($isCurrentPageAppointments ? 'count-badge' : 'count-badge') . "'>$pendingAppointmentsCount</span>"; } ?>
                    </a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view taripas', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="taripa"><i class="fa-solid fa-peso-sign"></i><span class="ms-2">Taripa</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can view maintenance tracker', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="maintenance_tracker"><i class="fa-solid fa-screwdriver-wrench"></i><span class="ms-2">Maintenance Tracker</span></a>
                  </li>
                <?php } ?>
                <?php if (hasPermission('Can manage CIN (Increase or Decrease)', $permissions)) { ?>
                  <li class="nav-item">
                    <a class="nav-link text-white" href="cin_management"><i class="fas fa-cogs"></i><span class="ms-2">CIN Management</span>
                  </a>
                  </li>
                <?php } ?>
                <?php
                  // Check if the user has at least one of the specified permissions
                  if (hasAnyPermission(['Can view appointments reports', 'Can view tricycles reports', 'Can view cin reports'], $permissions)) {
                ?>
                  <li class="nav-item" id="maintenanceDropdown">
                    <a class="nav-link text-white d-flex" href="#" data-bs-toggle="collapse" data-bs-target="#maintenanceSubMenu" aria-expanded="false" aria-controls="maintenanceSubMenu"><i class="fa-solid fa-file text-white"></i><span class="ms-2 text-white">Reports</span><i id="maintenanceIcon" class="fa-solid fa-angle-right fa-xs maintenance-fa" style="color: #ffffff;"></i></a>
                    <ul id="maintenanceSubMenu" class="nav flex-column ms-4 collapse rounded bg-warning <?php if ($current_page_is_maintenance) echo 'show'; ?>">
                    <div>
                      <?php if (hasPermission('Can view appointments reports', $permissions)) { ?>
                        <li class="nav-item mt-2 pt-1 px-2 mb-1">
                          <a class="nav-link text-white fw-bold reports" style="font-size: 11px;" href="appointments_reports">Appointments Reports</a>
                        </li>
                      <?php } ?>
                      <?php if (hasPermission('Can view tricycles reports', $permissions)) { ?>
                        <li class="nav-item pb-1 px-2">
                          <a class="nav-link text-white fw-bold" style="font-size: 11px; margin-bottom: 5px;" href="tricycles_reports">Tricycles Reports</a>
                        </li>
                      <?php } ?>
                      <?php if (!empty($usedCINs) && hasPermission('Can view cin reports', $permissions)) { ?>
                        <li class="nav-item mb-2 pb-1 px-2">
                          <a class="nav-link text-white fw-bold" style="font-size: 11px; margin-bottom: 5px;" href="cin_reports">CIN Reports</a>
                        </li>
                      <?php } ?>
                    </div>
                    </ul>     
                  </li>
                <?php } ?>
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
  document.addEventListener('DOMContentLoaded', function() {
    // Add an event listener to the account dropdown toggle
    var accountDropdown = document.getElementById('accountDropdown');
    if (accountDropdown) {
      accountDropdown.addEventListener('click', function() {
        var icon = document.getElementById('profileIcon');
        if (icon) {
          icon.classList.toggle('rotated');
        }
      });
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
  // Add an event listener to the maintenance dropdown toggle
    var maintenanceDropdown = document.getElementById('maintenanceDropdown');
    if (maintenanceDropdown) {
      maintenanceDropdown.addEventListener('click', function() {
        var icon = document.getElementById('maintenanceIcon');
        if (icon) {
          icon.classList.toggle('rotateMaintenance');
        }
      });
    }
  });

  // Add an event listener to the maintenance links
  var maintenanceLinks = document.querySelectorAll('#maintenanceSubMenu a');
  maintenanceLinks.forEach(function(link) {
    link.addEventListener('click', function() {
      var icon = document.getElementById('maintenanceIcon');
      icon.classList.toggle('rotateMaintenance');
    });
  });

  $(document).ready(function() {
    // Handle hover state
    $('.nav-item').hover(
      function() {
        var badge = $(this).find('.badge');
        if (badge) {
          badge.css('background-color', 'yellow');
          badge.css('color', 'black');
        }
      },
      function() {
        var badge = $(this).find('.badge');
        if (badge) {
          badge.css('background-color', '');
          badge.css('color', '');
        }
      }
    );

    // Handle active state
    $('.nav-item').click(function() {
      $('.nav-item').removeClass('focus');
      $(this).addClass('focus');
    });
  });
</script>
</html>