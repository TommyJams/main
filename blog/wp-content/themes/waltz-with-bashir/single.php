<?php get_header(); ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    	<div class="post">
            <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
            <div class="meta-above"><span class="meta-time"><?php the_time('Y-m-d H:i:s') ?></span><span class="meta-cat"><?php the_category(', ') ?></span><span class="meta-tag"><?php the_tags('Tag: ',' > '); ?></span></div>
            <div class="entry-content">
		<?php the_content(); ?>
            </div><!--entry-content end-->
            <div class="meta-below"><a href="<?php the_permalink() ?>#comments">Comments (<?php comments_number('0', '1', '%'); ?>)</a></div>
        </div><!--post end-->
        <div class="nav">
            <div class="next"><?php next_post_link('%link &raquo;') ?></div>        
        	<div><?php previous_post_link('&laquo; %link') ?></div>
        </div><!--nav end-->
	<?php comments_template(); // Get wp-comments.php template ?>
	<?php endwhile; else: ?>
	<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>        
        </div><!--main end-->                                        
    </div><!--left end-->
	
<?php include(TEMPLATEPATH."/sidebar.php"); ?>
<?php get_footer(); ?>