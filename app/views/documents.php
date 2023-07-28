<!--
  The concept of "Active" and "Inactive" statuses can be used to represent the availability or validity of a document. Also, on the actions column it should contain a view btn which redirects user to the uploaded document.

  The status can also be "Expired" or "Pending".
-->

<div class="container-fluid">
  <div class="row">
    {{sidebar}} 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
      <div class="row">
        <div class="col-12 title-head text-uppercase">
          <h6>documents</h6>
        </div>
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <div class="mt-3">
                <a href="#" class="text-uppercase sidebar-btnContent">Upload</a>
              </div>
            </div>
            <div class="col-12">
              <div class="container table-responsive pt-4">
                <table class="table table-hover">
                  <thead class="thead-custom">
                    <tr class="text-center text-uppercase">
                      <th scope="col">#</th>
                      <th scope="col">Document Name</th>
                      <th scope="col">Document Type</th>
                      <th scope="col">Upload Date</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php foreach ($documents as $index => $document): ?>
                      <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td class="text-capitalize"><?php echo $document['document_name']; ?></td>
                        <td><?php echo $document['document_type']; ?></td>
                        <td><?php echo $document['upload_date']; ?></td>
                        <td>
                          <a href="#" class="view-data-btn me-1 btn btn-primary fs-4" onclick="openFileModal('<?php echo $document['document_url']; ?>')">Download</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="fileModal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content authentication-modal">
            <div class="modal-header border border-bottom-0 pb-0">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5">
              <div id="fileViewerContainer" class="text-center"></div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

<script>
  let modal = document.getElementById("fileModal");
  function openFileModal(fileUrl) {
    let fileExtension = fileUrl.split('.').pop().toLowerCase();

    // Clear the fileViewerContainer
    let fileViewerContainer = document.getElementById("fileViewerContainer");
    fileViewerContainer.innerHTML = '';

    if (fileExtension === 'pdf' || fileExtension === 'doc' || fileExtension === 'docx' || fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'gif' || fileExtension === 'xlsx') {
      downloadFile(fileUrl);
    } else {
      // For other document types, open the file in a new tab
      window.open(fileUrl, '_blank');
    }
  }

  // Function to download PDF and DOCX files
  function downloadFile(fileUrl) {
    let link = document.createElement('a');
    link.href = fileUrl;
    link.target = '_blank';
    link.download = 'download';
    link.click();
  }
</script>