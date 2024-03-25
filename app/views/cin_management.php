<style>
  #radioButtonsContainer {
    display: flex;
    justify-content: center;
  }
  
  .cinBack-btnContent {
    padding: 5px 18px;
    color: white;
    background-color: gray;
    border: gray 1px solid;
    text-decoration: none;
    border-radius: 10px;
    font-size: 12px;
    letter-spacing: 2px;
    float: right;
    margin-right: 15px !important;
  }

  .cinBack-btnContent:hover {
    background-color: rgb(201, 201, 201);
    border: gray 1px solid;
    color: black;
  }
</style>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">CIN Management</h6>
    </div>
    <div class="col-lg-12 mt-2">
      <div class="row">
        <div class="col-12 pt-2">
          <div class="container pt-4">
            <div id="newMaintenancerForm">
              <form class="default-form" method="POST" action="">
                <div class="content-container mt-2 pb-3" id="selectActionSection">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Select Action to CIN Numbers</h6>
                  </div>
                  <div class="row px-5 p-4 pt-5 ">
                    <div class="col-12 d-flex py-3 px-5">
                      <div class="col-12 px-5">
                        <div class="d-flex gap-5 text-center px-3" id="radioButtonsContainer">
                          <div class="new-appointment-selection rounded-3 mb-4 px-2 mx-1">
                            <input type="radio" id="increaseCin" name="changeType" value="increase">
                            <label for="increaseCin">Increase</label>
                          </div>
                          <div class="new-appointment-selection rounded-3">
                            <input type="radio" id="decreaseCin" name="changeType" value="decrease">
                            <label for="decreaseCin">Decrease</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>    
                </div>

                <div class="content-container mt-2 pb-3" id="changeAmountSection" style="display: none;">
                  <div class="bckgrnd pt-2">
                    <h6 class="pl-2 text-uppercase text-center text-light fs-6">Update CIN Limit</h6>
                  </div>
                  
                  <div class="container">
                    <div class="row">
                      <div class="col-12">
                        <div class="row mt-1 p-2">
                          <div class="col-6 px-3 pt-1 mt-1">
                            <p class="text-muted fw-bold fst-italic"><span class="text-dark">Total CIN Numbers: </span><?php echo $totalCinNumbers; ?></p>
                          </div>

                          <div class="col-6 px-3 pt-1 mt-1">
                            <p class="text-muted fw-bold fst-italic"><span class="text-dark">Total Available CIN Numbers: </span><?php echo $totalAvailableCin; ?></p>
                          </div>
                          
                          <div id="increaseField" class="row mt-1 p-2" style="display: none;">
                            <div class="col-12 px-5">
                              <label for="increaseAmount" class="form-label">Enter the amount to increase:</label>
                              <input type="number" class="form-control w-100" id="increaseAmount" name="increaseAmount" required>
                            </div>
                          </div>
                          <div id="decreaseField" class="row mt-1 p-2" style="display: none;">
                            <div class="col-12 px-5">
                              <label for="decreaseAmount" class="form-label">Enter the amount to decrease:</label>
                              <input type="number" class="form-control w-100" id="decreaseAmount" name="decreaseAmount" required>
                            </div>
                          </div>
                        </div>
                        
                      </div>

                    </div>
                  </div>
                </div>

                <div class="text-end my-3" id="submitButtonSection" style="display: none;">
                  <button type="submit" class="sidebar-btnContent" name="update_user_details">Update CIN Availability</button>
                </div>
                <div class="text-end my-3" id="backButtonSection" style="display: none;">
                  <a href="cin_management" class="cinBack-btnContent" id="backButton">Back</a>
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
  document.addEventListener('DOMContentLoaded', function() {
    const changeType = document.querySelectorAll('input[name="changeType"]');
    const changeAmountSection = document.getElementById('changeAmountSection');
    const increaseField = document.getElementById('increaseField');
    const decreaseField = document.getElementById('decreaseField');
    const selectActionSection = document.getElementById('selectActionSection');
    const submitButtonSection = document.getElementById('submitButtonSection');
    const backButtonSection = document.getElementById('backButtonSection');

    changeType.forEach(function(input) {
      input.addEventListener('change', function() {
        if (input.value === 'increase') {
          increaseField.style.display = 'block';
          decreaseField.style.display = 'none';
          document.getElementById('increaseAmount').setAttribute('required', 'required');
          document.getElementById('decreaseAmount').removeAttribute('required');
        } else {
          increaseField.style.display = 'none';
          decreaseField.style.display = 'block';
          document.getElementById('decreaseAmount').setAttribute('required', 'required');
          document.getElementById('increaseAmount').removeAttribute('required');
        }
        changeAmountSection.style.display = 'block';
        selectActionSection.style.display = 'none'; // Hide the "Select Action" section
        backButtonSection.style.display = 'block'; // Show the back button
        submitButtonSection.style.display = 'block'; // Show the submit button
      });
    });

    const form = document.querySelector('.default-form');
    form.addEventListener('submit', function(event) {
      const increaseAmount = document.getElementById('increaseAmount').value;
      const decreaseAmount = document.getElementById('decreaseAmount').value;

      if (document.getElementById('increaseCin').checked && !increaseAmount) {
        event.preventDefault();
        alert('Please enter the amount to increase.');
      } else if (document.getElementById('decreaseCin').checked && !decreaseAmount) {
        event.preventDefault();
        alert('Please enter the amount to decrease.');
      }
    });

    const backButton = document.getElementById('backButton');
    backButton.addEventListener('click', function() {
      selectActionSection.style.display = 'block'; // Show the "Select Action" section
      changeAmountSection.style.display = 'none'; // Hide the change amount section
      backButtonSection.style.display = 'none'; // Hide the back button
      submitButtonSection.style.display = 'none'; // Hide the submit button
    });
  });
</script>