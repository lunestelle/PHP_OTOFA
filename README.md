# OTOFA - Ormoc Tricycle Online Franchise Appointment

## Description

OTOFA is a web-based management system designed for tricycle franchise appointment management. The system facilitates processes such as tricycle registration, renewal, dropping of franchise, change of motorcycle, and transfer of ownership. It also includes SMS notifications to streamline and enhance the efficiency of these processes.

## Technologies Used

- PHP 8.2.12
- XAMPP
- [Bootstrap](https://getbootstrap.com) - Front-end framework for styling.
- [DataTables](https://datatables.net) - JavaScript library for interactive tables.
- [FontAwesome](https://fontawesome.com) - Icon toolkit for scalable vector icons.
- [Google Charts](https://developers.google.com/chart) - JavaScript library for creating interactive charts.
- [html2canvas](https://html2canvas.hertzen.com) - JavaScript library to take screenshots of web pages.
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - PHP library for sending email.
- [Infobip](https://www.infobip.com) - SMS notification service.

## Installation

1. **Clone the repository or download the zip file.**

   ```bash
   git clone https://github.com/lunestelle/PHP_OTOFA.git
   
2. **Move the otofa directory to the htdocs folder in your XAMPP installation.**
   - For example, if your XAMPP is installed on Windows and the htdocs directory is in C:\xampp, move the otofa directory to `C:\xampp\htdocs`.
3. **Create a database named otofa in XAMPP.**
4. **Update the database configuration in the `core/config.php` file**

   ```bash
	define('DB_NAME', 'otofa');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_DRIVER', 'mysql');
   
5. **Import the database schema from otofa.sql on public directory into the otofa database.**
6. **Update `php.ini` file:**
   - To ensure the system operates correctly and efficiently, you need to modify your `php.ini` file. This file contains configuration settings for PHP, and these adjustments are necessary for handling image processing and file uploads effectively.

   1. **Enable GD extension:**
      - Locate your `php.ini` file. The location of this file can vary depending on your server setup. Common locations include `/etc/php/7.x/apache2/php.ini` on Linux or `C:\xampp\php\php.ini` on Windows.
      - Uncomment the extension=gd line in your php.ini file to enable the imagecreatetruecolor() function, which is used for creating new users and generating profile pictures. This line should look like:

        ```ini
        ;extension=gd
        ```
     	Change it to:
   
     	```ini
     	extension=gd
     	```

   2. **Increase the Maximum File Uploads Limit and Update the Post Max Size and Upload File Size Settings:**
      - To handle larger file uploads, especially if your system involves multiple files being uploaded simultaneously, you need to increase the maximum file upload limit and update the post max size and upload file size settings. Update the following lines in your `php.ini` file:

        ```ini
        max_file_uploads = 100
        post_max_size = 100M
        upload_max_filesize = 80M
        ```

   3. **Restart Web Server:**
      - Save the `php.ini` file and close your text editor after making these changes.
      - Restart your web server to apply the changes. The command to restart your server depends on the software you are using.
9. **Open the browser and navigate to localhost**
   
