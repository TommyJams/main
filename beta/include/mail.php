<?php
ini_set("SMTP","ssl://smtp.gmail.com" ); 
ini_set('sendmail_from', 'testpromoter.tommy@gmail.com');
ini_set('smtp_port', '587');

$message = "
<html>
<head>
<title>$subject</title>
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
			<font color=white size=2>To unsubscribe <a href='update.php?un=true'>click here
		</tr>-->
	</table>
</div>
</body>
</html>
";

    require_once("../plugin/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = 'testpromoter.tommy@gmail.com';
	$mail->Password = '1tommyblah';           
	//$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
    console.log('$error');

/*
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
$headers .= 'From: tommyjams.official@gmail.com' . "\r\n";

mail($to,$subject,$message,$headers);*/
?>