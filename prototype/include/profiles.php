<?
ob_start();

if (!isset($_SESSION)) {
session_start();
}
if(isset($_SESSION['id'])){$_GET['id']=$_SESSION['id'];}
unset($_SESSION['id']);


include('../connect.php');
if(isset($_GET["id"]))
{

$SQLs = "SELECT * FROM `$database`.`members` WHERE link='$_GET[id]'";
$results = mysql_query($SQLs);
while ($a = mysql_fetch_assoc($results))
{
$id=$a["id"];$idaa=$id;$usernam=$a["username"];$name=$a["name"];$_SESSION['name']=$name;$email=$a["email"];
$street=$a["add"];$city=$a["city"];$state=$a["state"];$country=$a["country"];$pincode=$a["pincode"];
$mobile=$a["mobile"];
$fb=$a["fb"];$twitter=$a["twitter"];$youtube=$a["youtube"];$myspace=$a["myspace"];$rever=$a["reverbnation"];$gplus=$a["gplus"];
$display=$a["display"];$user=$a["user"];$type=$a["type"];
$job=$a["job"];$designation=$a["designation"];$organization=$a["organization"];
$artistrate=$a["artistrate"];$adminrate=$a["adminrate"];$about=$a["about"];
}
}
else
{
	header("logout.php");exit;
	}




if($about=="")
{$about="You haven't added this section till now";}	 
if($type=="Promoter"){     $users="images/promoter/$user";$usersa="../images/promoter/$user";; }
 elseif($type=="Artist"){     $users="images/artist/$user";$usersa="../images/artist/$user"; }

if(!file_exists($usersa)|| $user==""){$users="images/profile.jpg";}



 ?>
 <html>
 <head>
<link rel='stylesheet' href='css/edit.css'>
	<!-- Include the JS files -->
	<script src="js/h5f.js"></script>
	<script src="js/functions.js"></script>
 
<script type="text/JavaScript">
function show(d)
{ document.getElementById('frameprofessional').style.display="none";
	document.getElementById('frameabout').style.display="none";
	document.getElementById('framecontact').style.display="none";
	document.getElementById('framesocial').style.display="none";	
	document.getElementById(d).style.display="block";	
}
</script>
 <script type="text/javascript" src="js/csspopup.js"></script>


 </head>
 <body>
  <div id="blanket" style="display:none;    background-color:#111;
   opacity: 0.65;
   position:absolute;
   z-index: 9001;
   top:0px;
   left:0px;
   width:100%;
"></div>
	<div id="profil" style="display:none; ">
		<a href="#" onClick="popup('profil')" ><img src="images/close.png" align="right"> </a><br />
       <center><font size="3" color="#333333"><b>Upload your pic</b></font></center>
       <table width="100%"><tr><td width="50%"> <form action="update.php" method="post" enctype="multipart/form-data">
          
		<label for="upload">Upload:</label>
	
		<input
			name="file"
			id="image"
			type="file"
            size="50" />
          <br><br><br><br><br>  
            <input
			name="submit"
			id="upload"
			type="submit"
            value="Upload" />
<br><br><br>		<span class="hint" style="line-height:10px;">Valid Image File.<br>jpg, png, bmp of Max. 150KB <span class="hint-pointer">&nbsp;</span></span><br>
        
	       </form> </td></tr>
        <tr><td><br></td></tr></table>    </div>

 <div id="box" style="display:block;">

<div id="content" class="clearfix">
<? if(!isset($_GET["edit"])){ ?>		
<section id="left">
			<div id="userStats" class="clearfix">
				<div class="pic">
					<? if(!isset($_GET['id']))
                    {print("<a href='#'  onclick=popup('profil')>");}
					else {print("<a href='#'>");}
					print ("<img src='$users' width=150 height=150 />"); ?></a>
				</div>

				<div class="data">
                <? if(!isset($_GET['id']) && (isset($_SESSION['username_artist']) || isset($_SESSION['username'])))
{
 ?>
                <a href="javascript:;" onClick="loadfram();"><img src="img/edit.png"  align="right"/></a> 
<? } ?>
					<h1><? print ("$name"); ?></h1>
					<h3><? print ("$city, $state, $country"); ?></h3>
					<h4><? print ("$job "); ?><b><? print ("$designation"); ?></b> , in <a href="#"><? print ("$organization"); ?></a></h4>
					
					<div class="sep"></div>
					<ul class="numbers clearfix">
						<li>Admin Rated<strong><? print ("$adminrate"); ?></strong></li>
						<li>Artist Rated<strong><? print ("$artistrate"); ?></strong></li>
						<li class="nobrdr">Gigs<strong>4</strong></li>
					</ul>
				</div>
			</div>

			<h1>About Me:</h1>
			<div class="about" >
            <p><? print ("$about"); ?></p>
		</div>
        
        	
		
        
        
        </section>
		
		<? } 
		elseif(isset($_GET["edit"]) && (isset($_SESSION['username_artist']) || isset($_SESSION['username']))) {?>
       <section id="left"  style=" height:600px;">
			
        <div class="register">

<center>
<div id="pageContainer">
	<? if(isset($_GET['success']) && $_GET['success']==1)
	{print("Change Done Successfullly");}
	else{
		if(isset($_GET['error']) && $_GET['error']==1)
	{print("Error!!! Fields left blank");}
	elseif(isset($_GET['error']) && $_GET['error']==2)
	{print("Error!!! Username or email already exist");}
		 ?>
		<div id="signUp" class="toggleTab" style="display:block; height:1250px;">
		<div id="framemenu" ><a href="javascript:;" onClick="show('frameprofessional'); ">Professional</a>
        <a href="javascript:;" onClick="show('framesocial');">Social</a>
        <a href="javascript:;" onClick="show('framecontact');">Contact</a>
        <a href="javascript:;" onClick="show('frameabout');">About</a></div>
				<br><br><br><br><br><br><br><br><br><br><br><br>
					<div id="frameprofessional">
                    <form action="update.php" method="POST" class="cleanForm" id="signUpForm">
			
				<fieldset>
			<p>
			
            		  <label for="Select">Occupation: <span class="requiredField">*</span></label>
						<select id="select" name="job" required >
                        <option value="Studying">Student</option>
                        <option value="Works as">Work</option>
                                            
                        </select>
						<em>Occupation</em>
					</p>
                    
                    <p>
						<label for="designation">Designation: <span class="requiredField">*</span></label>
						<input type="text" id="full-name" name="designation" value="<? print($designation); ?>"  pattern="^[a-zA-Z0-9. ]{3,15}$" autofocus required />
						<em>What do you do e.g B.tech or Chairman</em>
					</p>

					<p>
						<label for="organization">Organization: <span class="requiredField">*</span></label>
						<input type="text" id="username" name="organization" pattern="^[a-zA-Z0-9/ -.]{3,20}$" value="<? print($organization); ?>" required />
						<em>Organization</em>
					</p>
                    
                    
					<div class="centera" style=" width:500px; position:relative; margin-top:20px; left:-80px;">
                    
				
					<input type="submit" value="Save Changes" />
</div>
					<div class="formExtra">
						<p><strong>Note: </strong> Fields marked with <span class="requiredField">*</span> are required.</p>
					</div>

				</fieldset>
			
			</form>
                    
					</div>
                    
                    <div id="framesocial">
				    
                <form action="update.php" method="POST" class="cleanForm" id="signUpForm">
			
				<fieldset>
				
                	<p>
						<label for="social">Facebook: <span class="requiredField">*</span></label>
						<input type="text" id="fb" name="fb" value="<? print($fb); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" required />
						<em>Social Profile link on Facebook.</em>
					</p>

					<p>
						<label for="social">Twitter: </label>
						<input type="text" id="twiter" name="twitter" value="<? print($twitter); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" />
						<em>Social Profile link on Twitter.</em>
					</p>
                    
					<p>
						<label for="social">Reverbnation:</label>
						<input type="text" id="reverbnation" name="rever" value="<? print($rever); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" />
						<em>Profile link on Reverbnation.</em>
					</p>
                    <p>
						<label for="social">Youtube:</label>
						<input type="text" id="youtube" name="youtube" value="<? print($youtube); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" />
						<em>Profile link on youtube.</em>
					</p>
                    
                    <p>
						<label for="social">MySpace:</label>
						<input type="text" id="myspace" name="myspace" value="<? print($myspace); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" />
						<em>Profile link on MySpace.</em>
					</p>
                    
                    <p>
						<label for="social">Google plus:</label>
						<input type="text" id="gplus" name="gplus" value="<? print($gplus); ?>" pattern="^[a-zA-Z0-9 ./-_]{20,50}$" />
						<em>Profile link on Google +.</em>
					</p>
				
                	<div class="centera" style=" width:500px; position:relative; margin-top:20px; left:-80px;">
                    
				
					<input type="submit" value="Save Changes" />
</div>
					<div class="formExtra">
						<p><strong>Note: </strong> Fields marked with <span class="requiredField">*</span> are required.</p>
					</div>

				</fieldset>
			
			</form>
                
                	</div>
                   
				  
                   
                    <div id="framecontact">
				 <form action="update.php" method="POST" class="cleanForm" id="signUpForm">
			
				<fieldset>
				
                	<p>
						<label for="phone">Mobile Number:</label>
						<input type="tel" id="phone" name="mobile" value="<? print($mobile); ?>" pattern="^[0-9]{10,10}$" required/>
						<em>10 digits only. E.g. 9876543210</em>
					</p>
					
                    <p>
						<label for="add">Address:</label>
						<input type="text" id="add" name="add" value="<? print($street); ?>" pattern="^[0-9a-zA-Z-,/ ]{8,50}$" required/>
						<em>House number and street</em>
					</p>
                    
                    <p>
						<label for="city">City:</label>
						<input type="text" id="city" name="city" value="<? print($city); ?>" pattern="^[a-zA-Z ]{3,15}$" required/>
						<em>Your city name. E.g. Delhi</em>
					</p>
                    <p>
						<label for="state">State:</label>
						<input type="text" id="state" name="state" value="<? print($state); ?>" pattern="^[a-zA-Z ]{3,15}$" required/>
						<em>Your State. E.g. UP</em>
					</p>
					
                    <p>
						<label for="Country">Country:</label>
						<input type="text" id="country" name="country" value="<? print($country); ?>" pattern="^[a-zA-Z ]{3,15}$" required/>
						<input type="text" id="pincode" name="pincode" value="<? print($pincode); ?>" pattern="^[0-9]{6,6}$" required/>
						<em>Your Country & PINCODE. E.g. INDIA & 110001</em>
					</p>
                
                	<div class="centera" style=" width:500px; position:relative; margin-top:20px; left:-80px;">
                    
				
					<input type="submit" value="Save Changes" />
</div>
					<div class="formExtra">
						<p><strong>Note: </strong> Fields marked with <span class="requiredField">*</span> are required.</p>
					</div>

				</fieldset>
			
			</form>
               
                    </div>
                   
				     <div id="frameabout">
				<form action="update.php" method="POST" class="cleanForm" id="signUpForm">
			
				<fieldset>
				   
                
                	<p>
						<label for="fb">About:</label>
						<textarea cols="60" rows="15"  id="about" name="about"  pattern="^[a-zA-Z0-9:/.-_?]{25,55}$"  required><? print($about); ?></textarea>
          			<em>About yourself</em>
					</p>
					<div class="centera" style=" width:500px; position:relative; margin-top:20px; left:-80px;">
                    
				
					<input type="submit" value="Save Changes" />
</div>
					<div class="formExtra">
						<p><strong>Note: </strong> Fields marked with <span class="requiredField">*</span> are required.</p>
					</div>

				</fieldset>
			
			</form>
                	</div>
			
			
				
		</div> <!-- end signUp -->
	<? } ?>
</div> <!-- end pageContainer -->
</center>
<br>

</div>
             
        
        </section> 
        
       <? } ?>



<section id="right">
			<div class="gcontent" style="margin-bottom:6px;">
				<div class="head"><h1>Contact</h1></div>
				<div class="boxy" style="height:57px;">
					

<span class="gigs" style="line-height:3em;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Mobile</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <? if(isset($_GET['id'])){$mobile= $mobile[0]."* * * * * * *";}
print ("$mobile"); ?><br /></span>
            <span class="gigs"  style=" width:55px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Email</b></span><span style="padding-left:75px; margin-top:-8px;">  <?  if(isset($_GET['id'])){$email=$email[0].$email[1]."* * * * * @ * * * *";}print ("$email"); ?></span>
            
					
				</div>
			</div>
         
         
            <div class="gcontent" style="margin-top:35px; border-top: 1px solid #ccc;">
				
				<div class="boxy">
					

					<div class="socialMediaLinks" style="text-align:center;">
<? if($fb!=""){ print("<a href='$fb' rel='me' target='_blank'><img src='img/facebook.png' /></a>"); }?>						
<? if($twitter!=""){ print("<a href='$twitter' rel='me' target='_blank'><img src='img/twitter.png' /></a>"); }?>						
<? if($rever!=""){ print("<a href='$rever' rel='me' target='_blank'><img src='img/reverbnation.png' /></a>"); }?>						
<? if($youtube!=""){ print("<a href='$youtube' rel='me' target='_blank'><img src='img/youtube.png' /></a>"); }?>						
<? if($myspace!=""){ print("<a href='$myspace' rel='me' target='_blank'><img src='img/myspace.png' /></a>"); }?>						
<? if($gplus!=""){ print("<a href='$gplus' rel='me' target='_blank'><img src='img/gplus.png' /></a>"); }?>
				</div>

					
				</div>
			</div>

			<div class="gcontent">
				<div class="head"><h1><? if($type=="promoter"){print("Previous GIGs");}else{print("Previous DIBs");} ?></h1></div>
				<div class="boxy">
					
					<div class="giglist clearfix">
						<div id="pgig" style="top:2px;">
<div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#"  style="color:#000;" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div>

<div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div>
<div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div>
<div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div><div class="gig">
			<span class="gigs" ><a href="#" >Rock Nite</a> by <a href="#" style="color:#000;"><b>Indian Ocean</b></a><br /></span>
            <span class="gigs">On 13 March 2012 At DTU, Delhi</span>
            <span class="gigs" style="color:#999; font-size:9px; line-height:3px; padding-top:10px;"></span>
</div>

          
                                   
</div>
					</div>

					
				</div>
			</div>
            
            
            
		</section>
        
        
	</div>
</div>
</body>
</html>