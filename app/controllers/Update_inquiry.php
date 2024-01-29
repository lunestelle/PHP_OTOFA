<?php

class Update_inquiry
{
  use Controller;

  public function index()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $inquiryModel = new Inquiry();

      if (isset($_POST['inquiryId']) && is_numeric($_POST['inquiryId']) && isset($_POST['inquiry-read-button'])) {
        $inquiryId = $_POST['inquiryId'];
        $inquiry = $inquiryModel->first(['id' => $inquiryId]);

        if ($inquiry->message_status === 'Unread') {
          $updated = $inquiryModel->update(['id' => $inquiryId], ['message_status' => 'read']);

          if ($updated) {
            set_flash_message("Message status updated successfully", "success"); 
          } else {
            set_flash_message("Error updating message status", "error");
          }
          redirect('inquiries');
        }
      } elseif (isset($_POST['inquiryId']) && is_numeric($_POST['inquiryId']) && isset($_POST['inquiry-respond-button'])) {
        $inquiryId = $_POST['inquiryId'];
        $response = $_POST['response'];
        $inquiry = $inquiryModel->first(['id' => $inquiryId]);

        $data = [
          'User' => $inquiry->full_name,
          'Message' => $response,
        ];

        $emailContent = $this->renderView('mailer/inquiry_response_email', false, $data);
        $smsContent = "Hello {$inquiry->full_name},\n\nThank you for reaching out to OTOFA! We appreciate your inquiry and the opportunity to assist you.\n\nAfter careful consideration, we would like to provide the following response to your inquiry:\n\n{$response}\n\nIf you have any further questions or need additional assistance, please feel free to contact us. We value your feedback and look forward to serving you.";

        $updated = $inquiryModel->update(['id' => $inquiryId], ['response' => $response, 'response_status' => 'responded']);

        if ($updated) {
          if (filter_var($inquiry->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            $subject = 'Inquiry Response';
            sendEmail($inquiry->email_or_phone, $subject, $emailContent);
          } else {
            sendSms($inquiry->email_or_phone, $smsContent); 
          }
          set_flash_message("Response sent successfully", "success");
          redirect('inquiries');
        } else {
          set_flash_message("Error updating message status", "error");
          redirect('inquiries');
        }
      } elseif (isset($_POST['exportCsv'])) {
        $inquiries = $inquiryModel->findAll();
        $csvData = [];
        $csvData[] = ['Full Name', 'Email or Phone Number', 'Message', 'Message Status', 'Response', 'Response Status'];

        foreach ($inquiries as $inquiry) {
          $csvData[] = [
            !empty($inquiry['full_name']) ? $inquiry['full_name'] : '----------------',
            !empty($inquiry['email_or_phone']) ? $inquiry['email_or_phone'] : '----------------',
            !empty($inquiry['message']) ? $inquiry['message'] : '----------------',
            !empty($inquiry['message_status']) ? $inquiry['message_status'] : '----------------',
            !empty($inquiry['response']) ? $inquiry['response'] : '----------------',
            !empty($inquiry['response_status']) ? $inquiry['response_status'] : '----------------',
          ];
        }

        downloadCsv($csvData, 'Inquiries_Export');
      }
    }
  }
}