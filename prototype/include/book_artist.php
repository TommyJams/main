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
</head>

<body>


<?
    if (!isset($_SESSION["book_artist_search_term"])) {
	$_SESSION["book_artist_search_term"]="";
    }
    // TODO: Change _SESSION["pages"] to something unique, since pages is also used by profile_search.php
    if (!isset($_SESSION["pages"])) {
        $_SESSION["pages"] = 1;
    }

	$searchTerm=$_SESSION["book_artist_search_term"];
?>

    <div id="searchbox" style="height:8%;">

        <form method="post" style="height:100%;" action="promoter.php?book_artist=1">

            <input type="text" name="book_artist_search_term" value="<? print($searchTerm); ?>"   style="height:100%; width:65%; border:0px;">

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

                                <td width="15%"><h1>City</h1></td>

                                <td width="10%"><h1>Social</h1></td>

                                <td width="15%"><h1>Genres</h1></td>

                                <td width="10%"><h1>Fee range</h1></td>

                                <td width="20%"><h1>Book</h1></td>

                            </tr>

                            <?

								if($searchTerm)
								{
								
									$query = "SELECT COUNT(*) as num FROM `$database`.`members` WHERE (`name` LIKE '%$searchTerm%' OR `username` LIKE '%$searchTerm%' OR `about` LIKE '%$searchTerm%'  OR `email` LIKE '%$searchTerm%'  OR `mobile` LIKE '%$searchTerm%')  AND status!=2";

									$total_pages = mysql_fetch_array(mysql_query($query));
$total_results = $total_pages['num'];

									$total_pages = $total_pages['num']/7;

									$total_pages=ceil($total_pages);

									$v=0;

									$que = "SELECT * FROM `$database`.`members` WHERE (`name` LIKE '%$searchTerm%' OR `username` LIKE '%$searchTerm%' OR `about` LIKE '%$searchTerm%'  OR `email` LIKE '%$searchTerm%'  OR `mobile` LIKE '%$searchTerm%') AND status!=2";

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

													<td width=15%>$city</td>

													<td width=10%>"
												);

											if($fb!=""){ print("<a href='$fb' rel='me' target='_blank'><img src='img/facebook.png' /></a>"); }						

											if($twitter!=""){ print("<a href='$twitter' rel='me' target='_blank'><img src='img/twitter.png' /></a>"); }					

											if($rever!=""){ print("<a href='$rever' rel='me' target='_blank'><img src='img/reverbnation.png' /></a>"); }				

											if($youtube!=""){ print("<a href='$youtube' rel='me' target='_blank'><img src='img/youtube.png' /></a>"); }						
											if($myspace!=""){ print("<a href='$myspace' rel='me' target='_blank'><img src='img/myspace.png' /></a>"); }					

											if($gplus!=""){ print("<a href='$gplus' rel='me' target='_blank'><img src='img/gplus.png' /></a>"); }
											print("</td>");

											$genre = array("Genre A", "Genre B", "Genre C", "Genre D");
											$genre_rand_num = rand(0, count($genre) - 1);
											print("<td width=15%>$genre[$genre_rand_num]</td>");

											$fee_range = array("Free", "< 10k", "10k - 30k", "30k - 1L", "> 1L");
											$fee_rand_num = rand(0, count($fee_range) - 1);
											print("<td width=10%>$fee_range[$fee_rand_num]</td>");
											print("<td width=20%>Click to book</td>");

	   print("</tr>");

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

			    // Show the page navigation, only if number of pages is more than 1.
			    if ($total_pages > 1) {
                            for($i=1;$i<=$total_pages;$i++)
							{
								if($_SESSION["pages"] == $i)
									print("<td><a href='$filepath?profile=search&pages=$i' style='background: #ffcc00; padding: 2px 12px; line-height: 30px;'>$i</a></td>");
								else
									print("<td><a href='$filepath?profile=search&pages=$i' style='padding: 2px 12px; line-height: 30px;'>$i</a></td>");
							}
			   }

                            ?>
                            </tr>
                        </table>

                </div>

            </section>

        </div>

    </div>
    <script type="text/javascript">
        $('#loading-indicator').hide();
    </script>
</body>
</html>

<!--
<div class="content"></div>
<script>
<?
/*
    // If no search term, or no genre_fliter is set, then ask the user to set them.
    if (!isset($_SESSION["book_artist_search_term"]) && !isset($_SESSION["genre_filter"])) {
	print("$('.content').load('include/select_genre.php');");
    } else {
	print("$('.content').load('include/book_artist_results.php');");
    }
*/
?>
</script>

</body>
</html>
-->
