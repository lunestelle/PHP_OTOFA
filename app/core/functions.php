<?php
require 'public/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Infobip\Api\SmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\ApiException;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

function show($stuff)
{
	echo "<pre>";
	print_r($stuff);
	echo "</pre>";
}

function escape_html_tags($str)
{
	return htmlspecialchars($str, ENT_QUOTES);
}

function redirect($path)
{
	header("Location: " . ROOT . "/" . $path);
	exit;
}

function sanitize_text($text)
{
	$text = nl2br($text);
	$text = escape_html_tags($text);
	return $text;
}

function is_authenticated()
{
	return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
}

function set_flash_message($message, $type = 'default')
{
	$_SESSION['flash_message'] = [
		'message' => $message,
		'type' => $type,
	];
}

function display_flash_message()
{
	if (isset($_SESSION['flash_message'])) {
		$message_type = $_SESSION['flash_message']['type'] ?? 'default';
		$css_class = '';

		switch ($message_type) {
			case 'success':
				$css_class = 'success';
				break;
			case 'error':
				$css_class = 'error';
				break;
			default:
				$css_class = 'default';
				break;
		}

		echo "<p class=\"flash-message $css_class\" id=\"flash-message\">";
		echo $_SESSION['flash_message']['message'];
		echo "</p>";

		unset($_SESSION['flash_message']);
	}
}

function checkInactivityTimeout()
{
	$timeoutDuration = 3600; // 1 hr in seconds

	if (is_authenticated()) {
		if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeoutDuration) {
			unset($_SESSION['USER']);
			unset($_SESSION['authenticated']);
			unset($_SESSION['last_activity']);
			set_flash_message("You have been logged out due to inactivity.", "default");
			redirect('');
			exit();
		} else {
			$_SESSION['last_activity'] = time(); // Update the last activity time
		}
	} elseif (isset($_SESSION['last_activity'])) {
		// User is not authenticated, but there is a last activity time set
		unset($_SESSION['last_activity']);
	}
}

function formatTime($time) {
	$options = ['hour' => 'numeric', 'minute' => '2-digit', 'hour12' => true];
	[$hours, $minutes] = explode(':', $time);
	$date = new DateTime();
	$date->setTime($hours, $minutes);
	return $date->format('h:i A');
}

function generateProfilePicture($initials) {
	// Set the image size
	$width = 100;
	$height = 100;
	
	// Create an image with a white background
	$image = imagecreatetruecolor($width, $height);
	$bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
	imagefill($image, 0, 0, $bgColor);
	
	list($r, $g, $b) = sscanf("#ff4200", "#%2x%2x%2x");
	$textColor = imagecolorallocate($image, $r, $g, $b);

	// Calculate the position to center the initials
	$fontSize = 40;
	$bbox = imagettfbbox($fontSize, 0, 'public/assets/fonts/Europa-Regular.ttf', $initials);
	$textWidth = $bbox[2] - $bbox[0];
	// Cast to integer if needed
	$x = (int)(($width - $textWidth) / 2);
	$y = (int)(($height + $fontSize) / 2);
	
	// Add the initials to the image
	imagettftext($image, $fontSize, 0, $x, $y, $textColor, 'public/assets/fonts/Europa-Regular.ttf', $initials);
	
	$path = 'public/profile_photos/generated_profile/' . uniqid() . '.png';
	header('Content-type: image/png'); 
	imagepng($image, $path);
	
	// Free up memory
	imagedestroy($image);
	
	return $path;
}

function hasStatus($statuses, $targetStatus) {
	foreach ($statuses as $status) {
		if ($status['status'] == $targetStatus) {
			return true;
		}
	}
	return false;
}

function hasStatusToUpdate($statuses) {
	foreach ($statuses as $status) {
		if ($status['status'] !== 'Dropped') {
			return true;
		}
	}
	return false;
}

function sendSms($phoneNumber, $message)
{

	$infobipConfiguration = new Configuration(
	    host: 'https://dk2ldr.api.infobip.com',
	    apiKey: '0aa57b4957d90ef24189830ed3d99fc1-43a40241-4c0d-426b-b27a-dc26a287849b'
	);
	$infobipSmsApi = new SmsApi(config: $infobipConfiguration);
	$infobipDestination = new SmsDestination(to: $phoneNumber);
	$infobipMessage = new SmsTextualMessage(
		destinations: [$infobipDestination],
		text: $message,
		from: "OTOFA"
	);
	$infobipRequest = new SmsAdvancedTextualRequest(messages: [$infobipMessage]);

	try {
		return $infobipSmsApi->sendSmsMessage($infobipRequest);
		
		// Check if the Infobip SMS was sent successfully
		// $smsResponse = $infobipSmsApi->sendSmsMessage($infobipRequest);
		// if ($smsResponse->getMessages()[0]->getStatus()->getName() === 'DELIVERED') {
		// 	return ['success' => true, 'message' => 'Infobip SMS sent successfully'];
		// } else {
		// 		return ['success' => false, 'message' => 'Infobip SMS sending failed'];
		// }
	} catch (\Exception $infobipException) {
		// echo("HTTP Code: " . $infobipException->getCode() . "\n");

		$smsGateway24BaseUrl = "https://smsgateway24.com";
		$smsGateway24Endpoint = "/getdata/addsms";
		$smsGateway24ApiKey = "02936db9235ef9d923ff9cb9661784a6"; 

		$guzzleClient = new Client([
			'base_uri' => $smsGateway24BaseUrl,
			'timeout' => 50.0,
		]);

		$paramsArr = [
			'token' => $smsGateway24ApiKey,
			'sendto' => $phoneNumber,
			'body' => $message,
			'device_id' => '11297',
			'sim' => '1',
			'urgent' => '1',
		];

		$formParams = ['form_params' => $paramsArr];

		try {
			$response = $guzzleClient->request('POST', $smsGateway24Endpoint, $formParams);

			// $responseData = json_decode($response->getBody(), true);
			// if (isset($responseData['error']) && $responseData['error'] === 0) {
			// 	return ['success' => true, 'message' => 'SmsGateway24 SMS sent successfully'];
			// } else {
			// 	return ['success' => false, 'message' => 'SmsGateway24 SMS sending failed'];
			// }
		} catch (\GuzzleHttp\Exception\RequestException $smsGateway24Exception) {
			error_log("Guzzle Exception: " . $smsGateway24Exception->getMessage());
			return ['success' => false, 'message' => 'SmsGateway24 SMS sending failed'];
		}
	}
}

function sendEmail($to, $subject, $body)
{
	// Check if the code is running on localhost
	if ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
		$mailerLocal = new PHPMailer(true);
		$mailerLocal->isSMTP();
		$mailerLocal->Host = 'smtp.gmail.com';
		$mailerLocal->Port = 465;
		$mailerLocal->SMTPSecure = 'ssl';
		$mailerLocal->SMTPAuth = true;
		$mailerLocal->Username = 'sakaycle@gmail.com';
		$mailerLocal->Password = 'hjhvxjbbxrmvxjkl';

		$mailerLocal->setFrom('sakaycle@gmail.com', 'OTOFA');
		$mailerLocal->addAddress($to);
		$mailerLocal->Subject = $subject;
		$mailerLocal->Body = $body;
		$mailerLocal->isHTML(true);
	} else {
		$mailerGoDaddy = new PHPMailer(true);
		$mailerGoDaddy->isSMTP();
		$mailerGoDaddy->Host = 'wlccicte.com';
		$mailerGoDaddy->Port = 465;
		$mailerGoDaddy->SMTPSecure = 'ssl';
		$mailerGoDaddy->SMTPAuth = true;
		$mailerGoDaddy->Username = 'info@wlccicte.com';
		$mailerGoDaddy->Password = 'otofa';

		$mailerGoDaddy->setFrom('info@wlccicte.com', 'OTOFA');
		$mailerGoDaddy->addAddress($to);
		$mailerGoDaddy->Subject = $subject;
		$mailerGoDaddy->Body = $body;
		$mailerGoDaddy->isHTML(true);
	}

	// Use the appropriate mailer object
	$mailer = isset($mailerLocal) ? $mailerLocal : $mailerGoDaddy;

	if (!$mailer->send()) {
		return 'Email could not be sent. Please try again later';
	} else {
		return 'success';
	}
}

function sendAppointmentNotifications($appointmentFormData, $data, $tricycleApplicationData, $cinNumber, $customTextMessage = null, $customEmailMessage = null, $customRequirementMessage = null)
{
  $phoneNumber = $appointmentFormData['phone_number'];
  $email = $appointmentFormData['email'];
  $status = $appointmentFormData['status'];
  $appointmentDate = strtotime($appointmentFormData['appointment_date']);
  $formattedDate = date('F j, Y', $appointmentDate);
  $formattedTime = date('h:i A', strtotime($appointmentFormData['appointment_time']));
  $rootPath = ROOT;

	// Check if the CIN numbers are provided as an array
	if (is_array($cinNumber)) {
		$cinNumberString = 'CIN ';
		$cinCount = count($cinNumber);
		foreach ($cinNumber as $key => $cin) {
			if ($key == $cinCount - 1 && $cinCount > 1) {
				$cinNumberString .= "and #{$cin}";
			} else {
				$cinNumberString .= "#{$cin}, ";
			}
		}
	} else {
		$cinNumberString = "CIN #{$cinNumber}";
	}

	if ($status === 'Approved') {
    $message = $customTextMessage;
    $subject = "Appointment Approved";
    $user = "Hello {$appointmentFormData['name']},";
    $emailMessage = $customEmailMessage;
    $requirements = $customRequirementMessage;
    $subMessage = "For more details, please check your appointment details on our website by clicking the button below.";
    $buttonLink = "$rootPath";

		if ($appointmentFormData['appointment_type'] === 'Renewal of Franchise'){
			$routeArea = $tricycleApplicationData->route_area;
			$penaltyFee = ($routeArea === 'Free Zone / Zone 1') ? '₱122.50' : '₱272.50';
			// Check if the appointment date is past January 20
			if ($appointmentDate > strtotime(date('Y-01-20'))) {
				$requirements .= "\n<div style='text-align: justify;margin-top:10px; color:#455056; font-size:15px; line-height:24px;'>Please be informed that your appointment is past the renewal period for the tricycle franchise, which occurred from December 20th to January 20th and a penalty of {$penaltyFee} is applicable due to late renewal.</div>";
				$message .= "\n\nNote: Please be informed that your appointment is past the renewal period for the tricycle franchise, which occurred from December 20 to January 20 and a penalty of {$penaltyFee} is applicable due to late renewal.\n";
			}
		}
		
		ob_start();
		include_once "app/views/mailer/approved_appointment_email.php";
		$templateContent = ob_get_clean();

		$templateContent = str_replace('{{Subject}}', $subject, $templateContent);
		$templateContent = str_replace('{{User}}', $user, $templateContent);
		$templateContent = str_replace('{{Message}}', nl2br($emailMessage), $templateContent);
		$templateContent = str_replace('{{Requirements}}', nl2br($requirements), $templateContent);
		$templateContent = str_replace('{{SubMessage}}', nl2br($subMessage), $templateContent);
		$templateContent = str_replace('{{SiteLink}}', nl2br($buttonLink), $templateContent);

		sendSms($phoneNumber, $message);
		sendEmail($email, $subject, $templateContent);
	} elseif ($status === 'Declined') {
		$message = "Hello {$appointmentFormData['name']},\n\nWe regret to inform you that your request for {$appointmentFormData['appointment_type']} appointment for tricycle {$cinNumberString} on {$formattedDate} at {$formattedTime} cannot be approved as some required documents are either missing or outdated. To finalize your appointment, please ensure that all necessary documents are current. Additionally, please review the feedback or comment section on the website for more details about your appointment: {$rootPath}.\n\nThank you for your understanding and cooperation.";

		$subject = "Appointment Declined";
		$user = "Hello {$appointmentFormData['name']},";
		$emailMessage = "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin-top:10px;'>We regret to inform you that your request for {$appointmentFormData['appointment_type']} appointment for tricycle {$cinNumberString} on <strong>{$formattedDate}</strong> at <strong>{$formattedTime}</strong> cannot be approved as some required documents are either missing or outdated. To finalize your appointment, please ensure that all necessary documents are current. If you have any questions or need assistance in updating your information, do not hesitate to reach out by replying to this email. Additionally, please review the feedback or comment section on the website for more details about your appointment by clicking the button below.</div>";
		$buttonLink = "$rootPath";
		$subMessage = "Thank you for your understanding and cooperation.";
	
		ob_start();
		include_once "app/views/mailer/appointment_email_template.php";
		$templateContent = ob_get_clean();
	
		$templateContent = str_replace('{{Subject}}', $subject, $templateContent);
		$templateContent = str_replace('{{User}}', nl2br($user), $templateContent);
		$templateContent = str_replace('{{Message}}', $emailMessage, $templateContent);
		$templateContent = str_replace('{{SiteLink}}', nl2br($buttonLink), $templateContent);
		$templateContent = str_replace('{{SubMessage}}', nl2br($subMessage), $templateContent);
	
		sendSms($phoneNumber, $message);
		sendEmail($email, $subject, $templateContent);
	} elseif ($status === 'On Process') {
		$message = "Hello {$appointmentFormData['name']},\n\nWe wanted to inform you that we have received your requirements of your {$appointmentFormData['name']} appointment with tricycle {$cinNumberString} and it's currently undergoing processing. Our team is actively engaged in assessing the details provided. We aim to complete this assessment within the expected timeframe and will notify you promptly upon its successful completion.\n\nThank you for your understanding and cooperation.\n\nFor more details, please check your appointment details on our website by clicking the link: {$rootPath}.";

		$subject = "Appointment On Process";
		$user = "Hello {$appointmentFormData['name']},";
		$emailMessage = "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin-top:10px;'>We wanted to inform you that we have received your requirement of your {$appointmentFormData['name']} appointment with tricycle {$cinNumberString} and it's currently undergoing processing. Our team is actively engaged in assessing the details provided. We aim to complete this assessment within the expected timeframe and will notify you promptly upon its successful completion. 
		</div>";
		$buttonLink = "$rootPath";
		$subMessage = "Thank you for your understanding and cooperation.";
	
		ob_start();
		include_once "app/views/mailer/appointment_email_template.php";
		$templateContent = ob_get_clean();
	
		$templateContent = str_replace('{{Subject}}', $subject, $templateContent);
		$templateContent = str_replace('{{User}}', nl2br($user), $templateContent);
		$templateContent = str_replace('{{Message}}', $emailMessage, $templateContent);
		$templateContent = str_replace('{{SiteLink}}', nl2br($buttonLink), $templateContent);
		$templateContent = str_replace('{{SubMessage}}', nl2br($subMessage), $templateContent);
	
		sendSms($phoneNumber, $message);
		sendEmail($email, $subject, $templateContent);
	} elseif ($status === 'Completed') {
		$message = "Hello {$appointmentFormData['name']},\n\nWe are pleased to inform you that your {$appointmentFormData['name']} appointment for tricycle {$cinNumberString} scheduled for {$formattedDate} at {$formattedTime} has been successfully completed. You can now obtain a copy of the processed papers at our Transportation Development Franchising and Regulatory Office (TDFRO) in Ormoc City Hall. For additional information and updates, please click the link below to visit our website.\n\nThank you for choosing our services.\n\n {$rootPath}";

		$subject = "Appointment Completed";
		$user = "Hello {$appointmentFormData['name']},";
		$emailMessage = "<div style='text-align: justify; color:#455056; font-size:15px;line-height:24px; margin-top:10px;'>We are pleased to inform you that your {$appointmentFormData['name']} appointment for tricycle {$cinNumberString} scheduled for <strong>{$formattedDate}</strong> at <strong>{$formattedTime}</strong> has been successfully completed. You can now obtain a copy of the processed papers at our Transportation Development Franchising and Regulatory Office (TDFRO) in Ormoc City Hall. For additional information and updates, please click the button below to visit our website.</div>";
		$buttonLink = "$rootPath";
		$subMessage = "Thank you for choosing our services.";
	
		ob_start();
		include_once "app/views/mailer/appointment_email_template.php";
		$templateContent = ob_get_clean();
	
		$templateContent = str_replace('{{Subject}}', $subject, $templateContent);
		$templateContent = str_replace('{{User}}', nl2br($user), $templateContent);
		$templateContent = str_replace('{{Message}}', $emailMessage, $templateContent);
		$templateContent = str_replace('{{SiteLink}}', nl2br($buttonLink), $templateContent);
		$templateContent = str_replace('{{SubMessage}}', nl2br($subMessage), $templateContent);
	
		sendSms($phoneNumber, $message);
		sendEmail($email, $subject, $templateContent);
	}
}

function systemNotifications($phoneNumber, $userName, $email, $subject, $customTextMessage = null, $customEmailMessage = null)
{
	$rootPath = ROOT;
	$message = $customTextMessage;

	$user = "Hello {$userName},";
	$emailMessage = $customEmailMessage;
	$subMessage = "For more details, please check the website by clicking the button below.";
	$buttonLink = "$rootPath";

	ob_start();
	include_once "app/views/mailer/appointment_email_template.php";
	$templateContent = ob_get_clean();

	$templateContent = str_replace('{{Subject}}', $subject, $templateContent);
	$templateContent = str_replace('{{User}}', $user, $templateContent);
	$templateContent = str_replace('{{Message}}', nl2br($emailMessage), $templateContent);
	$templateContent = str_replace('{{SubMessage}}', nl2br($subMessage), $templateContent);
	$templateContent = str_replace('{{SiteLink}}', nl2br($buttonLink), $templateContent);

	sendSms($phoneNumber, $message);
	sendEmail($email, $subject, $templateContent);
}

function downloadCsv($data, $filename)
{
	header('Content-Type: text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

	$output = fopen('php://output', 'w');
	foreach ($data as $row) {
		fputcsv($output, $row);
	}
	fclose($output);

	exit();
}

function hasPermission($permission, $userPermissions) {
	return in_array($permission, $userPermissions);
}

function hasAnyPermission($requiredPermissions, $userPermissions) {
  foreach ($requiredPermissions as $requiredPermission) {
    // Check if the user has the current required permission
    if (in_array($requiredPermission, $userPermissions)) {
      return true;
    }
  }
  return false;
}