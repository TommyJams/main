<?php
/**
 * @package WordPress
 * @subpackage Gold_Pot_Theme
 */
get_header();
?>

<?php if (have_posts()) : ?>

		<h2 class="pagetitle searchtitle">Search Results</h2>
		<?php if (is_search()) { ?>
			<p class="queryBlog">You have searched the blog archives for <strong>'<?php the_search_query(); ?>'</strong>.</p>
		<?php } ?>

		
<?php while (have_posts()) : the_post(); ?>


<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="storyheader <?php if(is_single()) : ?>singlepost<?php endif; ?>">
		<h3 class="storytitle"><span class="storyComment"><?php comments_popup_link(__('0'), __('1'), __('%'), 'on', 'off'); ?></span><span class="postDate"><?php echo strftime('%m.%d.%y',strtotime(get_the_time('m/d/Y'))); ?></span> <span class="titleName"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></span></h3>
		<div class="meta"><?php the_author() ?> to <?php the_category(',') ?> <?php the_tags(__('&#8212; Tags: '), ', ', ''); ?>  &nbsp;<?php edit_post_link(__('<strong>Edit This</strong>')); ?></div>
	</div>
</div>

<?php endwhile; else: ?>
		<h2 class="searchtitle">No Search Results Found</h2>
		<p class="queryBlog">Try a different search?</p>
		<?php get_search_form(); ?>
<?php endif; ?>

<div class="navi">
	<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>

</div>

<?php get_footer(); ?>
