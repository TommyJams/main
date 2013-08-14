<?php
/**
 * @package WordPress
 * @subpackage Gold_Pot_Theme
 */
?>
<!-- begin sidebar -->
<div id="menu">

<ul>
<?php 	/* Widgetized sidebar, if you have the plugin installed. */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
	<?php wp_list_pages('title_li=' . __('Pages')); ?>
	<?php wp_list_bookmarks('title_after=&title_before='); ?>
	<?php wp_list_categories('title_li=' . __('Categories')); ?>

 <li id="archives"><?php _e('Archives'); ?>
	<ul>
	 <?php wp_get_archives('type=monthly'); ?>
	</ul>
 </li>
 <li id="meta"><?php _e('Meta'); ?>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS'); ?>"><?php _e('<abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>'); ?></a></li>
		<li><a href="http://validator.w3.org/check/referer" title="<?php _e('This page validates as XHTML 1.0 Transitional'); ?>"><?php _e('Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr>'); ?></a></li>
		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		<li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.'); ?>"><abbr title="WordPress">WP</abbr></a></li>
		<?php wp_meta(); ?>
	</ul>
 </li>
<?php endif; ?>
<li>Powered by
	<ul>
		<li><a href="http://www.wordpress.org/" title="Wordpress">WordPress</a><!--<?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. --></li>
		<li><a href="http://www.etrecos.com/" title="Gold Pot Theme created by eTrecos">Gold Pot Theme</a></li>	
	</ul></li>

</ul>




</div>
<!-- end sidebar -->
