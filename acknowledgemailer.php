<?php
		$testrun=isset($_GET[test])? $_GET[test] : 'no';
       //echo "arrived at mailer";
	   $from_name=isset($_POST[pubname])? $_POST[pubname] : "publisher";
	   $event_title= isset($_POST[title]) ? $_POST[title] : "Untitled Event";
		$event_date= isset($_POST[fromDate]) ? $_POST[fromDate] : "1/1/2016";
		$reserve_date=isset($_POST[reserve_date]) ? $_POST[reserve_date] : "1/1/2016";
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
		$recipient = isset($_POST[recipient]) ? $_POST[recipient] : "cauleyfrank@gmail.com";
        $recipient .=  ",cauleyfrank@gmail.com";
		if($testrun == 'yes'){
			$recipient ="cauleyfrank@gmail.com";
		}
        // Set the email subject.
        $subject = "Your recent event information submission";

        // Build the email content.
		$email_content = sprintf("To:  %s ,\n\n",$from_name);
		if (isset($_POST[event_source])){
			if ($_POST[event_source]=='gc'){
				$email_content .= "We accessed your google calendar to find events occuring in the coming week. \n\n";
			}
		}
		$email_content .= sprintf("We posted your event entitled \"%s\" taking place on %s in the Gray and White Event database",$event_title,$event_date);
		if($event_date != $reserve_date){
			$email_content .= sprintf("\n Because the reserve date of %s has been set the publication date will be adjusted so that it will appear in the proper week of the \"Peggy Jo Studio Newslettter.\"",$reserve_date);
		}else{
        $email_content .= "\nIt will appear in the  \"Peggy Jo Studio Newsletter\" in the appropriate weekly edition. ";
		}
        $email_content .= "\n\nYou can see how your entry will be presented by going to ";
		$email_content .= "http://www.graypluswhite.com/whtw/calendar.php and selecting the date of the event.";
		$email_content .= "\n\nThe \"Peggy Jo Studio Newsletter\" is published every Monday and sent to over 8,000 email subscribers. Past issues of the newsletter can be seen at http://www.peggyjostudio.net/archivenews.php";
		$email_content .= "\n\nPlease inform your members about http://pjnews.mobi which can be accessed on most smartphones, tablets, laptops and desktops.";
		$email_content .= "  An annoucement at an event or an entry in a newsletter would be greatly appreciated.";
		$email_content .= "\n\n\t\t From: \n\t\t cauleyfrank@gmail.com";
		 

        // Build the email headers.
        $email_headers = "From: cauleyfrank@gmail.com";
			
		
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


