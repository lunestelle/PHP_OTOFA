<?php

class Inquiries
{
  use Controller;

  public function index()
  {
    if (!is_authenticated()) {
      set_flash_message("Oops! You need to be logged in to view this page.", "error");
      redirect('');
    }

    // Define the required permissions for accessing the edit user page
    $requiredPermissions = [
      "Can view and respond to inquiries"
    ];

    // Check if the logged-in user has any of the required permissions
    $userPermissions = isset($_SESSION['USER']->permissions) ? explode(', ', $_SESSION['USER']->permissions) : [];
    if (!hasAnyPermission($requiredPermissions, $userPermissions)) {
      set_flash_message("Access denied. You don't have the required permissions.", "error");
      redirect('');
    }

    $messageFilter = $_GET['message_status'] ?? 'all';
    $responseFilter = $_GET['response_status'] ?? 'all';

    $inquiryModel = new Inquiry();
    $data['inquiries'] = [];
    $data['index'] = 1;
    $data['messageFilter'] = $messageFilter;
    $data['responseFilter'] = $responseFilter;

    if ($messageFilter === 'all' && $responseFilter === 'all') {
      $inquiriesData = $inquiryModel->findAll();
    } else {
      $inquiriesData = $inquiryModel->getFilteredInquiries($messageFilter, $responseFilter);
    }

    if (!empty($inquiriesData)) {
      foreach ($inquiriesData as $inquiry) {
        $data['inquiries'][] = [
					'id' => $inquiry->id,
          'full_name' => $inquiry->full_name,
          'email_or_phone' => $inquiry->email_or_phone,
          'message' => $inquiry->message,
          'message_status' => $inquiry->message_status,
          'response' => $inquiry->response,
          'response_status' => $inquiry->response_status,
        ];
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exportCsv'])) {
      $csvData = [];
      $csvData[] = ['Inquiries'];
      $csvData[] = ['Full Name', 'Email or Phone Number', 'Message', 'Message Status', 'Response', 'Response Status'];

      foreach ($data['inquiries'] as $inquiry) {
        $csvData[] = [
          $inquiry['full_name'],
          $inquiry['email_or_phone'],
          $inquiry['message'],
          $inquiry['message_status'],
          $inquiry['response'],
          $inquiry['response_status'],
        ];
      }

      downloadCsv($csvData, 'Inquiries_Export');
    }

    echo $this->renderView('inquiries', true, $data);
  }
}