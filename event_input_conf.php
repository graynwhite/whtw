<HTML>
<HEAD>
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
   <META NAME="Frank J. Cauley" CONTENT="Current Events">
   <META NAME="GENERATOR" CONTENT="Microsoft FrontPage 5.0">
   <TITLE>Confirm event data entry</TITLE>
<META NAME="resource-type" CONTENT="document">
<meta name="generator" content="Sausage Software HotDog Professional 4">

</HEAD>
<body>
<?php
        $event_date = $From_year .$From_mm . $From_day;

        $activity = addslashes($activity);
        $event_org = $Org;
        $event_start = $Start_Time_Hours.$Start_Time_Minutes.$Start_AMPM;
        $event_end = $To_Time_Hours.$To_Time_Minutes.$To_AMPM;
        if ( $To_year == " " ){
            $event_end_date = $event_date;
        }else{
            $event_end_date = $To_year.$To_mm.$To_day;
        }
        if ( $Reserve_year == " " ){
            $event_rsv_date = $event_date;
        }else{
            $event_rsv_date = $Reserve_year.$reserve_mm.$reserve_day;
        }
        $event_dow = $Dow;
        $event_place = $place;
        $event_name = $activity;
        $price_member = $Price_Member;
        $price_guest = $Non_Member_Price;
        $Dow = $Dow;
        $submitted_by = $emailid;



        if ( $yourpswd <> "6r1n11" ){
            print("<p>You are not authorized to to use this system</p>");
            exit;
        }

        //connect to the database server
            include("../cgi-bin//connect.inc");

        $sql= "INSERT into events(Date_from,Event_org,Time_start,Time_end,
               Date_to,Resby,Dow,Place,Activity,Price_members,Price_guests,
               Event_open, Event_priority, SUBMITTED_BY)
               VALUES(\"$event_date\", \"$event_org\", \"$event_start\",\"$event_end\",
               \"$event_end_date\", \"$event_rsv_date\",\"$Dow\", \"$event_place\",
               \"$event_name\",\"$Price_member\",\"$Price_guest\",\"$event_type\",
               \"$Event_priority\",\"$submitted_by\")
                ";
            $result = @mysql_query($sql);    
            if (!$result) {
                    echo("<p>Error performing query Email this information to cauleyfrank@gmail.com" . mysql_error() . "</p> ");
      
           
                       }else{
                        print("<p> Event added to database </p>");
                        }
                         
?>
</body>
</html>
