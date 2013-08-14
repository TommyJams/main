<?php
$to = $email;
$subject = "Account Activation mail";
$mess="Dear User,<br><br>Acctivate your account, <a href='http://depth.co.in/shop/update.php?link=activation&activate=$link'>click here</a>.<br><br>IP : $ip";
$message = "
<html>
<head>
<title>$sub</title>
</head>
<body>
$mess<br><br><br><br><br>
<center><font color=blue size=2>To unsubscribe <a href='update.php?un=$un'>click here</center>
</body>
</html>
";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
$headers .= 'From: iamakash@akash.com' . "\r\n";

mail($to,$subject,$message,$headers);
?>