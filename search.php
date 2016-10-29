<?php
$address = isset($_GET['address']) ? $_GET['address'] : "Blackfinn Royal Oak, Mi.";
?>
<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Google Powered Site Search | Tutorialzine Demo</title>

<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<div id="page">

    <h1>Google Powered Site Search</h1>
    
    <form id="searchForm" method="post">
		<fieldset>
        
           	<input id="s" type="text" value=\" . <?php echo $address ?> ."\""  />
            
            <input type="submit" value="Submit" id="submitButton" />
            
            <div id="searchInContainer">
                <input type="radio" name="check" value="site" id="searchSite" checked />
                <label for="searchSite" id="siteNameLabel">Search</label>
                
                <input type="radio" name="check" value="web" id="searchWeb" />
                <label for="searchWeb">Search The Web</label>
			</div>
                        
            <ul class="icons">
                <li class="web" title="Web Search" data-searchType="web">Web</li>
                <li class="images" title="Image Search" data-searchType="images">Images</li>
                <li class="news" title="News Search" data-searchType="news">News</li>
                <li class="videos" title="Video Search" data-searchType="video">Videos</li>
            </ul>
            
        </fieldset>
    </form>

    <div id="resultsDiv"></div>
    
</div>

<!-- It would be great if you leave the link back to the tutorial. Thanks! -->
<p class="credit"><a href="http://tutorialzine.com/2010/09/google-powered-site-search-ajax-jquery/">Powered by Tzine &amp; Google</a></p>
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="script.js"></script>
</body>
</html>
