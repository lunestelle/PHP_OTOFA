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
                <div class="content-container mt-2 mb-3" id="appointmentTypeContainer">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex py-3 px-5">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center px-2">
                          <div class="row-1">
                            <div class="new-appointment-selection rounded-3 mb-4">
                              <input type="radio" id="newFranchise" name="appointmentType" value="New Franchise" <?php echo ($data['userHasCin'] && !$data['allCinNumbersUsed']) ? '' : 'disabled'; ?>>
                              <label for="newFranchise">New Franchise</label>
                            </div>
                            <?php if ($userHasCin) { ?>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="renewalFranchise" name="appointmentType" value="Renewal of Franchise" <?php echo $userHasRenewalStatus ? '' : 'disabled'; ?>>
                                <label for="renewalFranchise">Renewal of Franchise</label>
                              </div>
                            <?php } ?>
                          </div>
                          <?php if ($userHasCin) { ?>
                            <div class="row-2">
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="changeMotorcycle" name="appointmentType" value="Change of Motorcycle" <?php echo $userHasChangeMotorStatus ? '' : 'disabled'; ?>>
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

                <div class="content-container mt-2 mb-3" id="noOfTricyclesContainer">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6" id="tricycleHeader">Select Number of Tricycles</h6>
                    <p class="text-muted m-2 p-1 fst-italic fw-bold" style="font-size: 13px;">Please specify the number of tricycles you want to franchise. You can select up to 5 tricycles.</p>
                  </div>
                  <div class="row px-3 p-4" id="">
                    <div class="col-12 d-flex mb- py-3">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center">
                          <div class="col-12">
                            <input type="number" id="numberOfTricycles" name="numberOfTricycles" class="form-control w-100" min="1" max="5" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                            
                <div class="content-container mt-2 mb-3" id="transferTypeContainer">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Transfer Type</h6>
                  </div>
                  <div class="row px-3 p-4" id="transferTypeOptions">
                    <div class="col-12 d-flex mb- py-3">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center">
                          <div class="col-6">
                            <div class="row-1">
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="none" name="transferType" value="None">
                                <label for="none">None</label>
                              </div>
                              <?php if ($userHasCin) { ?>
                                <div class="new-appointment-selection rounded-3">
                                  <input type="radio" id="intent_of_transfer" name="transferType" value="Intent of Transfer">
                                  <label for="intent_of_transfer">Intent of Transfer</label>
                                </div>
                              <?php } ?>
                            </div>
                          </div>
                          <div class="col-5">
                            <?php if ($userHasCin) { ?>
                              <div class="row-2">
                                <div class="new-appointment-selection rounded-3 mb-4">
                                  <input type="radio" id="transfer_deceased" name="transferType" value="Transfer of Ownership from Deceased Owner">
                                  <label for="transfer_deceased">Transfer of Ownership <br> from Deceased Owner</label>
                                </div>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </div>

                <?php if ($userHasCin) { ?>
                  <div class="content-container mt-2 mb-3" id="tricycleCinContainer">
                    <div class="bckgrnd pt-2">
                      <h6 class="text-uppercase text-center text-light fs-6">Select Tricycle CIN</h6>
                    </div>
                    <div class="row px-3 p-4">
                      <div class="col-12 d-flex mb- py-3">
                        <div class="col-12 px-5">
                          <div class="d-flex gap-5 text-center">
                            <div class="col-12">
                              <div class="row-1">
                                <select id="tricycleCin" name="tricycleCin" class="form-select" style="text-align: center; font-weight: bold;">
                                  <option value="" selected disabled>Please Select Here</option>
                                  <!-- Options will be added dynamically using JavaScript the data in here should be the data from the fetch tricycle cin numbers where dropdown should be displayed here containing the cin number -->
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                  
                  </div>
                <?php } ?>

                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" name="schedule_appointment" id="scheduleAppointmentBtn">Nessdfsxt</button>
                </div>
                
                <div class="text-end my-3">
                  <button type="button" class="sidebar-btnContent" id="nextBtn">Next</button>
                </div>
                <div class="text-end my-3">
                  <button type="button" class="sidebar-btnContent" id="prevBtn">Previous</button>
                </div> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  $(document).ready(function () {
    function toggleSections() {
      let appointmentType = $("input[name='appointmentType']:checked").val();
      let transferType = $("input[name='transferType']:checked").val();
      let tricycleCin = $("#tricycleCin").val();
      let noOfTricycle = $("input[name='numberOfTricycles']").val();

      // Hide all containers initially
      $("#noOfTricyclesContainer, #transferTypeContainer, #tricycleCinContainer, #prevBtn, #nextBtn, #scheduleAppointmentBtn").hide();

      // Show containers based on selected appointment type
      if (appointmentType === "New Franchise") {
        $("#noOfTricyclesContainer, #prevBtn, #scheduleAppointmentBtn").show();
        $("#tricycleHeader").text("Select Number of Tricycles for the New Franchise");
        $("#appointmentTypeContainer").hide();
      } else if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle") {
        if (noOfTricycle) {
          $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
        } else {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
          $("#appointmentTypeContainer, #tricycleCinContainer").hide();
        }
      } else if (appointmentType === "Transfer of Ownership") {
        if (noOfTricycle) {
          $("#transferTypeContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn").hide();
        } else if (transferType) {
          $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#nextBtn").hide();
        } else {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#tricycleHeader").text("Select Number of Tricycles for the Transfer of Ownership");
          $("#appointmentTypeContainer, #tricycleCinContainer, #transferTypeContainer").hide();
        }
      } else {
        $("#appointmentTypeContainer").show();
        $("#prevBtn, #nextBtn, #scheduleAppointmentBtn").hide()
      }

      let isSaveButtonDisabled = !appointmentType ||  (appointmentType === "New Franchise" && !noOfTricycle) ||  (appointmentType === "Transfer of Ownership" && !transferType) || (appointmentType !== "New Franchise" && !tricycleCin && !noOfTricycle);
      $("#scheduleAppointmentBtn").prop("disabled", isSaveButtonDisabled);

      if (isSaveButtonDisabled) {
        $("#scheduleAppointmentBtn").css({
          "background-color": "#cccccc",
          "border-color": "#999999",
          "color": "#666666",
          "font-weight": "bolder"
        });
      } else {
        $("#scheduleAppointmentBtn").removeAttr("style");
      }
    }

    function fetchTricycleCinNumbers() {
      let appointmentType = $("input[name='appointmentType']:checked").val();
      if (appointmentType) { 
        $.ajax({
          url: 'fetch_tricycle_cin_numbers',
          type: 'POST',
          data: { appointmentType: appointmentType },
          dataType: 'json',
          success: function (response) {
            let options = response.tricycleCinNumbers;
            $('#tricycleCin').empty();
            $('#tricycleCin').append('<option value="" selected disabled>Please Select Here</option>');
            $.each(options, function(index, value) {
              $('#tricycleCin').append('<option style="text-align: center; font-weight: bold;" value="' + value.cin_number + '">' + value.cin_number + '</option>');
            });
          },
          error: function () {
            console.error('Error fetching tricycle CIN numbers');
          }
        });
      }
    }

    toggleSections();
    fetchTricycleCinNumbers();

    $("input[name='appointmentType'], input[name='transferType']").change(function () {
      toggleSections();
      fetchTricycleCinNumbers();
    });

    $("#tricycleCin").change(function () {
      toggleSections();
    });

    $("#prevBtn").click(function() {
      // Find the currently visible container
      let visibleContainerId = $(".content-container:visible").attr("id");
      let appointmentType = $("input[name='appointmentType']:checked").val();

      // Hide the current container
      $("#" + visibleContainerId).hide();

      // Show the previous container based on the current one
      if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType) {
          $("#appointmentTypeContainer, #nextBtn").show();
          $("#prevBtn, #scheduleAppointmentBtn").hide();
        }
      } else if (visibleContainerId === "tricycleCinContainer") {
        if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle" || appointmentType === "Transfer of Ownership") {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn").hide();
        }
      } else if (visibleContainerId === "transferTypeContainer") {
        if (appointmentType === "Transfer of Ownership") {
          $("#tricycleCinContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn").hide();
        }
      }
    });

    $("#nextBtn").click(function() {
      // Find the currently visible container
      let visibleContainerId = $(".content-container:visible").attr("id");
      let appointmentType = $("input[name='appointmentType']:checked").val();

      // Hide the current container
      $("#" + visibleContainerId).hide();

      // Show the next container based on the current one
      if (visibleContainerId === "appointmentTypeContainer") {
        if (appointmentType === "New Franchise") {
          $("#noOfTricyclesContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#nextBtn").hide();
        } else if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle" || appointmentType === "Transfer of Ownership") {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn").hide();
        }
      } else if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle") {
          $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#nextBtn").hide();
        } else if (appointmentType === "Transfer of Ownership") {
          $("#tricycleCinContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn").hide();
        }
      } else if (visibleContainerId === "tricycleCinContainer") {
        let transferType = $("input[name='transferType']:checked").val();

        if (appointmentType === "Transfer of Ownership") {
          $("#transferTypeContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#nextBtn").hide();
        }
      }
    });
  });
</script>