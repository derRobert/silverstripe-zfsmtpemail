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
                    new TextField('SmtpHost', 'Server(e.g. mail.mydomain.com)'),
                    new TextField('SmtpUsername', 'Account/Username'),
                    new TextField('SmtpPassword', 'Password'),
                    new EmailField('FromEmail', 'Default sender email address'),
                    new TextField('FromName', 'Default sender name')
                    );
            $fields->addFieldsToTab('Root.SmtpConfiguration', $new_fields);
            return $fields;

        }


    


}
?>
