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

if(isset($_GET['id'])) {

    $_SESSION['id']=$_GET['id'];
    
}

include('connect.php');

$SQLs = "SELECT * FROM `$database`.`members` WHERE fb_id='$username'";

$results = mysql_query($SQLs);

while ($a = mysql_fetch_assoc($results))

{

    $id=$a["id"];$idaa=$id;$usernam=$a["username"];$name=$a["name"];$_SESSION['name']=$name;$email=$a["email"];

    $street=$a["add"];$city=$a["city"];$state=$a["state"];$country=$a["country"];$pincode=$a["pincode"];

    $mobile=$a["mobile"];

    $fb=$a["fb"];$twitter=$a["twitter"];$youtube=$a["youtube"];$myspace=$a["myspace"];$rever=$a["reverbnation"];$gplus=$a["gplus"];

    $display=$a["display"];$user=$a["user"];$type=$a["type"];

    $job=$a["job"];$designation=$a["designation"];

    $artistrate=$a["artistrate"];$adminrate=$a["adminrate"];

}
	 

if($type=="Promoter") {

    $users="images/promoter/$user";
    
}

elseif($type=="Artist") {

    $users="images/artist/$user"; 

}

if(!file_exists($users) && $user=="") {

    $users="images/profile.jpg";
    
}

else if(!file_exists($users) && $user!="") {

    $users="https://graph.facebook.com/"."$user/picture&type=large";
    
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>TommyJams</title>

    <link href="css/profile.css" rel="stylesheet" type="text/css" />

    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <link href="css/styler.css" rel="stylesheet" type="text/css" />

    <link href="css/supersized/supersized.css" rel="stylesheet" type="text/css" />

	<link href="css/style_footer.css" rel="stylesheet" type="text/css" />
    
    <link href="http://fonts.googleapis.com/css?family=Voces" rel="stylesheet" type="text/css" />
	
	<link href="http://fonts.googleapis.com/css?family=Dosis:300,400" rel="stylesheet" type="text/css" />
    <script src="js/motionpack.js"></script>

    <!--
    <script type="text/javascript" src="http://i3indya.com/js/jquery.aviaSlider.js"></script>

    <script type="text/javascript" src="http://i3indya.com/js/aviaInit.js"></script>

    <style type="text/css">

        #pscroller2{

            width: 800px;

            height: 15px;

        }



        #pscroller2 a{

            text-decoration: none;

        }

        .someclass{ //class to apply to your scroller(s) if desired

        }

    </style>
    -->

    <script type="text/javascript" src="js/jquery.min.js" ></script>

    <script type="text/javascript" src="js/jquery.supersized.min.js"></script>

   <script type="text/javascript" src="../../script/jquery.carouFredSel.packed.js"></script> 
    <script type="text/javascript" src="js/main.js"></script> <!--contains document ready function-->

	<script type="text/javascript" src="js/h5f.js"></script>

	<script type="text/javascript" src="js/functions.js"></script>

	<script type="text/javascript" src="js/csspopup.js"></script>

    <script language="javascript"> 

function loadblog(a) 

{

	/*document.getElementById('lefty').style.display="none";

	document.getElementById('lefty1').style.display="block";

	link = 'include/blog/wp-login.php';

	parent.leftframe.location.href=link; */

} 

</script>

<!--
<script language="javascript"> 

	link = a+".php?include="+a; 

    parent.leftframe.location.href=link; 

</script>
-->

<script>

    function loadframe(a) 

    { 
        
		$("#loading-indicator").show();

        if(a=="left"){ $("#lefty").load("include/profile.php");}

        else if(a=="gigs"){  $("#lefty").load("include/promoter_gigs.php");}

        else if(a=="add"){ $("#lefty").load("include/gig.php");}
		
		else if(a.substring(0,9)=="updategig"){
			
			$("#lefty").load("include/gig.php?"+a);
		
		}

		/*else if(a=="dib"){ $("#lefty").load("include/dib.php");}*/

    }

    function loadfram(a) 

    {

		$("#loading-indicator").show();

        $("#lefty").load("include/profile.php?edit=1");

    }

	function showProfile(a)
    
	{
	
		$("#loading-indicator").show();

		$("#lefty").load("include/profile.php?id="+a);

	}

    function gig(a) 

    {
		
		$("#loading-indicator").show();
        
		$("#lefty").load("include/gigs.php?gig="+a);

    }

</script>

</head>



<body>

    <?
	include("include/leftCommon.php");
	?>

	<div id="main-container">

        <!--
        <div id="header">

            <div class="logo"><a href="index.php"><img src="images/logo.png" width="205" height="34" /></a></div>
            
            <div id="headerTabsContainer">

                <div class="menu"><a href="#">Artists</a></div>
                <div class="menu"><a href="javascript:;" onClick="loadframe('left');">Profile</a></div>
                <div class="menu"><a  href="javascript:;" onClick="loadframe('gigs');">My Gigs </a></div>
                <div class="menu"><a  href="javascript:;" onClick="loadframe('add');">Launch</a></div>

                <div id="loginContainer">
                    <div class="menu" id="signmenu">
                        <a  href="javascript:;" onClick="loadframe('left');"><?/* print ("Welcome $name !"); */?></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="javascript:;" onClick="loadfram();">Edit Profile</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="logout.php">Log Out</a>
                    </div>
                </div>

            </div>

            <div id="menu_search" >
                <form action="promoter.php?profile=search" method="post">
                    <input type="text1" name="profile" value="Profile" id="search"   onfocus="blank(this)" onblur="unblank(this)"  />
                </form>
            </div>

        </div> footer-->

        <div id="lefty">
        </div>

        <div id="lefty1" style="display:none;  overflow-y:hidden;">

            <iframe name="leftframe" id="leftframe1" width="100%" height="100%" frameborder="0"></iframe>

        </div>

        <script>

        <?
            if(isset($_GET["profile"]) && $_GET["profile"]=="search")

            { 

                if(isset($_GET["pages"])){$_SESSION["pages"]=$_GET["pages"];}

                else{$_SESSION["pages"]=1;}

                if(isset($_POST["profile"])){$_SESSION["profile"]=$_POST["profile"];}

                print("$('#lefty').load('include/profile_search.php?page=$_SESSION[pages]');");

            }

            else if(isset($_GET["feed"])){ print("$('#lefty').load('include/feed.php?feed=$_GET[feed]');");}

            else if(isset($_GET["thank"])){ print("$('#lefty').load('include/thank.php?rate=1');");}

            else{ 

                if(!isset($_GET["id"]) && !isset($_GET["gig"])){ print("$('#lefty').load('include/profile.php');");}

                else if(isset($_GET["id"])){ print("$('#lefty').load('include/profile.php?id=$_GET[id]');");}

                else if(isset($_GET["gig"]) && isset($_GET["added"])){ print("$('#lefty').load('include/gigs.php?gig=$_GET[gig]&added=new');");}
				
				else if(isset($_GET["gig"]) && isset($_GET["edited"])){ print("$('#lefty').load('include/gigs.php?gig=$_GET[gig]&edited=new');");}

                else if(isset($_GET["gig"])){ print("$('#lefty').load('include/gigs.php?gig=$_GET[gig]');");}

            }
        ?>

        </script>
		
		<!-- start menu -->
      <div id="menuFooter" style="background:#000;">
        <ul>
          <li>
            <a  href="javascript:;" onClick="loadframe('add');"><h3>Launch Gig</h3></a>
          </li>
          <li>
            <a  href="javascript:;" onClick="loadframe('gigs');"><h3>My Gigs</h3></a>
          </li>
          <li>
            <a href="javascript:;" onClick="loadframe('left');"><h3>Profile</h3></a>
          </li>
          <li>
            <a href="javascript:;" onClick="loadfram();"><h3>Edit Profile</h3></a>
          </li>
        </ul>
      </div>
      <!-- end menu --> 
	  
		<!--
        <table id = "footerTable">
            <tr>
                <td>
                    <a  href="javascript:;" onClick="loadframe('add');">
                        <img style="height:60px; margin-right:20px;"
                             src="images/icons/footer_add.png"
                             onmouseover="this.src = 'images/icons/footer_add_yellow.png';"
                             onmouseout="this.src = 'images/icons/footer_add.png';"
                             alt="Launch Gig"
                             title="Launch Gig"
                        /> <!--Launch Gig
                    </a>
                </td>
                <td>
                    <a  href="javascript:;" onClick="loadframe('gigs');">
                        <img style="height:60px; margin-right:20px;"
                             src="images/icons/footer_mic.png"
                             onmouseover="this.src = 'images/icons/footer_mic_yellow.png';"
                             onmouseout="this.src = 'images/icons/footer_mic.png';"
                             alt="My Gigs"
                             title="My Gigs"
                        /> <!--My Gigs
                    </a>
                </td>
                <td>
                    <a href="javascript:;" onClick="loadframe('left');">
                        <img style="height:60px; margin-right:20px;"
                             src="images/icons/footer_user.png"
                             onmouseover="this.src = 'images/icons/footer_user_yellow.png';"
                             onmouseout="this.src = 'images/icons/footer_user.png';"
                             alt="Profile"
                             title="Profile"
                        /> <!--Profile
                    </a>
                </td>
                <td>
                    <a href="javascript:;" onClick="loadfram();">
                        <img style="height:60px; margin-right:20px;"
                             src="images/icons/footer_useredit.png"
                             onmouseover="this.src = 'images/icons/footer_useredit_yellow.png';"
                             onmouseout="this.src = 'images/icons/footer_useredit.png';"
                             alt="Edit Profile"
                             title="Edit Profile"
                        /> <!--Edit Profile
                    </a>
                </td>
            </tr>
        </table>
		-->
        
        </div>

    </div> <!--main-container-->

    <?
	include("include/rightCommon.php");
	?>

</body>

</html>

<?

ob_end_flush();

?>
