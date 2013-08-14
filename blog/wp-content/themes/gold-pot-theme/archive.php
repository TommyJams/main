<?php
/**
 * @package WordPress
 * @subpackage Gold_Pot_Theme
 */
get_header();
?>

<?php if (have_posts()) : ?>

		<h2 class="pagetitle searchtitle">Archives</h2>
	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<p class="queryBlog">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</p>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<p class="queryBlog">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</p>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<p class="queryBlog">Archive for <?php the_time('F jS, Y'); ?></p>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<p class="queryBlog">Archive for <?php the_time('F, Y'); ?></p>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<p class="queryBlog">Archive for <?php the_time('Y'); ?></p>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<p class="queryBlog">Author Archive</p>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<p class="queryBlog">Blog Archives</p>
 	  <?php } ?>
		
<?php while (have_posts()) : the_post(); ?>


<div <?php post_class() ?> id="post-<?php the_ID(); ?>">

<div class="storyheader <?php if(is_single()) : ?>singlepost<?php endif; ?>">
		<h3 class="storytitle"><span class="storyComment"><?php comments_popup_link(__('0'), __('1'), __('%'), 'on', 'off'); ?></span><span class="postDate"><?php echo strftime('%m.%d.%y',strtotime(get_the_time('m/d/Y'))); ?></span> <span class="titleName"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></span></h3>
		<div class="meta"><?php the_author() ?> to <?php the_category(',') ?> <?php the_tags(__('&#8212; Tags: '), ', ', ''); ?>  &nbsp;<?php edit_post_link(__('<strong>Edit This</strong>')); ?></div>
	</div>
</div>

<?php endwhile; else: ?>
		<h2 class="pagetitle searchtitle">No Search Results Found</h2>
			<small class="queryBlog">Try a different search.</small>
		<div class="searchboxbody">
		<?php get_search_form(); ?>
		</div>
<?php endif; ?>

<div class="navi">
	<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
	<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
</div>

</div>

<?php get_footer(); ?>
