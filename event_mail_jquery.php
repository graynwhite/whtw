
<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/jquery/jformer.php');
$contactForm = new JFormer('contactForm', array()); 
$contactForm->addJFormComponentArray(array( 
new JFormComponentName('name', 'Name:', array(
      'validationOptions' => array('required'), 
     )), 
new JFormComponentSingleLineText('email', 'E-mail address:', array( 
      'width' => 'long', 
      'validationOptions' => array('required', 'email'), // notice the validation options 
      )), 
new JFormComponentSingleLineText('subject', 'Subject:', array( 
       'width' => 'longest', 
       'validationOptions' => array('required'), 
       )), 
new JFormComponentTextArea('message', 'Message:', array( 
      'width' => 'longest', 
      'height' => 'medium', 
      'validationOptions' => array('required'), 
       )), 
    )); 
    // Set the function for a successful form submission 
    function onSubmit($formValues) { 
    if(!empty($formValues->name->middleInitial)) { 
     $name = $formValues->name->firstName.' '.$formValues->name->middleInitial.' '.$formValues->name->lastName; 
   } 
   else { 
         $name = $formValues->name->firstName.' '.$formValues->name->lastName; 
   } 
       // Send the message - you would need to include a mailing package or some other way to send your message 
        // The return array returns to jFormer and tells it how to handle the response 
        if(!$mail->Send()) { 
        $return = array('status' => 'failure', 'response' => $mail->ErrorInfo); 
         $return['failureNoticeHtml'] = 'There was a problem sending your e-mail.'; // failureNoticeHtml returns and html error message 
       } 
       else { 
       $return = array('status' => 'success', 'response' => 'Message successfully sent.'); 
        $return['successPageHtml'] = '<p>Thanks for Contacting Us</p><p>Your message has been successfully sent. We will respond as soon as possible.</p>'; // successPageHtml returns html for a success page. this can be any html. 
      } 
       return $return; 
   } 
   // Process any request to the form 
    $contactForm->processRequest(); 
?> 
<html>
<head>
<link rel="stylesheet" type="text/css" href="../jquery/jformer.css" ></link>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<title>Organization Event Input jquery</title> 
<script type="text/javascript" src="../jquery/jformer.uncompressed.js" ></script> 
</head>
<body>
</body>
</html>