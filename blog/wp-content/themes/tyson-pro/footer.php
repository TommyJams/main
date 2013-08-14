<?php
/**
 * @package WordPress
 * @subpackage Tyson
 */
?>

<div id="footer">

<div class="foot1">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_left') ) : ?>   
<li>
<h3>friends &amp; links</h3>
<ul>
 <?php wp_list_bookmarks('title_li=&categorize=0'); ?>
</ul>
</li>
<?php endif; ?>
</ul>
</div><!-- /foot1 -->

<div class="foot2">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_middle') ) : ?> 
<li>
<h3>Pages</h3>
<ul>
 <?php wp_list_pages('title_li='); ?>
</ul>
</li>
<?php endif; ?>
</ul>
</div><!-- /foot2 -->

<div class="foot3">
<ul>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_right') ) : ?> 
<li>
<h3>Monthly archives</h3>
<ul>
 <?php wp_get_archives('type=monthly&limit=5'); ?>
</ul>
</li>
<?php endif; ?>
</ul>
</div><!-- /foot3 -->
     
<div class="cleared"></div>
</div><!-- /footer -->


<div id="credits">
<div id="creditsleft">
Powered by <a href="http://wordpress.org/extend/themes/">Wordpress</a></div>
<!-- /creditsleft -->
        
<div id="creditsright">Design by - <a href="http://hairtyson.com">Hair Tyson</a></div>
<!-- /creditsright -->
<div class="cleared"></div>
</div><!-- /credits -->

<?php wp_footer(); ?>
</div><!-- /wrapper -->

</body>
</html>
