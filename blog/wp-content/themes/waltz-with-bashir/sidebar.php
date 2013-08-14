    <div id="right">
    	<ul>
		<?php 	/* Widgetized sidebar, if you have the plugin installed. */

		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
            <li>
            	<h3>Categories</h3>
                <ul>
                <?php wp_list_categories('title_li=&show_count=1'); ?> 
                </ul>
            </li>
        	<li>
            	<h3>Recent Posts</h3>
                <ul>
				<?php get_archives('postbypost', 5); ?>
                </ul>
            </li>
            	<li>
                	<h3>Random Posts</h3>
                    <ul class="sidebar_content">
						<?php if (have_posts()) : ?>
						<?php query_posts(array('orderby' => 'rand', 'showposts' => 5)); ?>
						<?php while (have_posts()) : the_post(); ?>                
						<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
						<?php endwhile; ?>
						<?php endif; ?>		
                    </ul>
                </li> 	
            <li>
            	<h3>Archives</h3>
                <ul>
                <?php wp_get_archives('type=monthly&limit=12'); ?>
                </ul>
            </li>
        	<li>
            	<h3>Links</h3>
              	<ul>              	
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
                </ul>
            </li>
<?php endif; ?>					
            <li>
              	<ul>  
                	<h3>Meta</h3>
            	<li>&copy;2009 <a href="<?php echo get_settings('home'); ?>"><?php bloginfo('name'); ?></a></li>
            	<li>Designed By <a href="http://www.geli.me" title="Geli's Blog">GeLi</a> &middot; <a href="http://www.geli.me/blog/waltz.html"  title="Wordpress Theme: Waltz With Bashir">Waltz</a></li>
            	<li>Powered By <a href="http://www.wordpress.org" target="_blank">Wordpress</a></li>
                </ul>
            </li> 	
	
        </ul>      
    </div><!--right end-->