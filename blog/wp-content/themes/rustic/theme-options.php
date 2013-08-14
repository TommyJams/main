<?php

add_action( 'admin_init', 'rustic_theme_options_init' );
add_action( 'admin_menu', 'rustic_theme_options_add_page' );
add_action( 'wp_head', 'rustic_check_trees' );
add_action( 'wp_head', 'rustic_use_google_font' );
add_action( 'wp_head', 'rustic_use_link_hover_color' );
add_action( 'wp_head', 'rustic_use_font_color' );

/**
 * Init plugin options to white list our options
 */
function rustic_theme_options_init(){
	register_setting( 'rustic_options', 'rustic_theme_options', 'rustic_theme_options_validate' );
}

/**
 * Load up the menu page
 */
function rustic_theme_options_add_page() {
	add_theme_page( __( 'Rustic Theme Options', 'rustic' ), __( 'Rustic Theme Options', 'rustic' ), 'edit_theme_options', 'rustic_theme_options', 'rustic_theme_options_do_page' );
}
/**
 * Add no trees stylesheet if selected in theme options
 */
function rustic_check_trees(){
global $rustic_theme_options;

 $radio_setting = $rustic_theme_options['radioinput'];
 if($radio_setting == 'no trees'){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri() . '/style-no-trees.css' ; ?>" />
<?php }else if($radio_setting == 'red'){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri() . '/style-red.css' ; ?>" />
<?php }else if($radio_setting == 'blue'){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri() . '/style-blue.css' ; ?>" />
<?php }else if($radio_setting == 'cream'){ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri() . '/style-cream.css' ; ?>" />
<?php }
}
/**
 * Use Google Font if selected in theme options
 */
function rustic_use_google_font(){
global $rustic_theme_options;

 if( isset($rustic_theme_options['font']['use_google_font']) && $rustic_theme_options['font']['use_google_font'] == 1){  
 	echo $rustic_theme_options['font']['stylesheet_link']; ?>
		<style type="text/css" media="all">
			body, input, textarea, .page-title span, .pingback a.url {
				<?php echo $rustic_theme_options['font']['font_family_code']; ?>
			}
		</style>
<?php }
}
/**
 * Change font color if selected in theme options
 */
function rustic_use_font_color(){
global $rustic_theme_options;

 if(isset($rustic_theme_options['font']['use_color']) && $rustic_theme_options['font']['use_color'] == 1){   ?>
		<style type="text/css" media="all">
			/*body, input, textarea, abbr, acronym, #site-generator a, #content, #content input, #content textarea*/
			html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, a, p, blockquote, pre,
 abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td, input, textarea {
				color: #<?php echo $rustic_theme_options['font']['color']; ?> !important;
			}
		</style>
<?php }
}
/**
 * Change link hover color if selected in theme options
 */
function rustic_use_link_hover_color(){
global $rustic_theme_options;

 if(isset($rustic_theme_options['link']['use_hover_color']) && $rustic_theme_options['link']['use_hover_color'] == 1){   ?>
		<style type="text/css" media="all">
			a:hover, a:active,  #searchsubmit:hover,   li:hover > a, li.current_page_item > a, li.current-menu-ancestor > a, li.current-menu-item > a, li.current-menu-parent > a {
				color: #<?php echo $rustic_theme_options['link']['hover_color']; ?> !important;
			}
		</style>
<?php }
}
/**
 * Create array for our radio options
 */

$radio_options = array(
	'no trees' => array(
		'value' => 'no trees',
		'label' => __( 'Normal Light (No Trees)', 'rustic' )
	),
	'trees' => array(
		'value' => 'trees',
		'label' => __( 'Normal Light (Trees)', 'rustic' )
	),
	'red' => array(
		'value' => 'red',
		'label' => __( 'Pink Light (Trees)', 'rustic' )
	),
	'blue' => array(
		'value' => 'blue',
		'label' => __( 'Blue Light (Trees)', 'rustic' )
	),
	'cream' => array(
		'value' => 'cream',
		'label' => __( 'Brown Wood (Trees)', 'rustic' )
	)
);
/**
 * Create array for portfolio style options
 */

$portfolio_style_options = array(
	'normal' => array(
		'value' => 'normal',
		'label' => __( 'Photo Style White Frame (Simple)', 'rustic' )
	),
	'wood' => array(
		'value' => 'wood',
		'label' => __( 'Museum Style Wooden Frame (Posh)', 'rustic' )
	)
);

/**
 * Create the options page
 */
function rustic_theme_options_do_page() {
	global $radio_options, $portfolio_style_options, $rustic_theme_options;

	

	?>

<div class="wrap">
  <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'rustic' ) . "</h2>"; ?>
  <?php if ( isset( $_REQUEST['settings-updated']) || isset( $_REQUEST['updated']) ) : ?>
  <div class="updated fade">
    <p><strong>
      <?php _e( 'Options saved', 'rustic' ); ?>
      </strong></p>
  </div>
  <?php endif; ?>
  <form method="post" action="options.php">
    <?php settings_fields( 'rustic_options' ); ?>
    
	<fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
    <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>
    <?php _e( 'General Settings', 'rustic' ); ?>
    </strong></legend>
	<table class="form-table">
      <?php
				/**
				 * Trees/No Trees radio buttons
				 */
				?>
      <tr valign="top">
        <th scope="row"><?php _e( '<strong>Choose Theme Style!</strong>', 'rustic' ); ?></th>
        <td><fieldset>
          <legend class="screen-reader-text"><span>
          <?php _e( 'Choose Theme Style', 'rustic' ); ?>
          </span></legend>
          <?php
							if ( ! isset( $checked ) )
								$checked = '';
							foreach ( $radio_options as $option ) {
								$radio_setting = $rustic_theme_options['radioinput'];

								if ( '' != $radio_setting ) {
									if ( $rustic_theme_options['radioinput'] == $option['value'] ) {
										$checked = "checked=\"checked\"";
									} else {
										$checked = '';
									}
								}
								?>
          <label class="description">
          <input type="radio" name="rustic_theme_options[radioinput]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
          <?php echo $option['label']; ?></label>
          <br />
          <?php
							}
						?>
          </fieldset></td>
      </tr>
	  
	  
	  
	  <!-- Choose Porfolio Style -->
	  <tr valign="top">
        <th scope="row"><?php _e( '<strong>Choose Porfolio Style</strong>', 'rustic' ); ?></th>
        <td><fieldset>
          <legend class="screen-reader-text"><span>
          <?php _e( 'Choose Portfolio Style', 'rustic' ); ?>
          </span></legend>
          <?php
							if ( ! isset( $rustic_theme_options['portfolio']['style'] ) )
								$rustic_theme_options['portfolio']['style'] = '';
								
							foreach ( $portfolio_style_options as $option2 ) {
								
									if ( $rustic_theme_options['portfolio']['style'] == $option2['value'] ) {
										$checked2 = "checked=\"checked\"";
									} else {
										$checked2 = '';
									}
								
								?>
          <label class="description">
          <input type="radio" name="rustic_theme_options[portfolio][style]" value="<?php esc_attr_e( $option2['value'] ); ?>" <?php echo $checked2; ?> />
          <?php echo $option2['label']; ?></label>
          <br />
          <?php
							}
						?>
          </fieldset></td><td>   <span class="description">
          <?php _e( 'Go to <b>Portfolio Items->Add New</b> and read <b>How to Make a Portfolio</b> to get started.', 'rustic' ); ?>
          </span> </td>
      </tr>
	  
	  
	  
	  <!-- Portfolio Items per Page -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[portfolio][items_per_page]" >
          <?php _e( 'Portfolio Items per Page', 'rustic' ); ?>
          </label></th>
        <td><input id="rustic_theme_options[portfolio][items_per_page]" class="small-text" type="text" name="rustic_theme_options[portfolio][items_per_page]" value="<?php if ( isset($rustic_theme_options['portfolio']['items_per_page']) && $rustic_theme_options['portfolio']['items_per_page'] )  echo esc_attr( $rustic_theme_options['portfolio']['items_per_page']); ?>" />
          </td><td>   <span class="description">
          <?php _e( 'This is how many items will appear on each page of your porfolio. It looks best when you use a multiple of 3 (ex: 3, 6, 9 ...etc.).', 'rustic' ); ?>
          </span> </td>
      </tr>
	  
	  
	  
	  <!-- Use Google Font? -->
		<tr valign="top">
        <th scope="row">
          <?php _e( 'Use <strong>Google web font</strong>?', 'rustic' ); ?>
          </th>
        <td><label for="rustic_theme_options[font][use_google_font]"><input name="rustic_theme_options[font][use_google_font]" type="checkbox" id="rustic_theme_options[font][use_google_font]" value="1" <?php if(isset($rustic_theme_options['font']['use_google_font'])) checked( $rustic_theme_options['font']['use_google_font'], 1 ); ?>  />
          <span class="description">
          <?php _e( 'Check to use <strong>Google web font</strong>.', 'rustic' ); ?>
          </span></label> </td>
		  <td>   <span class="description"> 
          <?php _e( 'Vist the <a href="http://www.google.com/webfonts#HomePlace:home"><strong>Google web font</strong> website</a>  , choose a font, and paste the code into the boxes below.', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Google Font Stylesheet Link -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[font][stylesheet_link]">
          <?php _e( '<strong>Google web font</strong> stylesheet link', 'rustic' ); ?>
          </label></th>
        <td><textarea id="rustic_theme_options[font][stylesheet_link]"  cols="70" rows="4" name="rustic_theme_options[font][stylesheet_link]" /><?php if ( isset($rustic_theme_options['font']['stylesheet_link']) && $rustic_theme_options['font']['stylesheet_link'] ) echo esc_textarea($rustic_theme_options['font']['stylesheet_link']); ?></textarea>
          </td><td>   <span class="description"> 
          <?php _e( 'Copy and paste <strong>Google web font</strong> stylesheet link here. Example: <br /><code>&lt;link href="http://fonts.googleapis.com/css?family=Lancelot" rel="stylesheet" type="text/css"&gt;</code>', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Google font-family code -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[font][font_family_code]">
          <?php _e( '<strong>Google web font</strong> font-family code', 'rustic' ); ?>
          </label></th>
        <td><textarea id="rustic_theme_options[font][font_family_code]"  cols="70" rows="4" name="rustic_theme_options[font][font_family_code]" /><?php  if ( isset($rustic_theme_options['font']['font_family_code']) && $rustic_theme_options['font']['font_family_code'] ) echo esc_textarea($rustic_theme_options['font']['font_family_code']); ?></textarea>
          </td><td>   <span class="description"> 
          <?php _e( 'Copy and paste <strong>Google web font</strong> font-family code here. Example: <br /><code>font-family: \'Lancelot\', cursive;</code>', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Change Font Color? -->
		<tr valign="top">
        <th scope="row">
          <?php _e( '<strong>Change font color?</strong>', 'rustic' ); ?>
          </th>
        <td><label for="rustic_theme_options[font][use_color]"><input name="rustic_theme_options[font][use_color]" type="checkbox" id="rustic_theme_options[font][use_color]" value="1" <?php if(isset($rustic_theme_options['font']['use_color'])) checked( $rustic_theme_options['font']['use_color'], 1 ); ?>  />
          <span class="description">
          <?php _e( 'Check to change font color.', 'rustic' ); ?>
          </span></label> </td>
		  <td>   <span class="description"> 
          <?php _e( 'Check this box to choose your own font color. Leave unchecked for default color (dark grey: 666666).', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Font Color -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[font][color]" >
          <?php _e( 'Font color', 'rustic' ); ?>
          </label></th>
        <td><input id="rustic_theme_options[font][color]" class="all-options" type="text" name="rustic_theme_options[font][color]" value="<?php  if ( isset($rustic_theme_options['font']['color']) && $rustic_theme_options['font']['color'] )  echo esc_attr( $rustic_theme_options['font']['color']); ?>" />
          </td><td>   <span class="description">
          <?php _e( 'Enter the hex value (6 characters long. Can use <strong>numbers 0-9</strong> and <strong>letters a-f</strong>) of the color you want for your text. (ex: indigo is 4b0082). Visit <a href="http://www.december.com/html/spec/colorhex.html" target="blank">This Color Chart</a> for more colors.', 'rustic' ); ?>
          </span> </td>
      </tr>
	  
	  <!-- Use Link Hover Color? -->
		<tr valign="top">
        <th scope="row">
          <?php _e( '<strong>Change link hover color?</strong>', 'rustic' ); ?>
          </th>
        <td><label for="rustic_theme_options[link][use_hover_color]"><input name="rustic_theme_options[link][use_hover_color]" type="checkbox" id="rustic_theme_options[link][use_hover_color]" value="1" <?php if(isset($rustic_theme_options['link']['use_hover_color'])) checked( $rustic_theme_options['link']['use_hover_color'], 1 ); ?>  />
          <span class="description">
          <?php _e( 'Check to change link hover color.', 'rustic' ); ?>
          </span></label> </td>
		  <td>   <span class="description"> 
          <?php _e( 'Check this box to choose your own link hover color. Leave unchecked for default color (maroon: 790000).', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Link Hover Color -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[link][hover_color]" >
          <?php _e( 'Link hover color', 'rustic' ); ?>
          </label></th>
        <td><input id="rustic_theme_options[link][hover_color]" class="all-options" type="text" name="rustic_theme_options[link][hover_color]" value="<?php if ( isset($rustic_theme_options['link']['hover_color']) && $rustic_theme_options['link']['hover_color'] )  echo esc_attr( $rustic_theme_options['link']['hover_color']); ?>" />
          </td><td>   <span class="description">
          <?php _e( 'Enter the hex value (6 characters long. Can use <strong>numbers 0-9</strong> and <strong>letters a-f</strong>) of the color you want to see when the cursor hovers over a link. (ex: blue is 0000ff). Visit <a href="http://www.december.com/html/spec/colorhex.html" target="blank">This Color Chart</a> for more colors.', 'rustic' ); ?>
          </span> </td>
      </tr>
	  
	  <!-- Use Logo Image? -->
		<tr valign="top">
        <th scope="row">
          <?php _e( '<strong>Use logo image?</strong>', 'rustic' ); ?>
          </th>
        <td><label for="rustic_theme_options[logo][use_logo_image]"><input name="rustic_theme_options[logo][use_logo_image]" type="checkbox" id="rustic_theme_options[logo][use_logo_image]" value="1" <?php if(isset($rustic_theme_options['logo']['use_logo_image'])) checked( $rustic_theme_options['logo']['use_logo_image'], 1 ); ?>  />
          <span class="description">
          <?php _e( 'Check to use logo image.', 'rustic' ); ?>
          </span></label> </td>
		  <td>   <span class="description"> 
          <?php _e( 'Check this box to use your own logo image. It will replace the site title and description.', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  <!-- Logo Image URL -->
      <tr valign="top">
        <th scope="row"><label for="rustic_theme_options[logo][image_uri]">
          <?php _e( 'Logo image URL', 'rustic' ); ?>
          </label></th>
        <td><textarea id="rustic_theme_options[logo][image_uri]"  cols="70" rows="4" name="rustic_theme_options[logo][image_uri]" /><?php  if ( isset($rustic_theme_options['logo']['image_uri']) && $rustic_theme_options['logo']['image_uri'] ) echo esc_textarea($rustic_theme_options['logo']['image_uri']); ?></textarea>
          </td><td>   <span class="description"> 
          <?php _e( 'Upload your logo image to the media library. Copy the "Location of the uploaded file" code and paste it in here. The URL of your logo image can also be found by going to Media->Library and clicking "Edit" under your logo image. Example: <br /><code>http://mysite.com/wordpress/wp-content/uploads/2011/11/my-logo-image.jpg</code>', 'rustic' ); ?>
          </span>
        </td>
      </tr>
	  
	  
	  
    </table>
	</fieldset>
    <!-- End General Settings -->
	
    <p class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'rustic' ); ?>" />
    </p>
  </form>
</div>
<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function rustic_theme_options_validate( $input ) {
	global $radio_options;

	
	// Our radio option must actually be in our array of radio options
	if ( ! isset( $input['radioinput'] ) )
		$input['radioinput'] = null;
	if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
		$input['radioinput'] = null;

	
	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/