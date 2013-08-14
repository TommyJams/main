<?php get_header(); ?>
    <div id="yui-main"> 
		<div class="yui-b">
		              <div class="main-wrapper">
			       <div id="main-overlay"></div>
				<div id="content" class="narrowcolumn">
			     <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Header') ) : ?>
			     <?php endif; ?>
				<?php if (have_posts()) : ?>
			
					<?php while (have_posts()) : the_post(); ?>
			
						<div class="post <?php (function_exists('sticky_class') == 1) ? sticky_class():'';  ?>" id="post-<?php the_ID(); ?>">
							<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
	  
	    <div class="alignleft f-left"> 
	   <small>by <strong><?php the_author_firstname() ?> <?php the_author_lastname() ?></strong> on <?php the_time('F jS, Y') ?> </small>
	        </div> 
	    <div class="alignright f-right"> 
	   <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?><img src="<?php bloginfo('template_url'); ?>/images/comment.png" alt="Comments" class="comment-img"/>
        </div> 
<div class="clear"></div>

							

			
							<div class="entry ">
								<?php the_content('Read Post &raquo;'); ?>
							</div>
			
							<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
<div class="clear"></div>
						</div>

			
					<?php endwhile; ?>
			
					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>
			
				<?php else : ?>
			
					<h2 class="center">Not Found</h2>
					<p class="center">Sorry, but you are looking for something that isn't here.</p>
					<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			
				<?php endif; ?>
			
				</div>
		    </div>
		</div>
	</div>
    <div id="sb" class="yui-b">
              <div class="sidebar-wrapper">
              <div id="sidebar-overlay"></div>
		<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
