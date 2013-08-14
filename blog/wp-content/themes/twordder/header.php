<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>


<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">google.load("jquery", "1.2.6")</script>

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/combo?2.6.0/build/reset-fonts-grids/reset-fonts-grids.css" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php 
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
wp_head(); 
?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

</head>
<body id="body">
<div id="<?php echo get_option('tw_page_width'); ?>" class="page <?php echo get_option('tw_layout_template'); ?>">
	<div id="hd">	
		<div class="yui-gf">
		    <div class="yui-u first">
				<div id="header">
                            <a href="<?php echo get_option('home'); ?>"><img class="logo" src="<?php bloginfo('template_directory'); ?>/images/default.gif" alt="" /></a>
				        <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('title'); ?></a></h1>
				        <p id="desc"><?php bloginfo('description'); ?></p>
				</div>
		    </div>
		    <div class="yui-g">
		       <div id="nav-padding">
		    	<div id="nav-wrapper" >
		    	       <div id="nav-overlay" class="wp-yui-menu"></div>
				<?php yui_wp_list_pages('title_li=&sort_column=menu_order');?>
			</div>
			</div>
		    </div>
		</div>
	</div>
	<div id="bd">	
