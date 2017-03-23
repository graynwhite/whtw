<HTML>
<Head><Title>Sending Email</title></head>
<?PHP
        if($BeenSubmitted){
                include("../cgi-bin//connect.inc");
                $sql="select distinct email from core";
                $result = @mysql_query($sql);
                if(!$result){
                        echo("<php> Query error Email this information to cauleyfrank@gmail.com" . mysql_error() .
                        "</P>");
                        exit();
                }
                while($row = mysql_fetch_array($result)){
                        $mailto=$row["email"];
                        mail($mailto,$subject,$body, "From: $mailfrom");

                }
        }
?>
<form ACTIOn="email.php" method="POST">
Your email address: <input type=TEXT Name = "mailfrom" size="40"><br>
Email Subject: <input type=text name="subject" size="80"><br>
Email Body: <Textarea name="body" rows="10" cols="50">
</textarea><p>
<Input type=HIDDEN name=BeenSubmitted value =TRUE>
<input type=submit name="Submit" Value="Submit">
</form>
</body>
</html>
