<?php

	/**************************************************************************/
	/**************************************************************************/

	require_once('config.php');
	require_once('../../include/functions.php');
	require_once('../../beta/connect.php');

	/**************************************************************************/
	
	$response=array('error'=>0,'info'=>null);

	$values=array
	(
		'voting-form-dedication'=> $_POST['voting-form-dedication'],
		'voting-form-name'		=> $_POST['voting-form-name'],
		'voting-form-email'		=> $_POST['voting-form-email'],
		'voting-form-song'		=> $_POST['voting-form-song']
	);
	
	if(isGPC()) $values=array_map('stripslashes',$values);
	
	/**************************************************************************/
	
	if(!validateEmail($values['voting-form-email']))
	{
 		$response['error']=1;	
		$response['info'][]=array('fieldId'=>'voting-form-email','message'=>VOTING_FORM_MSG_INVALID_DATA_MAIL);
		createResponse($response);
	}
	
	$SQLs = "SELECT * FROM `$database`.`songpoll` WHERE song_id=".$values['voting-form-song'];
	$results = mysql_query($SQLs);
	while ($a = mysql_fetch_assoc($results))
	{
		$songName=$a["song_name"];
		$origArtist=$a["orig_artist"];
		$gigID=$a["gig_id"];
		$gigName=$a["gig_name"];
		$dedication=$a["dedication"];
		$votes=$a["votes"];
	}

	// Prepare dedication to be appended.
	if($values['voting-form-dedication'] || $values['voting-form-name'])
		$dedication .= "\n".$values['voting-form-dedication']."\nBy ".$values['voting-form-name']."\n";

	//Check for duplicate votes
	$preExists = 0;
	$SQLs = "SELECT * FROM `$database`.`songfans` WHERE song_id='".$values['voting-form-song']."' AND gig_id='".$gigID."' AND email='".$values['voting-form-email']."'";
	$results = mysql_query($SQLs);
	$a = mysql_fetch_assoc($results);
	if($a)
		$preExists = 1;
	else
		$votes += 1;

	//Increment votes and dedication field for the song
	$SQLu = "UPDATE `$database`.`songpoll` SET votes=".$votes.", dedication='".$dedication."' WHERE song_id=".$values['voting-form-song'];
	$resultu = mysql_query($SQLu);
	if(!$resultu)
	{
		$response['error']=1;
		$response['info'][]=array('fieldId'=>'voting-form-send','message'=>VOTING_FORM_MSG_DATABASE_FAILURE);
		createResponse($response);
	}
	
	//Add the new id into fan database
	if($preExists == 0)
	{
		$SQLi = "INSERT INTO `$database`.`songfans` (`name`,`email`,`dedication`,`gig_id`,`song_id`) VALUES('".$values['voting-form-name']."','".$values['voting-form-email']."','".$values['voting-form-dedication']."','".$gigID."','".$values['voting-form-song']."')";
		$resulti = mysql_query($SQLi);
		if(!$resulti)
		{
			$response['error']=1;
			$response['info'][]=array('fieldId'=>'voting-form-send','message'=>VOTING_FORM_MSG_DATABASE_INSERT_FAILURE);
			createResponse($response);
		}
	}
	

	/************* This code is for MailChimp Integration ****************/
	require_once('../newsletter-form/MCAPI.class.php');

	// API Key: http://admin.mailchimp.com/account/api/
	$api = new MCAPI('4b1d3dfd9a40c3a47861fa481d644505-us5');

	// List's Id: http://admin.mailchimp.com/lists/
	$list_id = "a29827c7a6";

	// Email to be subscribed
	$email = $values['voting-form-email'];
	// List Parameters
	$email_type = 'html';
	$double_optin=true;
	$update_existing=false;
	$replace_interests=true;
	$send_welcome=true;
	$listType='Fan';
	$merge_vars = array('NAME'=>$values['voting-form-name'],
						'GROUPINGS'=>array(
							array('name'=>'User Type', 'groups'=>$listType)
							)
						);

	if($api->listSubscribe($list_id, $email, $merge_vars, $email_type, $double_optin, $update_existing, $replace_interests, $send_welcome) === false)
	{
		//'Error: ' . $api->errorMessage;
		/*$response['error']=1;
		$response['info'][]=array('fieldId'=>'voting-form-send','message'=>VOTING_FORM_MSG_API_FAILURE);
		createResponse($response);*/
		$to = "alerts@tommyjams.com";
		$subject = "$email could not be added to mailchimp (voting)";
		$message = "$email could not be added to mailchimp (voting)";
		include("../../beta/include/mail.php");
	}

	$to = "alerts@tommyjams.com";
	$subject = "$email submitted dedication";
	$message = "$email submitted dedication";
	include("../../beta/include/mail.php");

	/**************************************************************************/
	
	$response['error']=0;
	$response['info'][]=array('fieldId'=>'voting-form-send','message'=>VOTING_FORM_SEND_MSG_OK);
	createResponse($response);		
	
	/**************************************************************************/	
	/**************************************************************************/
	
?>