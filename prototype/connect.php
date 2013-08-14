<?php
mysql_close(mysql_connect("localhost","tommyjam_shop","akash1"));
$connection = mysql_connect("localhost","tommyjam_shop","akash1");
if (!$connection) {
	die("Database connection failed: " . mysql_error());
}

$database = "tommyjam_test";


$db_select = mysql_select_db($database,$connection);
if(!$db_select)
{
die("database selection failed".mysql_error());
}


