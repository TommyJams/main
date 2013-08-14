<?php
/**
 * @package WordPress
 * @subpackage Gold_Pot_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>


<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<!--[if IE]>
	<style type="text/css">
	.storytitle span.storyComment .on {top:3px !important;}
	</style>
	<![endif]-->
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body>

<div id="topHeader">
<div id="topContainer">
	<ul id="web2">
		<li><a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/home.gif" alt="Go to Homepage" /></a></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/feed_icon.gif" alt="My RSS" /></a></li>
		<li><a id="wp_twitter_id" href="http://twitter.com/" ><img src="<?php echo get_template_directory_uri() ?>/images/twitter_feed.gif" alt="My Twitter" /></a></li>
		<li><a id="wp_facebook_id" href="http://www.facebook.com/"><img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.gif" alt="My Facebook" /></a></li>
	</ul>
	<div id="searchBox">
		<?php get_search_form(); ?>
	</div>
</div>
</div>

<div id="rap">
<h1 id="header"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><span class="description"><?php bloginfo('description'); ?></span></h1>
<div id="content">
<div id="contentContainer">
<!-- end header -->
