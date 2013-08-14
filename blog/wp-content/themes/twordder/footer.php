	</div>
	<div id="ft">
	  <div class="footer-wrapper">
	     <div id="footer-overlay"></div>
	     <div id="footer-content">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
			<p>&copy; <?php echo date('Y').' ';bloginfo('name'); ?>&nbsp;&nbsp;
<?php endif; ?>
				<a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
				| <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.

                    &nbsp;&nbsp;Theme by <a href="http://johndturner.com">johndturner.com</a>
			</p></div></div>
	</div>
</div>
	<?php wp_footer(); ?>
</body>
</html>
