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
                <div class="content-container mt-2 mb-3" id="appointmentTypeContainer" style="width: 600px;">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Appointment Type</h6>
                  </div>
                  <div class="row px-3 p-4">
                    <div class="col-12 d-flex py-3 px-4">
                      <div class="col-12 px-4">
                        <div class="d-flex gap-5 text-center px-4">
                          <!-- Radio Buttons for Appointment Type -->
                          <div class="row-1">
                            <!-- New Franchise -->
                            <div class="new-appointment-selection rounded-3 mb-4">
                              <input type="radio" id="newFranchise" name="appointmentType" value="New Franchise" 
                                <?php echo (!$data['allCinNumbersUsed'] && $data['tricycleCount'] < 3) ? '' : 'disabled'; ?>>
                              <label for="newFranchise">New Franchise</label>
                            </div>
                            <!-- Renewal of Franchise (if user has CIN) -->
                            <?php if ($userHasCin) { ?>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="renewalFranchise" name="appointmentType" value="Renewal of Franchise" <?php echo $userHasRenewalStatus ? '' : 'disabled'; ?>>
                                <label for="renewalFranchise">Renewal of Franchise</label>
                              </div>
                            <?php } else { ?>
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="renewalFranchise" name="appointmentType" value="Renewal of Franchise" disabled>
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
                            <?php } else { ?>
                              <div class="new-appointment-selection rounded-3 mb-4">
                                <input type="radio" id="changeMotorcycle" name="appointmentType" value="Change of Motorcycle" disabled>
                                <label for="changeMotorcycle">Change of Motorcycle</label>
                              </div>
                              <!-- Transfer of Ownership -->
                              <div class="new-appointment-selection rounded-3">
                                <input type="radio" id="transferOwnership" name="appointmentType" value="Transfer of Ownership" disabled>
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
                    <p class="text-muted m-2 py-2  fst-italic fw-bold" id="noOftricycleDetails" style="font-size: 13px;">Please specify the number of tricycles you want to franchise. You can select up to 3 tricycles.</p>
                  </div>
                  <div class="row px-3 p-4" id="">
                    <div class="col-12 d-flex mb- py-3">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center">
                          <div class="col-12">
                            <input type="number" id="numberOfTricycles" name="numberOfTricycles" class="form-control w-100" min="1" max="3" required>
                            <!-- Tricycle error message container -->
                            <div id="tricycleErrorMessage" class="text-danger mt-2 d-none"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Transfer Type Section -->
                <div class="content-container mt-2 mb-3" id="transferTypeContainer"  style="width: 600px;">
                  <div class="bckgrnd pt-2">
                    <h6 class="text-uppercase text-center text-light fs-6">Select Transfer Type</h6>
                  </div>
                  <div class="row px-2 p-2" id="transferTypeOptions">
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
                                <div class="new-appointment-selection rounded-3 mb-4 mx-2">
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
                  <div class="content-container mt-2 mb-3" id="tricycleCinContainer" style="width: 600px;">
                    <div class="bckgrnd pt-2">
                      <h6 class="text-uppercase text-center text-light fs-6">Select Tricycle CIN</h6>
                      <p id="multiSelectNote" class="text-muted m-2 py-2  fst-italic fw-bold" style="font-size: 13px; display:none;"></p>
                    </div>
                    <div class="row px-3 p-4">
                      <div class="col-12 d-flex mb- py-3">
                        <div class="col-12 px-5">
                          <div class="d-flex gap-5 text-center">
                            <div class="col-12">
                              <div class="row-1">
                                <select id="tricycleCin" name="tricycleCin[]" class="form-select w-100" style="text-align: center; font-weight: bold; width: 100 !important;">
                                  <option disabled>Please Select Here</option>
                                  <!-- Options will be added dynamically using JavaScript the data in here should be the data from the fetch tricycle cin numbers where dropdown should be displayed here containing the cin number -->
                                </select>
                              </div>
                              <div id="cinErrorMessage" class="text-danger mt-2 d-none"></div>
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
        $(".content-container").hide();
        $("#prevBtn, #scheduleAppointmentBtn, #nextBtn").hide();

        switch (appointmentType) {
          case "New Franchise":
            $("#noOfTricyclesContainer, #scheduleAppointmentBtn, #prevBtn").show();
            $("#cancelBtn, #nextBtn").hide();
            $("#tricycleHeader").text("Select Number of Tricycles for the New Franchise");
            $("#noOftricycleDetails").text(`Please specify the number of tricycles you want to franchise. Currently, there ${availableCinCount === 1 ? 'is' : 'are'} ${availableCinCount} available CIN${availableCinCount === 1 ? '' : 's'} for franchising. You can franchise up to 3 CINs.`);
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
              // Use 'is' instead of 'are' when there's only one CIN
              const verb = fetchedCINs.length === 1 ? 'is' : 'are';
              $("#noOftricycleDetails").text(`Please indicate the number of tricycles you wish to change motorcycles. The CIN number eligible for this change ${verb} ${cinText}.`);
            } else {
              $("#noOfTricyclesContainer, #prevBtn").show();
              $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
            }
            break;
          case "Transfer of Ownership":
            if (!noOfTricycle) {
              $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
            } else if (!transferType) {
              $("#transferTypeContainer, #prevBtn, #nextBtn").show();
            } else if (tricycleCin){
              $("#tricycleCinContainer, #prevBtn, #scheduleAppointmentBtn").show();
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
      const transferType = $("input[name='transferType']:checked").val();
        
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
        } else if (appointmentType === "Change of Motorcycle" || appointmentType === "Renewal of Franchise" || appointmentType === "Transfer of Ownership") {
          if ($("#numberOfTricycles").val().trim() !== "" && parseInt($("#numberOfTricycles").val()) != 0) {
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
      }

      else if (visibleContainerId === "transferTypeContainer") {
        if (appointmentType === "Transfer of Ownership") {
          if ($("input[name='transferType']:checked").length > 0) {
            $("#nextBtn").prop("disabled", false);
            $("#nextBtn").removeClass("d-none");
            $("#nextBtn").removeAttr("style");
          } else {
            // If the transferType hasnt been selected input field is empty, disable the nextBtn button and add the d-none class
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
      
      const isSaveButtonDisabled = !appointmentType || (appointmentType === "New Franchise" && !noOfTricycle) || (appointmentType === "Transfer of Ownership" && !transferType && !noOfTricycle && !tricycleCin && (tricycleCin.length == noOfTricycle)) || (appointmentType !== "New Franchise" && !tricycleCin && !noOfTricycle);
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

    function displayTricycleErrorMessage(message) {
      const errorMessageContainer = $("#tricycleErrorMessage");
      errorMessageContainer.text(message).removeClass("d-none");
    }

    function hideTricycleErrorMessage() {
      const errorMessageContainer = $("#tricycleErrorMessage");
      errorMessageContainer.text("").addClass("d-none");
    }

    function toggleValidations() {
      const visibleContainerId = $(".content-container:visible").attr("id");
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const numberOfTricycles = parseInt($("#numberOfTricycles").val().trim());
      // const maxTricycles = parseInt($("#numberOfTricycles").attr("max"));
      // const minTricycles = parseInt($("#numberOfTricycles").attr("min"));

      const maxTricyclesAllowed = 3; // The maximum number of tricycles an operator can own
      const currentTricyclesOwned = <?php echo $data['tricycleCount']; ?>;  
      const maxTricycles = maxTricyclesAllowed - currentTricyclesOwned;

      // Check if the visible container is noOfTricyclesContainer
      if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType === "New Franchise") {
          if ($("#numberOfTricycles").val().trim() !== "" && parseInt($("#numberOfTricycles").val()) != 0) {
            $("#scheduleAppointmentBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
            hideTricycleErrorMessage();
          }

          if (numberOfTricycles == "") {
            $("#scheduleAppointmentBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
            hideTricycleErrorMessage();
          }

          if (numberOfTricycles > 0 && numberOfTricycles <= maxTricycles) {
            // Number of tricycles is within the limit, enable scheduleAppointmentBtn
            $("#scheduleAppointmentBtn").prop("disabled", false).removeClass("d-none").removeAttr("style");
            hideTricycleErrorMessage(); // Hide any existing error message
          } else {
            // Number of tricycles is invalid, show error message and disable scheduleAppointmentBtn
            $("#scheduleAppointmentBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
            
            if (numberOfTricycles <= 0) {
              displayTricycleErrorMessage("Error: Number of tricycles must be greater than 0");
            } else if (numberOfTricycles > maxTricyclesAllowed) {
              displayTricycleErrorMessage("Error: The number of tricycles inputted exceeds the allowed limit of tricycle CINs an operator can own.");
            } else if (numberOfTricycles + currentTricyclesOwned > maxTricyclesAllowed) {
              displayTricycleErrorMessage(`Error: You can only own up to ${maxTricyclesAllowed} tricycles in total. You already own ${currentTricyclesOwned}.`);
            } else if (numberOfTricycles > maxTricycles) {
              displayTricycleErrorMessage(`Error: You can add up to ${maxTricycles} more tricycles.`);
            }
          }
        } else if (appointmentType === "Change of Motorcycle" || appointmentType === "Renewal of Franchise" || appointmentType === "Transfer of Ownership") {
          if ($("#numberOfTricycles").val().trim() !== "" && parseInt($("#numberOfTricycles").val()) != 0) {
            $("#nextBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
            hideTricycleErrorMessage();
          }

          if (numberOfTricycles == "") {
            $("#nextBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });
            hideTricycleErrorMessage();
          }

          if (numberOfTricycles > 0 && numberOfTricycles <= maxTricyclesAllowed && numberOfTricycles <= currentTricyclesOwned) {
            // Number of tricycles is within the limit, enable nextBtn
            $("#nextBtn").prop("disabled", false).removeClass("d-none").removeAttr("style");
            hideTricycleErrorMessage(); // Hide any existing error message
          } else {
            // Number of tricycles is invalid, show error message and disable nextBtn
            $("#nextBtn").prop("disabled", true).css({
              "background-color": "#cccccc",
              "border-color": "#999999",
              "color": "#666666",
              "font-weight": "bolder"
            });

            if (numberOfTricycles <= 0) {
              displayTricycleErrorMessage("Error: Number of tricycles must be greater than 0");
            } else if (numberOfTricycles > maxTricyclesAllowed) {
              displayTricycleErrorMessage("Error: The number of tricycles inputted exceeds the allowed limit of tricycle CINs an operator can own.");
            } else if (numberOfTricycles > currentTricyclesOwned) {
              displayTricycleErrorMessage(`Error: You can only transfer ownership of up to ${currentTricyclesOwned} tricycle CINs, as that is the total number of tricycles you currently own.`);
            }
          }
        }
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
      const maxTricyclesAllowed = 3; // The maximum number of tricycles an operator can own
      const currentTricyclesOwned = <?php echo $data['tricycleCount']; ?>;  
      const maxTricycles = maxTricyclesAllowed - currentTricyclesOwned;

      $("#" + visibleContainerId).hide();

      // Show previous/next container based on current one
      if (visibleContainerId === "appointmentTypeContainer") {
        if (appointmentType === "New Franchise") {
          $("#noOfTricyclesContainer, #prevBtn, #scheduleAppointmentBtn").show();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
          $("#noOftricycleDetails").text("Please specify the number of tricycles you want to franchise. Currently, there are " + availableCinCount + " available CINs for franchising. You can franchise up to" + maxTricycles + " CINs.");
          $("#nextBtn, #cancelBtn").hide();

          if (availableCinCount >= 5) {
            $("#numberOfTricycles").attr("max", 3);
          } else {
            $("#numberOfTricycles").attr("max", availableCinCount);
          }
        } else if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle" || appointmentType === "Transfer of Ownership") {
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

          // Use 'is' instead of 'are' when there's only one CIN
          const verb = fetchedCINs.length === 1 ? 'is' : 'are';
          let appointmentTypeText = "";
          if (appointmentType === "Renewal of Franchise") {
            appointmentTypeText = "renew the franchise";
          } else if (appointmentType === "Transfer of Ownership") {
            appointmentTypeText = "transfer the ownership";
          } else {
            appointmentTypeText = "change motorcycles";
          }
          $("#noOftricycleDetails").text(`Please indicate the number of tricycles you wish to ${appointmentTypeText}. The CIN number eligible for this change ${verb} ${cinText}.`);


          if (fetchedCINs.length >= 5) {
            $("#numberOfTricycles").attr("max", 3);
          } else {
            $("#numberOfTricycles").attr("max", fetchedCINs.length);
          }

          toggleNextBtn();
          toggleValidations();
        }
      } else if (visibleContainerId === "noOfTricyclesContainer") {
        if (appointmentType === "New Franchise") {
          $("#appointmentTypeContainer, #cancelBtn, #nextBtn").show();
          $("#prevBtn, #scheduleAppointmentBtn, #tricycleCinContainer").hide();
          $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);
        } else if (appointmentType === "Change of Motorcycle" || appointmentType === "Renewal of Franchise") {
          if (triggeredByPrevBtn) {
            $("#appointmentTypeContainer, #cancelBtn, #nextBtn").show();
            $("#prevBtn, #scheduleAppointmentBtn, #tricycleCinContainer").hide();
            $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);

            toggleNextBtn();
          } else if (triggeredByNextBtn) {
            $("#tricycleCinContainer, #scheduleAppointmentBtn, #prevBtn").show();
            $("#nextBtn, #cancelBtn").hide();
          }
        } else if (appointmentType === "Transfer of Ownership") {
          if (triggeredByPrevBtn) {
            $("#appointmentTypeContainer, #cancelBtn, #nextBtn").show();
            $("#prevBtn, #scheduleAppointmentBtn, #tricycleCinContainer").hide();
            $("#tricycleHeader").text(`Select Number of Tricycles for the ${appointmentType}`);

            toggleNextBtn();
          } else if (triggeredByNextBtn) {
            $("#transferTypeContainer, #nextBtn, #prevBtn").show();
            $("#scheduleAppointmentBtn, #cancelBtn").hide();
            
            toggleNextBtn();
          }
        }
      } else if (visibleContainerId === "tricycleCinContainer") {
        if (appointmentType === "Renewal of Franchise" || appointmentType === "Change of Motorcycle") {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn, #cancelBtn").hide();
        } else if (appointmentType === "Transfer of Ownership") {
          $("#transferTypeContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn, #cancelBtn").hide();
          toggleNextBtn();
        }
      } else if (visibleContainerId === "transferTypeContainer" && appointmentType === "Transfer of Ownership") {
        if (triggeredByPrevBtn) {
          $("#noOfTricyclesContainer, #prevBtn, #nextBtn").show();
          $("#scheduleAppointmentBtn, #cancelBtn").hide();

          toggleNextBtn();
        } else if (triggeredByNextBtn) {
          $("#tricycleCinContainer, #scheduleAppointmentBtn, #prevBtn").show();
          $("#nextBtn, #cancelBtn").hide();
        }
      }
    });

    // Event listener for radio button changes
    $("input[name='appointmentType']").change(function() {
      toggleNextBtn();
      fetchTricycleCinNumbers();
    });

    $("input[name='transferType']").change(function() {
      toggleNextBtn();
      fetchTricycleCinNumbers();
    });

    $("select[name='tricycleCin']").change(function() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      const visibleContainerId = $(".content-container:visible").attr("id");

      // Toggle the save button based on the conditions
      if ((appointmentType === "Change of Motorcycle" || appointmentType === "Renewal of Franchise" || appointmentType === "Transfer of Ownership") && visibleContainerId === "tricycleCinContainer") {
        toggleSaveBtn();
      }

      // Toggle the save button based on the conditions
      if (appointmentType === "Transfer of Ownership" && visibleContainerId === "tricycleCinContainer") {
        const noOfTricycle = $("input[name='numberOfTricycles']").val();
        const tricycleCin = $("#tricycleCin").val();
        if (tricycleCin && tricycleCin.length == noOfTricycles) {
          toggleSaveBtn();
        }
      }
    });

    // Event listener for input field changes
    $("#numberOfTricycles").on("input", function() {
      const appointmentType = $("input[name='appointmentType']:checked").val();
      if (appointmentType === "New Franchise") {
        toggleSaveBtn();
        toggleValidations();
      } else if (appointmentType === "Change of Motorcycle" || appointmentType === "Renewal of Franchise" || appointmentType === "Transfer of Ownership") {
        toggleNextBtn();
        toggleValidations();
      }
    });

    $("#tricycleCin").change(toggleSections);

    toggleSections();
    fetchTricycleCinNumbers();
    toggleNextBtn();
    toggleSaveBtn();
  });

  $(document).ready(function () {
    const appointmentType = $("input[name='appointmentType']:checked").val();
    const $tricycleCin = $("#tricycleCin");
    const $cinErrorMessage = $("#cinErrorMessage");
    const $saveBtn = $("#scheduleAppointmentBtn");

    function updateTricycleCin(numberOfTricycles) {
      // Update the tricycle CIN select element
      $tricycleCin.attr("multiple", numberOfTricycles > 1); // Enable multiple selections if more than 1 tricycle

      // Update the multi-select note
      if (numberOfTricycles > 1) {
        $("#multiSelectNote").text(`Press Ctrl and select up to ${numberOfTricycles} options.`).show();
      } else {
        $("#multiSelectNote").hide();
      }

      const limit = numberOfTricycles;

      // Remove any previous event listeners to prevent multiple alerts
      $tricycleCin.off("change");

      $tricycleCin.on("change", function () {
        const selectedOptions = $tricycleCin.find("option:selected").not("[disabled]"); // Exclude disabled options

        if (selectedOptions.length > limit) {
          selectedOptions.last().prop("selected", false); // Deselect the last selected option
          $cinErrorMessage.text("You can only select up to " + limit + " CIN(s).").removeClass("d-none").show();
        } else {
          $cinErrorMessage.hide();
        }

        // Check if the exact number of required options are selected to enable the save button
        toggleSaveBtn(selectedOptions.length === limit);
      });
    }

    function toggleSaveBtn(enable) {
      if (enable) {
        $saveBtn.removeAttr("disabled").css({
          "color": "white",
          "background-color": "#FF4200",
          "border": "1px solid #FF4200",
          "text-decoration": "none",
          "border-radius": "10px",
          "font-size": "12px",
          "letter-spacing": "2px"
        });
      } else {
        $saveBtn.attr("disabled", true).css({
          "color": "#666666",
          "background-color": "#cccccc",
          "border": "1px solid #999999",
          "text-decoration": "none",
          "border-radius": "10px",
          "font-size": "12px",
          "letter-spacing": "2px"
        });
      }
    }

    // Assume you have some event or function to call updateTricycleCin with the current number of tricycles
    $("#numberOfTricycles").on("change", function () {
      const numberOfTricycles = parseInt($(this).val(), 10);
      const appointmentType = $("input[name='appointmentType']:checked").val();
      if (appointmentType === "Transfer of Ownership") {
        updateTricycleCin(numberOfTricycles);
        toggleSaveBtn(false); // Ensure save button is disabled initially
      }
    });

    $("input[name='appointmentType']").on("change", function() {
      const initialNumberOfTricycles = parseInt($("#numberOfTricycles").val(), 10);
      updateTricycleCin(initialNumberOfTricycles);
      toggleSaveBtn(false); // Ensure save button is disabled initially
    });
  });
</script>