<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top" id="mainAppointmentForm">
      <h6 class="title-head">Schedule New Appointment</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-3">
            <div id="newAppointmentForm">
              <form class="default-form" method="POST" action="" id="appointmentForm">
                <div class="content-container mt-2 mb-3">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex mb- py-3">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center">
                          <div class="row-1">
                            <div class="new-appointment-selection rounded-3 mb-4">
                              <input type="radio" id="newFranchise" name="appointmentType" value="New Franchise">
                              <label for="newFranchise">New Franchise</label>
                            </div>
                            <?php if ($userHasCin) { ?>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="renewalFranchise" name="appointmentType" value="Renewal of Franchise">
                                <label for="renewalFranchise">Renewal of Franchise</label>
                              </div>
                            <?php } ?>
                          </div>
                          <?php if ($userHasCin) { ?>
                            <div class="row-2">
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="changeMotorcycle" name="appointmentType" value="Change of Motorcycle">
                                <label for="changeMotorcycle">Change of Motorcycle</label>
                              </div>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="transferOwnership" name="appointmentType" value="Transfer of Ownership">
                                <label for="transferOwnership">Transfer of Ownership</label>
                              </div>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" name="schedule_appointment" id="scheduleAppointmentBtn">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>