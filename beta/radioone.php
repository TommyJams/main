<?

ob_start();

if (!isset($_SESSION)) {

session_start();

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<meta property="og:title" content="One Bengaluru One Music: The Shah Hussain Project" />

	<meta property="og:type" content="website" />

	<meta property="og:image" content="http://tommyjams.com/beta/images/radioone/artists/shahhussain.jpg"/>

	<meta property="og:url" content="http://tommyjams.com/beta/radioone.php" />

	<meta property="og:site_name" content="TommyJams" />

	<meta property="og:description" content="TommyJams & Radio One 94.3: One Bengaluru One Music" />

	<meta property="fb:app_id" content="566516890030362" />

    <title>TommyJams & Radio One 94.3: One Bengaluru One Music</title>

    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <link href="css/supersized/supersized.css" rel="stylesheet" type="text/css" />
	
	<link href="css/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
	
	<link href="css/videoTiles.css" rel="stylesheet" type="text/css"/>

    <script type="text/javascript" src="js/jquery.min.js" ></script>

    <script type="text/javascript" src="js/jquery.supersized.min.js"></script>
	
	<script type="text/javascript" src="js/jquery.fancybox.js"></script>

    <script type="text/javascript" src="js/main.js"></script> <!--contains document ready function-->

</head>

<body>
 
    <?
	include("include/leftCommon.php");
	?>

	<div id="main-container">

        <div id="inner-container">

            <div class="head">

                <h1>One Bangalore One Music</h1>

            </div>

			<div id="lefty">

				<div id="videoTilesContainer" style="height: 100%; width: 100%; overflow-y: auto; position:relative;">

				</div>

			</div>

        </div>
		
		<script>
		
			var link = "include/videoTiles.php";
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			if(vars.length == 1)
			{
				var dateParamPair = vars[0].split("=");
				if(dateParamPair[0] == "date")
				{
					link = link.concat("?date=");
					link = link.concat(dateParamPair[1]);
				}
			}
			$('#videoTilesContainer').load(link);
		</script>

    </div> <!--main-container-->

	<?
	include("include/rightCommon.php");
	?>

</body>

</html>