<?php

ob_start();

if (!isset($_SESSION)) {

session_start();

}

include('../connect.php');





 ?>

<html>

<head>

    <link rel='stylesheet' href='css/edit.css'>

    <!-- Include the JS files -->

	<!--<style>

	.paging { padding:10px 0px 0px 0px; text-align:center; font-size:13px;}

	.paging.display{text-align:right;}

	.paging a, .paging span {padding:2px 8px 2px 8px;}

	.paging span {font-weight:bold; color:#000; font-size:13px; }

	.paging a {color:#000; text-decoration:none; border:1px solid #dddddd;}

	.paging a:hover { text-decoration:none; background-color:#6C6C6C; color:#fff; border-color:#000;}

	.paging span.prn { font-size:13px; font-weight:normal; color:#aaa; }

	.paging a.prn { border:2px solid #dddddd;}

	.paging a.prn:hover { border-color:#000;}

	.paging p#total_count{color:#aaa; font-size:12px; padding-top:8px; padding-left:18px;}

	.paging p#total_display{color:#aaa; font-size:12px; padding-top:10px;}

	</style>-->

</head>

<body>

<? 

	if(!isset($_SESSION["profile"])){$_SESSION["profile"]=" ";}

	$searchProfile=$_SESSION["profile"];

	if(!isset($_SESSION["pages"])){$_SESSION["pages"]=1;}

?>

    <div id="searchbox" style="height:8%;">

        <form method="post" style="height:100%;" action="

            <? if(isset($_SESSION['username'])){ print("promoter.php?profile=search"); }

            elseif(isset($_SESSION['username_artist'])){ print("artist.php?profile=search"); }

            else{ print("index.php?profile=search"); }

            ?>

            " >

            <input type="text" name="profile" value="<? print($searchProfile); ?>"   style="height:100%; width:65%; border:0px;">

            <input type="submit" value="Find Profile"  style="width: 30%; height:100%; border: 0px; margin-left:1%;"> 

        </form>

    </div>

    <div id="box" style="display:block; height:85%;">

        <div id="content" class="clearfix">

            <section id="left" style="width:100%; background:#000;">

                <div class="gcontent" style="margin-bottom:6px; margin-top:5px; overflow-y:auto;">

                        <table class="searchResultsTable" width="100%" style="padding: 10px 10px; text-align: center;">

                            <tr bgcolor="#ffcc00" height="30px">

                                <td width="10%"><h1>Image</h1></td>

                                <td width="20%"><h1>Name</h1></td>

								<td width="20%"><h1>User</h1></td>

                                <td width="10%"><h1>Type</h1></td>

                                <td width="15%"><h1>City</h1></td>

                                <td width="25%"><h1>Social</h1></td>

                            </tr>

                            <?
								if($searchProfile)
								{
								
									$query = "SELECT COUNT(*) as num FROM `$database`.`members` WHERE (`name` LIKE '%$searchProfile%' OR `username` LIKE '%$searchProfile%' OR `about` LIKE '%$searchProfile%'  OR `email` LIKE '%$searchProfile%'  OR `mobile` LIKE '%$searchProfile%')  AND status!=2";

									$total_pages = mysql_fetch_array(mysql_query($query));

									$total_pages = $total_pages['num']/7;

									$total_pages=ceil($total_pages);

									$v=0;

									$que = "SELECT * FROM `$database`.`members` WHERE (`name` LIKE '%$searchProfile%' OR `username` LIKE '%$searchProfile%' OR `about` LIKE '%$searchProfile%'  OR `email` LIKE '%$searchProfile%'  OR `mobile` LIKE '%$searchProfile%') AND status!=2";

									$sea=mysql_query($que);

									while($a = mysql_fetch_assoc($sea))

									{

										$v=$v+1;

										$id=$a["id"];$name=$a["name"];$city=$a["city"];$usernam=$a["username"];

										$state=$a["state"];$type=$a["type"];$fb=$a["fb"];$twitter=$a["twitter"];

										$youtube=$a["youtube"];$rever=$a["reverbnation"];$gplus=$a["gplus"];$myspace=$a["myspace"];$link=$a["link"];

										$user=$a["user"];

										if($type=="Promoter" && $user!=""){     $users="images/promoter/$user";$usersa="../images/promoter/$user";; }

										elseif($type=="Artist"  && $user!=""){     $users="images/artist/$user";$usersa="../images/artist/$user"; }

										else{$usersa="images/profile.jpg";}

								
										if(!file_exists($usersa)&& $user==""){$users="images/profile.jpg";}

										else if(!file_exists($usersa) && $user!=""){$users="https://graph.facebook.com/"."$user/picture";}

										$linker=$link*15999;				

										if($v<($_SESSION["pages"]*7) && $v>($_SESSION["pages"]*7)-7)

										{

                            ?>

                            <?

											if(isset($_SESSION['username'])){$goto="promoter.php?id=$link";}

											else if(isset($_SESSION['username_artist'])){$goto="artist.php?id=$link";}

											else{$goto="fbconnect.php";}

											print("

												<tr height='20px' bgcolor='#000'>

													<td width=10%><img src='$users' width=50px height=50px></td>

													<td width=20%><a href='$goto' onClick=verify_login('$goto');>$name</a></td>
													
													<td width=20%><a href='$goto' onClick=verify_login('$goto');>$usernam</a></td>

													<td width=10%>$type</td>

													<td width=15%>$city</td>

													<td width=25%>"
												);

											if($fb!=""){ print("<a href='$fb' rel='me' target='_blank'><img src='img/facebook.png' /></a>"); }						

											if($twitter!=""){ print("<a href='$twitter' rel='me' target='_blank'><img src='img/twitter.png' /></a>"); }					

											if($rever!=""){ print("<a href='$rever' rel='me' target='_blank'><img src='img/reverbnation.png' /></a>"); }				

											if($youtube!=""){ print("<a href='$youtube' rel='me' target='_blank'><img src='img/youtube.png' /></a>"); }						

											if($myspace!=""){ print("<a href='$myspace' rel='me' target='_blank'><img src='img/myspace.png' /></a>"); }					

											if($gplus!=""){ print("<a href='$gplus' rel='me' target='_blank'><img src='img/gplus.png' /></a>"); }

											print("</td></tr>");

                            ?>

                            <?

										}

									}
								
								}
								
								else
								
								{
								
									$total_pages = 0;
								
								}
                            
                            ?> 
                            
                        </table>

                        <table class="searchResultsTable" style="padding: 0px 10px; ">
                            <tr>
                            <?
                            
                            $url = $_SERVER['PHP_SELF'];
                            $parts = parse_url($url);
                            $filepath = $parts['path'];

                            if($filepath != "index.php" && $filepath != "artist.php" && $filepath != "promoter.php")
                            {
                                if(isset($_SESSION['username']))
                                {
                                    $filepath = "promoter.php";
                                }

                                elseif(isset($_SESSION['username_artist']))
                                {
                                    $filepath = "artist.php";
                                }
                                
                                else
                                {
                                    $filepath = "index.php";
                                }
                            }

                            if($total_pages>20){$total_pages=20;}

                            for($i=1;$i<=$total_pages;$i++)
							{
								if($_SESSION["pages"] == $i)
									print("<td><a href='$filepath?profile=search&pages=$i' style='background: #ffcc00; padding: 2px 12px; line-height: 30px;'>$i</a></td>");
								else
									print("<td><a href='$filepath?profile=search&pages=$i' style='padding: 2px 12px; line-height: 30px;'>$i</a></td>");
							}

                            ?>
                            </tr>
                        </table>

                </div>

            </section>

        </div>

    </div>

</body>

</html>