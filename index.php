<?php

session_start(); // Starts the PHP session

require "app/core/init.php"; // Includes the initialization file, which sets up the application

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0); // Sets the error display based on the DEBUG constant

$app = new App(); // Creates an instance of the App class
$app->loadController(); // Calls the loadController method of the App instance