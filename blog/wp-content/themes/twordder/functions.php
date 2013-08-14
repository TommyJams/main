<?php
/**************** Register Sidebar Widgets *****************/
if ( function_exists('register_sidebar') )
    register_sidebar(array('name'=>'Blog Sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array('name'=>'Footer',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array('name'=>'Blog Header',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ));
    register_sidebar(array('name'=>'Page Sidebar',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
/**************** Custom Image Header ****************/
// Reference
$yuiGrids = array("doc"=>750,"doc2"=>950,"doc3"=>1024,"doc4"=>974,"custom-doc"=>(get_option('tw_custom_page_width') == "" ? 750 : intval(get_option('tw_custom_page_width'))));
//  Set some default values
define('HEADER_TEXTCOLOR', '000'); //  Default text color
define('HEADER_IMAGE', '%s/images/default.gif'); // %s is theme dir uri, set a default image
define('HEADER_IMAGE_WIDTH', (get_option('tw_custom_header_image_width') == "" ? 200 : intval(get_option('tw_custom_header_image_width')))); 
define('HEADER_IMAGE_HEIGHT', (get_option('tw_custom_header_image_height') == "" ? 45 : intval(get_option('tw_custom_header_image_height'))));  // Same for height

function header_style() {
    //  This function defines the style for the theme
    //  You can change these selectors to match your theme
?>
<style type="text/css">
#header{
    background: url(<?php header_image() ?>) no-repeat;
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
	padding:0 0 0 18px;
}
#header h1 {
    padding-top:10;
    margin: 0;
}
.logo {
    display: none;
}
<?php
//  Has the text been hidden?
//  If so, set display to equal none
if ( 'blank' == get_header_textcolor() ) { ?>
#header h1, #header #desc {
    display: none;
}
#header{
   padding:0px;
}
.logo {
    display: inline;
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
}
<?php } else {
    //  Otherwise, set the color to be the user selected one
    ?>
#header h1 a, #desc {
    color:#<?php header_textcolor() ?>;
}
<?php } ?>
</style>
<?php
}
function admin_header_style() {
    //  This function styles the admin page
?>
<style type="text/css">
#headimg{
    background: url(<?php header_image() ?>) no-repeat;
    height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
    width:<?php echo HEADER_IMAGE_WIDTH; ?>px;
    padding:0 0 0 18px;
}



#headimg h1{
    padding-top:0px;
    margin: 0;
}
#headimg h1 a, #desc{
    color:#<?php header_textcolor() ?>;
    text-decoration: none;
    border-bottom: none;
}
#desc {
    padding-top: 15px;
    margin-right: 30px;
}
<?php if ( 'blank' == get_header_textcolor() ) { ?>
#headimg h1, #headimg #desc {
    display: none;
}
#headimg h1 a, #headimg #desc {
    color:#<?php echo HEADER_TEXTCOLOR ?>;
}
<?php } ?>
</style>
<?php
}
/*  This is the key function call, it communicates with the API
    and adds the options to the admin menu.  You pass the names of your
    two styling functions, first the one that styles the theme, then
    the one that styles the admin page*/
add_custom_image_header('header_style', 'admin_header_style');
/**************** Legacy Comments ****************/
add_filter('comments_template', 'legacy_comments');
function legacy_comments($file) {
	if ( !function_exists('wp_list_comments') ) 
		$file = TEMPLATEPATH . '/legacy.comments.php';
	return $file;
}
/**************** Options Page ****************/
$themename = "Twordder Theme";
$shortname = "tw";
$options = array (
    
    array(  "name" => "Page Width",
            "id" => $shortname."_page_width",
			"type" => "select",
            "std" => "doc",
            "options" => array(
				"doc" => "750px Centered", 
				"doc2"=> "950px Centered", 
				//"doc4"=> "974px Centered", 
				//"doc3"=> "100% Fluid", 
				"custom-doc"=> "Custom Page Width")),
    
    array(    "name" => "Custom Page Width",
            "id" => $shortname."_custom_page_width",
            "std" => "",
            "type" => "text"),
    
    array(    "name" => "Layout Templates",
            "id" => $shortname."_layout_template",
            "type" => "select",
            "std" => "yui-t5",
            "options" => array(
				"yui-t1" => "Two columns, narrow on left, 160px", 
				"yui-t2"=> "Two columns, narrow on left, 180px", 
				"yui-t3"=> "Two columns, narrow on left, 300px", 
				"yui-t4"=> "Two columns, narrow on right, 180px", 
				"yui-t5"=> "Two columns, narrow on right, 240px", 
				"yui-t6"=> "Two columns, narrow on right, 300px")),
    array(    "name" => "Custom Header Image Width",
            "id" => $shortname."_custom_header_image_width",
            "std" => "",
            "type" => "text"),
            
    array(    "name" => "Custom Header Image Height",
            "id" => $shortname."_custom_header_image_height",
            "std" => "",
            "type" => "text"),
				
    array(    "name" => "Background",
            "id" => $shortname."_background",
            "std" => "#ffffff",
            "type" => "ctext"),

    array(    "name" => "Text",
            "id" => $shortname."_text",
            "std" => "#ffffff",
            "type" => "ctext"),
			
    array(    "name" => "Links",
            "id" => $shortname."_links",
            "std" => "#ffffff",
            "type" => "ctext"),
		
    array(    "name" => "Sidebar",
            "id" => $shortname."_sidebar",
            "std" => "#ffffff",
            "type" => "ctext"),
			
    array(    "name" => "Sidebar Border",
            "id" => $shortname."_sidebar_border",
            "std" => "#ffffff",
            "type" => "ctext"),
			
    array(    "name" => "Background Image URL",
            "id" => $shortname."_background_image",
            "std" => "",
            "type" => "text"),
			
    array(    "name" => "Tile Background Image",
            "id" => $shortname."_tile",
            "std" => "",
            "type" => "checkbox"),

    array(    "name" => "Background Opacity",
            "id" => $shortname."_background_opacity",
            "type" => "select",
            "std" => "100",
            "options" => array(
				"100" => "100%", 
				"90"=> "90%", 
				"80"=> "80%", 
				"70"=> "70%", 
				"60"=> "60%", 
				"50"=> "50%",
				"40"=> "40%",
				"30"=> "30%",
				"20"=> "20%",
				"10"=> "10%",
				"0"=> "0%",
				)
	   ),
);
$tw_options = array();
function tw_add_admin() {

    global $themename, $shortname, $options;
    //zend_debug::dump($_POST);
	

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
				$tile = $_REQUEST['tw_tile'];
				if (empty($tile)){
					update_option('tw_tile', 'false');
				}
                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "Theme Options", 'edit_themes', basename(__FILE__), 'tw_admin');

}
function tw_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
?>


<div class="wrap">
<h2><?php echo $themename; ?> Settings</h2>
<iframe id="preview" name="preview" src="<?php echo get_option('siteurl');  ?>?temppreview=true" style="width:100%;height:300px;border:1px solid #ccc"></iframe>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/farbtastic/farbtastic.js"></script>
<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/farbtastic/farbtastic.css" />
<script type="text/javascript">
  
   $(document).ready(function() {
    var f = $.farbtastic('#colorpicker');
    var p = $('#colorpicker').css('opacity', 0.25);
    var selected;
    $('.picker')
      .each(function () { f.linkTo(this); $(this).css('opacity', 0.75); })
      .focus(function() {
        if (selected) {
          $(selected).css('opacity', 0.75);
        }
        f.linkTo(this);
        p.css('opacity', 1);
        $(selected = this).css('opacity', 1);
      });
  });


function setColors(){
	document.getElementById('tw_background').value = colors[0];
	document.getElementById('tw_text').value = colors[1];
	document.getElementById('tw_links').value = colors[2];
	document.getElementById('tw_sidebar').value = colors[3];
	document.getElementById('tw_sidebar_border').value = colors[4];
	document.getElementById('tw_background').style.backgroundColor = colors[0];
	document.getElementById('tw_text').style.backgroundColor = colors[1];
	document.getElementById('tw_links').style.backgroundColor = colors[2];
	document.getElementById('tw_sidebar').style.backgroundColor = colors[3];
	document.getElementById('tw_sidebar_border').style.backgroundColor = colors[4];
	//set colors
	//window.frames['preview'].document.backgroundColor = colors[0];
       //window.frames['preview'].document.backgroundImage = bgImage;
	//window.frames['preview'].document.color = colors[1];
	//window.frames['preview'].document.body.style.color = colors[1] ;
	//window.frames['preview'].document.getElementById('sb').style.backgroundColor = colors[3];
	$(window.frames['preview'].document).ready(function () {
	       $("#nav-overlay" , window.frames['preview'].document).css({'opacity' : $("#tw_background_opacity").val() * 0.01});
	       $("#main-overlay" , window.frames['preview'].document).css({'opacity' : $("#tw_background_opacity").val() * 0.01});
	       $("#sidebar-overlay" , window.frames['preview'].document).css({'opacity' : $("#tw_background_opacity").val() * 0.01});
	       $("#footer-overlay" , window.frames['preview'].document).css({'opacity' : $("#tw_background_opacity").val() * 0.01});
		$("html,body", window.frames['preview'].document).css({'color' : colors[1]});
		$("#sb", window.frames['preview'].document).css({'background-color' : colors[3]});
		$("a", window.frames['preview'].document).css({'color' : colors[2], 'text-decoration': 'none'});
		$("html,body" , window.frames['preview'].document).css({'background-color' : colors[0]});
		if(bgImage != ''){
	     	   $("html,body", window.frames['preview'].document).css({'background-image': 'url('+bgImage+')','background-attachment': 'fixed','background-position':'left top'});
		}
		if(bgTile == 'true'){
		   $("html,body", window.frames['preview'].document).css({'background-repeat':'repeat '});
		}
		else{
		   $("html,body", window.frames['preview'].document).css({'background-repeat':'no-repeat'});
		}
       

		<?php
		switch(get_option('tw_layout_template')){
		case 'yui-t1':
		case 'yui-t2':
		case 'yui-t3':
			$borderPos = 'right';
		break;
		case 'yui-t4':
		case 'yui-t5':
		case 'yui-t6':
			$borderPos = 'left';
		break;
		}
		?>
		$(".sidebar-wrapper", window.frames['preview'].document).css({'border-<?php echo $borderPos; ?>' : colors[4] + ' 1px solid'});
	});	
}
function shuffleColors(){
	colors = shuffle(colors);
	setColors();
}

function shuffle(o){ //v1.0
	for(var j, x, i = o.length; i; j = parseInt(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	return o;
};
var palette = new Object();
var colors = new Array();
colors[0] = '<?php echo get_option('tw_background') ?>';
colors[1] = '<?php echo get_option('tw_text') ?>';
colors[2] = '<?php echo get_option('tw_links') ?>';
colors[3] = '<?php echo get_option('tw_sidebar') ?>';
colors[4] = '<?php echo get_option('tw_sidebar_border') ?>';

var bgImage = '<?php echo get_option('tw_background_image') ?>';
var bgTile  =  '<?php echo get_option('tw_tile') ?>'; 
function getRandom(){
	colorId = document.getElementById('colorId').value;
       $.getJSON("<?php bloginfo('template_url'); ?>/lib/api-colourlovers.php?id="+ colorId, function(data){
		palette = data;
		colors =palette.colors;  
		$("#badge").css({'border':'1px solid #ccc'});
		document.getElementById('badge').src = palette.badgeurl ;
		document.getElementById('badgeLink').href = palette.url ;
		$('#colorId2').html( palette.id) ;
		$('#cl2').show( ) ;
		
		setColors();
	});
}

</script>
<h2>Templates</h2>
<h2>COLOURlovers.com Colors</h2>
<div style="position:relative">
<table class="form-table">
  <tr>
      <td colspan="2" >    
<div style="width:400px">Enter the <a href="http://www.colourlovers.com">COLOURlovers.com</a> ID and click <strong>Get Colors</strong> or leave it blank to get a random color palette . Use the <strong>Shuffle Colors</strong> to move colors around. Click <strong>Save Changes</strong> at the bottom of the page when your done!</td></div>
  </tr>
  <tr valign="top"> 
    <th scope="row">Colour Lovers ID:</th>
    <td><input id="colorId" name="colorId" type="text" value=""  /><td>
  </tr>
  <tr valign="top"> 
    <td colspan="2">
    <p class="submit">
	<input name="getRandom" type="button" value="Get Colors" onclick="getRandom();" />
	<input name="shuffleColors" type="button" value="Shuffle Colors" onclick="shuffleColors();" />   
    </p>
    <td>
  </tr>
</table>
<div id="badge-wrapper">
    <strong id="cl2" style="display:none">Color ID: </strong><span id="colorId2"></span><br />
    <a id="badgeLink" ><img id="badge" alt=""/></a>
</div>
</div>

<h2>Custom Colors, Background &amp; Layout</h2>
<div style="position:relative">
<form method="post">

<table class="form-table">
  <tr>
      <td colspan="2" >    
<div style="width:400px">Click <strong>Save Changes</strong> at the bottom of the page when your done!</td></div>
  </tr>
<?php foreach ($options as $value) { 
    
if ($value['type'] == "text") { ?>
        
<tr valign="top"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
     <?php
	if($value['id'] =='tw_background_image'){
         echo '<br /><div style="width:400px">Upload your background image by clicking <strong>Media</strong> on the left hand menu in Wordpress 2.7 and up. Then click <strong>Add New</strong>. Upload your image. After you have uploaded your image click <strong>View</strong>. This will open a new page, then click on the image itself. Once you just see the image copy the address in the browser\'s address bar and paste it in <strong>Background Image</strong> textbox</div>';
    }
     ?>
    </td>
</tr>

<?php } elseif ($value['type'] == "ctext") { ?>
        
<tr valign="top"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" class="picker" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
    </td>
</tr>

<?php } elseif ($value['type'] == "checkbox") { ?>
        
<tr valign="top"> 
    <th scope="row"><?php echo $value['name']; ?>:</th>
    <td>
        <input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="true" <?php if(get_settings( $value['id'] ) == 'true') echo 'checked="yes"'; ?> /> 
    </td>
</tr>

<?php } elseif ($value['type'] == "select") { ?>

    <tr valign="top"> 
        <th scope="row"><?php echo $value['name']; ?>:</th>
        <td>
            <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option=>$text) { ?>
                <option value="<?php echo $option; ?>" <?php if ( get_settings( $value['id'] ) == $option && get_settings( $value['id'] )  != "") { echo ' selected="selected"'; } elseif ($option == $value['std'] && get_settings( $value['id'] )  == "") { echo ' selected="selected"'; } ?>><?php echo $text; ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>

<?php 
} 
}
?>

</table>
<style type="text/css">
.colorSelector1 {
	position: absolute;
	top: 255px;
	left: 450px;
}
#badge-wrapper {
	position: absolute;
	top: 10px;
	left: 450px;
}
</style>

<div id="colorpicker" class="colorSelector1"></div>
  

<p class="submit">
<input name="save" type="submit" value="Save Changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
</div>

<script type="text/javascript">
	setTimeout("setColors()",4000)
	//setColors();
</script>
<?php
}

function array_to_object($array = array()) {
    if (!empty($array)) {
        $data = false;

        foreach ($array as $akey => $aval) {
            $data -> {$akey} = $aval;
        }

        return $data;
    }

    return false;
}

if(!function_exists('tw_wp_head')){
function tw_wp_head() { 
	?>
	<style type="text/css"> 
	#custom-doc {
		margin:auto;text-align:left; /* leave unchanged */
		width: <?php echo round((get_option('tw_custom_page_width') == "" ? 750 : intval(get_option('tw_custom_page_width')))/13,2); ?>em;/* non-IE */
		*width:<?php echo round((get_option('tw_custom_page_width') == "" ? 750 : intval(get_option('tw_custom_page_width')))/13.3333,2); ?>em;/* IE */
		min-width:<?php echo intval(get_option('tw_custom_page_width')); ?>px;/* optional but recommended */
	}
	</style>
	
	<?php	
	}
}

if(!function_exists('yui_menu_wp_head')){
	function yui_menu_wp_head() { 
	?>
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.6.0/build/menu/assets/menu.css" /> 
	<script type="text/javascript" src="http://yui.yahooapis.com/combo?2.6.0/build/yahoo-dom-event/yahoo-dom-event.js&amp;2.6.0/build/container/container_core-min.js&amp;2.6.0/build/menu/menu-min.js"></script>
	<script type="text/javascript">
	   YAHOO.util.Event.onContentReady("navmenu", function () {
	    var oMenuBar = new YAHOO.widget.MenuBar("navmenu", { 
	                     autosubmenudisplay: true, 
	                     hidedelay: 750, 
	                     lazyload: true });
	        oMenuBar.render();
	    });
	</script>
	<?php	
	}
}

if(!function_exists('tw_wp_foot')){
	function tw_wp_foot(){
		switch(get_option('tw_layout_template')){
			case 'yui-t1':
			case 'yui-t2':
			case 'yui-t3':
				$sidebarPos = 'left';
				$mainPos='right';
			break;
			case 'yui-t4':
			case 'yui-t5':
			case 'yui-t6':
				$sidebarPos = 'right';
				$mainPos='left';
			break;
				
		}
		
?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.corners.min.js"></script>
<script type="text/javascript">
$jdt_jQuery = jQuery.noConflict();

$jdt_jQuery(document).ready( function(){
	if ($jdt_jQuery.browser.msie == false) { 
	if ($jdt_jQuery.browser.opera == false) {
		$jdt_jQuery('#main-overlay').corners("<?php echo $mainPos ?> 5px");
		$jdt_jQuery('#main-overylay-wide').corners("5px");
		$jdt_jQuery('#sidebar-overlay').corners("<?php echo $sidebarPos ?> 5px");
	       $jdt_jQuery('.wp-yui-menu').corners("5px");
	       $jdt_jQuery('#footer-overlay').corners(" 5px");
	}}

	if ( $jdt_jQuery("#ymp-btn-buy").length > 0 ) {
	$jdt_jQuery("#ymp-btn-buy").css("display","none");
	}

});

$jdt_jQuery(window).load(function () {
          yuiFixColHeight();

});
	   $jdt_jQuery("#yui-main > .yui-b").bind("DOMAttrModified", function(e){
               yuiFixColHeight();
          });

var resizeSb = null;
var resizeMain = null;
function yuiFixColHeight() {
	   var c = $jdt_jQuery("#yui-main").attr('offsetHeight');
	   var s = $jdt_jQuery("#sb").attr('offsetHeight');
	   
	   if(parseFloat(c) >= parseFloat(s)){
	       var h = parseFloat(c) - 3;
	       resizeSb = function(h){
	   	$jdt_jQuery("#sb").css("height",h);
	   	$jdt_jQuery(".sidebar-wrapper,#sidebar-overlay,.main-wrapper,#main-overlay").css('height','100%');
	   	}
	   	setTimeout("resizeSb("+h+")",1000);
	   }else{
		var h = parseFloat(s) - 9;
	   	$jdt_jQuery("#yui-main > .yui-b").css("height",h);
	   	$jdt_jQuery(".sidebar-wrapper,#sidebar-overlay,.main-wrapper,#main-overlay").css('height','100%');

	   }
	   

}




</script>
<?php
	}
}

//function tw_init(){
	if(get_option('tw_page_width') == ''){
		update_option('tw_page_width','doc');
	}
	if(get_option('tw_layout_template') == ''){
		update_option('tw_layout_template','yui-t5');
	}
	if(get_option('tw_background') == ''){
		update_option('tw_background','#fff');
	}
	if(get_option('tw_text') == ''){
		update_option('tw_text','#000');
	}
	if(get_option('tw_links') == ''){
		update_option('tw_links','#0000FF');
	}
	if(get_option('tw_sidebar') == ''){
		update_option('tw_sidebar','#fff');
	}
	if(get_option('tw_sidebar_border') == ''){
		update_option('tw_sidebar_border','#fff');
	}
	if(get_option('tw_tile') == ''){
		update_option('tw_tile','');
	}
//}
add_action('wp_head', 'tw_wp_head');
add_action('wp_footer', 'tw_wp_foot');
add_action('wp_head', 'yui_menu_wp_head');
add_action('admin_menu', 'tw_add_admin'); 


/**************** YUI Menu code ****************/
if(!function_exists('yui_wp_list_pages')){
	function yui_wp_list_pages($args = '') {
		$defaults = array(
			'depth' => 0, 'show_date' => '',
			'date_format' => get_option('date_format'),
			'child_of' => 0, 'exclude' => '',
			'title_li' => __('Pages'), 'echo' => 1,
			'authors' => '', 'sort_column' => 'menu_order, post_title',
			'link_before' => '', 'link_after' => ''
		);
	
		$r = wp_parse_args( $args, $defaults );
		extract( $r, EXTR_SKIP );
	
		$output = '<div  id="navmenu" class="yuimenubar yuimenubarnav"><div class="bd"><ul class="first-of-type">';
		$current_page = 0;
	
		// sanitize, mostly to keep spaces out
		$r['exclude'] = preg_replace('[^0-9,]', '', $r['exclude']);
	
		// Allow plugins to filter an array of excluded pages
		$r['exclude'] = implode(',', apply_filters('wp_list_pages_excludes', explode(',', $r['exclude'])));
	
		// Query pages.
		$r['hierarchical'] = 0;
		$pages = get_pages($r);
	
		if ( !empty($pages) ) {
			if ( $r['title_li'] )
				$output .= '<li class="pagenav yuimenuitem">' . $r['title_li'] . ' <div class="yuimenu"><div class="bd"><ul>';
	
			global $wp_query;
			if ( is_page() || $wp_query->is_posts_page )
				$current_page = $wp_query->get_queried_object_id();
			$output .= yui_walk_page_tree($pages, $r['depth'], $current_page, $r);
			if ( $r['title_li'] )
				$output .= '</ul></div></div></li>';
		}
	    $output .= '</ul></div></div>';
		$output = apply_filters('wp_list_pages', $output);
	
		if ( $r['echo'] )
			echo $output ;
		else
			return $output;
	}
}

if(!function_exists('yui_walk_page_tree')){
	function yui_walk_page_tree($pages, $depth, $current_page, $r) {
		$walker = new yui_Walker_Page;
		$args = array($pages, $depth, $r, $current_page);
		return call_user_func_array(array(&$walker, 'walk'), $args);
	}
}

if(!class_exists('yui_Walker_Page')){
	class yui_Walker_Page extends Walker {
	
		var $tree_type = 'page';
	
	
		var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');
	
		function start_lvl(&$output, $depth) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"yuimenu\"><div class=\"bd\"><ul class=\"first-of-type\">\n";
		}
	
	
		function end_lvl(&$output, $depth) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul></div></div>\n";
		}
	
	
		function start_el(&$output, $page, $depth, $args, $current_page) {
			if ( $depth )
				$indent = str_repeat("\t", $depth);
			else
				$indent = '';
	
			extract($args, EXTR_SKIP);
			$css_class = 'page_item page-item-'.$page->ID;
			if ( !empty($current_page) ) {
				$_current_page = get_page( $current_page );
				if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
					$css_class .= ' current_page_ancestor';
				if ( $page->ID == $current_page )
					$css_class .= ' current_page_item';
				elseif ( $_current_page && $page->ID == $_current_page->post_parent )
					$css_class .= ' current_page_parent';
			} elseif ( $page->ID == get_option('page_for_posts') ) {
				$css_class .= ' current_page_parent';
			}
	
			$output .= $indent . '<li class="yuimenuitem ' . $css_class . '"><a class="yuimenuitemlabel" href="' . get_page_link($page->ID) . '" title="' . attribute_escape(apply_filters('the_title', $page->post_title)) . '">' . $link_before . apply_filters('the_title', $page->post_title) . $link_after . '</a>';
	
			if ( !empty($show_date) ) {
				if ( 'modified' == $show_date )
					$time = $page->post_modified;
				else
					$time = $page->post_date;
	
				$output .= " " . mysql2date($date_format, $time);
			}
		}
	
		function end_el(&$output, $page, $depth) {
			$output .= "</li>\n";
		}
	
	}
}

/****************** Comments *****************************/

function twordder_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" class="comment-u">
<div class="yui-gf"> 
	<div class="yui-u first">
          <?php echo get_avatar($comment,$size='50',$default='<path_to_url>' ); ?>
		<br />
		<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
	</div>
	<div class="yui-u">   
         <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
   <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
</div>
     </div>
<?php
        }
 
 
function set_css(){

global $options;

foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); } }


	switch(get_option('tw_layout_template')){
		case 'yui-t1':
		case 'yui-t2':
		case 'yui-t3':
			$borderPos = 'right';
		break;
		case 'yui-t4':
		case 'yui-t5':
		case 'yui-t6':
			$borderPos = 'left';
		break;
	}
	if(!isset($_REQUEST['temppreview'])){
	?>
	<style type="text/css">
	html, body {
	background-color:<?php echo (empty($tw_background)) ? ' #5C5C5C' : $tw_background; ?> ;
	<?php if(!empty($tw_background_image)) { ?>
	background-image: url(<?php echo $tw_background_image; ?>)   ;
	<?php } ?>
	background-attachment: fixed;
	background-position:left top;
	<?php if($tw_tile == 'true') { ?>
	background-repeat:repeat ;
	<?php } else { ?>
	background-repeat:no-repeat ;
	<?php } ?>
	color: <?php echo $tw_text; ?> ! important  ;
}

a {
	color: <?php echo (empty($tw_links)) ? ' #ccc' : $tw_links; ?> ! important;
	text-decoration:none;
}

a:hover {
	color: <?php echo (empty($tw_links)) ? ' #ccc' : $tw_links; ?>  ! important;
	text-decoration:underline;
}

.sidebar-wrapper{
    border-<?php echo $borderPos; ?>:<?php echo (empty($tw_sidebar_border)) ? ' C0C0C0' : $tw_sidebar_border; ?> 1px solid ! important;
}

#sidebar-overlay{

	background-color:<?php echo (empty($tw_sidebar)) ? ' C0C0C0' : $tw_sidebar; ?> ;
       opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	-moz-opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	filter: alpha(opacity=<?php echo (empty($tw_background_opacity)) ?  100 : $tw_background_opacity; ?>);
}

#nav-overlay{

       opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	-moz-opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	filter: alpha(opacity=<?php echo (empty($tw_background_opacity)) ?  100 : $tw_background_opacity; ?>);
}

#footer-overlay{

       opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	-moz-opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	filter: alpha(opacity=<?php echo (empty($tw_background_opacity)) ?  100 : $tw_background_opacity; ?>);
}

#main-overlay{

       opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	-moz-opacity: <?php echo (empty($tw_background_opacity)) ?  100 * 0.01 : $tw_background_opacity * 0.01; ?>;
	filter: alpha(opacity=<?php echo (empty($tw_background_opacity)) ?  100 : $tw_background_opacity; ?>);
}</style>
<?php
}
}

add_action('wp_head', 'set_css',99);



?>
