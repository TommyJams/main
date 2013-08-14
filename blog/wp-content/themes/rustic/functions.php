<?php
/**
 * Rustic functions and definitions (adapted from theme twentyten).
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, rustic_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Rustic 
 * @since Rustic 1.0 
 */
 // Load up our awesome theme options (no trees etc.)
//require_once ( get_stylesheet_directory() . '/theme-options.php' );
require_once ( get_template_directory() . '/theme-options.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 650;
/**
* Portfolio Setup.
*/
include_once(TEMPLATEPATH . '/helpers/rustic-portfolio-prettyphoto-link.php');
include_once(TEMPLATEPATH . '/post-types/portfolio.php');

include_once(TEMPLATEPATH . '/helpers/rustic-pagination.php');//Pagination

function change_number_of_posts($query) {//modify portfolio items per page...'pre_get_posts' hook is alternative to query_posts which caused pagination problem.
	if ( is_tax(array('portfolio','portfolio-tag')) ){ // only on portfolio/portfolio-tag archives pages.
		global $rustic_theme_options; 
		$query->query_vars['posts_per_page'] = $rustic_theme_options['portfolio']['items_per_page'];// the number of portfolio items to show.
	} 
	return $query; // return modified/unmodified query.
}
add_filter('pre_get_posts', 'change_number_of_posts');


function rustic_scripts_init() {//Load scripts on 'init' hook.
	wp_enqueue_script('rustic_prettyphoto_script', get_template_directory_uri().'/prettyphoto/js/jquery.prettyPhoto.js', array('jquery'));
	wp_enqueue_script('rustic_superfish_script', get_template_directory_uri().'/js/superfish.js', array('jquery'));//Portfolio hover effect.
	wp_enqueue_script('rustic_custom_script', get_template_directory_uri().'/js/custom.js', array('jquery'));//keep last in list
}

function rustic_print_styles(){//Load stylesheets on 'wp_print_styles' hook.
	wp_enqueue_style( 'rustic_prettyphoto_stylesheet', get_template_directory_uri().'/prettyphoto/css/prettyPhoto.css');
	}
	
if (!is_admin()  ) { // Won't load scripts/styles on admin pages.
	add_action('init', 'rustic_scripts_init');
	add_action('wp_print_styles', 'rustic_print_styles');
}

/** Tell WordPress to run rustic_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'rustic_setup' );

if ( ! function_exists( 'rustic_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override rustic_setup() in a child theme, add your own rustic_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses load_theme_textdomain() For translation/localization support.
 *
 * @since Rustic 1.0 
 */
function rustic_setup() {

	$GLOBALS['rustic_theme_options'] = get_option( 'rustic_theme_options' ); //set global theme options variable for use in templates and admin.
	
	//Use Featured Images in Portfolios as thumbnails.
	add_theme_support( 'post-thumbnails', array( 'portfolio-item' ) );
	
	/*add_image_size( 'portfolio', 280, 158, true );*/ // 16:9(widescreen)...
	add_image_size( 'blog-200', 200, 133, true ); // 3:2(print)...
	add_image_size( 'portfolio-admin', 130, 73, true ); // 16:9(widescreen)...

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'rustic', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'rustic' ),
	) );

	
}
endif;

function rustic_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'rustic_page_menu_args' );

/**
 * Sets the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Rustic 1.0
 * @return int
 */
function rustic_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'rustic_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Rustic 1.0
 * @return string "Continue Reading" link
 */
function rustic_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'rustic' ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and rustic_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Rustic 1.0
 * @return string An ellipsis
 */
function rustic_auto_excerpt_more( $more ) {
	return ' &hellip;' . rustic_continue_reading_link();
}
add_filter( 'excerpt_more', 'rustic_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Rustic 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function rustic_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= rustic_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'rustic_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Rustic's style.css.
 *
 * @since Rustic 1.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function rustic_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'rustic_remove_gallery_css' );

if ( ! function_exists( 'rustic_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own rustic_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Rustic 1.0
 */
function rustic_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard"> <?php echo get_avatar( $comment, 40 ); ?> <?php printf( __( '%s <span class="says">says:</span>', 'rustic' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
    <!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em>
    <?php _e( 'Your comment is awaiting moderation.', 'rustic' ); ?>
    </em> <br>
    <?php endif; ?>
    <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'rustic' ), get_comment_date(),  get_comment_time() ); ?>
      </a>
      <?php edit_comment_link( __( '(Edit)', 'rustic' ), ' ' );
			?>
    </div>
    <!-- .comment-meta .commentmetadata -->
    <div class="comment-body">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply -->
  </div>
  <!-- #comment-##  -->
  <?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'rustic' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __('(Edit)', 'rustic'), ' ' ); ?>
  </p>
  <?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars.
 *
 * To override rustic_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Rustic 1.0
 * @uses register_sidebar
 */
function rustic_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'rustic' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'rustic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'rustic' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'rustic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
/** Register sidebars by running rustic_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'rustic_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Rustic 1.0
 */
function rustic_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'rustic_remove_recent_comments_style' );

if ( ! function_exists( 'rustic_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Rustic 1.0
 */
function rustic_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'rustic' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'rustic' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'rustic_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Rustic 1.0
 */
function rustic_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'rustic' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'rustic' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'rustic' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;