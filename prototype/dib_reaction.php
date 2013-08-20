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
$link=$_POST["gig"]/15999;
$artist_id=$_POST["giger"];
if($_POST["accept"])
{
	$SQLs = "UPDATE `$database`.`transaction` SET status=1 WHERE gig_id='$link' AND artist_id=$artist_id";
	$results = mysql_query($SQLs);
	if(!$results)
	{
		die("Database query failed: " . mysql_error());
	}
	
/*	$SQLs = "UPDATE `$database`.`transaction` SET status=2 WHERE gig_id='$link' AND artist_id!=$artist_id";
	$results = mysql_query($SQLs); */

	$SQLs = "SELECT * FROM `$database`.`transaction` WHERE gig_id='$link'";
	$results = mysql_query($SQLs);
	while ($a = mysql_fetch_assoc($results))
	{
		$status=$a["status"];
		$gig=$a["gig_name"];
		$artist_id=$a["artist_id"];
		$artist_name=$a["artist_name"];
		$promoter_name=$a["promoter_name"];
		
		$q2 = "SELECT * FROM `$database`.`members` WHERE link='$artist_id'";
		$result_set2 = mysql_query($q2);	
		if (mysql_num_rows($result_set2) == 1) 
		{
				$found = mysql_fetch_array($result_set2);
				$artist_name=$found["name"];
				$artist_email=$found["email"];
		}
		$to = $artist_email;
		$gigname=$gig;

		if($status==1)
		{
			$SQLs = "SELECT * FROM `$database`.`shop` WHERE link='$link'";
			$result1 = mysql_query($SQLs);
			$a = mysql_fetch_array($result1);
			{
				$gig=$a["gig"];$date=$a["venue_date"];$vtime=$a["venue_time"];
				$promoter_name=$a["promoter_name"];$promoter=$a["promoter"];
			}
			$q8 = "INSERT INTO `$database`.`rating` (`id`, `event_date`, `event_time`, `status`, `artist_id`, `artist_name`, `promoter_id`, `promoter_name`, `gig_id`, `gig_name`, `promoter_rate`, `promoter_comment`, `promoter_gig_rate`, `promoter_gig_comment`, `promoter_future`, `artist_rate`, `artist_comment`, `artist_dib_comment`, `artist_future`, `time`)
											VALUES (NULL, '$date', '$vtime', '2', '$artist_id', '$artist_name', '$promoter', '$promoter_name', '$link', '$gig', '', '', '', '', '', '', '', '', '', CURRENT_TIMESTAMP);";
			$result_set8 = mysql_query($q8);
			if (!$result_set8)
			{
				die("Database query failed: " . mysql_error());
			}
			$acceptedArtist=$artist_name;
			$subject = "Dib Accepted for $gig";

			$mess="<p style='text-align:left;'>
			Dear $artist_name,<br><br>
			Congratulations! Your dib has been accepted for the gig: '$gig' on TommyJams.
			<br>
			Please login to your profile on TommyJams and view the host details and contact number in the 'Dibs Status' section.
			<br>
			We wish you all the very best for the gig.
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
					<td>Rate Promoter and Gig</td>
					<td><a href='http://www.tommyjams.com/prototype/artist.php?feed=$link'>RATE</a> (enabled only after the gig)</td>
				</tr>
			</table>
			</center>
			";
		}
//		elseif($status==2)
		elseif($status==4)
		{
			$subject = "Dib Rejected for $gig";
			$mess="<p style='text-align:left;'>
			Dear $artist_name,<br><br>
			Sorry, your dib for the gig: '$gig' has been rejected by the host.
			<br>
			However, there are a lot more gigs to be booked on TommyJams and you'll surely find the right ones for you. Please login to your profile on TommyJams and search for the latest gigs in the 'Find Gigs' section.
			<br>
			We wish you all the very best in the future.
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
			</table>
			</center>
			";
		}
		include("include/mail.php");

		$to = "alerts@tommyjams.com";
		include("include/mail.php");
	}	

	$SQLs = "UPDATE `$database`.`transaction` SET status=2 WHERE gig_id='$link' AND artist_id=$artist_id AND status=4";
	$results = mysql_query($SQLs);
	
	$q2 = "SELECT * FROM `$database`.`members` WHERE fb_id='$username'";
	$result_set2 = mysql_query($q2);
	if (mysql_num_rows($result_set2) == 1) 
	{
		$found = mysql_fetch_array($result_set2);
		$promoter_name=$found["name"];
		$promoter_email=$found["email"];
		$to = $promoter_email;
		$subject = "Booked Gig: $gigname";
		$mess="<p style='text-align:left;'>
				Dear $promoter_name,<br><br>
				Congratulations! Your gig: '$gigname' is now booked on TommyJams.
				<br>
				Please login to your profile on TommyJams and view the artist details and contact number in the 'My Gigs' section.
				<br>
				We wish you all the very best for the gig.
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
						<td>$acceptedArtist</td>
					</tr>
					<tr>
						<td>Rate Artist and Gig</td>
						<td><a href='http://www.tommyjams.com/prototype/promoter.php?feed=$link'>RATE</a> (enabled only after the gig)</td>
					</tr>
				</table>
				</center>
				";
		include("include/mail.php");
		
		

		$to = "alerts@tommyjams.com";
		include("include/mail.php");
	}
}
elseif($_POST["reject"])
{
	$SQLs = "UPDATE `$database`.`transaction` SET status=2 WHERE gig_id='$link' AND artist_id=$artist_id";
	$results = mysql_query($SQLs);

	$SQLs = "SELECT * FROM `$database`.`transaction` WHERE gig_id='$link' AND artist_id=$artist_id";
	$results = mysql_query($SQLs);

	if (mysql_num_rows($results) == 1) 
	{
		$found = mysql_fetch_array($results);
		$artist_name=$found["artist_name"];
		$gig=$found["gig_name"];
		$promoter_name=$found["promoter_name"];
		
		$q2 = "SELECT * FROM `$database`.`members` WHERE link='$artist_id'";
		$result_set2 = mysql_query($q2);	
		if (mysql_num_rows($result_set2) == 1) 
		{
				$found = mysql_fetch_array($result_set2);
				$artist_email=$found["email"];
		}
		$to = $artist_email;

		$subject = "Dib Rejected for $gig";
		$mess="<p style='text-align:left;'>
		Dear $artist_name,<br><br>
		Sorry, your dib for the gig: '$gig' has been rejected by the host.
		<br>
		However, there are a lot more gigs to be booked on TommyJams and you'll surely find the right ones for you. Please login to your profile on TommyJams and search for the latest gigs in the 'Find Gigs' section.
		<br>
		We wish you all the very best in the future.
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
		</table>
		</center>
		";
		include("include/mail.php");

		$to = "alerts@tommyjams.com";
		include("include/mail.php");
	}
}
elseif($_POST["recommendArtist"])
{
	$SQLs = "SELECT * FROM `$database`.`shop` WHERE link='$link'";
	$results = mysql_query($SQLs);
	$a = mysql_fetch_array($results);
	{
		$gig=$a["gig"];
		$date=$a["venue_date"];
		$promoter_name=$a["promoter_name"];
	}

	$to = "contact@tommyjams.com";
	$subject = "Artist recommendation wanted for $gig";
	$mess="<p style='text-align:left;'>
	Dear Admin,<br><br>
	You have received a recommendation request for $gig.
	<br>
	</p>
	<center>
	<table border='1'>
		<tr>
			<td>Gig</td>
			<td>$gig</td>
		</tr>
		<tr>
			<td>Gig ID</td>
			<td>$link</td>
		</tr>
		<tr>
			<td>Date</td>
			<td>$date</td>
		</tr>
		<tr>
			<td>Promoter</td>
			<td>$promoter_name</td>
		</tr>
	</table>
	</center>
	";
	include("include/mail.php");

	$to = "alerts@tommyjams.com";
	include("include/mail.php");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;

?>
