<?php
require_once("Zend/Mail.php");
require_once("Zend/Mail/Transport/Smtp.php");

class SmtpEmail {
    
    /**
     *
     * @var SSViewer
     */
    protected $_viewer = NULL;
    /**
     *
     * @var ViewableData
     */
    protected $_data = NULL;
    
    
    public function __construct($tplName=NULL) {
        if( !is_null($tplName) ) {    
            $this->_viewer = new SSViewer($tplName);
        }
    }
    
    public function populateData(ViewableData $data) {
        $this->_data = $data;       
    }
    
    public function test() {
        return $this->_viewer->process($this->_data);
    }

    /**
     *
     * @param string $toEmail
     * @param string $subject
     * @param string $body
     * @param string $bcc
     * @param string $replyToEmail
     * @param string $fromEmail
     * @param string $fromName
     * @return bool
     */
    public function send($toEmail, $subject, $body=NULL, $bcc=NULL, $replyToEmail=NULL, $fromEmail=NULL, $fromName=NULL)
    {

        $site_config = SiteConfig::current_site_config();
        if( empty($site_config->SmtpHost) || empty($site_config->SmtpUsername) || empty($site_config->SmtpPassword) || empty($site_config->FromEmail)) {
            die('Missing SMTP Auth Settings');
        }

        $config = array('auth' => 'login',
                        'username' => $site_config->SmtpUsername,
                        'password' => $site_config->SmtpPassword);
        
        if( is_null($body) && is_null($this->_viewer) ) {
            throw new Exception('You have to set $body as argument or set a template at constructor');
        } else {
            if( is_null($body) ) {
                $body = $this->_viewer->process( $this->_data );
            }
        }

        $transport = new Zend_Mail_Transport_Smtp($site_config->SmtpHost, $config);
        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyText($body);
        $mail->setBodyHtml($body);
        $fromEmail = is_null($fromEmail) ? $site_config->FromEmail : $fromEmail;
        $fromName = is_null($fromName) ? $site_config->FromName : $fromName;
        $mail->setFrom($fromEmail, $fromName);
        $mail->addTo($toEmail);
        $mail->setSubject($subject);
        if( !is_null($replyToEmail) )
            $mail->setReplyTo ($replyToEmail);
        if( !is_null($bcc) )
            $mail->addBcc($bcc);
        $mail->send($transport);
        return true;
    }  

}