<?php get_header(); ?>
    <div id="yui-main"> 
		<div class="yui-b">
		              <div class="main-wrapper">
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
	</div>
    <div  id="sb" class="yui-b">
                  <div class="sidebar-wrapper">
                    <div id="sidebar-overlay"></div>
			<div id="sidebar">
		          <ul>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Sidebar') ) : ?>
					
		<?php endif; ?>
                    </ul>
               </div>
               </div>
	</div>
<?php get_footer(); ?>
