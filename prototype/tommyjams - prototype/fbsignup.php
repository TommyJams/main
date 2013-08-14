<?php
ob_start();

if (!isset($_SESSION)) {
session_start();
}
$email=$_GET["Email"];
$username=$_GET["Username"];
$password=rand(111111,9999999);
$name=$_GET["Name"];
$city=$_GET["City"];
$you=$_GET["You"];
$fb=$_GET["fb"];
$about=$_GET["AboutMe"];


$fbid=$_GET["User_id"];
if(!isset($_GET["Email"]) || !isset($_GET["AboutMe"]) || !isset($_GET["fb"]) || !isset($_GET["Username"]) || !isset($_GET["User_id"]))
{
header("Location: index.php?include=signup&error=1");
exit;
}
 
include("connect.php");
//**********************************************************
$q1 = "SELECT * FROM `$database`.`members` WHERE username = '{$username}' AND email = '{$email}' AND status=1 AND fb_id='$fbid'";
$result_set1 = mysql_query($q1);	

if (!$result_set1)
die("Database query failed: " . mysql_error());

if (mysql_num_rows($result_set1) >= 1) 
{
 
			  
		$found_admin = mysql_fetch_array($result_set1);
		$type=$found_admin["type"];
		$name=$found_admin["name"];
		if($type=="Promoter")
		{
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		{		header("Location: promoter.php?success=1");
		exit;}
		}
		elseif($type=="Artist")
		{
		$_SESSION['username_artist'] = $username;
		$_SESSION['password_artist'] = $password;
		{
		header("Location: artist.php?success=1");exit;
		}
		}

}

$SQLs = "SELECT id FROM `$database`.`members`";
$results = mysql_query($SQLs);
while ($a = mysql_fetch_assoc($results))
{$id=$a["id"];
}$id=$id+1;

//**********************************************************
//**************************
$ida=$id*15993;
$link="$ida";
$ip=$_SERVER['REMOTE_ADDR'];
$password=md5($password);
$query = "INSERT INTO `$database`.`members` (`id`, `type`, `name`, `username`, `password`, `email`, `fb_id`, `city`, `about`, `fb`, `status`, `link`, `ip`, `time`) 
VALUES (NULL, '$you', '$name', '$username', '$password', '$email', '$fbid', '$city', '$about', '$fb', '1', '$ida',  '$ip', CURRENT_TIMESTAMP)";
$active=$link;
$ress = mysql_query($query);
if (!$ress)
{die("Database query failed: " . mysql_error());}
//*****************************
else{
	$url="http://depth.co.in/shop/".$type."php?id=".$ida;
	$password=md5($password);
$query = "INSERT INTO `$database`.`wp_blogusers` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (NULL, '$ida', '$password', '$username', '$email', '$url', '0000-00-00 00:00:00', '', '0', '$name');";
$ress = mysql_query($query);
if (!$ress){die("Database query failed: " . mysql_error());}
	
	include("confirm.php"); 
	print("<center>
    <br><br>You are successfully regestered<br><br><br><table border=0>
    <tr><td width=150>Name</td><td>$name</td></tr>
    <tr><td>User</td><td>$you</td></tr>
    <tr><td>Email</td><td>$email</td></tr>
    <tr><td>City</td><td>$city</td></tr>
    <tr><td>Facebook</td><td>$fb</td></tr>
    </table><br><br><br>
	<br><br>You are successfully regestered For our <b>BLOG</b> with nickname - $name<br><br><br>
	<a href='fbconnect.php' style='width:120px; height:20px; background:#F0E68C;'>Continue</a></center>
	
    ");
    }



?>

