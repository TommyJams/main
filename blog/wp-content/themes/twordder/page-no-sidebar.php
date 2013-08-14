<?php
/*
Template Name: Page No Sidebar
*/
?>
<?php get_header(); ?>
	<div class="yui-g">
	       <div class="main-wrapper-wide">
	       <div id="main-overlay"></div>
		<div id="content" class="narrowcolumn">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
			<h1><?php the_title(); ?></h1>
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
	
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	
				</div>
			</div>
			<?php endwhile; endif; ?>
		<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
		<?php comments_template(); ?>
		</div>
		</div>
	</div>
<?php get_footer(); ?>
