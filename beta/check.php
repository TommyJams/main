<?php
ob_start();

if (!isset($_SESSION)) {
session_start();
}

if(isset($_SESSION['username_artist']))
{
header("Location: logout.php");
exit;
}

else if(isset($_SESSION['username']))
{
header("Location: logout.php");
exit;
}


if (!isset($_POST['username']) || !isset($_POST['password']))
{
header("Location: index.php?error=2&set=not logged in");
exit;
}


$username=$_POST['username'];
$password=$_POST['password'];


include("connect.php");

$password=md5($password);

$q1 = "SELECT * FROM `$database`.`members` WHERE username = '{$username}' AND password = '{$password}' AND status=1";
$result_set1 = mysql_query($q1);	

if (!$result_set1)
die("Database query failed: " . mysql_error());

if (mysql_num_rows($result_set1) == 1) 
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
else
{

	header("Location: index.php?error=3&what=incorrect credential&status=$type");
		exit;
}



ob_end_flush();

?>