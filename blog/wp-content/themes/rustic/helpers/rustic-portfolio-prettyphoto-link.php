<?php

function rustic_portfolio_prettyphoto_link($input_link){  
//GET THEME OPTIONS HERE...$color, $bg_color, $logo_url...maybe call theme options once in functions.php instead of calling get_option several times...
	$color = ''; // Default for now...
	$bg_color = '';
	$logo_url = '';

    
    $prettyphoto_link = $input_link; // If not mp3, mp4, flv, or f4v then leave as is.

    
    $theme_folder_url = get_template_directory_uri();
	
	if( $color ){
            $controlColor = "0x".$color;
        	}else{
			$controlColor = "0x00ff00"; // Default green controls
		}
		
	if( $bg_color ){
		$controlBackColor = "0x".$bg_color;
		}else{
		$controlBackColor = "0x666666"; // Default grey background
	}

    
    $mp3 = strpos($input_link, ".mp3");
	$mp4 = strpos($input_link, ".mp4");
	$flv = strpos($input_link, ".flv");
    $f4v = strpos($input_link, ".f4v");

    if($mp3 !== false){

        $prettyphoto_link = "$theme_folder_url/flvplayer/NonverBlaster.swf";
        $prettyphoto_link .= "?width=350&amp;height=17&amp;"; 
		$prettyphoto_link .= "flashvars=";
		$prettyphoto_link .= "mediaURL=".$input_link;  
		$prettyphoto_link .= "&amp;teaserURL=";
		$prettyphoto_link .= "&amp;controlColor=".$controlColor;
		$prettyphoto_link .= "&amp;playerBackColor=".$controlBackColor; 
		$prettyphoto_link .= "&amp;autoPlay=true";
    }

    
    if( $mp4 !== false || $flv !== false || $f4v !== false ){ 
 
        if (preg_match('/^([^?]+)\?width=(\d*)&height=(\d*)/i', $input_link, $match)){
            
            $input_video_url = $match[1];
            $input_video_width = $match[2];
            $input_video_height = $match[3];
        }
        
        $total_height = $input_video_height + 40;

        $prettyphoto_link = "$theme_folder_url/flvplayer/NonverBlaster.swf";
        $prettyphoto_link .= "?width=".$input_video_width."&amp;height=".$total_height;
        $prettyphoto_link .= '&amp;flashvars=';
		$prettyphoto_link .= "mediaURL=".$input_video_url;
		$prettyphoto_link .= "&amp;teaserURL=";
		$prettyphoto_link .= "&amp;allowSmoothing=true";
		$prettyphoto_link .= "&amp;autoPlay=true";
		$prettyphoto_link .= "&amp;buffer=6";
		$prettyphoto_link .= "&amp;showTimecode=true";
		$prettyphoto_link .= "&amp;loop=false";
        $prettyphoto_link .= "&amp;controlColor=".$controlColor;
        $prettyphoto_link .= "&amp;controlBackColor=".$controlBackColor;	
		$prettyphoto_link .= "&amp;scaleIfFullScreen=true";
		$prettyphoto_link .= "&amp;showScalingButton=true";
		$prettyphoto_link .= "&amp;defaultVolume=100";
		$prettyphoto_link .= "&amp;crop=false"; 
		if( $logo_url ){ // Optional
            $prettyphoto_link .= "&amp;indentImageURL=".$logo_url;
        }
    }
    
    return $prettyphoto_link;
} 