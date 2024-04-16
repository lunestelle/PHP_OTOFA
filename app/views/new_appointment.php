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
                <!-- Appointment Type Section -->
                <div class="content-container mt-2 mb-3" id="appointmentTypeContainer">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex py-3 px-5">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center px-2">
                          <!-- Radio Buttons for Appointment Type -->
                          <div class="row-1">
                            <!-- New Franchise -->
                            <div class="new-appointment-selection rounded-3 mb-4">
                              <input type="radio" id="newFranchise" name="appointmentType" value="New Franchise" <?php echo ($data['userHasCin'] && !$data['allCinNumbersUsed']) ? '' : 'disabled'; ?>>
                              <label for="newFranchise">New Franchise</label>
                            </div>
                            <!-- Renewal of Franchise (if user has CIN) -->
                            <?php if ($userHasCin) { ?>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="renewalFranchise" name="appointmentType" value="Renewal of Franchise" <?php echo $userHasRenewalStatus ? '' : 'disabled'; ?>>
                                <label for="renewalFranchise">Renewal of Franchise</label>
                              </div>
                            <?php } ?>
                          </div>
                          <div class="row-2">
                            <!-- Change of Motorcycle (if user has CIN) -->
                            <?php if ($userHasCin) { ?>
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="changeMotorcycle" name="appointmentType" value="Change of Motorcycle" <?php echo $userHasChangeMotorStatus ? '' : 'disabled'; ?>>
                                <label for="changeMotorcycle">Change of Motorcycle</label>
                              </div>
                              <!-- Transfer of Ownership -->
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="transferOwnership" name="appointmentType" value="Transfer of Ownership">
                                <label for="transferOwnership">Transfer of Ownership</label>
                              </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </div>

                <!-- Number of Tricycles Section -->
                <div class="content-container mt-2 mb-3" id="noOfTricyclesContainer">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6" id="tricycleHeader">Select Number of Tricycles</h6>
                    <p class="text-muted m-2 p-1 fst-italic fw-bold" id="noOftricycleDetails" style="font-size: 13px;">Please specify the number of tricycles you want to franchise. You can select up to 5 tricycles.</p>
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

                <!-- Transfer Type Section -->
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
                              <!-- None -->
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="none" name="transferType" value="None">
                                <label for="none">None</label>
                              </div>
                              <!-- Intent of Transfer (if user has CIN) -->
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
                                <!-- Transfer of Ownership from Deceased Owner (if user has CIN) -->
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

                <!-- Tricycle CIN Section (if user has CIN) -->
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
                                <select id="tricycleCin" name="tricycleCin" class="form-select w-100" style="text-align: center; font-weight: bold; width: 100 !important;">
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

                <!-- Save, Next, and Previous Buttons -->
                <div class="text-end my-3">
                  <button type="submit" class="sidebar-btnContent" style="margin-right: 10px !important;" name="schedule_appointment" id="scheduleAppointmentBtn">Save</button>
                  <button type="button" class="sidebar-btnContent d-none" id="nextBtn" disabled>Next</button>
                  <button type="button" class="sidebar-btnContent" style="margin-right: 10px !important;" id="prevBtn">Previous</button>
                  <a href="appointments" class="sidebar-btnContent" style="margin-right: 10px !important;" id="cancelBtn">Cancel</a>
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
    let triggeredByPrevBtn = false;
    let triggeredByNextBtn = false;
    let availableCinCount = <?php echo $totalAvailableCins; ?>;
    let fetchedCINs = [];

    function fetchTricycleCinNumbers() {
      let appointmentType = $("input[name='appointmentType']:checked").val();
      if (appointmentType) { 
        $.ajax({
          url: 'fetch_tricycle_cin_numbers',
          type: 'POST',
          data: { appointmentType: appointmentType },
          dataType: 'json',
          success: function (response) {
            fetchedCINs = response.tricycleCinNumbers.map(value => value.cin_number);
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

    function toggleSections() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const transferType = $("input[name='transferType']:checked").val();
      const tricycleCin = $("#tricycleCin").val();
      const noOfTricycle = $("input[name='numberOfTricycles']").val();
      const visibleContainerId = $(".content-container:visible").attr("id");

      // Function to show/hide containers based on appointment type
      function showHideContainersForAppointmentType() {
        // Hiding all containers initially
        $(".content-container").hide();
        $("#prevBtn, #scheduleAppointmentBtn, #nextBtn").hide();

        switch (appointmentType) {
          case "New Franchise":
            $("#noOfTricyclesContainer, #scheduleAppointmentBtn, #prevBtn").show();
            $("#cancelBtn, #nextBtn").hide();
            $("#tricycleHeader").text("Select Number of Tricycles for the New Franchise");
            $("#noOftricycleDetails").text("Please specify the number of tricycles you want to franchise. Currently, there are " + availableCinCount + " available CINs for franchising. You can franchise up to 5 CINs.");
            break;
          case "Renewal of Franchise":
          case "Change of Motorcycle":
            if (noOfTricycle) {
              $("#tricycleCinContainer, #scheduleAppointmentBtn, #prevBtn").show();
              $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
              
              // Update the text with fetched CIN numbers
              let cinText = ""; // Initialize the text variable
              if (fetchedCINs.length === 1) {
                cinText = fetchedCINs[0];
              } else {
                if (fetchedCINs.length === 2) {
                  cinText = fetchedCINs.join(" and ");
                } else {
                  cinText = fetchedCINs.slice(0, -1).join(", ") + ", and " + fetchedCINs.slice(-1);
                }
              }
              $("#noOftricycleDetails").text(`Please indicate the number of tricycles you wish to change motorcycles. The CIN numbers eligible for this change are ${cinText}.`);

              
            } else {
              $("#noOfTricyclesContainer, #prevBtn").show();
              $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
            }
            break;
          case "Transfer of Ownership":
            if (noOfTricycle) {
              $("#transferTypeContainer, #prevBtn").show();
            } else if (transferType) {
              $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
            } else {
              $("#noOfTricyclesContainer, #prevBtn").show();
              $("#tricycleHeader").text("Select Number of Tricycles for the Transfer of Ownership");
            }
            break;
          default:
            $("#appointmentTypeContainer, #nextBtn").show();
            break;
        }
      }

      showHideContainersForAppointmentType();
    }

    function toggleNextBtn() {
      const visibleContainerId = $(".content-container:visible").attr("id");
      const appointmentType = $("input[name='appointmentType']:checked").val();
        
      // Check if the visible section is appointmentTypeContainer
      if (visibleContainerId === "appointmentTypeContainer") {
        // Check if any radio button is selected
        if ($("input[name='appointmentType']:checked").length > 0) {
          // Enable the nextBtn button and remove the d-none class
          $("#nextBtn").prop("disabled", false);
          $("#nextBtn").removeClass("d-none");
          $("#nextBtn").removeAttr("style");
      } else {
          // If no radio button is selected, disable the nextBtn button and add the d-none class
          $("#nextBtn").prop("disabled", true).css({
            "background-color": "#cccccc",
            "border-color": "#999999",
            "color": "#666666",
            "font-weight": "bolder"
          });
          $("#nextBtn").addClass("d-none");
        }
      }
        
      // Check if the visible container is noOfTricyclesContainer
      else if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType === "New Franchise") {
          $("#nextBtn").prop("disabled", true);
          $("#nextBtn").addClass("d-none");
        } else if (appointmentType === "Change of Motorcycle") {
          if ($("#numberOfTricycles").val().trim() !== "") {
            $("#nextBtn").prop("disabled", false);
            $("#nextBtn").removeClass("d-none");
            $("#nextBtn").removeAttr("style");
          } else {
            // If the number of tricycles input field is empty, disable the nextBtn button and add the d-none class
            $("#nextBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
          }
        }
      } else {
        // For other sections, hide and disable the nextBtn button
        $("#nextBtn").prop("disabled", true).css({
            "background-color": "#cccccc",
            "border-color": "#999999",
            "color": "#666666",
            "font-weight": "bolder"
        });
        $("#nextBtn").addClass("d-none");
      }
    }

    function toggleSaveBtn() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const noOfTricycle = $("input[name='numberOfTricycles']").val();
      const transferType = $("input[name='transferType']:checked").val();
      const tricycleCin = $("#tricycleCin").val();
      
      const isSaveButtonDisabled = !appointmentType || (appointmentType === "New Franchise" && !noOfTricycle) || (appointmentType === "Transfer of Ownership" && !transferType && !noOfTricycle && !tricycleCin) || (appointmentType !== "New Franchise" && !tricycleCin && !noOfTricycle);
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

    $("#prevBtn").click(function () {
      triggeredByPrevBtn = true;
      triggeredByNextBtn = false;
    });

    $("#nextBtn").click(function () {
      triggeredByPrevBtn = false;
      triggeredByNextBtn = true;
    });

    $("#prevBtn, #nextBtn").click(function () {
      const visibleContainerId = $(".content-container:visible").attr("id");
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const transferType = $("input[name='transferType']:checked").val();
      const tricycleCin = $("#tricycleCin").val();
      const noOfTricycle = $("input[name='numberOfTricycles']").val();

      $("#" + visibleContainerId).hide();

      // Show previous/next container based on current one
      if (visibleContainerId === "appointmentTypeContainer") {
        if (appointmentType === "New Franchise") {
          $("#noOfTricyclesContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
          $("#noOftricycleDetails").text("Please specify the number of tricycles you want to franchise. Currently, there are " + availableCinCount + " available CINs for franchising. You can franchise up to 5 CINs.");
          $("#nextBtn, #cancelBtn").hide();

          if (availableCinCount >= 5) {
            $("#numberOfTricycles").attr("max", 5);
          } else {
            $("#numberOfTricycles").attr("max", availableCinCount);
          }
        } else if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle") {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
          $("#scheduleAppointmentBtn, #cancelBtn").hide();

          // Update the text with fetched CIN numbers
          let cinText = ""; // Initialize the text variable
          if (fetchedCINs.length === 1) {
            cinText = fetchedCINs[0];
          } else {
            if (fetchedCINs.length === 2) {
              cinText = fetchedCINs.join(" and ");
            } else {
              cinText = fetchedCINs.slice(0, -1).join(", ") + ", and " + fetchedCINs.slice(-1);
            }
          }
          $("#noOftricycleDetails").text(`Please indicate the number of tricycles you wish to change motorcycles. The CIN numbers eligible for this change are ${cinText}.`);

          if (fetchedCINs.length >= 5) {
            $("#numberOfTricycles").attr("max", 5);
          } else {
            $("#numberOfTricycles").attr("max", fetchedCINs.length);
          }




          toggleNextBtn();
        }
      } else if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType === "New Franchise") {
          $("#appointmentTypeContainer, #cancelBtn, #nextBtn").show();
          $("#prevBtn, #scheduleAppointmentBtn, #tricycleCinContainer").hide();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
        } else if (appointmentType === "Change of Motorcycle") {
          if (triggeredByPrevBtn) {
            $("#appointmentTypeContainer, #cancelBtn, #nextBtn").show();
            $("#prevBtn, #scheduleAppointmentBtn, #tricycleCinContainer").hide();
            $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);

            toggleNextBtn();
          } else if (triggeredByNextBtn) {
            $("#tricycleCinContainer, #scheduleAppointmentBtn, #prevBtn").show();
            $("#nextBtn, #cancelBtn").hide();
            $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);

          }
        }
      } else if (visibleContainerId === "tricycleCinContainer") {
        if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle") {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn, #cancelBtn").hide();
        } else if (appointmentType === "Transfer of Ownership") {
          $("#transferTypeContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn, #cancelBtn").hide();
        }
      } else if (visibleContainerId === "transferTypeContainer" && appointmentType === "Transfer of Ownership") {
        $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
        $("#nextBtn, #cancelBtn").hide();
      }
    });

    // Event listener for radio button changes
    $("input[name='appointmentType']").change(function() {
      toggleNextBtn();
      fetchTricycleCinNumbers();
    });

    $("select[name='tricycleCin']").change(function() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const visibleContainerId = $(".content-container:visible").attr("id");

      // Toggle the save button based on the conditions
      if (appointmentType === "Change of Motorcycle" && visibleContainerId === "tricycleCinContainer") {
        toggleSaveBtn();
      }
    });


    // Event listener for input field changes
    $("#numberOfTricycles").on("input", function() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      if (appointmentType === "New Franchise") {
        toggleSaveBtn();
      } else if (appointmentType === "Change of Motorcycle") {
        toggleNextBtn();
      }
    });

    $("#tricycleCin").change(toggleSections);

    toggleSections();
    fetchTricycleCinNumbers();
    toggleNextBtn();
    toggleSaveBtn();
  });
</script>