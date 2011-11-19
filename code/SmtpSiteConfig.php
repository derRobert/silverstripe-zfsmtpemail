<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SiteEmailConfig
 *
 * @author ROBERT
 */
class SmtpSiteConfig extends DataObjectDecorator {

        static $field_labels = array(
            'NewRequestAutoReply' => 'Auto-Antwort bei neuer Anfrage'
        );

	function extraStatics() {
		return array(
			'db' => array(
				'SmtpHost' => 'Varchar(256)',
				'SmtpUsername' => 'Varchar(64)',
				'SmtpPassword' => 'Varchar(64)',
                                'FromEmail'     => 'Varchar(64)',
                                'FromName'     => 'Varchar(64)'
			)
		);
	}

        function  updateCMSFields(FieldSet &$fields) {
            $new_fields = new FieldSet(
                    new TextField('SmtpHost', 'Host'),
                    new TextField('SmtpUsername', 'Konto/Benutzername'),
                    new TextField('SmtpPassword', 'Password'),
                    new EmailField('FromEmail', 'Absender Email'),
                    new TextField('FromName', 'Absender Name')
                    );
            $fields->addFieldsToTab('Root.Emailkonfiguration', $new_fields);
            return $fields;

        }


    


}
?>
