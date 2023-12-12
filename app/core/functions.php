<?php

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;
use Twilio\Rest\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'public/phpmailer/src/Exception.php';
require 'public/phpmailer/src/PHPMailer.php';
require 'public/phpmailer/src/SMTP.php';

require "public/vendor/autoload.php";

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
	$timeoutDuration = 900; // 15 minutes in seconds

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

function sendSms($phoneNumber, $message)
{
	// First SMS Gateway (Infobip)
	$infobipBaseUrl = "xl9v6g.api.infobip.com";
	$infobipApiKey = "99213ffff87a1b97867d5365edfdac3b-8d2c3f10-e175-4afd-8307-d6940b95fc26";

	$infobipConfiguration = new Configuration(host: $infobipBaseUrl, apiKey: $infobipApiKey);
	$infobipApi = new SmsApi(config: $infobipConfiguration);
	$infobipDestination = new SmsDestination(to: $phoneNumber);
	$infobipMessage = new SmsTextualMessage(
		destinations: [$infobipDestination],
		text: $message,
		from: "sakaycle.com"
	);
	$infobipRequest = new SmsAdvancedTextualRequest(messages: [$infobipMessage]);

	try {
		return $infobipApi->sendSmsMessage($infobipRequest);
	} catch (\Exception $infobipException) {
		// Second SMS Gateway (SmsGateway24)
		$smsGateway24BaseUrl = "https://smsgateway24.com";
		$smsGateway24Endpoint = "/getdata/addsms";
		$smsGateway24ApiKey = "02936db9235ef9d923ff9cb9661784a6"; 

		$guzzleClient = new Client([
			'base_uri' => $smsGateway24BaseUrl,
			'timeout' => 2.0,
		]);

		$paramsArr = [
			'token' => $smsGateway24ApiKey,
			'sendto' => $phoneNumber,
			'body' => $message,
			'device_id' => '11297',
			'sim' => '0',
			'urgent' => '1',
		];

		$formParams = ['form_params' => $paramsArr];

		try {
			$response = $guzzleClient->request('POST', $smsGateway24Endpoint, $formParams);

			// Example of a good answer:
			// {"error":0,"sms_id":22074938,"message":"Sms has been saved successfully"}
			return json_decode($response->getBody(), true);
		} catch (RequestException $smsGateway24Exception) {
			return null;
		}
	}
}

function sendEmail($to, $subject, $body)
{
  $mailer = new PHPMailer;
  $mailer->isSMTP();
  $mailer->Host = 'smtp.gmail.com';
  $mailer->Port = 465;
  $mailer->SMTPSecure = 'ssl';
  $mailer->SMTPAuth = true;
  $mailer->Username = 'sakaycle@gmail.com';
  $mailer->Password = 'hagfqeqlqdtyhqzi'; 

  $mailer->setFrom('sakaycle@gmail.com', 'Sakaycle');
  $mailer->addAddress($to);
  $mailer->Subject = $subject;
  $mailer->Body = $body;
  $mailer->isHTML(true);

  if (!$mailer->send()) {
    return 'Email could not be sent. Please try again later';
  } else {
    return 'success';
  }
}
