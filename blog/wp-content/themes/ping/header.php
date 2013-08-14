<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage SwitchUp Studios
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ping' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href='http://fonts.googleapis.com/css?family=Jockey+One:normal' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
	global $ping_options;
	$ping_settings = get_option( 'ping_options', $ping_options );
?>
<!--[if IE 7]>
<style>
#search {
width:190px !important;
height:35px !important;
float:left !important;
}
</style>
<![endif]-->
<!--[if IE 8]>
<style>
.widget_search #s,
#s {/* This keeps the search inputs in line */
	line-height:24px;
	height:24px;
	padding:4px 30px 0 7px;
}
</style>
<![endif]-->


<!-- 
	This theme uses the 'site-color' picked in the theme-options page to set many different color values throughout the theme. These are all displayed below. If you would like another element to also use this color, add it to the corresponding lists below (background-color, color etc) or create your own! Remember to echo the color variable by using 'echo $ping_settings['site_color'];' within PHP brackets
--------------------------------------------->
<style>
#content .entry-title,
.hentry,
.facebook:hover,
.twitter:hover,
.rss:hover,
.widget-title,
#colophon,
#footer,
ins,
#header {
	background-color:#<?php echo $ping_settings['site_color']; ?>;
}
@-webkit-keyframes headeranimation {
        0%, 100% {
                background-color:#999;
        }
        50% {
                background-color:#<?php echo $ping_settings['site_color']; ?>;
        }
}
@-moz-keyframes headeranimation {
        0%, 100% {
                background-color:#999;
        }
        50% {
                background-color:#<?php echo $ping_settings['site_color']; ?>;
        }
}
#colophon {
	border:1px solid #<?php echo $ping_settings['site_color']; ?>;
}
#access ul ul {
	border-left:2px solid #<?php echo $ping_settings['site_color']; ?> ;
	border-right:2px solid #<?php echo $ping_settings['site_color']; ?> ;
	border-bottom:2px solid #<?php echo $ping_settings['site_color']; ?> ;
}
#access li:hover > a,
#access ul ul :hover > a,
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a,
.widget-title:hover,
a:link,
a:visited,
.navigation a:active,
.navigation a:hover {
	color:#<?php echo $ping_settings['site_color']; ?>;
}
</style>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="outermostwrapper">
<div id="outerwrapper">
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">
			<div id="branding" role="banner">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
                <div id="site-description"><?php bloginfo( 'description' ); ?></div>
                   
			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'ping' ); ?>"><?php _e( 'Skip to content', 'ping' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
                <ul class="menu">
                <li id="menumeta">
                <div id="search" class="widget-container widget_search">
                <?php get_search_form(); ?>
                </div>
                <a class="twitter" href="http://twitter.com/<?php echo $ping_settings['twitter']; ?>">Twitter</a>
                <a class="facebook" href="http://facebook.com/<?php echo $ping_settings['facebook']; ?>">Facebook</a>
                <a class="rss" href="<?php bloginfo('rss2_url'); ?>">RSS</a>
                </li>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'container' => false,  'items_wrap' => '%3$s', 'fallback_cb' => 'ping_fallback_menu' ) ); ?>
               </ul>
                              
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
