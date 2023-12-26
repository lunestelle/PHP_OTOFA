<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Export Data</h6>
    </div>
    <div class="col-lg-12 mt-4">
      <div class="row mt-2">
        <div class="col-12">

          <div class="col-6">
            <label for="export_data" class="form-label fw-bold">Select Data to Export:</label>
            <select class="form-select" name="export_data" id="export_data">
              <option value="operators">Operators</option>
              <option value="drivers">Drivers</option>
              <option value="taripa">Taripa</option>
            </select>
          </div>

        </div>
      </div>
    </div>

    <div class="col-12">
      <div class="table-responsive pt-4">
        <table class="table table-hover" id="exportTable">
          <thead></thead>
          <tbody></tbody> <!-- Empty tbody to be populated dynamically -->
        </table>
      </div>
    </div>
  </div>
</main>
<script>
$(document).ready(function () {
  // Event listener for the export_data dropdown
  $('#export_data').change(function () {
    // Get the selected value
    var selectedData = $(this).val();

    // Make an AJAX request to fetch data for the selected option
    $.ajax({
      url: 'export', // Replace with the actual URL
      type: 'POST', // You can use 'GET' if appropriate
      data: { export_data: selectedData },
      dataType: 'json', // Change to the appropriate data type
      success: function (data) {
        // Update the table content based on the fetched data
        updateTable(data);
      },
      error: function (error) {
        console.log(error);
      }
    });
  });

  // Function to update the table content
  function updateTable(data) {
    // Clear existing table content
    $('#exportTable thead').empty();
    $('#exportTable tbody').empty();

    // Update the headers based on the selected data
    var headerRow = '<tr>';
    if ($('#export_data').val() === 'operators') {
      headerRow += '<th class="operator-columns">Full Name</th>';
      headerRow += '<th class="operator-columns">Phone Number</th>';
      headerRow += '<th class="operator-columns">Email</th>';
      headerRow += '<th class="operator-columns">Address</th>';
    } else if ($('#export_data').val() === 'drivers') {
      headerRow += '<th class="driver-columns">Name</th>';
      headerRow += '<th class="driver-columns">Birthdate</th>';
      headerRow += '<th class="driver-columns">Address</th>';
      headerRow += '<th class="driver-columns">Phone Number</th>';
      headerRow += '<th class="driver-columns">License Number</th>';
    } else if ($('#export_data').val() === 'taripa') {
      headerRow += '<th class="taripa-columns">Route Area</th>';
      headerRow += '<th class="taripa-columns">Barangay</th>';
      headerRow += '<th class="taripa-columns">Regular Rate</th>';
      headerRow += '<th class="taripa-columns">Student Rate</th>';
      headerRow += '<th class="taripa-columns">Senior & PWD Rate</th>';
    }
    headerRow += '</tr>';

    // Append the header row to the thead
    $('#exportTable thead').append(headerRow);

    // Populate the table with the new data
    $.each(data, function (index, row) {
      var newRow = '<tr>';
      // Add table columns based on the selected data
      if ($('#export_data').val() === 'operators') {
        newRow += '<td class="operator-columns">' + (row.full_name || '--------------') + '</td>';
        newRow += '<td class="operator-columns">' + (row.phone_number || '--------------') + '</td>';
        newRow += '<td class="operator-columns">' + (row.email || '--------------') + '</td>';
        newRow += '<td class="operator-columns">' + (row.address || '--------------') + '</td>';
      } else if ($('#export_data').val() === 'drivers') {
        newRow += '<td class="driver-columns">' + (row.name || '--------------') + '</td>';
        newRow += '<td class="driver-columns">' + (row.birthdate || '--------------') + '</td>';
        newRow += '<td class="driver-columns">' + (row.address || '--------------') + '</td>';
        newRow += '<td class="driver-columns">' + (row.phone_no || '--------------') + '</td>';
        newRow += '<td class="driver-columns">' + (row.license_no || '--------------') + '</td>';
      } else if ($('#export_data').val() === 'taripa') {
        newRow += '<td class="taripa-columns">' + (row.route_area || '--------------') + '</td>';
        newRow += '<td class="taripa-columns">' + (row.barangay || '--------------') + '</td>';
        newRow += '<td class="taripa-columns">' + (row.regular_rate || '--------------') + '</td>';
        newRow += '<td class="taripa-columns">' + (row.student_rate || '--------------') + '</td>';
        newRow += '<td class="taripa-columns">' + (row.senior_and_pwd_rate || '--------------') + '</td>';
      }
      newRow += '</tr>';
      $('#exportTable tbody').append(newRow);
    });
  }

  // Trigger the change event to initially populate the table with default data
  $('#export_data').trigger('change');
});
</script>
