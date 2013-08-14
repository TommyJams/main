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

    <title>TommyJams - Press</title>

    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <link href="css/supersized/supersized.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery.min.js" ></script>

    <script type="text/javascript" src="js/jquery.supersized.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script> <!--contains document ready function-->

</head>

<body>
 
    <?
	include("include/leftCommon.php");
	?>

	<div id="main-container">

        <div id="inner-container">

            <div class="head">

                <h1>Press</h1>

            </div>

            <div id="textContainer">
                
                <p>
				
					Interested in us? Want to know more about us? Please contact us at:
					<br><br>
					Tel: +91 9902644556
					<br>
					Email: contact@tommyjams.com
					<br><br>
					<a href="press/press_kit.zip">Download Press Kit</a>
				</p>
                
            </div>
        
        </div>

    </div> <!--main-container-->

    <?
	include("include/rightCommon.php");
	?>

</body>

</html>