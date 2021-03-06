<?php
/*
 * Based off of PlanetoZh works
 * http://wordpress.org/extend/plugins/ozh-colourlovers-admin-css-designer/
 * 
 */

// Main func: get a palette from COLOURlovers weeeeeeeeeeeeee
function jdt_cl_get_random_palette($id = 0, $save = true) {

	$id = ($id == 0) ? 'palettes/random' : 'palette/'.strval($id) ;
	
	$url = 'http://www.colourlovers.com/api/'.$id;
	
	// Use Snoopy to fetch page
	require_once('class-snoopy.php');
	if (!class_exists(snoopy)) {
		return jdt_cl_fallback_random('Class Snoopy not found');
	}
	$client = new Snoopy();
	$client->agent = 'http://johndturner.com/';
	$client->read_timeout = $client->_fp_timeout = 5;
	if (@$client->fetch($url) === false) {
		return jdt_cl_fallback_random('Could not contact site, maybe down');
	}
	// Did we get XML as expected?
	if (!$client->headers or strpos(join(' ',$client->headers), 'Content-Type: text/xml;')  === false)
		return jdt_cl_fallback_random('Unexpected result. Host maybe down?');
		
	// Process XML
	$xml = ($client->results);
	require_once(dirname(__FILE__).'/xmlparser.php');
	$xml = new XMLParser($xml,'raw');
	$xml = @$xml->getTree();

	$xml = jdt_cl_flatten_array($xml['palettes'][0]['palette'][0]);
	$xml['colors'] = jdt_cl_flatten_array_colors($xml['colors'][0]['hex']);
	/* Now we have something like:
		$xml = Array (
		[title] => "Coffee 'n Cakes",
		[username] => "spiralstairs",
		[numviews] => 191,
		[numvotes] => 0,
		[numcomments] => 7,
		[numhearts] => 0,
		[rank] => 35474,
		[datecreated] => "2007-11-10 13:56:47",
		[colors] => Array (
				[0] => "#DF928C",
				[1] => "#F5F7C4",
				[2] => "#E2D6AF",
				[3] => "#BDB885",
				[4] => "#4E3A0F",
			),
		[description] => "Coffee, chocolate, cakes and cookies",
		[url] => "http://www.colourlovers.com/palette/203023/Coffee_n_Cakes",
		[imageurl] => "http://www.colourlovers.com/paletteImg/DF928C/F5F7C4/E2D6AF/BDB885/4E3A0F/Coffee_n_Cakes.png",
		[apiurl] => "http://www.colourlovers.com/api/palette/203023"
		);
	*/
	
	// Fix things if needed (missing colors or no colors maybe?)
	$xml = jdt_cl_fallback_random('', $xml);
	
	return $xml;

}

// Return a random color. Neato! From http://www.php.net/manual/en/function.dechex.php#39634
function jdt_cl_rndcolor() {
	return '#' . substr('00000' . dechex(mt_rand(0, 0xffffff)), -6);
}

// Fix palette inconsistencies (missing colors, no colors, or nothing at all)
function jdt_cl_fallback_random($msg='', $xml = array() ) {
	$xml = (array)$xml;
	if ((!$xml['colors']) or (count($xml['colors']) == 1 && $xml['colors'][0] = '#' ) ) {
		// either no XML or a dead palette
		$xml['colors'] = NULL;
		$msg .= ' (Palette not found. Random colors generated...)';
	} else {		
		// Some checks for incomplete palettes
		if(!($xml['colors'][1])) $xml['colors'][1] = $xml['colors'][0];
		if(!($xml['colors'][2])) $xml['colors'][2] = $xml['colors'][1];
		if(!($xml['colors'][3])) $xml['colors'][3] = $xml['colors'][0];
		if(!($xml['colors'][4])) $xml['colors'][4] = $xml['colors'][1];
	}
	
	$fixed = Array (
	'title' => "Ooops... Error :/",
	'username' => "jdt",
	'numviews' => -1,
	'numvotes' => -1,
	'numcomments' => -1,
	'numhearts' => -1,
	'rank' => -1,
	'datecreated' => "1972-03-23 07:10:00",
	'colors' => array(jdt_cl_rndcolor(), jdt_cl_rndcolor(), jdt_cl_rndcolor(), jdt_cl_rndcolor(), jdt_cl_rndcolor()),
	'url' => "http://planetjdt.com/",
	'imageurl' => "#",
	'apiurl' => "#",
	'description' => $msg
	);
	
	$didfix = false;
	foreach ($fixed as $k=>$v) {
		if ($xml[$k] == NULL && $k != 'description') {
			$xml[$k] = $fixed[$k];
			$didfix = true;
		}
	}
	if ($didfix)
		$xml['description'] = trim($xml['description'] . ' ' .$msg);

	return $xml;
}




function jdt_cl_flatten_array($xml) {
	foreach($xml as $k=>$v) {
		if (array_key_exists('VALUE', $v[0]))
			$xml[$k] = $v[0]['VALUE'];
	}
	return $xml;
}

function jdt_cl_flatten_array_colors($xml) {
	foreach($xml as $k=>$v) {
		$xml[$k] = '#'.$v['VALUE'];
	}
	return $xml;
}
$id = $_REQUEST['id'];
$palette = jdt_cl_get_random_palette($id); // missing: 29535; incomplete: 125480, complete but with some 0: 96764 

echo json_encode($palette);

?>
		
	
