<?php
/**
 * @package WordPress
 * @subpackage Gold_Pot_Theme
 */
get_header();
?>

<?php if (have_posts()) : 
		if(is_single()){ ?>

		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
		
<?php }
while (have_posts()) : the_post(); ?>


	<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
	
		<div class="storyheader <?php if(is_single()) : ?>singlepost<?php endif; ?>">
			<h3 class="storytitle"><span class="storyComment"><?php comments_popup_link(__('0'), __('1'), __('%'), 'on', 'off'); ?></span><span class="postDate"><?php echo strftime('%m.%d.%y',strtotime(get_the_time('m/d/Y'))); ?></span> <span class="titleName"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></span>		
			</h3>
			<div class="meta"><span class="<?php if(is_page()) : ?>hidden<?php endif; ?>"><?php the_author() ?> to <?php the_category(',') ?> <?php the_tags(__('&#8212; Tags: '), ', ', ''); ?></span>  &nbsp;<?php edit_post_link(__('<strong>Edit This</strong>')); ?></div>
		</div>	
		
		<div class="storycontent <?php if(is_single()) : ?>singlepost<?php endif; ?>">
			<?php the_content(__('(more...)')); ?>
			<?php wp_link_pages(array('before' => '<p>Pages: ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
	
	</div>

<?php comments_template(); // Get wp-comments.php template ?>

<?php endwhile; else: ?>
<h2 class="searchtitle">Not Found</h2>
		<p class="queryBlog">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
<?php endif; ?>

<div class="navi">
	<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>

</div>

<?php get_footer(); ?>
