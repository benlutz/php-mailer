# php-mailer

php-mailer is a simple PHP API that accepts POST requests with name and email, allowing you to send emails from a hosting service like World4You. This is perfect for use with a static frontend, such as a contact form built with React.

## Installation
To install php-mailer, simply clone this repository und upload `mailer.php` to your server. Adapt accepted fields, sender email and message to your liking. 

## Usage
Once it's uploaded, make a POST request to `{yourURL}/mailer.php`. Adapt your `.htaccess` if you want to remove the file extension. 
