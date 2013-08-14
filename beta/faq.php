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

    <title>TommyJams - FAQ</title>

    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <link href="css/supersized/supersized.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="js/jquery.min.js" ></script>

    <script type="text/javascript" src="js/jquery.supersized.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script> <!--contains document ready function-->

</head>

<body>
 
	<!-- Background overlay -->
    <div id="background-overlay"></div>
    <!-- /Background overlay -->

    <?
	include("include/leftSidebar.php");
	?>

    <div id="logoContainer">
    
        <a href="index.php">

            <img alt="Home" title="Home" src="images/tjlogo_small.png">

        </a>

    </div>

    <div id="slideText">
        <h3 id="slideTextHeading">
            Slide Text Heading
        </h3>
        <h4 id="slideTextBody">
            Slide Text Body
        </h4>
    </div>
	
	<div id="main-container">

        <div id="inner-container">

            <div class="head">

                <h1>FAQ</h1>

            </div>

            <div id="textContainer">
                
                <p> HelloWorld!</p>
                
            </div>
        
        </div>

    </div> <!--main-container-->

	<?
	include("include/header.php");
	?>

</body>

</html>