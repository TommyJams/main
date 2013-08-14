<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Rustic
 * @since Rustic 1.0
 */
?>
	
	</div><!-- #main -->
	<div id="footer" role="contentinfo">
	
	
	
	<div id="little-menu"><?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
		<p class="pat">Theme Rustic 2.1.x by <a href="http://bannerfish.biz">Patrick Bagby</a><br/>Powered by <a href="http://wordpress.org">WordPress</a></p>
	</div><!-- #little-menu -->
		<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
	</div><!-- #footer -->
</div><!-- #wrapper -->


</body>
</html>
