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

    $inquiryModel = new Inquiry();
    $inquiriesData = $inquiryModel->findAll();
    $data['inquiries'] = [];
    $data['index'] = 1;

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