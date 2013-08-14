<!-- -------------------------------------------------------------- -->
<!-- Header		 											   	    -->
<!-- -------------------------------------------------------------- -->
<div id="headerBox" class="box">
	<div class="boxTop">
		<ul id="tabMenu">
		<!--
		  <li class="posts selected"></li>
		  <li class="comments"></li>
		  <li class="category"></li>
		  <li class="famous"></li>
		  <li class="random"></li>
		-->
		  <li class="blog" title="Blog" alt="Blog"></li>
		  <li class="search" title="Search" alt="Search"></li>
		  <li class="login" title="Login" alt="Login"></li>
		</ul>
	</div>

	<div class="boxBody">

		<div id="blogBox" class="parent">
			<div id="enclosingBlogButton">
				<a href="http://www.tommyjams.com/blog/" target="_blank">Blog</a>
			</div>
		</div>

		<div id="searchBox" class="parent">
		<?php
			//Need to redirect to logged_in_page?profile=search or index.php?profile=search from any other page.
			$url = $_SERVER['PHP_SELF'];
			$parts = parse_url($url);
			$filepath = explode('/',$parts['path']);
			$filepath = end($filepath);
			if($filepath!="index.php" && $filepath!="artist.php" && $filepath!="promoter.php")
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
			print(" <form action='$filepath?profile=search' method='post'>
						<input type='text1' name='profile' value='Search Profiles' id='searchTextBox' onfocus='blank(this)' onblur='unblank(this)'  />
						<input type='submit' value='Go'>
					</form>
				");
		?>
		</div>

		<div id="loginBox" class="parent">
			<div id="enclosingLoginButton">
			<!-- <table id = "loginTable">
				<tr>
					<td>
						<div class="menu" id="signupmenu">
							<a href="fbconnect.php?what=1">
								<div style="height:25px; font-size:0px; width:90px;  cursor:pointer; background:url(images/fbpro.png) no-repeat;" onClick="fbstuff('Promoter')">
								Promoter
								</div>
							</a>
						</div>
					</td>    
					<td>
						<div class="menu" id="signupmenu">
							<a href="fbconnect.php?what=2">
								<div style="height:25px;  font-size:0px; width:70px; cursor:pointer; background:url(images/fbart.png) no-repeat;" onClick="fbstuff('Artist')">
								Artist
								</div>
							</a>
						</div>
					</td>
				</tr>
			</table> -->
			<!-- Code for the new Facebook Login widget
			<div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1"></div>
			-->
			<?
			if(isset($_SESSION["username"]) || isset($_SESSION["username_artist"])) {
				print( "<a class='loginWidgetRef' href='logout.php'>
							<img src='images/icons/fb_logout.jpg'/>
						</a>");
			}
			else {
				/*old facebook login system
				<table>
					<tr>
						<td>
							<a class='loginWidgetRef' href='fbconnect.php?what=2'>
								<table>
									<tr>
									<td><img src='images/icons/facebook_icon_small.png'></img></td>
									<td style='background:#ffcc00;'><h3>Login</h3></td>
									</tr>
								</table>
							</a>
						</td>
					</tr>
					<tr><td><hr></td></tr>
					<tr>
						<td>
							<form id='radioButton'>
							<input name='group1' type='radio' value='artist' checked onClick='radioClicked(2)'/> Artist<br>
							<input name='group1' type='radio' value='promoter' onClick='radioClicked(1)'/> Promoter<br>
							<input name='group1' type='radio' value='venue' onClick='radioClicked(1)'/> Venue
							</form>
						</td>
					</tr>
					<tr>
						<td>
							<a class='loginWidgetRef' href='fbconnect.php?what=2'>
								<table>
									<tr>
									<td><img src='images/icons/facebook_icon_small.png'></img></td>
									<td style='background:#ffcc00;'><h3>Register</h3></td>
									</tr>
								</table>
							</a>
						</td>
					</tr>
				</table>*/
				print("<div class='fb-login-button' size='large' onlogin=facebookLoginCallback(); registration-url='http://www.tommyjams.com/prototype/fbconnect.php?registered=no'>
				</div>");
			}
			?>
			</div> <!--enclosingLoginButton-->
		</div>	<!--loginBox-->
	</div> <!--boxBody-->

	<!-- <div class="boxBottom"></div> -->
</div> <!--headerBox-->

<div class="right-advertisement-container" style="float:right; margin-right:5%; margin-top:10%">
    <div class="right-advertisement-carousel">
								<li>
									<h4>Above & Beyond</h4>
									<div>
										<a href="http://www.tommyjams.com/blog/above-beyond-bringing-tatw450-to-india" class="preloader overlay-image" rel="gallery-1">
											<img src="image/_sample/tatw450.jpg" alt="" />
											<span></span>
										</a>
										<p>Bangalore</p>
									</div>
								</li>

								<li>
									<h4>NH7 Weekender</h4>
									<div>
										<a href="image/_sample/weekender.jpg" class="preloader overlay-image fancybox-image" rel="gallery-1">
											<img src="image/_sample/weekender.jpg" alt="" />
											<span></span>
										</a>
										<p>Delhi, Pune & Bangalore</p>
									</div>
								</li>

								<li>
									<h4>Sunburn</h4>
									<div>
										<a href="image/_sample/sunburn.jpg" class="preloader overlay-image fancybox-image" rel="gallery-1">
											<img src="image/_sample/sunburn.jpg" alt="" />
											<span></span>
										</a>
										<p>Delhi, Bangalore and Goa</p>
									</div>
								</li>

								<li>
									<h4>Swedish House Mafia</h4>
									<div>
										<a href="http://www.tommyjams.com/blog/swedish-house-mafia-one-last-tour/" class="preloader overlay-image" rel="gallery-1">
											<img src="image/_sample/swedishhousemafia.jpg" alt="" />
											<span></span>
										</a>
										<p>Delhi and Mumbai</p>
									</div>
								</li>

								<li>
									<h4>Shaa'ir and Func</h4>
									<div>
										<a href="http://www.youtube.com/embed/r-aer2QFybc" class="preloader overlay-video fancybox-video-youtube">
											<img src="image/_sample/shaairnfunc.jpg" alt="" />
											<span></span>
										</a>
										<p>Electronic Music Duo</p>
									</div>
								</li>

								<li>
									<h4>OctoberFest 2012</h4>
									<div>
										<a href="image/_sample/octoberfest.jpg" class="preloader overlay-image fancybox-image" rel="gallery-1">
											<img src="image/_sample/octoberfest.jpg" alt="" />
											<span></span>
										</a>
										<p>Bangalore, Hyderabad</p>
									</div>
								</li>
    </div>
</div>
<div style="clear:both"></div>

<!-- -------------------------------------------------------------- -->
<!-- Right Sidebar 											   	    -->
<!-- -------------------------------------------------------------- -->
<div id="rightSidebarSmall">
    <!--<img src="images/icons/sidebar/icon_left_arrow.png">-->
</div>

<div id="rightSidebarBox">
    <ul>
        <li><a href="http://twitter.com/TommyJams" target="_blank" class="social-media-twitter"></a></li>
		<li><a href="http://www.facebook.com/tommyjams.live" target="_blank" class="social-media-facebook"></a></li>
		<li><a href="http://plus.google.com/117792283320356907836" target="_blank" class="social-media-googleplus"></a></li>
    </ul>
</div>

<div id="copyrightContainer">
	<p>Copyright 2013 - All Rights Reserved</p>
</div>
