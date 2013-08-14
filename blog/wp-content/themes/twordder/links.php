<?php
/*
Template Name: Links
*/
?>

<?php get_header(); ?>
    <div id="yui-main"> 
		<div class="yui-b">
		<div class="main-wrapper">
			       <div id="main-overlay"></div>
				<div id="content" class="widecolumn">
				
				<h2>Links:</h2>
				<ul>
				<?php wp_list_bookmarks(); ?>
				</ul>
				
				</div>
		</div>
		</div>
	</div>
    <div  id="sb" class=" yui-b">
                <div class="sidebar-wrapper">
              <div id="sidebar-overlay"></div>
		<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>
