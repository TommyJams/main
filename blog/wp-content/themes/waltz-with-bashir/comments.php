<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.'); ?></p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->
<div id="cmts">
<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('0', '1', '%' );?> Comments</h3>
	<ol id="commentlist">
	<?php foreach ($comments as $comment) : ?>
		<li id="comment-<?php comment_ID() ?>">
        	<div class="avatar"><?php if ( function_exists ( 'get_avatar' ) ) { echo get_avatar ( $comment , '48' , '' ) ; } ?> </div>
            <div class="comment_content">
            	<div class="comment_meta"><?php comment_author_link() ?><?php if ($comment->comment_approved == '0') : ?><em><?php _e('(Your comment is awaiting moderation.)'); ?></em><?php endif; ?> @ <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_time('Y-m-d, H:i'); ?></a></div>
                <div class="comment_text"><?php comment_text() ?></div>
            </div>
            <div class="clearboth"></div>
		</li>
	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>
	<?php endforeach; /* end for each comment */ ?>
	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments"><?php _e('Comment Closed'); ?></p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<h3 id="addcomment"><?php _e('Leave a comment'); ?></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>
	<?php _e('You must be '); ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>"><?php _e('logged in'); ?></a><?php _e(' to post a comment.'); ?>
</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>
	<?php _e('Logged in as '); ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a><?php _e(' | '); ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Logout"><?php _e('Logout'); ?></a>
</p>

<?php else : ?>

<p>
	<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="" tabindex="1" /><label for="author"><?php _e('Name*'); ?></label>
</p>

<p>
	<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="" tabindex="2" /><label for="email"><?php _e('Email'); ?><?php if ($req) echo "Your Email"; ?></label>
</p>

<p>
	<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="" tabindex="3" /><label for="url"><?php _e('Site'); ?><?php if ($req) echo " (Your Blog)"; ?></label>
</p>

<?php endif; ?>

<p>
	<textarea name="comment" id="comment" cols="40" rows="10" tabindex="1"></textarea>
</p>

<p>
	<input name="submit" type="submit" id="submit" tabindex="5" value="Submite" />
	<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; ?>

<?php endif; ?>
</div>