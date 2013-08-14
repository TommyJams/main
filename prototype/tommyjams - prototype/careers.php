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

    <title>TommyJams - Careers</title>

    <link href="css/style.css" rel="stylesheet" type="text/css" />
    
    <link href="css/edit.css" rel="stylesheet" type="text/css" />

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

                <h1>Careers</h1>

            </div>

            <div id="textContainer">
                
                <p>
                TommyJams is always on the lookout for young, enthusiastic professionals or amateurs who find music as their passion! If you qualify 
                as the above and are interested in being a part of the revolution that TommyJams is bringing in the music industry, do drop us a message
                using the form below with a small introduction and we shall be happy to consider your inclusion in the TommyJams family.
                </p>
                
                <form action="contactform.php" method="post" style="width:50%; margin-top:20px; left:50%; margin-left:25%;">
                    <table style="border:0px; width:100%;">
                        <tr style="width:100%;">
                            <td style="width:100%;">
                                <!--Your name-->
                                <input type="text" value="Your name" name="cf_name" style="width:50%; margin-top:10px;">
                            </td>
                        </tr>
                        <tr style="width:100%;">
                            <td style="width:100%;">
                                <!--Your e-mail-->
                                <input type="text" value="Your e-mail" name="cf_email" style="width:50%; margin-top:10px;">
                            </td>
                        </tr>
                        <tr style="width:100%;">
                            <td style="width:100%;">
                                <!--Your introduction-->
                                <textarea name="cf_message" style="height:200px; width:100%; margin-top:10px; font-family: Arial; font-size: 14px;">Your introduction</textarea>
                            </td>
                        </tr>
                        <tr style="width:100%;">
                            <td style="width:100%;">
                                <input type="submit" value="Send" style="width:auto; margin: 10px auto;">
                            </td>
                        </tr>
                    </table>
                </form>

            </div>
        
        </div>

    </div> <!--main-container-->

	<?
	include("include/rightCommon.php");
	?>

</body>

</html>