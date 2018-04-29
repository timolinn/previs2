<?php

namespace Previs\Services;

use PHPMailer\PHPMailer\PHPMailer;


class Mail
{

    public $email;
    public $phpMailer;
    protected $isSmtp = true;
    protected $subject;
    protected $error;
    protected $debugLevel = 0;
    protected $cc = array();
    protected $bcc = array();
    protected $message;

    public function __construct($email, $subject, $message)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
        $this->phpMailer = $this->getPhpMailerInstance();
    }

    private function getPhpMailerInstance()
    {
        $mail = new PHPMailer(true);
        $mail->Charset = 'utf-8';
        ini_set('default_charset', 'UTF-8');

        return $mail;
    }

    public function send()
    {
        $mailer = $this->build();
        if (!$this->phpMailer->send()) {
            return "Mailer Error: " . $this->phpMailer->ErrorInfo;
        } else {
            return "Message sent!";
        }
    }

    public function build()
    {

        //Tell PHPMailer to use SMTP
        $this->isSmtp ? $this->phpMailer->isSMTP() : null;

        $this->phpMailer->SMTPDebug = $this->debugLevel;
        //Set the hostname of the mail server
        $this->phpMailer->Host = $this->config('host');

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $this->phpMailer->Port = $this->config('port');
        //Set the encryption system to use - ssl (deprecated) or tls
        $this->phpMailer->SMTPSecure = $this->config('security');
        //Whether to use SMTP authentication
        $this->phpMailer->SMTPAuth = $this->config('auth');
        //Username to use for SMTP authentication - use full email address for gmail
        $this->phpMailer->Username = $this->config('username');;
        //Password to use for SMTP authentication
        $this->phpMailer->Password = $this->config('password');
        //Set who the message is to be sent from
        $this->phpMailer->setFrom($this->config('from'), $this->config('senderName'));
        //Set an alternative reply-to address
        $this->phpMailer->addReplyTo('fabrobocomx@gmail.com', 'Timothy Onyiuke');
        //Set who the message is to be sent to
        $this->phpMailer->addAddress($this->email, 'Willian Borges');
        //Set the subject line
        $this->phpMailer->Subject = $this->subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $this->phpMailer->msgHTML($this->message, realpath(__DIR__ . '/../views/emails'));
        //Replace the plain text body with one created manually
        $this->phpMailer->AltBody = 'Previs Discount Club says Hi :)';
        //send the message, check for errors
        return $this;
    }

    public function config($data)
    {
        // $config = include __DIR__ . DS .'mail'.DS .'src'.DS .'config'.DS .'mail.php';
        $config = app('config')->get('mail');

        return $config[$data];
    }

}
