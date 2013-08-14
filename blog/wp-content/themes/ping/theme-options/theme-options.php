<?php


// Default options values
$ping_options = array(
	'site_color' => 'ffa200',
	'facebook' => '',
	'twitter' => '',
	'footer_text' => 'Ping created by <a href="http://switchupstudios.com/">SwitchUp Studios</a>',
	'footer_html' => ''
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function ping_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'ping_theme_options', 'ping_options', 'ping_validate_options' );
}
function load_custom_js_color_picker_style(){
        wp_register_style( 'custom_js_color_picker_style', get_stylesheet_directory_uri() . '/theme-options/css/jPicker-1.1.6.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_js_color_picker_style' );
}
add_action('admin_enqueue_scripts', 'load_custom_js_color_picker_style');

function load_custom_admin_style(){
        wp_register_style( 'custom_admin_style', get_stylesheet_directory_uri() . '/theme-options/admin.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_admin_style' );
}
add_action('admin_enqueue_scripts', 'load_custom_admin_style');

function load_custom_js_color_picker(){
        wp_register_script( 'custom_js_color_picker', get_stylesheet_directory_uri() . '/theme-options/jpicker-1.1.6.min.js', false, '1.0.0' );
        wp_enqueue_script( 'custom_js_color_picker' );
}
add_action('admin_enqueue_scripts', 'load_custom_js_color_picker');


add_action( 'admin_init', 'ping_register_settings' );

function ping_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'ping_theme_options_page' );
}
add_action( 'admin_menu', 'ping_theme_options' );

// Function to generate options page
function ping_theme_options_page() {
	global $ping_options, $ping_categories, $ping_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

	<div class="wrap">

	<?php screen_icon(); echo "<h2>" . get_current_theme() . __( 'Theme Options', 'ping' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>

	<?php if ( false !== $_REQUEST['updated'] ) : ?>
	<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ping' ); ?></strong></p></div>
	<?php endif; // If the form has just been submitted, this shows the notification ?>

	<form method="post" action="options.php">

	<?php $settings = get_option( 'ping_options', $ping_options ); ?>
	
	<?php settings_fields( 'ping_theme_options' );
	/* This function outputs some hidden fields required by the form,
	including a nonce, a unique number used to ensure the form has been submitted from the admin page
	and not somewhere else, very important for security */ ?>

	
   <div class="admin-option"> 
   <label for="site_color">Sitewide Color:</label>

    <script type="text/javascript">        
  jQuery(document).ready(
    function()
    {
		jQuery.fn.jPicker.defaults.images.clientPath='<?php echo get_template_directory_uri(); echo ('/theme-options/'); ?>images/';
		jQuery.fn.jPicker.defaults.window.position.x='left';
		jQuery.fn.jPicker.defaults.window.position.y='bottom';
      jQuery('#Binded').jPicker();
	  });
</script>
<div class="textinput">
	<input id="Binded" name="ping_options[site_color]" type="text" value="<?php  esc_attr_e($settings['site_color']); ?>" />
    </div>
    </div>
    <div class="admin-option"> 
<label for="facebook">Facebook URL<br/ >(the bit after 'facebook.com/')</label>
<div class="textinput">
	<input id="facebook" name="ping_options[facebook]" type="text" value="<?php  esc_attr_e($settings['facebook']); ?>" />
</div>
</div>
   <div class="admin-option"> 
<label for="twitter">Twitter URL<br/ >(the bit after 'twitter.com/')</label>
<div class="textinput">
	<input id="twitter" name="ping_options[twitter]" type="text" value="<?php  esc_attr_e($settings['twitter']); ?>" />
</div>
</div>
   <div class="admin-option"> 
     
 <label for="footer_text">Footer Text<br/ >(insert any text you wish to be in the footer)</label>

	<textarea id="footer_text" name="ping_options[footer_text]" type="text" ><?php  esc_attr_e($settings['footer_text']); ?></textarea>
    </div>
       <div class="admin-option"> 
      <label for="footer_html">Footer HTML<br/ >(insert any html/scripts, like Google Analytics)</label>

	<textarea id="footer_html" name="ping_options[footer_html]" type="text" ><?php  esc_attr_e($settings['footer_html']); ?></textarea>
</div>
	<p class="submit"><input type="submit" class="button-primary" value="Save Options" /></p>

	</form>

	</div>

	<?php
}

function ping_validate_options( $input ) {
	global $ping_options, $ping_categories, $ping_layouts;

	$settings = get_option( 'ping_options', $ping_options );
	
	
	$input['site-color'] = wp_filter_nohtml_kses( $input['site-color'] );
	$input['facebook'] = wp_filter_nohtml_kses( $input['facebook'] );
	$input['twitter'] = wp_filter_nohtml_kses( $input['twitter'] );
	$input['footer_text'] = wp_kses( $input['footer_text'], array('a' => array('href' => array(),'title' => array()),'br' => array(),'em' => array(),'strong' => array(), 'span' => array()) );
	$input['footer_html'] = wp_kses( $input['footer_html'], array('script' => array('type' => array())) );
	
	
	return $input;
}

endif;  // EndIf is_admin()