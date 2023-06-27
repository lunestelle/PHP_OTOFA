{{sidebar}}

<!-- Kani na page dapat naa ni siyay filter by: driver and date -->
<div class="content">
  <div class="row">
    <div class="col-12 title-head text-uppercase">
      <h6>maintenance logs</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <div class="mt-3">
            <a href="#" class="text-uppercase sidebar-btnContent">New</a>
          </div>
        </div>
        <div class="col-12">
          <div class="container table-responsive pt-4"> 
            <table class="table-bordered table-hover">
              <thead class="thead-custom">
                <tr class="text-center text-uppercase">
                  <th scope="col">#</th>
                  <th scope="col">Plate No.</th>
                  <th scope="col">Driver's Name </th>
                  <th scope="col">Date</th>
                  <th scope="col">Expense</th>
                  <th scope="col">Description</th>
                  <th scope="col">Receipt</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr>
                  <th scope="row">1</th>
                  <td>123</td>
                  <td>Juan Dela Cruz</td>
                  <td>2023-06-18</td>
                  <td>150</td>
                  <td>Routine Maintenance</td>
                  <td><img src="<?=ROOT?>/assets/images/receipt-icon.png" alt="Receipt Image" width="40"></td>
                  <td>
                    <div class="col-auto d-flex justify-content-center">
                      <span href="#" class="view_data py-0 px-1 me-1" style="color:darkgoldenrod" title="View Product Details"><i class="fas fa-file-alt"></i></span>
                      <a href="#" class="edit_data text-primary py-0 px-1 me-1" title="Edit Product Details"><i class="fa fa-edit"></i></a>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>456</td>
                  <td>Pedro Kalungsod</td>
                  <td>2023-06-15</td>
                  <td>200</td>
                  <td>Repair work</td>
                  <td><img src="<?=ROOT?>/assets/images/receipt-icon.png" alt="Receipt Image" width="40"></td>
                  <td>
                    <div class="col-auto d-flex justify-content-center">
                      <span href="#" class="view_data py-0 px-1 me-1" style="color:darkgoldenrod" title="View Product Details"><i class="fas fa-file-alt"></i></span>
                      <a href="#" class="edit_data text-primary py-0 px-1 me-1" title="Edit Product Details"><i class="fa fa-edit"></i></a>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>