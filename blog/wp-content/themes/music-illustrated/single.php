<?php get_header(); ?>
<?php $options = get_option('inove_options'); ?>

<?php if (have_posts()) : the_post(); update_post_caches($posts); ?>

	<div id="postpath">
		<a title="<?php _e('Go to homepage', 'inove'); ?>" href="<?php echo get_settings('home'); ?>/"><?php _e('Home', 'inove'); ?></a>
		 &gt; <?php the_category(', '); ?>
		 &gt; <?php the_title(); ?>
	</div>

	<div class="post <?php if( in_category( "MusicLabs" ) ) print("specialPost"); elseif( in_category( "BanjaraTalkies" ) ) print("banjaraPost"); ?>" id="post-<?php the_ID(); ?>">
        <div class="date"><span><?php the_time('d') ?></span> <?php the_time('M') ?></div>
		<?php if( in_category( "MusicLabs" ) ) { ?>
			<div class="musicLabsDiv"></div>
			<h2 style="margin: 10px 0 10px 60px;">
		<?php } elseif( in_category( "BanjaraTalkies" ) ) { ?>
			<div class="banjaraDiv"></div>
			<h2 style="margin: 10px 0 10px 90px;">
 	        <?php } else {?>
			<h2>
		<?php } ?>
		<?php the_title();?>
			</h2>
		<div class="info">
			<span class="comments">By
				<?php
					if ( function_exists( 'coauthors_posts_links' ) ) {
						coauthors_posts_links();
					} else {
						the_author_posts_link();
					}
				?>
		    	</span>
                        <?php edit_post_link(__('Edit', 'inove'), '<span class="editpost">', '</span>'); ?>
           	         <!--<span class="comments"><?php comments_popup_link(__('No comments', 'inove'), __('1 comment', 'inove'), __('% comments', 'inove'), '', __('Comments off', 'inove')); ?></span>-->
                        <div class="fixed"></div>
                    </div>
		<div class="content">
			<?php the_content(); ?>
            <?php wp_link_pages(); ?>
			<div class="fixed"></div>
		</div>
		<div class="under">
                        <?php if ($options['categories']) : ?><span class="categories"><?php _e('Categories: ', 'inove'); ?></span><span><?php the_category(', '); ?></span><?php endif; ?><br />
                        <?php if ($options['tags']) : ?><span class="tags"><?php _e('Tags: ', 'inove'); ?><?php the_tags('', ', ', ''); ?></span><?php endif; ?>
                    </div>
	</div>

	<!-- related posts START -->
	<?php
		// when related posts with title
		if(function_exists('wp23_related_posts')) {
			echo '<div id="related_posts">';
			wp23_related_posts();
			echo '</div>';
			echo '<div class="fixed"></div>';
		}
		/*
		// when related posts without title
		if(function_exists('wp23_related_posts')) {
			echo '<div class="boxcaption">';
			echo '<h3>Related Posts</h3>';
			echo '</div>';
			echo '<div id="related_posts" class="box">';
			wp23_related_posts();
			echo '</div>';
			echo '<div class="fixed"></div>';
		}
		*/
	?>
	<!-- related posts END -->

	<?php include('templates/comments.php'); ?>

	<div id="postnavi">
		<span class="prev"><?php next_post_link('%link') ?></span>
		<span class="next"><?php previous_post_link('%link') ?></span>
		<div class="fixed"></div>
	</div>

<?php else : ?>
	<div class="errorbox">
		<?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
	</div>
<?php endif; ?>

<?php get_footer(); ?>