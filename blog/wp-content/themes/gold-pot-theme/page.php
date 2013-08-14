<?php
/**
 * @package WordPress
 * @subpackage Mondo_Zen_Theme
 */

get_header(); ?>

	<div class="ispage">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				
				<div class="storyheader">
					<h3 class="storytitle"><span class="titleName"><?php the_title(); ?></span></h3>
					<div class="meta"><?php edit_post_link(__('<strong>Edit This</strong>')); ?></div>
				</div>	
				
				<div class="storycontent">
					<?php the_content(__('(more...)')); ?>
					<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				</div>

			</div>
	
			<?php comments_template(); // Get wp-comments.php template ?>			


		<?php endwhile; endif; ?>		

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>