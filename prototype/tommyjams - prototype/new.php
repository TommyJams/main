<?php
ob_start();

if (!isset($_SESSION)) {
session_start();
}
$email=$_POST["email"];
$username=$_POST["username"];
$password=$_POST["password"];
$you=$_POST["you"];
$name=$_POST["name"];
$mobile=$_POST["phone"];
$fb=$_POST["facebook"];
$city=$_POST["city"];
$state=$_POST["state"];
$address=$_POST["add"];
if(!isset($_POST["email"]) || !isset($_POST["you"]) || !isset($_POST["username"]) || !isset($_POST["password"]))
{
header("Location: signup.php?include=signup&error=1");
exit;
}
 
include("connect.php");
//**********************************************************
$query = "SELECT * FROM `$database`.`members` WHERE fb_id='$username' OR email = '$email'";
$result_check = mysql_query($query);
$checka = mysql_num_rows($result_check);
if($checka>=1)
{
	header("Location: signup.php?include=signup&error=2");
	exit;
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
$query = "INSERT INTO `$database`.`members` (`id`, `type`, `name`, `username`, `password`, `email`, `mobile`, `add`, `city`, `state`, `fb`, `status`, `link`, `ip`, `time`) 
VALUES (NULL, '$you', '$name', '$username', '$password', '$email', '$mobile', '$address', '$city', '$state', '$fb', '3', '$ida', '$ip', CURRENT_TIMESTAMP)";
$active=$link;
$ress = mysql_query($query);
if (!$ress)
{die("Database query failed: " . mysql_error());}
//*****************************
else{
	include("confirm.php");
	$password=md5($password);
$query = "INSERT INTO `$database`.`wp_blogusers` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`) VALUES (NULL, '$username', '$password', '$username', '$email', '', '0000-00-00 00:00:00', '', '0', '$name');";
$ress = mysql_query($query);
if (!$ress){die("Database query failed: " . mysql_error());}

	header("Location: signup.php?include=signup&success=1");
	exit;}



?>

