This is the first - very early - version of a mail module, that submits emails via smtp-auth.

Important: It assumes that the Zend Framework is in the php include_path
Usage:

    extract the module in the root directory of your silverstripe installation as directory "zfsmtpemail"
    run /dev/build/?flush=1
    visit your site config in the cms an populate the SMTP Account information

Send an Email without a template:
    $mail = new SmtpEmail();
    $mail->send('you@yourdomain.com', 'The Subject', 'The body'));

Send an Email using a silverstripe template: $mail = new SmtpEmail('MyMailTemplate'); $mail->send('you@yourdomain.com', 'The Subject'));

Send an Email using a silverstripe template and custom data:

MyMailTemplate.ss

 <h3>Hello, $Name</h3>

Inside controller/method

 $mail = new SmtpEmail('MyMailTemplate');
 $mail->populateData( new ArrayData( array('$Name'=>'Hallo') ) );
 $mail->send('you@yourdomain.com', 'The Subject')); // no argument for $body, because it is rendered by the template

