<?php
		$testrun=isset($_GET[test])? $_GET[test] : 'no';
       //echo "arrived at mailer";
	   $to_name=isset($_POST[pubname])? $_POST[pubname] : "Subscriber";
	   $to_name=$to_name==""? "Subscriber" : $to_name;
	   $reason=$_POST['reason'];
	   $reason=$reason=="" ? "Uknown" : $reason;
	   $isp= isset($_POST[isp])? $_POST[isp] : 'https://help.yahoo.com/kb/helpcentral';
	    $recipient = isset($_POST[recipient]) ? $_POST[recipient] : "cauleyfj64@gmail.com";
        $recipient .=  ",webmaster@peggyjostudio.net";
		if($testrun == 'yes'){
			$recipient ="cauleyfj64@gmail.com";
		}
		
        // Set the email subject.
        $subject = "Your copy of the Peggy Jo Studio Newsletter is Bouncing";
		
        // Build the email content.
		$email_content = sprintf("To:  %s ,\n\n",$to_name);
		$email_content .= sprintf("The email management program that the PJSN uses has classified your subsciber account as %s ",$reason);
		$email_content .=" Please contact your Internet Service Provider's cutomer service to find out why your newsletter is being bounced.";
		//$email_content .=sprintf("\n\n Your internet provider is %s ",$isp);
		$email_content .= "Your internet service provider is something like comcast, aol, gmail or yahoo and is indicated by the characters after the @";
		$email_content .= " call their helpline.";
		$email_content .="\n\nWe also encourage you to renew your subscription by accessing this page: http://ui.constantcontact.com/d.jsp?m=1011148101198&p=oi ";
		$email_content .=" \n\n If you no longer wish to receive this newsletter, please respond to this email stating that you want";
		$email_content .=" to be removed from the database";
		$email_content .="\n\n To resume your subscription click on this link , fill out the form and then submit it.";
		$email_content .=" In addition, please place this email address in your contact list: peggyjo@peggyjostudio.net ";
		$email_content .="\n\nThe newsletter is sent to over 8,000 email addresses every Monday morning. you can see past issues at http://www.peggyjostudio.net/archivenews.php. A mobile version of the newsletter can be seen on your mobile device, laptop and desktop at http://peggyjomobile.net ";
		$email_content .="\n\n\t\tFrom: Webmaster\n\t\tWebmaster@peggyjostudio.net";	 

        // Build the email headers.
        $email_headers = "From: webmaster@peggyjostudio.net";
			
		
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn\'t send your message.";
		
        }

     

?>


