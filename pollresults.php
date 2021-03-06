<?
	include('beta/connect.php');
	$currentGig = "1784265";

	if($_GET['gig'])
	{
		$currentGig = $_GET['gig'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>

		<title>TommyJams - Dedication Results</title>
		<meta name="fragment" content="!"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<meta property="og:title" content="TommyJams: Winning Song!" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="http://tommyjams.com/image/icon/tjtrophy_small.jpg"/>
		<meta property="og:url" content="http://tommyjams.com/" />
		<meta property="og:site_name" content="TommyJams" />
		<meta property="og:description" content="See your dedications being featured" />
		<meta property="fb:app_id" content="566516890030362" />
		
		<link rel="stylesheet" type="text/css" href="style/jquery.qtip.css"/>
		<link rel="stylesheet" type="text/css" href="style/jquery-ui/jquery-ui.css"/>
		<link rel="stylesheet" type="text/css" href="style/supersized/supersized.css"/>
		<link rel="stylesheet" type="text/css" href="style/base.css"/> 
		<link rel="stylesheet" type="text/css" href="style/poll.css"/> 
		
		<link rel="stylesheet" type="text/css" media="screen and (max-width:969px)" href="style/responsive/width-0-969.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (max-width:767px)" href="style/responsive/width-0-767.css"/>
		
		<link rel="stylesheet" type="text/css" media="screen and (min-width:480px) and (max-width:969px)" href="style/responsive/width-480-969.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (min-width:768px) and (max-width:969px)" href="style/responsive/width-768-969.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (min-width:480px) and (max-width:767px)" href="style/responsive/width-480-767.css"/>
		<link rel="stylesheet" type="text/css" media="screen and (max-width:479px)" href="style/responsive/width-0-479.css"/>
		
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Voces"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Dosis:400,700" />

		<script type="text/javascript" src="script/linkify.js"></script>
		<script type="text/javascript" src="script/jquery.min.js"></script>
		<script type="text/javascript" src="script/jquery-ui.min.js"></script>
		<script type="text/javascript" src="script/jquery.easing.js"></script>
		<script type="text/javascript" src="script/jquery.blockUI.js"></script>
		<script type="text/javascript" src="script/jquery.qtip.min.js"></script>
		<script type="text/javascript" src="script/jquery.supersized.min.js"></script>
		<script type="text/javascript" src="script/jquery.elastic.source.js"></script>
		<script type="text/javascript" src="script/jquery.infieldlabel.min.js"></script>
		<script type="text/javascript" src="script/jquery.scrollTo.min.js"></script>
		
		<script type="text/javascript" src="script/script.js"></script>
		<script type="text/javascript" src="script/poll.js"></script>
        <script type="text/javascript" src="plugin/voting-form/voting-form.js"></script>
		<script type="text/javascript">
          var _gaq = _gaq || [];
		  var pluginUrl = '//www.google-analytics.com/plugins/ga/inpage_linkid.js'; 
		  _gaq.push(['_require', 'inpage_linkid', pluginUrl]);
          _gaq.push(['_setAccount', 'UA-34924795-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
		<script>
			$(function() {
			$( "#voting-form-buttonset" ).buttonset();
			});
		</script>
	</head>
 
	<body>
		
		<div id="fb-root"></div>
		
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		
		<!-- -------------------------------------------------------------- -->
		<!-- Left Sidebar 											   	    -->
		<!-- -------------------------------------------------------------- -->
		<!--<div id="leftSidebarSmall">
			<img src="images/icons/sidebar/icon_right_arrow.png">
		</div>

		<div id="leftSidebarBox">
			<ul>
				<li><a href="beta/aboutus.php" 	target="_blank" title="About Us" 		alt="About Us"><img src="beta/images/icons/sidebar/about_1.png"/></a></li>
				<li><a href="beta/terms.php" 	target="_blank" title="Terms of Use" 	alt="Terms of Use"><img src="beta/images/icons/sidebar/terms_1.png"/></a></li>
				<li><a href="beta/careers.php" 	target="_blank" title="Careers" 		alt="Careers"><img src="beta/images/icons/sidebar/careers_1.png"/></a></li>
				<li><a href="beta/press.php" 	target="_blank" title="Press" 			alt="Press"><img src="beta/images/icons/sidebar/press_1.png"/></a></li>
				<li><a href="beta/advertise.php" target="_blank" title="Advertise" 		alt="Advertise"><img src="beta/images/icons/sidebar/advertise_1.png"/></a></li>
				<li><a href="beta/help.php" 	target="_blank" title="Help" 			alt="Help"><img src="beta/images/icons/sidebar/help_1.png"/></a></li>
			</ul>
		</div>
		-->

		<!-- -------------------------------------------------------------- -->
		<!-- Main Body	 											   	    -->
		<!-- -------------------------------------------------------------- -->

		<div class="main main-body">
		
			<!-- Content -->
			<div class="content clear-fix">
				
				<ul class="no-list clear-fix section-list">
					
					<!-- Main -->
					<li class="text-center clear-fix">
												
						<!-- Logo -->
                        <a href="http://www.tommyjams.com" target="_blank"><img src="image/icon/tjlogo_small.png" alt="" style="margin: 0 auto; width:158px; max-width:50%;"/></a>

						<p class="subtitle-paragraph margin-top-20 margin-bottom-20 clear-fix">
                            <span class = "bold">
								<?
									$SQLs = "SELECT DISTINCT gig_name FROM `$database`.`songpoll` WHERE gig_id='".$currentGig."'";
									$results = mysql_query($SQLs);

									while ($a = mysql_fetch_assoc($results))
									{
										$gigName=$a["gig_name"];
									}

									print("$gigName");
								?>
                            </span>
                        </p>

						<!-- Voting form -->
						<form name="voting-form" id="voting-form" action="" method="post" class="clear-fix">

							<div class="clear-fix">

								<p class="subtitle-paragraph margin-top-20 margin-bottom-20 clear-fix">

									<?
										$SQLs = "SELECT song_id, song_name, orig_artist, votes, dedication FROM `$database`.`songpoll` WHERE gig_id='".$currentGig."' ORDER BY votes DESC, song_id ASC";
										$results = mysql_query($SQLs);

										while ($a = mysql_fetch_assoc($results))
										{
											$votes=$a["votes"];
											if($votes)
											{
												$songID=$a["song_id"]; 
												$songName=$a["song_name"];
												$origArtist=$a["orig_artist"];
												$dedication=nl2br($a["dedication"]);
												
												print("<span class = 'bold'>".$songName." by ".$origArtist."</span>".$dedication."<br><br>");
											}
										}
									?>
									
								</p>

							</div>
							
						</form>
						<!-- /Voting form -->

					</li>

					<div  class="footer text-center clear-fix">
						<p>Copyright 2013 - All Rights Reserved</p>
					</div>

				</ul>

			</div>
			<!-- /Content -->
			
			

		</div>
			
		<!-- Background overlay -->
		<div id="background-overlay"></div>
		<!-- /Background overlay -->

	</body>
</html>