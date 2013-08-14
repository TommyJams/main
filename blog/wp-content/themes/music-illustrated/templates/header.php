<!-- header START -->
<div id="header">

	<!-- banner START -->
	<?php if( $options['banner_content'] && (
		($options['banner_registered'] && $user_ID) || 
		($options['banner_commentator'] && !$user_ID && isset($_COOKIE['comment_author_'.COOKIEHASH])) || 
		($options['banner_visitor'] && !$user_ID && !isset($_COOKIE['comment_author_'.COOKIEHASH]))
	) ) : ?>
		<div class="banner">
			<?php echo($options['banner_content']); ?>
		</div>
	<?php endif; ?>
	<!-- banner END -->

	<div id="caption">
		<h1 id="title"><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<div id="tagline"><?php bloginfo('description'); ?></div>
	</div>

	<div class="fixed"></div>
</div>
<!-- header END -->

<!-- navigation START -->
<div id="navigation">
	<!-- menus START -->
	<ul id="menus">
		<li class="page_item"><a class="home" title="<?php _e('Home', 'inove'); ?>" href="http://www.tommyjams.com"><?php _e('Home', 'inove'); ?></a>
		</li>
		<li class="<?php echo($home_menu); ?>"><a class="home" title="<?php _e('Blog', 'inove'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Blog', 'inove'); ?></a>
		</li>
		<li class="<?php echo($musiclabs_menu); ?>"><a class="home" title="<?php _e('MusicLabs', 'inove'); ?>" href="<?php echo get_settings('home'); ?>/category/musiclabs/"><?php _e('MusicLabs', 'inove'); ?></a>
		</li>
		<li class="<?php echo($banjara_menu); ?>"><a class="home" title="<?php _e('BanjaraTalkies', 'inove'); ?>" href="<?php echo get_settings('home'); ?>/category/banjaratalkies/"><?php _e('BanjaraTalkies', 'inove'); ?></a>
		</li>
		<?php
			if($options['menu_type'] == 'categories') {
				wp_list_categories('title_li=0&orderby=name&show_count=0');
			} else {
				wp_list_pages('title_li=0&sort_column=menu_order');
			}
		?>
	</ul>
	<!-- menus END -->



	<div class="fixed"></div>
</div>
<!-- navigation END -->