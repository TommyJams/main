<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if ( function_exists('register_sidebar') ){
	 register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => '',
	));
}

/** @ignore */
function custom_url_head() {
	//update url
	//wp_twitter_id
	//wp_twitter_id" href="http://twitter.com/aflama
	//wp_facebook_id" href="http://www.facebook.com/profile.php?id=53103448
	
	$head = "<script type='text/javascript'><!-- // \n";
	$output = '';
	if ( false !== ( $url = twitter_header_url() ) ) {
		$output .= "document.getElementById('wp_twitter_id').href = 'http://twitter.com/$url';\n";
	}
	if ( false !== ( $url = facebook_header_url() ) ) {
		$output .= "document.getElementById('wp_facebook_id').href = 'http://www.facebook.com/profile.php?id=$url';\n";
	}
	$foot = "// --></script>\n";
	if ( '' != $output )
		echo $head . $output . $foot;
}

add_action('wp_footer', 'custom_url_head');

function twitter_header_url_string() {
	$url = twitter_header_url();
	if ( false === $url )
		return '';
	return $url;
}

function facebook_header_url_string() {
	$url = facebook_header_url();
	if ( false === $url )
		return '';
	return $url;
}

function twitter_header_url() {
	return apply_filters('twitter_header_url', get_option('twitter_header_url'));
}

function facebook_header_url() {
	return apply_filters('facebook_header_url', get_option('facebook_header_url'));
}

add_action('admin_menu', 'goldpot_add_theme_page');

function goldpot_add_theme_page() {
	if ( isset( $_GET['page'] ) && $_GET['page'] == basename(__FILE__) ) {
		if ( isset( $_REQUEST['action'] ) && 'save' == $_REQUEST['action'] ) {
		
				
				if ( isset($_REQUEST['twitterurl']) ) {
					if ( '' == $_REQUEST['twitterurl'] )
						delete_option('twitterurl');
					else {			
						update_option('twitter_header_url', $_REQUEST['twitterurl']);
					}				
				}

				if ( isset($_REQUEST['facebookurl']) ) {
					if ( '' == $_REQUEST['facebookurl'] )
						delete_option('facebookurl');
					else {			
						update_option('facebook_header_url', $_REQUEST['facebookurl']);
					}	
				}
				
			#print_r($_REQUEST);
			wp_redirect("themes.php?page=functions.php&saved=true");
			die;
		}
		add_action('admin_head', 'goldpot_theme_page_head');
	}
	add_theme_page(__('Customize Top Nav Link'), __('Top Nav Links'), 'edit_themes', basename(__FILE__), 'goldpot_theme_page');
}

function goldpot_theme_page_head() {

}

function goldpot_theme_page() {
	if ( isset( $_REQUEST['saved'] ) ) echo '<div id="message" class="updated fade"><p><strong>'.__('Options saved.').'</strong></p></div>';
?>
<div class='wrap'>
	<h2><?php _e('Customize Top Nav Link'); ?></h2>
		<div id="myForm">
			<form method="post" name="goldpotform" id="goldpotform" action="<?php echo attribute_escape($_SERVER['REQUEST_URI']); ?>">
				<label for="twitterurl">Your twitter username:</label> <input type="text" name="twitterurl" id="twitterurl" value="<?php echo attribute_escape(twitter_header_url_string()); ?>" /><br />
				<label for="facebookurl">Your Facebook profile ID:</label> <input type="text" name="facebookurl" id="facebookurl" value="<?php echo attribute_escape(facebook_header_url_string()); ?>" /><Br />
				<small>(You can find your profile ID by clicking on your profile, you will see an ID number there. Just copy that ID and paste it here!)</small>
				<input type="hidden" name="action" value="save" />
				<p class="submit"><input type="submit" name="submitform" class="button-primary" value="<?php echo attribute_escape(__('Update my Information')); ?>" /></p>
			</form>			
		</div>
	</div>
</div>
<?php } ?>
