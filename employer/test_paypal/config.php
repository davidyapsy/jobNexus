
<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'jobnexus2@gmail.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', '/jobnexus/employer/test_paypal/success.php'); 
define('PAYPAL_CANCEL_URL', '/jobnexus/employer/test_paypal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', '/jobnexus/employer/test_paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 'MYR'); 
 
// Database configuration 
define('DB_HOST', 'localhost'); 
define('DB_USERNAME', 'root'); 
define('DB_PASSWORD', ''); 
define('DB_NAME', 'db_jobnexus'); 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");