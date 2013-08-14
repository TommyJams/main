<?
ob_start();

if (!isset($_SESSION)) {
session_start();
}

if(!isset($_SESSION['username']))
{
header("Location: index.php");
exit;
}
$username=$_SESSION['username'];
$password=md5($_SESSION['password']);

include('connect.php');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reaction</title>
<link href="css/profile.css" rel="stylesheet" type="text/css" />
<link href="css/edit.css" rel="stylesheet" type="text/css" />
<!--
<style type="text/css">
	.ui-tooltip-success {
		color:#FFFFFF;
		font-size:14px;
		border:none;
		background:#61911B;
		width: 100px;
		height: 50px;
	}
</style>
<script type="text/javascript" src="js/jquery-1.3.2.min.js" ></script>
<script type="text/javascript" src="js/jquery.qtip.min.js"></script>
-->
<script type="text/javascript">
function showMessageTip(windowName, message)
{
	/*$('#recommendArtist').qtip('destroy');*/
	if(message)
	{
		/*$('#recommendArtist').qtip(
							{
								style: {classes:'ui-tooltip-success'},
								content: 	{text:'Blah'},
								position: 	{my:'top center',at:'bottom center'}
							}
						).qtip('show');*/
						
		alert(message);
	}
}
</script>

<script LANGUAGE="JavaScript">
function confirmSubmit()
{
    var agree=confirm("Are you sure you wish to accept this Artist's Dib? The gig will be booked and all other artists will automatically get rejected for this gig.");
    if (agree)
        return true ;
    else
        return false ;
}
</script>
</head>

<body>
	<span class="dibsList" style="width:96% padding-left:2% padding-right:2%">
	<?
		$link=$_GET["linker"]/15999;
		$linker=$_GET["linker"];
		$SQL = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$link AND status=4";
		$result = mysql_query($SQL);
		while ($b = mysql_fetch_assoc($result))
		{
			$dibs_exist = 1;
			$artist_id=$b["artist_id"];$artist_name=$b["artist_name"];
			print("<div style='width:50%; margin-top: 10px; height:18px; text-align: center; float:left;'><a href='promoter.php?id=$artist_id' target='_top' class='whiteHoverRef' style='font-size: 16px;'>$artist_name</a></div>"); 
	?>
			<form action="dib_reaction.php" method="post">        
				<input type="hidden" name="gig" value="<? print($linker); ?>">
				<input type="hidden" name="giger" value="<? print($artist_id); ?>">
				<div style="width:45%; float:left; padding-top:10px; padding-right:5px; height:33px;">
					<input type="submit" value="Accept" name="accept" style="width: 48%; background:#B4F62F; float:left;" onClick="return confirmSubmit()">
					<input type="submit" value="Reject" name="reject" style="width: 48%; background:#FF3C35; float:right;">
				</div>
			</form>
	<?
		}

		if($dibs_exist == 1)
		{
	?>
			<form action="dib_reaction.php" method="post">        
				<input type="hidden" name="gig" value="<? print($linker); ?>">
				<div style="width:100%; height: 40px; margin-top: 10px; float:left;">
					<input type="submit" value="Recommend Artist" id="recommendArtist" name="recommendArtist" style="width: 200px; color:#FFF; background:#000; margin-left:-100px; left:50%; position:absolute;" onClick="showMessageTip('#recommendArtist','We shall contact you within 24 hours with a recommendation from among the artists who have applied. Thank you for your patience.');">
				</div>
			</form>
	<?
		}
	?>
	</span>
</body>
</html>