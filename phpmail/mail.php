<?php
 require_once "Mail.php";
 require_once "Mail/mime.php";
 
 // see http://pear.php.net/manual/en/package.mail.mail-mime.php
 // for further extended documentation on Mail_Mime

 $from = "Web Master ";
 $to = "Nobody ";
 $subject = "Test HTML email using PHP Pear w/ SMTP\r\n\r\n";
 $text = "This is a text test email message";
 $html = "

This is an html test email message
 This Is A Link
";
 $crlf = "\n";

 // create a new Mail_Mime for use
 $mime = new Mail_mime($crlf); 
 // define body for Text only receipt
 $mime->setTXTBody($text); 
 // define body for HTML capable recipients
 $mime->setHTMLBody($html);
 
 // specify a file to attach below, relative to the script's location
 // if not using an attachment, comment these lines out
 // set appropriate MIME type for attachment you are using below, if applicable
 // for reference see http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types

 $file = "attachment.jpg";
 $mimetype = "image/jpeg";
 $mime->addAttachment($file, $mimetype); 

 // specify the SMTP server credentials to be used for delivery
 // if using a third party mail service, be sure to use their hostname
 $host = "mail.emailsrvr.com";
 $username = "webmaster@example.com";
 $password = "yourPassword";
 
 $headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
 $smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));

 
 $body = $mime->get();
 $headers = $mime->headers($headers); 
 
 $mail = $smtp->send($to, $headers, $body);
 
 if (PEAR::isError($mail)) {
  echo("

" . $mail->getMessage() . "
");
} else {
  echo("

Message successfully sent!
");
}
?>
