<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>
    <div id="yui-main"> 
		<div class="yui-b">
		              <div class="main-wrapper">
			       <div id="main-overlay"></div>
				<div id="content" class="widecolumn">
				
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				
				<h2>Archives by Month:</h2>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
				
				<h2>Archives by Subject:</h2>
					<ul>
						 <?php wp_list_categories(); ?>
					</ul>
				
				</div>
				</div>
		
		</div>
	</div>
    <div  id="sb" class="yui-b">
              <div class="sidebar-wrapper">
              <div id="sidebar-overlay"></div>
		<?php get_sidebar(); ?>
		</div>
	</div>
<?php get_footer(); ?>
