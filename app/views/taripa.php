<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">taripa</h6>
    </div>
    <div class="col-12">
      <div class="row mt-2">
        <?php if ($userRole === 'admin' || $userRole === 'personnel' || $userRole === 'operator'): ?>
          <?php if (hasPermission('Can generate taripa', $permissions)) { ?>
            <div class="col-12 mt-3">
              <a href="new_taripa" class="text-uppercase sidebar-btnContent mt-1 new-button">New</a>
            </div>
          <?php } ?>
        <?php endif; ?>
        <?php if (!empty($taripas) && $userRole === 'operator'): ?>
          <div class="col-12 mt-3">
            <form method="post" action="">
              <button type="submit" id="exportCsv" name="exportCsv" style="border: none; background: none; padding: 0; margin: 0;">
                <img src="public/assets/images/export-csv.png" style="height: 38px; width: 40px; position: absolute; top: 5px; right: 35px;" alt="export file">
              </button>
            </form>    
          </div>
        <?php endif; ?>
        <div class="col-6">
          <label for="routeAreaFilter" class="fw-bold" style="font-size: 13px;">Filter Route Area:</label>
          <select id="routeAreaFilter" class="form-select" style="height: 35px; font-size: 14px;">
            <option value="All">All</option>
            <option value="Free Zone / Zone 1">Free Zone / Zone 1</option>
            <option value="Free Zone & Zone 2">Freezone & Zone 2</option>
            <option value="Free Zone & Zone 3">Freezone & Zone 3</option>
            <option value="Free Zone & Zone 4">Freezone & Zone 4</option>
          </select>
        </div>
        <div class="col-6">
          <label for="yearFilter" class="fw-bold" style="font-size: 13px;">Filter Year:</label>
          <select id="yearFilter" class="form-select" style="height: 35px; font-size: 14px;">
            <?php foreach ($years as $year): ?>
              <option value="<?php echo $year; ?>" <?php echo ($year == $selectedFilter) ? 'selected' : ''; ?>><?php echo $year; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
    
    <div class="col-12">
      <div class="mb-3 pb-2">
        <button class="taripa-print text-uppercase" onclick="printTaripa(event)">Print</button>
        <button id="downloadPdfButton" class="taripa-download-pdf text-uppercase" onclick="downloadPdf()">Download PDF</button>
      </div>
      <?php if (!empty($taripas) && $userRole === 'admin') : ?>
        <div class="mt-3 text-end">
          <form method="post" action="">
            <button type="submit" id="exportCsv" name="exportCsv" style="border: none; background: none; padding: 0; margin: 0;">
              <img src="public/assets/images/export-csv.png" style="height: 38px; width: 40px; position: absolute; top: 5px; right: 100px;" alt="export file">
            </button>
          </form>    
        </div>
      <?php endif; ?>
      <div class="table-responsive pt-3">
        <table class="table table-hover" id="systemTable">
          <thead>
            <tr class="text-uppercase">
              <th scope="col" class="text-center">#</th>
              <?php if ($selectedFilter === 'All'): ?>
                <th scope="col" class="text-center">Route Area</th>
              <?php endif; ?>
              <th scope="col" class="text-center">Barangay</th>
              <th scope="col" class="text-center">Regular Fare</th>
              <th scope="col" class="text-center">Discounted Fare</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <?php foreach ($taripas as $taripa): ?>
              <tr>
                <td><?php echo $index++; ?></td>
                <?php if ($selectedFilter === 'All'): ?>
                  <td><?php echo $taripa['route_area']; ?></td>
                <?php endif; ?>
                <td><?php echo $taripa['barangay']; ?></td>
                <td><?php echo '₱' . number_format($taripa['regular_fare'], 2, '.', ''); ?></td>
                <td><?php echo '₱' . number_format($taripa['discounted_fare'], 2, '.', ''); ?></td>
              </tr>
            <?php endforeach; ?>   
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const selectedFilter = urlParams.get('route_area');
  const selectedYear = urlParams.get('year');

  // Set the selected filter values to the dropdowns
  if (selectedFilter) {
    document.getElementById("routeAreaFilter").value = selectedFilter;
  }

  if (selectedYear) {
    document.getElementById("yearFilter").value = selectedYear;
  }

  document.getElementById("routeAreaFilter").addEventListener("change", function() {
    const selectedValue = this.value;
    const yearFilter = document.getElementById("yearFilter").value;
    let url = 'taripa?route_area=' + encodeURIComponent(selectedValue);
    
    if (yearFilter !== 'All') {
      url += '&year=' + encodeURIComponent(yearFilter);
    }

    window.location.href = url;
  });

  document.getElementById("yearFilter").addEventListener("change", function() {
    const selectedValue = this.value;
    const routeAreaFilter = document.getElementById("routeAreaFilter").value;
    let url = 'taripa?year=' + encodeURIComponent(selectedValue);
    
    if (routeAreaFilter !== 'All') {
      url += '&route_area=' + encodeURIComponent(routeAreaFilter);
    }
    window.location.href = url;
  });

  function printTaripa(event) {
    // Create the iframe
    let printFrame = document.createElement('iframe');
    printFrame.style.position = 'fixed';
    printFrame.style.top = '-1000px';

    document.body.appendChild(printFrame);
    let taripaYear = document.getElementById("yearFilter").value;

    $.ajax({
      url: 'print_taripa_content?year=' + taripaYear,
      type: 'GET',
      dataType: 'html',
      success: function(data) {
        // Set the content of the iframe's document
        let doc = printFrame.contentDocument || printFrame.contentWindow.document;
        doc.open();

        doc.write('<html><head><style>@media print { @page { size: legal !important; margin: 0.1cm !important; } body { color: black !important; margin: 0.1cm !important; } .label { display: inline-block; width: 250px; white-space: nowrap; } .form-input-line { border-bottom: 0.5px solid black; margin-top: 1px; width: calc(100% - 160px); display: inline-block; box-sizing: border-box; } }</style></head><body>');


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
        console.error('Error fetching print_taripa_content:', textStatus, errorThrown);
        document.body.removeChild(printFrame);
      }
    });
  }

  window.jsPDF = window.jspdf.jsPDF;
  let docPDF = new jsPDF();

  function downloadPdf() {
    let taripaYear = document.getElementById("yearFilter").value;

    $.ajax({
      url: 'print_taripa_content?year=' + taripaYear,
      type: 'GET',
      dataType: 'html',
      success: function (data) {
        let styledData = '<html><head><meta charset="UTF-8"><style>@media print { @page { size: legal !important; margin: 0.1cm !important; } body { color: black !important; margin: 0.1cm !important; } .label { display: inline-block; width: 250px; white-space: nowrap; } .form-input-line { border-bottom: 0.5px solid black; margin-top: 1px; width: calc(100% - 160px); display: inline-block; box-sizing: border-box; } }</style><link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet"></head><body>';

        docPDF.html(styledData + data + '</body></html>', {
          callback: function () {
            docPDF.save(taripaYear + '_TRICYCLE_TARIPA.pdf');
          },
          x: 10,
          y: 10,
          width: 190,
          windowWidth: 1150
        });
      },
      error: function () {
        console.error('Error fetching content. Please try again.');
      }
    });
  }
</script>