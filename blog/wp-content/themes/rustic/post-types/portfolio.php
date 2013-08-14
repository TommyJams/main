<?php
/**
*Register post type "portfolio-item".
**/
add_action('init', 'rustic_portfolio_init');

function rustic_portfolio_init() 
{
	$portfolio_item_labels = array(
		'add_new_item' => __('Add New Portfolio Item', 'rustic'),
		'edit_item' => __('Edit Portfolio Item', 'rustic'),
		'new_item' => __('New Portfolio Item', 'rustic'),
		'view_item' => __('View Portfolio Item', 'rustic'),
		'search_items' => __('Search Portfolio Items', 'rustic'),
		'not_found' => __('No portfolio items found', 'rustic'),
		'not_found_in_trash' => __('No portfolio items found in Trash', 'rustic')
	);
	
	$portfolio_item_args = array(
		'label' => __('Portfolio Items', 'rustic'),
		'labels' => $portfolio_item_labels,
		'singular_label' => __('Porfolio Item', 'rustic'),
		'public' => true,
		'capability_type' => 'page',
		'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments') 
		
	);
	
	register_post_type('portfolio-item', $portfolio_item_args);
	
	
/**
* Register taxonomies "portfolio" and "portfolio-tag".
**/
	
	$portfolio_labels = array(
		'name' => _x('Portfolios', 'taxonomy general name', 'rustic'),
		'all_items' => __('All Portfolios', 'rustic'),
		'add_new_item' => __('Add New Portfolio', 'rustic'),
		'new_item_name' => __('New Portfolio Name', 'rustic')
	);
	
	$portfolio_args = array(
		'labels' => $portfolio_labels,
		'hierarchical' => true
	);
	
	register_taxonomy( 'portfolio', 'portfolio-item', $portfolio_args );
	
	
	$portfolio_tag_labels = array(
		'name' => _x('Portfolio Tags', 'taxonomy general name', 'rustic'),
		'all_items' => __('All Portfolio Tags', 'rustic'),
		'add_new_item' => __('Add New Portfolio Tag', 'rustic'),
		'new_item_name' => __('New Portfolio Tag Name', 'rustic')
	);
	
	$portfolio_tag_args = array(
		'labels' => $portfolio_tag_labels,
		'hierarchical' => true
	);
	
	register_taxonomy( 'portfolio-tag', 'portfolio-item', $portfolio_tag_args );
	
	flush_rewrite_rules();//Fix 404 issue when viewing taxonomy archive pages (i.e. portfolios).
} // end rustic_portfolio_init...


/**
* Customize admin pages.
**/


function rustic_portfolio_item_column_names($columns){
    
    $columns = array(
        "cb" => "<input type=\"checkbox\" />",
        "title" => "Portfolio Item",
        "rustic_portfolio" => "Portfolio",
        "rustic_portfolio_tags" => "Portfolio Tags",
        "rustic_portfolio_item_thumbnail" => "Portfolio Item Thumbnail"
    );

    return $columns;
}

function rustic_portfolio_item_column_contents($column){
    global $post;
    switch ($column){

        case "rustic_portfolio" :

            $portfolios = get_the_terms($post->ID, "portfolio");
            $portfolio_names = array();
            if($portfolios) {
                foreach ($portfolios as $portfolio)
                    array_push($portfolio_names, $portfolio->name);

                echo implode($portfolio_names, ", ");
            } else {
                _e("Not in Portfolio", "rustic");
            }
            break;

        case "rustic_portfolio_tags" :

            $portfolios = get_the_terms($post->ID, "portfolio-tag");
            $portfolio_names = array();
            if($portfolios) {
                foreach ($portfolios as $portfolio)
                    array_push($portfolio_names, $portfolio->name);

                echo implode($portfolio_names, ", ");
            } else {
                _e("No Portfolio Tags", "rustic");
            }
            break;

         case "rustic_portfolio_item_thumbnail" :
             
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('portfolio-admin');
            } else {
                print __('Please select a featured image.', 'rustic');
            }
            break;

    }
}

add_filter("manage_edit-portfolio-item_columns", "rustic_portfolio_item_column_names");
add_action("manage_posts_custom_column", "rustic_portfolio_item_column_contents");

/**
* Meta boxes.
**/

add_action("admin_init", "rustic_portfolio_meta_box_init");  
add_action('save_post', 'rustic_update_portfolio');  

 


function rustic_update_portfolio(){

	global $post; 

  // to prevent metadata or custom fields from disappearing...
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    return; 
	
	if(isset($_POST["_rustic_portfolio_media_link"]))	 
    	update_post_meta($post->ID, "_rustic_portfolio_media_link", $_POST["_rustic_portfolio_media_link"]);
}


//Run on the admin_init hook...
function rustic_portfolio_meta_box_init(){
	
	add_meta_box( 'portfolio1', __('How to Make a Portfolio', 'rustic'), 'rustic_portfolio_meta_box1', 'portfolio-item', 'normal', 'high'); 
}

/*META BOX 1*/

function rustic_portfolio_meta_box1(){ 

	$custom_fields = get_post_custom();  
	$portfolio_media_link = $custom_fields["_rustic_portfolio_media_link"][0];
	
?>  
    
	
	<span><?php _e('<i>Step-by-Step Instructions on</i> <b>How to Make a Portfolio:</b><br><br>
<b>1. ( First Step )</b> The first step is to choose the image that will appear in your portfolio as a thumbnail image. Click "Set featured image" (see box in right column). Click the "<b>From Computer</b>" tab (<b>From Computer</b> is important because it lets Rustic make the right size image. Images in the Media Library won\'t work.), then press "Select Files" button. After you choose the image, be sure to click <b>"Use as featured image"</b> instead of "Insert into Post". Click the "File URL" button and copy the <b>Link URL</b>. Close by pressing the "x" in the upper right corner.<br><br>
<b>2.</b> Put the full link to your media item into the <b>Media Link</b> box below. This is what will be in your gallery, and will open in a light-box when the Featured Image is clicked. Either use the <b>Link URL</b> from the last step, or choose another link from the "Media"  section of the WordPress admin. In the Media section you can click "edit" for the media item and you will see the link labled as <b>"File URL"</b>. Most types of media will work, including images, music mp3\'s, video mp4\'s and Flash flv files. Links to YouTube videos work too! (see <b>Valid Media Links:</b> below )<br><br>
<b>3.</b> Choose a "Portfolio" or make a new one (see <b>Portfolios</b> box in right column). Portfolios are similar to a Categories used to hold portfolio items.<br><br> 
<b>4.</b> Write something about your portfolio item in the box above. This is the post that will appear when the "<b>Read More</b>" link is clicked. Give the post a title and press Publish.<br><br>
<b>5.</b> Continue to make <b>Portfolio Items</b> to fill your portfolio. Remember to select one or more <b>Portfolios</b> before publishing.<br><br>
<b>6.</b> After you are satisfied that you have enough items in your portfolio, go to <b>Appearance->Menus</b> in the WordPress admin and put your portfolio in the menu. Save the menu and make sure the correct menu is selected in "<b>Theme Locations</b>" box.<br><br>
<b>7. ( Final Step! )</b> Look for your portfolio in the main menu. Click the link and admire you\'re beautiful new portfolio!<br><br>
<b>Valid Media Links:</b><br><br>

 Images<br><br>
<code>http://www.mysite.com/wp-content/uploads/2011/11/my_image.jpg</code><br><br>

 YouTube Video</b><br><br>
<code>http://www.youtube.com/watch?v=YCdFFFAxLz0</code><br><br>

 Vimeo Video</b><br><br>
<code>http://vimeo.com/32619535</code><br><br>

 MP3 Files</b><br><br>
<code>http://www.mysite.com/wp-content/uploads/2011/11/my_song.mp3</code><br><br>

 Flash SWF Files</b> (note: <b>width and height must be attached</b>)<br><br>
<code>http://www.mysite.com/wp-content/uploads/2011/11/my_flashfile.swf<b>?width=600&height=300</b></code><br><br>

 FLV FlashVideo Files</b> (note: <b>width and height must be attached</b>)<br><br>
<code>http://www.mysite.com/wp-content/uploads/2011/11/my_flashvideo.flv<b>?width=480&height=270</b></code><br><br>

 MP4 Video Files</b> (note: <b>width and height must be attached</b>)<br><br>
<code>http://www.mysite.com/wp-content/uploads/2011/11/my_video.mp4<b>?width=1280&height=720</b></code><br><br>

<b>Media Link</b>', "rustic"); ?></span><br>
	
	<textarea class="attachmentlinks" name="_rustic_portfolio_media_link"><?php echo esc_textarea($portfolio_media_link); ?></textarea><br>
	
<?php  }
