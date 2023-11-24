# Sakaycle - Tricycle Franchise Appointment System

## Description

Sakaycle is a web-based management system designed for tricycle franchise appointment management. The system facilitates processes such as tricycle registration, renewal, dropping of franchise, change of motorcycle, and transfer of ownership. It also includes SMS notifications to streamline and enhance the efficiency of these processes.

## Installation

1. **Clone the repository or download the zip file.**

   ```bash
   git clone https://github.com/lunestelle/PHP_Sakaycle.git 
2. **Move the sakaycle directory to the htdocs folder in your XAMPP installation.**
   - For example, if your XAMPP is installed on Windows and the htdocs directory is in C:\xampp, move the sakaycle directory to C:\xampp\htdocs.
4.  **Create a database named sakaycle in XAMPP.**
5. **Update the database configuration in the .env file**

   ```bash
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=sakaycle
6. **Import the database schema from sakaycle.sql into the sakaycle database.**
7. **Update php.ini file:
   - Uncomment the extension=gd line in your php.ini file to resolve issues related to the `imagecreatetruecolor()` function.** when creating new users which are used when generating its profile picture.
9. **Open the browser and navigate to localhost**

## Technologies Used

- PHP 8.2.12
- XAMPP
- [Bootstrap](https://getbootstrap.com) - Front-end framework for styling.
- [DataTables](https://datatables.net) - JavaScript library for interactive tables.
