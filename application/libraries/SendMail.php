<?php

/**
 * Description of SendMail
 *
 * @author hucak
 */
class SendMail {

    private $SMTP_HOST;
    private $SMTP_PORT;
    private $SMTP_FROM;
    private $SMTP_FROM_NAME;
    private $SMTP_USER;
    private $SMTP_PASS;
    private $mail;
    public $errors;

    public function __construct($options) {
        $this->SMTP_PORT = 25;
        $this->errors = '';
        if (isset($options['SMTP_HOST']))
            $this->SMTP_HOST = $options['SMTP_HOST'];
        if (isset($options['SMTP_PORT']))
            $this->SMTP_PORT = $options['SMTP_PORT'];
        if (isset($options['SMTP_FROM']))
            $this->SMTP_FROM = $options['SMTP_FROM'];
        if (isset($options['SMTP_FROM_NAME']))
            $this->SMTP_FROM_NAME = $options['SMTP_FROM_NAME'];
        if (isset($options['SMTP_USER']))
            $this->SMTP_USER = $options['SMTP_USER'];
        if (isset($options['SMTP_PASS']))
            $this->SMTP_PASS = $options['SMTP_PASS'];
        
        require APPPATH . 'third_party/PHPMailer/class.phpmailer.php';
        require APPPATH . 'third_party/PHPMailer/class.smtp.php';
        $this->mail = new PHPMailer;
    }

    /* sent to pdf file via email attach 

     * @param string or array recipients email address
     * @param string email's subject
     * @param string email's body
     * @param string Report's pdf file name path
     * @return boolean
     * 
     */

    public function sendtomail($recipients, $subject, $body, $pdfilepath) {

        $this->mail->IsSMTP();                                      // Set mailer to use SMTP
        $this->mail->CharSet = "UTF-8";
        $this->mail->Host = $this->SMTP_HOST;               // Specify main and backup server
        $this->mail->Port = $this->SMTP_PORT;                                    // Set the SMTP port
        if (!empty($this->SMTP_PASS))
            $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->Username = $this->SMTP_USER;                // SMTP username
        $this->mail->Password = $this->SMTP_PASS;                  // SMTP password
        if (!empty($this->SMTP_FROM))
            $this->mail->From = $this->SMTP_FROM;
        else
            $this->mail->From = $this->SMTP_USER;

        $this->mail->FromName = $this->SMTP_FROM_NAME;
        if (is_array($recipients)) {
            foreach ($recipients as $email) {
                $this->mail->AddAddress($email); // Add a recipient
            }
        }
        if (is_string($recipients))
            $this->mail->AddAddress($recipients);




        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->IsHTML(true);                                  // Set email format to HTML
        if (is_array($pdfilepath))
            foreach ($pdfilepath as $finfo) {
                $this->mail->addAttachment($finfo['file_path'], $finfo['file_name']);
            }
        if (!$this->mail->Send()) {
            $this->errors = $this->mail->ErrorInfo;
            return false;
        }

        return true;
    }

}
