<?php
ob_start();

if (!isset($_SESSION)) {
session_start();
}
$username=$_SESSION["username"];

session_destroy();


header("Location:index.php");
exit;

?>