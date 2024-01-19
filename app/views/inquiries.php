<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
  <div class="row">
    <div class="col-12 text-uppercase nav-top">
      <h6 class="title-head">Inquiries</h6>
    </div>
    <div class="col-lg-12">
      <div class="row">
        <div class="col-12">
          <?php if (!empty($inquiries)): ?>
            <div class="mt-3 text-end">
              <form method="post" action="">
                <button type="submit" id="exportCsv" name="exportCsv" class="export-btn">Export as CSV</button>
              </form>
            </div>
          <?php endif; ?>
          <div class="table-responsive pt-4">
            <table class="table table-hover" id="systemTable">
              <thead class="thead-custom">
                <tr class="text-uppercase">
                  <th scope="col" class="text-center">Full Name</th>
                  <th scope="col" class="text-center">Email or Phone Number</th>
                  <th scope="col" class="text-center">Message</th>
                  <th scope="col" class="text-center">Message Status</th>
                  <th scope="col" class="text-center">Response</th>
                  <th scope="col" class="text-center">Response Status</th>
                  <th scope="col" class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="text-center text-capitalize">
                <?php foreach ($inquiries as $inquiry): ?>
                  <tr>
                    <td><?= !empty($inquiry['full_name']) ? $inquiry['full_name'] : '----------------'; ?></td>
                    <td class="text-lowercase"><?= !empty($inquiry['email_or_phone']) ? $inquiry['email_or_phone'] : '----------------'; ?></td>
                    <td class="text-start text-truncate" style="max-width: 150px;">
                      <?= !empty($inquiry['message']) ? $inquiry['message'] : '----------------'; ?>
                    </td>
                    <td>
                      <span class="badge bg-primary text-uppercase p-2"><?= !empty($inquiry['message_status']) ? $inquiry['message_status'] : '----------------'; ?></span>
                    </td>
                    <td class="text-start text-justify"><?= !empty($inquiry['response']) ? substr($inquiry['response'], 0, 100) . '...' : '----------------'; ?></td>
                    <td>
                      <span class="badge bg-success text-uppercase p-2"><?= !empty($inquiry['response_status']) ? $inquiry['response_status'] : '----------------'; ?></span>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm" style="font-size: 12px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#readModal<?= $inquiry['id']; ?>">
                          View Message
                        </button>
                        <?php if (!empty($inquiry['response'])): ?>
                          <button type="button" class="btn btn-info btn-sm" style="font-size: 12px; font-weight: bold;" data-bs-toggle="modal" data-bs-target="#viewResponseModal<?= $inquiry['id']; ?>">
                            View Response
                          </button>
                        <?php else: ?>
                          <button type="button" class="btn btn-success btn-sm" style="font-size: 12px;" data-bs-toggle="modal" data-bs-target="#respondModal<?= $inquiry['id']; ?>">
                          Respond
                        </button>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>

                  <!-- Read Modal -->
                  <div class="modal fade" id="readModal<?= $inquiry['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="readModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <form id="readForm<?= $inquiry['id']; ?>" method="post" action="update_inquiry">
                          <div class="modal-header">
                            <h5 class="modal-title" id="readModalLabel">Read Message</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-inquiry-id="<?= $inquiry['id']; ?>" data-modal-type="read"></button>
                          </div>
                          <div class="modal-body">
                            <?= !empty($inquiry['message']) ? $inquiry['message'] : 'No message available'; ?>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-inquiry-id="<?= $inquiry['id']; ?>" data-modal-type="read">Close</button>
                          </div>
                          <input type="hidden" name="inquiryId" value="<?= $inquiry['id']; ?>">
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Respond Modal -->
                  <div class="modal fade" id="respondModal<?= $inquiry['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="respondModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <form id="respondForm<?= $inquiry['id']; ?>" method="post" action="update_inquiry">
                          <div class="modal-header">
                            <h5 class="modal-title" id="respondModalLabel">Respond to Inquiry</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" data-inquiry-id="<?= $inquiry['id']; ?>" data-modal-type="respond"></button>
                          </div>
                          <div class="modal-body">
                            <textarea class="form-control w-100" style="width: 100% !important; height: 100%;" rows="8" name="response" placeholder="Write your response here..."></textarea>
                            <input type="hidden" name="inquiryId" value="<?= $inquiry['id']; ?>">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="inquiry-respond-button">Send Response</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-inquiry-id="<?= $inquiry['id']; ?>" data-modal-type="respond">Close</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- View Response Modal -->
                  <div class="modal fade" id="viewResponseModal<?= $inquiry['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewResponseModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="viewResponseModalLabel">View Response</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <?= !empty($inquiry['response']) ? $inquiry['response'] : 'No response available'; ?>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    <?php foreach ($inquiries as $inquiry): ?>
      var modal<?= $inquiry['id']; ?> = document.getElementById('readModal<?= $inquiry['id']; ?>');
      
      modal<?= $inquiry['id']; ?>.addEventListener('hidden.bs.modal', function () {
        var form = document.getElementById('readForm<?= $inquiry['id']; ?>');
        var status = '<?= $inquiry['message_status']; ?>'; // Get the current message status

        // Check if the status is 'unread' before submitting the form
        if (status.toLowerCase() === 'unread') {
          var submitButton = document.createElement('input');
          submitButton.type = 'hidden';
          submitButton.name = 'inquiry-read-button'; // Set the desired name
          form.appendChild(submitButton);
          form.submit();
        }
      });
    <?php endforeach; ?>
  });
</script>