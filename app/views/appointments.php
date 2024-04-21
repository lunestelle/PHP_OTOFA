<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Appointments</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <?php if ($userRole === 'operator'): ?>  
          <div class="col-12">
            <div class="mt-3">
              <form method="post" action="">
                <button type="submit" name="newAppointment" class="text-uppercase sidebar-btnContent mt-1 new-button">New</button>
              </form>
            </div>
            <?php if (!empty($appointments)): ?>
              <div class="mt-3 text-end">
                <form method="post" action="">
                  <button type="submit" id="exportCsv" name="exportCsv" style="border: none; background: none; padding: 0; margin: 0;">
                    <img src="public/assets/images/export-csv.png" style="height: 38px; width: 40px; position: absolute; top: 5px; right: 100px;" alt="export file">
                  </button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php elseif ($userRole === 'admin'): ?>
          <div class="col-12">
            <?php if (!empty($appointments)): ?>
              <div class="mt-3 text-end">
                <form method="post" action="">
                  <button type="submit" id="exportCsv" name="exportCsv" style="border: none; background: none; padding: 0; margin: 0;">
                    <img src="public/assets/images/export-csv.png" style="height: 38px; width: 40px; position: absolute; top: 5px; right: 35px;" alt="export file">
                  </button>
                </form>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <div class="col-12 mt-1">
          <form method="get" action="">
            <div class="row">
              <div class="col-md-3">
                <label for="startDate" class="fw-bold" style="font-size: 13px;">Start Date:</label>
                <input type="date" id="startDate" name="startDate" class="form-control" style="height: 35px; font-size: 14px;" value="<?php echo ($_GET['startDate'] ?? ''); ?>">
              </div>
              <div class="col-md-3">
                <label for="endDate" class="fw-bold" style="font-size: 13px;">End Date:</label>
                <input type="date" id="endDate" name="endDate" class="form-control"  style="height: 35px; font-size: 14px;" value="<?php echo ($_GET['endDate'] ?? ''); ?>">
              </div>

              <div class="col-md-4">
                <label for="statusFilter" class="fw-bold" style="font-size: 13px;">Filter By Status:</label>
                <select id="statusFilter" class="form-select" style="height: 35px; font-size: 14px;">
                  <option value="all" <?php echo ($statusFilter === 'all') ? 'selected' : ''; ?>>All</option>
                  <option value="Pending" <?php echo ($statusFilter === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                  <option value="Approved" <?php echo ($statusFilter === 'Approved') ? 'selected' : ''; ?>>Approved</option>
                  <option value="Declined" <?php echo ($statusFilter === 'Declined') ? 'selected' : ''; ?>>Declined</option>
                  <option value="On Process" <?php echo ($statusFilter === 'On Process') ? 'selected' : ''; ?>>On Process</option>
                  <option value="Completed" <?php echo ($statusFilter === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
              </div>
              <div class="col-md-2">
                <button type="submit" class="filter-btn mt-4" id="applyFilter">Filter</button>
              </div>
            </div>
          </form>
        </div>

        <div class="col-12">
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Name</th>
                  <th scope="col" class="text-center">Phone Number</th>
                  <th scope="col" class="text-center">Email</th>
                  <th scope="col" class="text-center">Appointment Type</th>
                  <th scope="col" class="text-center">Date</th>
                  <th scope="col" class="text-center">Time</th>
                  <th scope="col" class="text-center">Status</th>
                  <th scope="col" class="text-center">Actions</th>
                  <?php if ($userRole === 'admin'): ?>
                    <th scope="col" class="m-0 text-center"></th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody class="text-center">
                <?php foreach ($appointments as $appointment): ?>
                  <?php
                    $appointmentDate = new DateTime($appointment['appointment_date']);
                    $currentDate = new DateTime();
                    $oneDayAhead = $currentDate->diff($appointmentDate)->days === 1;
                  ?>
                  <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $appointment['name']; ?></td>
                    <td><?php echo $appointment['phone_number']; ?></td>
                    <td><?php echo empty($appointment['email']) ? '----------------' : $appointment['email']; ?></td>
                    <td><?php echo $appointment['appointment_type']; ?></td>
                    <td><?php echo $appointment['appointment_date']; ?></td>
                    <td><?php echo $appointment['appointment_time']; ?></td>
                    <td>
                      <?php
                        $status = $appointment['status'];
                        $badgeColor = '';

                        switch ($status) {
                          case 'Pending':
                            $badgeColor = 'bg-dark'; // Green color for pending
                            break;
                          case 'Declined':
                            $badgeColor = 'bg-danger'; // Red color for declined
                            break;
                          case 'Completed':
                            $badgeColor = 'bg-warning text-dark'; // Blue color for completed
                            break;
                          case 'Approved':
                            $badgeColor = 'bg-success'; // Light blue color for approved
                            break;
                          case 'Cancelled':
                            $badgeColor = 'bg-danger'; // Red color for cancelled
                            break;
                          // Add cases for other statuses as needed
                          default:
                            $badgeColor = 'bg-secondary'; // Default color
                            break;
                        }
                      ?>
                      <span class="badge status-badge text-uppercase p-1 <?php echo $badgeColor; ?>"><?php echo $status; ?></span>
                    </td>
                    <td>
                      <a href="<?php echo ('view_appointment?appointment_id=') . $appointment['appointment_id']; ?>" class="view_data px-1 me-1 view-btn" title="View Appointment Details"><i class="fa-solid fa-file-lines fa-xl"></i></a>
                      <?php if ($userRole === 'operator' && $appointment['status'] === "Pending"): ?>
                        <?php
                          $editUrl = '';

                          if ($appointment['appointment_type'] === 'New Franchise') {
                              $editUrl = 'edit_new_franchise';
                          } elseif ($appointment['appointment_type'] === 'Renewal of Franchise') {
                              $editUrl = 'edit_renewal_of_franchise';
                          } elseif ($appointment['appointment_type'] === 'Change of Motorcycle') {
                              $editUrl = 'edit_change_of_motorcycle';
                          } elseif ($appointment['appointment_type'] === 'Transfer of Ownership') {
                              if ($appointment['transfer_type'] === 'None') {
                                  $editUrl = 'edit_transfer_of_ownership';
                              } elseif ($appointment['transfer_type'] === 'Intent of Transfer') {
                                  $editUrl = 'edit_intent_of_transfer';
                              } elseif ($appointment['transfer_type'] === 'Transfer of Ownership from Deceased Owner') {
                                  $editUrl = 'edit_ownership_transfer_from_deceased_owner';
                              }
                          }

                          echo '<a href="' . $editUrl . '?appointment_id=' . $appointment['appointment_id'] . '" class="edit_data px-1 me-1 edit-btn" title="Edit Appointment"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>';
                        ?>
                      <?php elseif (($appointment['status'] === "Pending" || $appointment['status'] === "Approved" || $appointment['status'] === "On Process") && hasAnyPermission(['Can approve appointments', 'Can decline appointments', 'Can on process appointments', 'Can completed appointments'], $permissions)): ?>
                        <?php
                          $editUrl = '';

                          if ($appointment['appointment_type'] === 'New Franchise') {
                              $editUrl = 'edit_new_franchise';
                          } elseif ($appointment['appointment_type'] === 'Renewal of Franchise') {
                              $editUrl = 'edit_renewal_of_franchise';
                          } elseif ($appointment['appointment_type'] === 'Change of Motorcycle') {
                              $editUrl = 'edit_change_of_motorcycle';
                          } elseif ($appointment['appointment_type'] === 'Transfer of Ownership') {
                              if ($appointment['transfer_type'] === 'None') {
                                $editUrl = 'edit_transfer_of_ownership';
                              } elseif ($appointment['transfer_type'] === 'Intent of Transfer') {
                                $editUrl = 'edit_intent_of_transfer';
                              } elseif ($appointment['transfer_type'] === 'Transfer of Ownership from Deceased Owner') {
                                $editUrl = 'edit_ownership_transfer_from_deceased_owner';
                              }
                          }

                          echo '<a href="' . $editUrl . '?appointment_id=' . $appointment['appointment_id'] . '" class="edit_data px-1 me-1 edit-btn" title="Edit Appointment"><i class="fa-solid fa-pen-to-square fa-xl"></i></a>';
                        ?>
                      <?php endif; ?>

                      <?php if ($userRole === 'operator' && $appointment['status'] === "Pending" && !$oneDayAhead): ?>
                        <a href="#" class="cancel_data px-1 me-1" style="color: red;" title="Cancel Appointment" data-bs-toggle="modal" data-bs-target="#cancelModal-<?php echo $appointment['appointment_id']; ?>">
                          <i class="fa-solid fa-times fa-xl"></i>
                        </a>
                      <?php endif; ?>
                    </td>
                    <?php if ($userRole === 'admin'): ?>
                      <td>
                        <button class="btn-print" data-appointmentId="<?php echo $appointment['appointment_id']; ?>" onclick="printAppointment(event)">Print</button>
                        <button id="downloadPdfButton" class="btn-download-pdf mt-1" data-appointmentId="<?php echo $appointment['appointment_id']; ?>" onclick="downloadPdf()">Download PDF</button>
                      </td>
                    <?php endif; ?>
                  </tr>
                  <!-- CANCEL APPOINTMENT MODAL for each appointment -->
                  <div class="modal fade" id="cancelModal-<?php echo $appointment['appointment_id']; ?>" tabindex="-1" aria-labelledby="cancelModalLabel-<?php echo $appointment['appointment_id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-0">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-title" id="cancelModalLabel-<?php echo $appointment['appointment_id']; ?>">
                          <h5 class="modal-title text-center mt-2">Cancel Appointment</h5>
                        </div>
                        <div class="modal-body mx-2 text-center">
                          <form id="cancelForm" action="<?php echo 'cancel_appointment?appointment_id=' . $appointment['appointment_id'] ?>" method="post">
                            <p>Are you sure you want to cancel the appointment for <span id="appointmentName"><?php echo $appointment['name']; ?></span> on <span id="appointmentDate"><?php echo date('F j, Y', strtotime($appointment['appointment_date'])); ?></span> at <span id="appointmentTime"><?php echo date('g:i A', strtotime($appointment['appointment_time'])); ?></span>?</p>
                            <input type="hidden" name="appointment_id" value="<?php echo $appointment['appointment_id']; ?>">
                            <input type="hidden" name="status" value="Cancelled">
                        </div>
                        <div class="modal-footer border-0 mb-2">
                          <button type="button" class="sidebar-btnContent" style="width: 100%; margin:auto; margin: 0 4px; padding: 8px;" data-bs-dismiss="modal">No, Keep Appointment</button>
                          <button type="submit" form="cancelForm" class="cancel-btn mt-1" style="width: 100%;  margin:auto; margin: 0 4px; padding: 8px;" id="cancelAppointmentModalButton" name="cancelAppointmentModalButton">Yes, Cancel Appointment</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function printAppointment(event) {
    // Create the iframe
    let printFrame = document.createElement('iframe');
    printFrame.style.position = 'fixed';
    printFrame.style.top = '-1000px';

    document.body.appendChild(printFrame);
    let appointmentId = event.currentTarget.getAttribute("data-appointmentId");

    $.ajax({
      url: 'print_content?appointment_id=' + appointmentId,
      type: 'GET',
      dataType: 'html',
      success: function(data) {
        // Set the content of the iframe's document
        let doc = printFrame.contentDocument || printFrame.contentWindow.document;
        doc.open();

        doc.write('<html><head><style>@media print { @page { size: legal !important; margin: 1.27cm; } body { color: black !important; } .label { display: inline-block; width: 150px; white-space: nowrap; } .form-input-line { border-bottom: 0.5px solid black; margin-top: 2px; width: calc(100% - 160px); display: inline-block; box-sizing: border-box; } }</style></head><body>');

        doc.write(data);
        doc.write('</body></html>');

        doc.close();

        // Wait for the iframe to load
        printFrame.onload = function() {
          // Focus on the iframe and print
          printFrame.contentWindow.focus();
          printFrame.contentWindow.print();

          // Remove the iframe after printing
          document.body.removeChild(printFrame);
        };
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.error('Error fetching print_content:', textStatus, errorThrown);
        document.body.removeChild(printFrame);
      }
    });
  }

  function downloadPdf() {
    let appointmentId = event.currentTarget.getAttribute("data-appointmentId");

    $.ajax({
      url: 'print_content?appointment_id=' + appointmentId,
      type: 'GET',
      dataType: 'html',
      success: function (data) {
        let styledData = '<html><head><style>body { color: black !important; } .label { display: inline-block; width: 150px; white-space: nowrap; } .form-input-line { border-bottom: 0.5px solid black; margin-top: 2px; width: calc(100% - 160px); display: inline-block; box-sizing: border-box; } .print-content { max-width: 100%; margin: 0; } .header-print { line-height: 3px; } .application-form { font-size: 10px; line-height: 11px; } .inspection-report { font-size: 10px; line-height: 5px; font-weight: 700; } .signature { font-size: 11px; }</style></head><body>';

        html2pdf(styledData + data + '</body></html>', {
          margin: 0.1,
          filename: 'tricycle_application_form.pdf',
          image: { type: 'png', quality: 0.98 },
          html2canvas: { scale: 2 },
          jsPDF: { unit: 'in', format: 'legal', orientation: 'portrait' }
        });
      },
      error: function () {
        console.error('Error fetching content. Please try again.');
      }
    });
  }

  $(document).ready(function () {
    $("#applyFilter").click(function (event) {
      event.preventDefault();

      const startDate = $("#startDate").val();
      const endDate = $("#endDate").val();
      const statusFilter = $("#statusFilter").val();

      let queryParams = [];

      if (statusFilter !== 'all') {
        queryParams.push('status=' + encodeURIComponent(statusFilter));
      }

      if (startDate && endDate) {
        queryParams.push(`startDate=${encodeURIComponent(startDate)}`);
        queryParams.push(`endDate=${encodeURIComponent(endDate)}`);
      }

      const queryString = queryParams.length > 0 ? '?' + queryParams.join('&') : '';

      // Construct the URL based on the current page URL
      const currentUrl = window.location.href.split('?')[0];
      const finalUrl = currentUrl + queryString;

      // Redirect to the final URL
      window.location.href = finalUrl;
    });
  });
</script>