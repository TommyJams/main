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
		'radio-form-name'		=> $_POST['radio-form-name'],
		'radio-form-band'		=> $_POST['radio-form-band'],
		'radio-form-phone'		=> $_POST['radio-form-phone'],
		'radio-form-email'		=> $_POST['radio-form-email']
	);
	
	if(isGPC()) $values=array_map('stripslashes',$values);
	
	if( isEmpty($values['radio-form-name']) )
	{
 		$response['error']=1;	
		$response['info'][]=array('fieldId'=>'radio-form-name','message'=>RADIO_FORM_MSG_INVALID_DATA_NAME);
		createResponse($response);
	}

	else if( isEmpty($values['radio-form-band']) )
	{
		$response['error']=1;	
		$response['info'][]=array('fieldId'=>'radio-form-band','message'=>RADIO_FORM_MSG_INVALID_DATA_BAND);
		createResponse($response);
	}

	else if( isEmpty($values['radio-form-phone']) )
	{
		$response['error']=1;	
		$response['info'][]=array('fieldId'=>'radio-form-phone','message'=>RADIO_FORM_MSG_INVALID_DATA_PHONE);
		createResponse($response);
	}

	else if(!validateEmail($values['radio-form-email']))
	{
 		$response['error']=1;	
		$response['info'][]=array('fieldId'=>'radio-form-email','message'=>RADIO_FORM_MSG_INVALID_DATA_MAIL);
		createResponse($response);
	}

	/**************************************************************************/

	$SQLi = "INSERT INTO `$database`.`radioonegate` (`name`,`band`,`phone`,`email`) VALUES('".$values['radio-form-name']."','".$values['radio-form-band']."','".$values['radio-form-phone']."','".$values['radio-form-email']."')";
	$resulti = mysql_query($SQLi);
	if(!$resulti)
	{
		$response['error']=1;
		$response['info'][]=array('fieldId'=>'radio-form-send','message'=>RADIO_FORM_MSG_DATABASE_INSERT_FAILURE);
		createResponse($response);
	}	

	/************* This code is for MailChimp Integration ****************/
	
	if( !isEmpty($values['radio-form-email']) )
	{
		require_once('../newsletter-form/MCAPI.class.php');

		// API Key: http://admin.mailchimp.com/account/api/
		$api = new MCAPI('4b1d3dfd9a40c3a47861fa481d644505-us5');

		// List's Id: http://admin.mailchimp.com/lists/
		$list_id = "a29827c7a6";

		// Email to be subscribed
		$email = $values['radio-form-email'];
		// List Parameters
		$email_type = 'html';
		$double_optin=true;
		$update_existing=true;
		$replace_interests=true;
		$send_welcome=true;
		$listType='Artist';
		$merge_vars = array('NAME'=>$values['radio-form-name'],
							'GROUPINGS'=>array(
								array('name'=>'User Type', 'groups'=>$listType)
								)
							);

		if($api->listSubscribe($list_id, $email, $merge_vars, $email_type, $double_optin, $update_existing, $replace_interests, $send_welcome) === false)
		{
			$to = "alerts@tommyjams.com";
			$subject = "$email could not be added to mailchimp (radioArtist)";
			$message = "$email could not be added to mailchimp (radioArtist)";
			include("../../beta/include/mail.php");
		}

		$to = "alerts@tommyjams.com";
		$subject = "$email submitted RadioOne (Artist)";
		$message = "$email submitted RadioOne (Artist)";
		include("../../beta/include/mail.php");
	}
	
	/**************************************************************************/
	
	$response['error']=0;
	$response['info'][]=array('fieldId'=>'radio-form-send','message'=>RADIO_FORM_SEND_MSG_OK);
	createResponse($response);		
	
	/**************************************************************************/	
	/**************************************************************************/
	
?>