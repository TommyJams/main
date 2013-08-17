<?php

require("../../plugin/phpmailer/class.phpmailer.php");
$mailer = new PHPMailer();
$mailer->IsSMTP();
$mailer->Host = 'ssl://smtp.live.com';
$mailer->Port = 587; //can be 587
$mailer->SMTPAuth = TRUE;
// Change this to your gmail address
$mailer->Username = 'tommyjams.bizspark@outlook.com';  
// Change this to your gmail password
$mailer->Password = '1tommyblah';  
// Change this to your gmail address
$mailer->From = 'admin@tommyjams.com';  
// This will reflect as from name in the email to be sent
$mailer->FromName = 'TommyJams Admin'; 
$mailer->Body = "<html>
<head>
<title>$sub</title>
</head>
<body>
<div style='background:#000; padding:10px;'>
	<table style='text-align:center; width: 100%; padding:50px; padding-top:20px;'>
		<tr style='margin-top:20px;'>
			<img src='http://www.tommyjams.com/beta/images/tjlogo_small.png'>
		</tr>
		<tr style='margin-top:50px; background:#ffcc00; padding:10px;'>
			$mess
		</tr>
		<!--<tr>
			<font color=white size=2>To unsubscribe <a href='update.php?un=$un'>click here
		</tr>-->
	</table>
</div>
</body>
</html>";
$mailer->Subject = $subject;
// This is where you want your email to be sent
$mailer->AddAddress($to);  
if(!$mailer->Send())
{
    echo "Message was not sent<br/ >";
    echo "Mailer Error: " . $mailer->ErrorInfo;
}
else
{
    echo "Message has been sent";
}

/*
$message = "
<html>
<head>
<title>$sub</title>
</head>
<body>
<div style='background:#000; padding:10px;'>
	<table style='text-align:center; width: 100%; padding:50px; padding-top:20px;'>
		<tr style='margin-top:20px;'>
			<img src='http://www.tommyjams.com/beta/images/tjlogo_small.png'>
		</tr>
		<tr style='margin-top:50px; background:#ffcc00; padding:10px;'>
			$mess
		</tr>
		<!--<tr>
			<font color=white size=2>To unsubscribe <a href='update.php?un=$un'>click here
		</tr>-->
	</table>
</div>
</body>
</html>
";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
$headers .= 'From: admin@tommyjams.com' . "\r\n";

mail($to,$subject,$message,$headers); */
?>