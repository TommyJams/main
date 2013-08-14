<?
ob_start();
if (!isset($_SESSION)) {
	session_start();
}
include('../connect.php');
if(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
	$password=md5($_SESSION['password']);
	$role="p";
}
elseif(isset($_SESSION['username_artist']))
{
	$username=$_SESSION['username_artist'];
	$password=md5($_SESSION['password_artist']);
	$role="a";
}
else
{
	header("index.php");
	exit;
}

$SQLs = "SELECT * FROM `$database`.`members` WHERE fb_id='$username'";
$results = mysql_query($SQLs);
while ($a = mysql_fetch_assoc($results))
{
	$loggedInID=$a["link"];
}
?>
<html>
<head>
	<link rel='stylesheet' href='css/edit.css'>
	<!-- Include the JS files -->
</head>
<body>
	<div id="box" style="display:block;">
		<div id="content" class="clearfix">
			<section id="left" style=" width:100%;">

				<?
				$q2 = "SELECT * FROM `$database`.`rating` WHERE gig_id=$_GET[feed]";
				$result_set2 = mysql_query($q2);
					if (mysql_num_rows($result_set2) == 1)
					{
						$found = mysql_fetch_array($result_set2);
						$status=$found["status"];
						$prate=$found["promoter_rate"];
						$arate=$found["artist_rate"];
						$edate=$found["event_date"];
						$date=date("Y-m-d");
						$today = strtotime($date); $event_date = strtotime($edate);
						if($event_date > $today)
						{
							print("<div class='gcontent' style='margin-bottom:6px; margin-top:10px;'>
							<div class='head'><h1>You may rate after the gig is over on: $edate</h1></div>");
							exit;
						}

						if(($role=="a" & $arate!=0) || ($role=="p" & $prate!=0))
						{
							print("<div class='gcontent' style='margin-bottom:6px; margin-top:10px;'>
							<div class='head'><h1>Sorry, Already Rated!</h1></div>");
							exit;
						}

						$artist_id=$found["artist_id"];$artist_name=$found["artist_name"];
						$promoter_id=$found["promoter_id"];$promoter_name=$found["promoter_name"];
						$gig_id=$found["gig_id"];$gig_name=$found["gig_name"];
						$p_rate=$found["promoter_rate"];$p_comment=$found["promoter_comment"];$p_gig_rate=$found["promoter_gig_rate"];$p_gig_comment=$found["promoter_gig_comment"];$p_future=$found["promoter_future"];
						$a_rate=$found["artist_rate"];$a_comment=$found["artist_comment"];$a_dib_rate=$found["artist_dib_rate"];$a_dib_comment=$found["artist_dib_comment"];$a_future=$found["artist_future"];

					}
					else 
 					{
						print("<div class='gcontent' style='margin-bottom:6px; margin-top:10px;'>
								<div class='head'><h1>No such gig to rate</h1></div>");
						exit;
					}

					if($role=="a")
					{
						/*$q2 = "SELECT * FROM `$database`.`members` WHERE link=$artist_id AND name='$artist_name'";
						$result_set2 = mysql_query($q2);

						if (mysql_num_rows($result_set2) != 1) */
						if($loggedInID != $artist_id)
						{
							print("<div class='gcontent' style='margin-bottom:6px; margin-top:10px;'>
								<div class='head'><h1>Ineligible for rating '$gig_name'</h1></div>");
							exit;
						}
					}

					elseif($role=="p")
					{
						/*$q2 = "SELECT * FROM `$database`.`members` WHERE link=$promoter_id AND name='$promoter_name'";
						$result_set2 = mysql_query($q2);
						if (mysql_num_rows($result_set2) != 1) */
						if($loggedInID != $promoter_id)
						{
							print("<div class='gcontent' style='margin-bottom:6px; margin-top:10px;'>
							<div class='head'><h1>Ineligible for rating '$gig_name'</h1></div>");
							exit;
						}
					}

					if(isset($_POST["gig"]) && (isset($_POST["prate"]) || isset($_POST["arate"])))
					{
						if($role=="a"){ $pag="artist"; }
						elseif($role=="p"){ $pag="promoter"; }

						if(isset($_POST["prate"]))
						{
							$prate=$_POST['prate'];
							$pcomment=$_POST['pcomment'];
							$gig=$_POST['gig'];
							$gigc=$_POST['gigc'];
							$future=$_POST['future'];

							$q2 = "UPDATE `$database`.`rating` SET `status` = '1', `promoter_rate` = '$prate',`promoter_comment` = '$pcomment', `promoter_gig_rate` = '$gig', `promoter_gig_comment` = '$gigc', `promoter_future` = '$future' WHERE `gig_id` =$_GET[feed]";
							$result_set2 = mysql_query($q2);

							if (!$result_set2)
							{die("Database query failed: " . mysql_error());}

							$to = "alerts@tommyjams.com";
							$subject = "Gig has been rated by Promoter";
							$mess="Gig: $_GET[feed]<br>Rating: $gig<br>Comment: $gigc";
							include("mail.php");

							$q1 = "SELECT * FROM `$database`.`members` WHERE link=$artist_id";
							$result_set1 = mysql_query($q1);
							if (mysql_num_rows($result_set1) == 1)
							{
								$a = mysql_fetch_array($result_set1);
								$silver = $a["silver"];
								$nsilver = $a["nsilver"];
								$nsilver++;
								$avgsilver = ((($nsilver-1) * $silver) + $prate)/($nsilver);

								$q3 = "UPDATE `$database`.`members` SET `silver` = '$avgsilver',`nsilver` = '$nsilver' WHERE link=$artist_id";
								$result_set3 = mysql_query($q3);

								if (!$result_set3)
								{die("Database query failed: " . mysql_error());}
							}
							header("Location: ../$pag.php?thank=1&rate=1");
							exit;
						}
						elseif(isset($_POST["arate"]))
						{							
							$arate=$_POST['arate'];
							$acomment=$_POST['acomment'];
							$gig=$_POST['gig'];
							$gigc=$_POST['gigc'];
							$future=$_POST['future'];
							$q2 = "UPDATE `$database`.`rating` SET `status` = '1', `artist_rate` = '$arate',`artist_comment` = '$acomment', `artist_dib_rate` = '$gig', `artist_dib_comment` = '$gigc', `artist_future` = '$future' WHERE `gig_id` =$_GET[feed]";
							$result_set2 = mysql_query($q2);
							if (!$result_set2)
							{die("Database query failed: " . mysql_error());}

							$to = "alerts@tommyjams.com";
							$subject = "Gig has been rated by Artist";
							$mess="Gig: $_GET[feed]<br>Rating: $gig<br>Comment: $gigc";
							include("mail.php");

							$q1 = "SELECT * FROM `$database`.`members` WHERE link=$promoter_id";
							$result_set1 = mysql_query($q1);
							if (mysql_num_rows($result_set1) == 1)
							{
								$a = mysql_fetch_array($result_set1);
								$silver = $a["silver"];
								$nsilver = $a["nsilver"];
								$nsilver++;
								$avgsilver = ((($nsilver-1) * $silver) + $arate)/($nsilver);
								
								$q3 = "UPDATE `$database`.`members` SET `silver` = '$avgsilver',`nsilver` = '$nsilver' WHERE link=$promoter_id";
								$result_set3 = mysql_query($q3);
								if (!$result_set3)
								{die("Database query failed: " . mysql_error());}
							}
							header("Location:  ../$pag.php?thank=1&rate=1");
							exit;
						}
					}
					else
					{				?>
						<div class="gcontent" style="margin-bottom:6px; margin-top:10px;">							<div class="head">								<h1>RATING & FEEDBACK</h1>							</div>
							<div id="signUp" class="sign" style="">
								<form action="<? print("include/feed.php?feed=$_GET[feed]"); ?>" method="POST" class="cleanForm" id="signUpForm" style="height:100%; overflow-y:auto;">
									<div id="maindetails" style="width:100%; height:300px;">
										<div id="details" style=" width:45%; float:left;">
											<center><a href="#" class="greenRef"><h1><? print("$gig_name");?></h1></a></center>											<table style="padding:20px; width:80%;">												<tr>													<td width="50%">														<p><label for="Select" style="float:right;">Gig Rating: <span class="requiredField">*</span></label></p>													</td>													<td width="50%">
														<select id="select" name="gig"  style="width:50px; height:25px; font-size:18px;" required >
														<?
															for($i=5;$i>0;$i--){ print("<option value=$i>$i</option>");}
														?>
														</select>													</td>												</tr>
												<tr>													<td width="50%">
														<p><label for="fb" style="float:right;">Comments on Gig:</label></p>													</td>													<td width="50%">
														<textarea cols="20" rows="7"  id="about" name="gigc" maxlength="100"></textarea>
														<em>(less than 100 characters)</em>													</td>												</tr>											</table>
										</div>
										<div id="details"  style=" width:45%; float:right;">											<center>												<a href="#" class="greenRef">													<h1>														<? 															if($role=="p"){ print("$artist_name"); }															elseif($role=="a"){ print("$promoter_name"); }														?>													</h1>												</a>											</center>											<table style="padding:20px; width:80%;">												<tr>													<td width="50%">														<p><label for="Select" style="float:right;">															<?																if($role=="p"){ print("Artist Rating:"); }
																elseif($role=="a"){ print("Promoter Rating:"); }															?>															<span class="requiredField">*</span>														</label></p>													</td>													<td width="50%">
														<select id="select" name="<?if($role=="p"){ print("prate"); }elseif($role=="a"){ print("arate"); }?>" 														style=" width:50px; height:25px; font-size:18px;" required >
															<?
																for($i=5;$i>0;$i--){ print("<option value=$i>$i</option>");}
															?>
														</select>													</td>												</tr>												<tr>													<td width="50%">
														<p><label for="fb" style="float:right;">														<?															if($role=="p"){ print("Comments on Artist:"); }															elseif($role=="a"){ print("Comments on Host:"); }														?>														</label></p>													</td>													<td width="50%">														<textarea cols="20" rows="7"  id="about" name="<?if($role=="p"){ print("pcomment"); }elseif($role=="a"){ print("acomment"); }?>" maxlength="100"></textarea>														<em>(less than 100 characters)</em>													</td>												</tr>												<tr>													<td width="50%">														<input type="checkbox" value="1" name="future" style="float:right; margin-right:5px;" />													</td>													<td width="50%">														<p>Would you conduct gigs with this <?if($role=="p"){ print("Artist"); }elseif($role=="a"){ print("Host"); }?> again?</p>													</td>												</tr>											</table>
										</div>
									</div>									<div class="centera" style="width:100%; position:relative; margin-top:10px; ">										<input type="submit" value="Rate" style="height:45px; width: 50px; left:50%; margin-left:-50px; position:relative; padding: 5px 5px;"/>									</div>								</form>
							</div>
						</div>
					</section>				</div>			</div>
<? } ?>	   
</body>
</html>