<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to rustic_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Rustic
 * @since Rustic 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'rustic' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'rustic' ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rustic' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rustic' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use rustic_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define rustic_comment() and that will be used instead.
					 * See rustic_comment() in rustic/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'rustic_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'rustic' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'rustic' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>


<?php endif; // end have_comments() ?> 


<?php //2.1.3 requirement
	if ( ! comments_open() ) : // Comments Closed. 
	
		if ( is_single() ){ //Show message for all posts. ?> 
			<p>Comments are closed.</p>
		<?php } 
		
		elseif ( is_page() && have_comments() ) { //Show message for pages that already have comments. ?>
			<p><?php _e( 'Comments are closed.', 'rustic' ); ?></p>
		<?php }
	
 endif; // end 2.1.3 requirement ?>


<?php comment_form(); ?>

</div><!-- #comments -->
