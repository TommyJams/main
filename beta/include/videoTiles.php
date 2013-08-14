<?

include('../connect.php');

$thisDate = NULL;
if($_GET["date"])
{
	$thisDate = $_GET["date"];
	$pieces = explode("-",$thisDate);
	$thisMonth = $pieces[1];
	$thisYear = $pieces[0];
}
else
{
	if($_GET["month"])
	{
		$thisMonth = $_GET["month"];
	}
	else
	{
		$thisMonth = date("m");
	}
	$thisYear = date("Y");
}

$SQLs = "SELECT * FROM `$database`.`radioone` WHERE YEAR(streamdate) = '".$thisYear."' AND MONTH(streamdate) = '".$thisMonth."'";
$results = mysql_query($SQLs);
if(mysql_num_rows($results) == 0)
{
	//No episodes seem to have come in yet, try previous month
	$thisMonth = $thisMonth - 1;
}

switch($thisMonth) {
	case '01': $thisMonthName = "January"; break;
	case '02': $thisMonthName = "February"; break;
	case '03': $thisMonthName = "March"; break;
	case '04': $thisMonthName = "April"; break;
	case '05': $thisMonthName = "May"; break;
	case '06': $thisMonthName = "June"; break;
	case '07': $thisMonthName = "July"; break;
	case '08': $thisMonthName = "August"; break;
	case '09': $thisMonthName = "September"; break;
	case '10': $thisMonthName = "October"; break;
	case '11': $thisMonthName = "November"; break;
	case '12': $thisMonthName = "December"; break;
}

?>

<!-- Month -->
<div id="monthWidgetBox">
	<?print("<h1>$thisMonthName</h1>");?>
</div>

<div id="monthWidgetContainer">
	<ul>
		<li><h1>January</h1></li>
		<li><h1>February</h1></li>
		<li><h1>March</h1></li>
		<li><h1>April</h1></li>
		<li><h1>May</h1></li>
        <li><h1>June</h1></li>
        <li><h1>July</h1></li>
        <li><h1>August</h1></li>
	</ul>
</div>

<!-- Video list -->
<div id="imageBoxContainer">

	<ul class="no-list image-list image-list-carousel">

	<?
		if($thisDate)
		{
			$SQLs = "SELECT * FROM `$database`.`radioone` WHERE streamdate = '".$thisDate."'";

			$results = mysql_query($SQLs);

			if(mysql_num_rows($results) == 1)
			{
				$a = mysql_fetch_assoc($results);
				$epName = $a["name"]; $epImage = $a["image"]; $epAudio = $a["audiolink"]; $epDate = date('jS M, Y',strtotime($a["streamdate"])); $epDesc = $a["desc"];
				print("
				<li class='bigListSize'>
					<div id='imageBox'>
						<a href='$epAudio' class='preloader overlay-video fancybox-audio-mixcloud'>
							<img src='images/radioone/artists/$epImage' alt=''/>
							<span></span>
						</a>
						<p class='imageBoxCaption'>$epName</p>
						<div class='imageDetails'>$epDate<br>$epDesc</div>
					</div>
				</li>");
			}
			else
			{
				print("
				<li class='bigListSize'>
					<div id='imageBox' style='padding-bottom: 10px'>Sorry, no listing found!</div>
				</li>");
			}
		}
		else
		{
			$SQLs = "SELECT * FROM `$database`.`radioone` WHERE YEAR(streamdate) = '".$thisYear."' AND MONTH(streamdate) = '".$thisMonth."'";

			$results = mysql_query($SQLs);

			if(mysql_num_rows($results) <= 4)
				while ($a = mysql_fetch_assoc($results))
				{
					$epName = $a["name"]; $epImage = $a["image"]; $epAudio = $a["audiolink"]; $epDate = date('jS M, Y',strtotime($a["streamdate"])); $epDesc = $a["desc"];
					print("
					<li class='bigListSize'>
						<div id='imageBox'>
							<a href='$epAudio' class='preloader overlay-video fancybox-audio-mixcloud'>
								<img src='images/radioone/artists/$epImage' alt=''/>
								<span></span>
							</a>
							<p class='imageBoxCaption'>$epName</p>
							<div class='imageDetails'>$epDate<br>$epDesc</div>
						</div>
					</li>");
				}
			else
				while ($a = mysql_fetch_assoc($results))
				{
					$epName = $a["name"]; $epImage = $a["image"]; $epAudio = $a["audiolink"]; $epDate = date('jS M, Y',strtotime($a["streamdate"])); $epDesc = $a["desc"];
					print("
					<li class='smallListSize'>
						<div id='imageBox'>
							<a href='$epAudio' class='preloader overlay-video fancybox-audio-mixcloud'>
								<img src='images/radioone/artists/$epImage' alt=''/>
								<span></span>
							</a>
							<p class='imageBoxCaption'>$epName</p>
							<div class='imageDetails'>$epDate<br>$epDesc</div>
						</div>
					</li>");
				}
		}
	?>

	</ul>

</div>

<!-- Radio One Logo-->
<a href="http://www.facebook.com/pages/ONE-Bengaluru-ONE-Music/128804727178554" target="_blank" id="radioOneLogo">

	<img src="../image/icon/radioonelogo.png" width="100%">

</a>

<script src="js/videoTiles.js">

</script>

<script type="text/javascript">

	initMonthWidget();
	initCaptions();
	initFancyBox();
	$("#loading-indicator").hide();
	
</script>
