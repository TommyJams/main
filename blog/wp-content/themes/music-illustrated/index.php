<?php get_header(); ?>
<?php
	$options = get_option('inove_options');
	if (function_exists('wp_list_comments')) {
		add_filter('get_comments_number', 'comment_count', 0);
	}
?>

			<?php if ($options['notice'] && $options['notice_content']) : ?>
                <div class="post" id="notice">          
                    <div class="content">
                        <?php echo($options['notice_content']); ?>
                        <div class="fixed"></div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
                <div class="post <?php if( in_category( "MusicLabs" ) ) print("specialPost"); else if( in_category( "BanjaraTalkies" ) ) print("banjaraPost"); ?>" id="post-<?php the_ID(); ?>">
                    <div class="date"><span><?php the_time('d') ?></span> <?php the_time('M') ?></div>
    		    <?php if( in_category( "MusicLabs" )) { ?>
			<div class="musicLabsDiv"></div>
			<h2 style="margin: 10px 0 10px 60px;">
    		    <?php } else if( in_category( "BanjaraTalkies" )) { ?>
			<div class="banjaraDiv"></div>
			<h2 style="margin: 10px 0 10px 90px;">
		    <?php } else {?>
			<h2>
		    <?php } ?>
			    <a class="title" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    
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
                        <!--<span class="comments"><?php /*comments_popup_link(__('No comments', 'inove'), __('1 comment', 'inove'), __('% comments', 'inove'), '', __('Comments off', 'inove'));*/ ?></span>-->
                        <div class="fixed"></div>
                    </div>
                    <div class="content">
                        <?php the_content(__('Read more...', 'inove')); ?>
                        <?php wp_link_pages(); ?>
                        <div class="fixed"></div>
                    </div>
                    <div class="under">
                        <?php if ($options['categories']) : ?><span class="categories"><?php _e('Categories: ', 'inove'); ?></span><span><?php the_category(', '); ?></span><?php endif; ?><br />
                        <?php if ($options['tags']) : ?><span class="tags"><?php _e('Tags: ', 'inove'); ?><?php the_tags('', ', ', ''); ?></span><?php endif; ?>
                    </div>
                </div>
            <?php endwhile; else : ?>
                <div class="errorbox">
                    <?php _e('Sorry, no posts matched your criteria.', 'inove'); ?>
                </div>
            <?php endif; ?>
            
            <div id="pagenavi">
                <?php if(function_exists('wp_pagenavi')) : ?>
                    <?php wp_pagenavi() ?>
                <?php else : ?>
                    <span class="newer"><?php previous_posts_link(__('Newer Entries', 'inove')); ?></span>
                    <span class="older"><?php next_posts_link(__('Older Entries', 'inove')); ?></span>
                <?php endif; ?>
                <div class="fixed"></div>
            </div>


<?php get_footer(); ?>