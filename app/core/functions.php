<?php

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