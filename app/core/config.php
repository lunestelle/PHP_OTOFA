<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	/** Database configuration **/
	define('DB_NAME', 'sakaycle');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_DRIVER', 'mysql');

	define('ROOT', 'http://localhost/PHP_Sakaycle/public');
} else {
	/** Database configuration **/
	define('DB_NAME', 'sakaycle');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_DRIVER', 'mysql');

	define('ROOT', 'https://www.yourwebsite.com');
}

define('APP_NAME', "My Website");
define('APP_DESC', "Best website on the planet");

/** Set to true to show errors **/
define('DEBUG', true);