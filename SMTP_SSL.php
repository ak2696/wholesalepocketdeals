<?php
require_once "/usr/local/php56/pear/Mail.php";

$from = "SiteGround <sgtest@swifthomeoffers.com>";
$to = "Simeon I <simeon.ivanov@siteground.com>";
$subject = "Test email using PHP SMTP with SSL\r\n\r\n";
$body = "This is a test email message";

$host = "ssl://swifthomeoffers.com";
$port = "465";
$username = "sgtest@swifthomeoffers.com";
$password = "_1Dc3s1c4L)b";

$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
} else {
  echo("<p>Message successfully sent!</p>");
}
?>
