<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
	/** Database configuration **/
	define('DB_NAME', 'sakaycle');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_DRIVER', 'mysql');

	define('ROOT', 'http://localhost/PHP_Sakaycle');
} else {
	/** Database configuration **/
	define('DB_NAME', 'sakaycle'); 
	define('DB_HOST', 'localhost');
	define('DB_USER', 'sakaycle_admin');
	define('DB_PASS', 'KYio]63K{9bf'); 
	define('DB_DRIVER', 'mysql');

	define('ROOT', 'https://wlccicte.com/otofa.com');
}

define('APP_NAME', "OTOFA");
define('APP_DESC', "Ormoc Tricycle Online Franchise Appointment");

/** Set to true to show errors **/
define('DEBUG', true);