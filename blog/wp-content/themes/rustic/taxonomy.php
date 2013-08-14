<?php 
global $rustic_theme_options;
get_header();


$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term_name = $term->name;
$term_taxonomy = $term->taxonomy;

if($term_taxonomy == 'portfolio-tag'){  
    $page_title = 'Tag: '.$term_name;
} else {    
    $page_title = $term_name;
}


$post_num = 1;
?>

		
<div id="container" class="one-column<?php if($rustic_theme_options['portfolio']['style'] != 'wood') { echo " no-wood-frame"; } ?>">
			<div id="content" role="main">
	
	
	<h1><?php echo $page_title; ?></h1>
	
	
	
	<div class="page-description">
		<?php echo category_description(); ?>
	</div>
	
	
	
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <?php
        
        $input_link = get_post_meta($post->ID, '_rustic_portfolio_media_link', true);
       

        $prettyphoto_link = rustic_portfolio_prettyphoto_link($input_link); 
        ?>
        
        <div class="one-third portfolio-item<?php if($post_num % 3 == 0) { echo " last"; }  ?>">
        	
        	
			
	       
            <a href="<?php echo $prettyphoto_link; ?>" title="<?php the_title(); ?>" class="portfolio-thumbnail"  rel="prettyPhoto[gallery]">
	        	<?php the_post_thumbnail('blog-200'); ?>
            </a>

    
	        
            <h4><?php the_title(); ?></h4> 
            
	        
            <p>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
						<?php _e("Read More", "rustic"); ?>
				</a>
			</p>
                
			
			<!-- end of item -->
        	
	    </div><!-- portfolio-item -->
		
		<?php if($post_num % 3 == 0) : ?>
        <!-- end of row -->
        <br style="clear:both;" />
        <?php endif; ?>

        <?php $post_num++; ?>

        <?php endwhile; ?>
		
    <?php endif; ?>
		
	<!-- end of portfolio items -->
        <br style="clear:both;" />	
		
	<?php rustic_pagination(); ?>
	</div><!-- #content -->
</div><!-- #container -->



<?php get_footer(); ?>