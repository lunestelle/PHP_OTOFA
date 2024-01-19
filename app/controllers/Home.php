<?php 

class Home
{
	use Controller;

	public function index()
	{
		$data = [];

		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_message'])) {
			$inquiryModel = new Inquiry();
	
			$inquiryData = [
				'full_name' => $_POST['full_name'] ?? '',
				'email_or_phone' => $_POST['email_or_phone'] ?? '',
				'message' => $_POST['message'] ?? '',
			];

			$data['validationErrors'] = $inquiryModel->validate($inquiryData);
			if (!empty($data['validationErrors'])) {
				foreach ($data['validationErrors'] as $error) {
					set_flash_message($error, 'error');
					$data = array_merge($data, $inquiryData);
				}
			} else {
				if ($inquiryModel->insert($inquiryData)) {
					set_flash_message("Message sent successfully.", "success");
				} else {
					set_flash_message("Failed to send message.", "error");
				}

				redirect('');
			}
		}

		echo $this->renderView('home', true, $data);
	}
}