<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use PHPExcel;
use PHPExcel_IOFactory;
use Cake\Mailer\Email;

class EmailController extends AppController {

  public function sendMail() {
    $email = new Email('gmail');
    $template_file = 'default';
    $email_attachments = []; //attachment absolute path not http path. ex : /var/www/html/test.txt
    $view_file = 'ctp_file_name';
    $email_to = TO_EMAIL_ID;
    $email_from = SMTP_MAIL_FROM;
    $email_from_signature = "Support Team";
    $details = []; //set variable for ctp file. Which you can use in ctp
    $email->viewVars(array('details' => $details));
    $email_subject = "SUBJECT";
    $email->emailFormat('html');
    $email->to($email_to);
    $email->template($view_file, $template_file);
    $email->from(array($email_from => $email_from_signature));
    $email->subject($email_subject);
    if (isset($email_attachments) && !empty($email_attachments)) {
        $email->attachments($email_attachments);
    }
    
     $email->send();
  
  }

}
