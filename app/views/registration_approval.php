<!-- The statuses provided in this example are:

Pending: This status indicates that the application is awaiting review and approval/rejection.
Approved: This status indicates that the application has been reviewed and approved by the staff from the Local Government.
Rejected: This status indicates that the application has been reviewed and rejected by the staff from the Local Government. -->

<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>Registration Applications</h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <div class="container table-responsive pt-4"> 
                <table class="table-bordered table-hover">
                  <thead class="thead-custom">
                    <tr class="text-center text-uppercase">
                      <th scope="col">#</th>
                      <th scope="col">Operator's Name</th>
                      <th scope="col">Contact Information</th>
                      <th scope="col">Tricycle Model</th>
                      <th scope="col">Plate No.</th>
                      <th scope="col">Color Code</th>
                      <th scope="col">Status</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <tr>
                      <th scope="row">1</th>
                      <td>John Doe</td>
                      <td>john@example.com</td>
                      <td>XYZ Model</td>
                      <td>ABC-123</td>
                      <td>Blue</td>
                      <td>Pending</td>
                      <td class="py-0 px-1">
                        <div class="col-auto d-flex justify-content-center">
                          <a href="#" class="view-data-btn py-0 px-1 me-1 btn btn-primary">
                            <i class="fas fa-file-alt"></i>
                            View Details
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jane Smith</td>
                      <td>jane@example.com</td>
                      <td>ABC Model</td>
                      <td>DEF-456</td>
                      <td>Red</td>
                      <td>Approved</td>
                      <td class="py-0 px-1">
                        <div class="col-auto d-flex justify-content-center">
                          <a href="#" class="view-data-btn py-0 px-1 me-1 btn btn-primary">
                            <i class="fas fa-file-alt"></i>
                            View Details
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td>Mark Johnson</td>
                      <td>mark@example.com</td>
                      <td>PQR Model</td>
                      <td>GHI-789</td>
                      <td>Yellow</td>
                      <td>Rejected</td>
                      <td class="py-0 px-1">
                        <div class="col-auto d-flex justify-content-center">
                          <a href="#" class="view-data-btn py-0 px-1 me-1 btn btn-primary">
                            <i class="fas fa-file-alt"></i>
                            View Details
                          </a>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">4</th>
                      <td>Lito Gaspi</td>
                      <td>mark@example.com</td>
                      <td>PQR Model</td>
                      <td>GHI-790</td>
                      <td>Green</td>
                      <td>Rejected</td>
                      <td class="py-0 px-1">
                        <div class="col-auto d-flex justify-content-center">
                          <a href="#" class="view-data-btn py-0 px-1 me-1 btn btn-primary">
                            <i class="fas fa-file-alt"></i>
                            View Details
                          </a>
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
    </main>
  </div>
</div>