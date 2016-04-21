<?php

namespace AppBundle\Mailer;

require_once dirname(__FILE__).'/../../../vendor/swiftmailer/swiftmailer/lib/swift_required.php';

class MailerClass {

    private $mailer;

    public function __construct()
    {
        // in the meanwhile, let's use this method to send emails directly
        $transport = \Swift_MailTransport::newInstance();

        // Create the Mailer using your created Transport
        $this->mailer = \Swift_Mailer::newInstance($transport);
    }

    public function sendContactEmail($name, $senderEmail, $subject, $text)
    {
        $message = \Swift_Message::newInstance();
        $message
            // Give the message a subject
            ->setSubject('New camiloenparis.com contact email: '.$subject)
            // Set the From address with an associative array
            ->setFrom(array($senderEmail => $name))
            // Set the To addresses with an associative array
            ->setTo(array("camilo.rodriguez@roomabe.com" => "Camilo"))
            // Give it a body
            ->setBody($text, 'text/html');

        // Send the message and return a true
        $this->mailer->send($message);
        return true;
    }


} 