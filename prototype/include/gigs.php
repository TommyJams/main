<?
ob_start();

if (!isset($_SESSION)) {
session_start();
}
include('../connect.php');
if(isset($_SESSION['username_artist'])  && !isset($_GET["id"]))
{
	$username=$_SESSION['username_artist'];
	$password=md5($_SESSION['password_artist']);
}
else if(isset($_SESSION['username'])  && !isset($_GET["id"]))
{
	$username=$_SESSION['username'];
	$password=md5($_SESSION['password']);
}
else{header("logout.php");exit;}


$SQLs = "SELECT * FROM `$database`.`shop` WHERE link='$_GET[gig]'";
$results = mysql_query($SQLs);
$a = mysql_fetch_array($results);
{
	$id=$a["id"];$gig=$a["gig"];$cat=$a["category"];
	$add=$a["venue_add"];$city=$a["venue_city"];$state=$a["venue_state"];$country=$a["venue_country"];$pincode=$a["venue_pin"];
	$fb=$a["fb"];$twitter=$a["twitter"];$web=$a["web"];
	$date=$a["venue_date"];$vtime=$a["venue_time"];$duration=$a["duration"];
	$formattedDate = date('d-m-Y',strtotime($date));
	$period=$a["period"];$promoter_name=$a["promoter_name"];$promoter=$a["promoter"];
	$SQLs = "SELECT mobile FROM `$database`.`members` WHERE link='$promoter'";
	$result = mysql_query($SQLs);
	$b = mysql_fetch_array($result);
	{$mobile=$b["mobile"];}
	if(!isset($_SESSION["username"])){$mobile=$mobile[0]." * * * * * * * *";}
	$status=$a["status"];$link=$a["link"];$image=$a["image"];
	$desc=$a["desc"];$budget_min=$a["budget_min"];$budget_max=$a["budget_min"]+$a["budget_min"]*$a["budget_max"]/100;$time=$a["time"];
}
if($image==""){$image="gigs.jpg";}
$gigs="images/gig/$image";

$todayTime = strtotime(date("Y-m-d"));
$dated = strtotime($date);
 ?>
 <html>
<head>
	<link rel='stylesheet' href='css/edit.css'>
	<!-- Include the JS files --> 
	<script type="text/JavaScript">
	function show(d)
	{ document.getElementById('frameprofessional').style.display="none";
		document.getElementById('frameabout').style.display="none";
		document.getElementById('framecontact').style.display="none";
		document.getElementById('framesocial').style.display="none";	
		document.getElementById(d).style.display="block";	
	}
	</script>

</head>
 <body>
    <?
    if(isset($_GET["added"]) && $_GET["added"]=="new")
    {
        echo('
                <script type="text/javascript">
                    messageBoxUp("Gig Launched","Please visit the My Gigs section to see updates on the gig. You can also change the gig logo by clicking on the gig profile picture.");
                </script>
            ');
    }
	elseif(isset($_GET["edited"]) && $_GET["edited"]=="new")
    {
        echo('
                <script type="text/javascript">
                    messageBoxUp("Gig Updated","Your changes have been updated successfully!");
                </script>
            ');
    }
    ?>
    <div id="blanket" style="display:none;
                            background-color:#111;
                            opacity: 0.65;
                            position:absolute;
                            z-index: 9001;
                            top:0px;
                            left:0px;
                            width:100%;
                            height:100%;
                            "/>

    <div id="messageBox" style="display:none;">
        <a id="msgBoxClose" href="javascript:;" onClick="messageBoxClose()">
        </a>
        <center>
            <h1 id="msgBoxTitle">
                Message Box
            </h1>
            <p id="msgBoxDetails">
                This is a generic Message Box. If you are getting this, then something went wrong.
            </p>
        </center>
    </div>

	<div id="profil" style="display:none; ">
        <a id="loginBoxClose" href="#" onClick="popup('profil')">
		</a>
        <center><h2>Upload gig logo</h2></center>
        
        <form action="update.php?gig=pic&pic=<? print("$link"); ?>" method="post" enctype="multipart/form-data">
            <table style="margin-top: 30px; width: 100%;">
                <tbody>
                    <tr>
                        <td>
                            <input name="gigs" id="image" type="file" size="50" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <span class="hint" style="line-height:10px;">
                                    Valid Image File (.jpg, .png, .bmp)
                                    <br>
                                    Max Size: 150KB
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">
                            <input name="submit" id="upload" type="submit" value="Upload" style="background: #000; color: #ffcc00; margin: 10px auto;"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div id="box" style="display:block; height:100%;">

    <? if(!isset($_GET["edit"])){ ?>		
        <section id="left" style="width:100%; height:100%;">
			<div id="userStats" class="clearfix">
                <div id="userPic" class="pic">
					<? if(isset($_SESSION['username']))
                    {print("<a href='#'  onclick=popup('profil')>");}
					else {print("<a href='#'>");}
					print ("<img src='$gigs' class='userStatsPic' />"); ?>
					</a>
				</div>
				<div class="data">
                    <div style=" width:35%; height:100%; float:left;">
                        <div id="userName">
							<h1 style="display:inline-block;"><? print ("$gig"); ?></h1>
						</div>
                        <h2 id='gigHostName'>Hosted by: <? print ("<a href='javascript:;' onClick=showProfile('$promoter');>$promoter_name</a>"); ?></h2>
                        <h2><?
                            if($city!="")
                            {
                                print("$city");
                            }
                            if($state!="")
                            {
                                if($city!="")
                                print(", ");

                                print("$state");
                            }
                            if($country!="")
                            {
                                if($city!="" || $state!="")
                                print(", ");

                                print("$country");
                            }
                        ?></h2>
                    </div>
					<div class="socialInfo">
						<div class="socialMediaLinks">
							<? if($fb!=""){ print("<a href='$fb' rel='me' target='_blank'><img src='img/facebook.png' /></a>"); }?>						
							<? if($twitter!=""){ print("<a href='$twitter' rel='me' target='_blank'><img src='img/twitter.png' /></a>"); }?>						
							<? if($web!=""){ print("<a href='$web' rel='me' target='_blank'><img src='img/web.png' /></a>"); }?>
						</div>
					</div>
                    <div class="medals" style="width:35%; height: auto; float:right; position:relative; top:30%; margin-top:-35px;">
                        <div id="gigStatus" style="width:auto; height:auto; margin:20px auto; position:relative;">
						<center>
                        <?
                        $yes=0;
						
						$SQLsa = "SELECT link FROM `$database`.`members` WHERE `fb_id`='$username'";
						$resultsa = mysql_query($SQLsa);
						if (!$resultsa)
							die("Database query failed: " . mysql_error());
						$pl = mysql_fetch_assoc($resultsa);
						$prolink=$pl["link"];

                        $q4 = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$link AND status=1";
                        $result_set4 = mysql_query($q4);	
                        if (mysql_num_rows($result_set4) == 1) 
                        {
                            $found = mysql_fetch_array($result_set4);
                            $yes=1;
							$artist_booked_id=$found["artist_id"];
							$artist_booked_name=$found["artist_name"];
							print("<h2>Artist:</h2>");
                            print("<a href='javascript:;' onClick=showProfile('$artist_booked_id'); class='whiteHoverRef'>$artist_booked_name</a>");
                        }
						elseif($promoter==$prolink)
						{
							print("<a  href='javascript:;' onClick=loadframe('updategig=$link'); class='whiteHoverRef'>Edit Gig</a>");
						}
                        elseif(isset($_SESSION["username_artist"]))
                        { 
                            $q2 = "SELECT link FROM `$database`.`members` WHERE fb_id='$_SESSION[username_artist]'";
                            $result_set2 = mysql_query($q2);	
                            if (mysql_num_rows($result_set2) == 1) 
                            {
                                $found = mysql_fetch_array($result_set2);
                                $artist_id=$found["link"];
                            }
                            $q4 = "SELECT * FROM `$database`.`transaction` WHERE gig_id=$link AND artist_id=$artist_id";
                            $result_set4 = mysql_query($q4);	
                            if (mysql_num_rows($result_set4) == 1) 
                            {                    
								$found = mysql_fetch_array($result_set4);
                                $statuss=$found["status"];
                                if($statuss==1){print("<a href='#' id='addnew' style='background: #0a0;'>Accepted</a>");}
                                elseif($statuss==2){print("<a href='#' id='addnew' style='background: #a00'>Rejected</a>");}
                                elseif($statuss==4){print("<a href='#' id='addnew' style='background: #282828;'>Pending</a>");}
                            }
							elseif($todayTime > $dated)
							{
								print("<a href='javascript:;' class='dibStatusRef' style='background:#666;'>Closed</a>");
							}
                            else
                            {                       
                                if($yes!=1)
                                {   ?>
                                    <form  action="dib_action.php"  method="post">
                                        <input type="hidden" name="gig" value="<? print($link);?>">
                                        <input id="dibStatusButton" name="dib" type="submit" value="DIB" onClick="return confirmSubmit()">
                                    </form>
                                    <?
                                }
                            }
                        }
                        /*
                        print("<p"); if(isset($_SESSION["username_artist"])){ print(" style='margin-top:25px;' ");}
                        print("><b>Description:-</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  $desc</p>");
                        */
                        ?>
						</center>
                        </div>
                    </div>
				</div> <!--data-->
			</div> <!--userStats-->
            <div id = "blank" style = "display: block; height: 4%; width: 100%" />
			<div class="about">
                <div class="gcontent" style="height:100%; background: #000; padding: 0px 20px; overflow-y:auto;">                    
                    <div class="boxy" style = "height:auto; margin:20px 0px;">
                        <table width="100%" style="text-align:left;">
                            <tr>
                                <td style="width:10%; background: #ffcc00;"><h2>Date<h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  print ("$formattedDate"); ?><td>
                            </tr>
                            <tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Time<h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  print ("$vtime"); ?></td>
                            </tr>
							<tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Duration<h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  print ("$duration hours"); ?></td>
                            </tr>
                            <tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Genre<h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  print ("$cat"); ?></td>
                            </tr>
                            <tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Budget<h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  if($budget_min == -1){print("Undefined");}else{print("INR $budget_min - $budget_max");} ?></td>
                            </tr>
                            <tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Venue</h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?  print ("$add, $city, $state, $country, $pincode"); ?></td>
                            </tr>
                            <tr style="color: #000; width:10%" >
                                <td style="width:10%; background: #ffcc00;"><h2>Description</h2></td>
                                <td style="color: #000; background: #fff; padding:5px;"><?
																							/*convert to URL*/
																							$descStr = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]","<a href=\"\\0\" style='color:#000;'>\\0</a>", $desc);
																							/*format newlines*/
																							$descStr = nl2br("$descStr");
																							print ("$descStr"); 
																						?>
								</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>
		<? } ?>
    </div>

	<script type="text/javascript">
		$('#loading-indicator').hide();
	</script>

	<script LANGUAGE="JavaScript">
	function confirmSubmit()
	{
		var agree=confirm("Are you sure you wish to call dibs for this gig? The host will receive the dibs and choose an artist. Please note, these dibs are not cancellable.");
		if (agree)
			return true ;
		else
			return false ;
	}
	</script>

</body>
</html>