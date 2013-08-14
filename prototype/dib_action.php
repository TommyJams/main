<?
ob_start();

if (!isset($_SESSION)) {
session_start();
}

include('connect.php');

if(isset($_SESSION['username_artist']) && $_POST['dib'])
{
{ 
$q1 = "SELECT * FROM `$database`.`shop` WHERE link='$_POST[gig]'";
$result_set1 = mysql_query($q1);	
 
{
 		$found = mysql_fetch_array($result_set1);
		$promoter_id=$found["promoter"];
		$promoter_name=$found["promoter_name"];
		$gig=$found["gig"];
		$date=$found["venue_date"];
		$formattedDate=date('d-m-Y',strtotime($date));
		$add=$found["add"];
		$city=$found["venue_city"];
		$state=$found["venue_state"];
		$country=$found["venue_country"];
}
$q2 = "SELECT * FROM `$database`.`members` WHERE fb_id='$_SESSION[username_artist]'";
$result_set2 = mysql_query($q2);	
if (mysql_num_rows($result_set2) == 1) 
{
 		$found = mysql_fetch_array($result_set2);
		$artist_id=$found["link"];
		$artist_name=$found["name"];
		$artist_email=$found["email"];
}

$q3 = "SELECT * FROM `$database`.`members` WHERE link=$promoter_id";
$result_set3 = mysql_query($q3);	
if (mysql_num_rows($result_set3) == 1) 
{
 		$found = mysql_fetch_array($result_set3);
		$promoter_email=$found["email"];
}

}

$q4 = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$_POST[gig] AND artist_id=$artist_id";
$result_set4 = mysql_query($q4);	
if (mysql_num_rows($result_set4) == 1) 
{
	
header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=1&set=not DIB');
	exit;
}

$q2 = "INSERT INTO `$database`.`transaction` (`id`, `status`, `artist_id`, `artist_name`, `promoter_id`, `promoter_name`, `gig_id`, `gig_name`, `time`) VALUES('', '4', '$artist_id', '$artist_name', '$promoter_id', '$promoter_name', '$_POST[gig]', '$gig', 'CURRENT_TIMESTAMP')";
$result_set2 = mysql_query($q2);
if (!$result_set2)
{die("Database query failed: " . mysql_error());}




$to = $artist_email;
$subject = "Registered Dib for $gig";
$mess="
<p style='text-align:left;'>
Dear $artist_name,<br><br>
Thank you for registering your dib with TommyJams.<br>
The dib has been sent to the promoter, and you can monitor the real-time status of your dib via your profile on TommyJams in the Dibs Status section.
<br><br>
Happy Jamming,
<br>
Team TommyJams
<br><br>
</p>
<center>
<table border='1'>
	<tr>
		<td>Gig</td>
		<td>$gig</td>
	</tr>
	<tr>
		<td>Promoter</td>
		<td>$promoter_name</td>
	</tr>
	<tr>
		<td>Date of Gig</td>
		<td>$formattedDate</td>
	</tr>
</table>
</center>";
include("include/mail.php");

$to = "alerts@tommyjams.com";
include("include/mail.php");

$to = $promoter_email;
$subject = "Dib Received for $gig";
$mess="
<p style='text-align:left;'>
Dear $promoter_name,<br><br>
You have just received a dib for your gig on TommyJams.<br>
You can monitor the dib and take action via your profile on TommyJams in the My Gigs section.
<br><br>
Happy Jamming,
<br>
Team TommyJams
<br><br>
</p>
<center>
<table border='1'>
	<tr>
		<td>Gig</td>
		<td>$gig</td>
	</tr>
	<tr>
		<td>Artist</td>
		<td>$artist_name</td>
	</tr>
	<tr>
		<td>Date of Gig</td>
		<td>$formattedDate</td>
	</tr>
</table>
</center>";
include("include/mail.php");

$to = "alerts@tommyjams.com";
include("include/mail.php");

header('Location: ' . $_SERVER['HTTP_REFERER'] . '?success=1&set=sucessfully DIB');
	exit;

}

?>
