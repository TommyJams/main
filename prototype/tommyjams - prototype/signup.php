<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dibs & Gigs</title>
<link href="css/include.css" rel="stylesheet" type="text/css" />
<link rel='stylesheet' href='css/master.css'>
	<!-- Include the JS files -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/h5f.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
<?
if(isset($_GET['include']) && $_GET['include']=="signup")
{include("include/signup.php");}
elseif(isset($_GET['include']) && $_GET['include']=="edit")
{include("include/edit.php");}

?>
</body>
</html>