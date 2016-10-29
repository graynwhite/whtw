<!-- Generateorgs.php --->
<?php
           // set the files to be used
           $event_maint_file ="./orgselects.dat";         
?>
<HTML>
<HEAD>
<title>Generating Organization select statements</title>
</HEAD>
<body>
<p>Generating <?=$event_maint_file?> ...</p>
<?PHP
           @unlink($event_maint_file);
           include("../cgi-bin//connect.inc");
           $sql=(" select Org_name, Org_num from orgs order by Org_name");
           $result = (@mysql_query($sql));
           if (!$result){ 
              echo("<p>error performing query Email this information to webmaster@graynwhite.com" . mysql_error() . "</p> ");
           exit();
           }
           $orgselect = fopen($event_maint_file,"w");
           if (!$orgselect) {
                      echo("Not able to open output file       ");
                        exit;
                     }
             fwrite($orgselect,"\t<SELECT NAME=\"Org\" size=\"1\" >\n");

            while ($row = mysql_fetch_array($result)){
            fwrite($orgselect,"\t<OPTION VALUE=\"" . $row["Org_num"] .">" . $row["Org_name"] ."\n");
           }
               fwrite($orgselect,"\t<OPTION VALUE=</SELECT>\n");
               fclose($orgselect);
?>
</body>
</html>
