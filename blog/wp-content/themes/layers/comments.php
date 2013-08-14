<?php // Do not delete these lines
	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';


/* You can start editing here. */
 ?>
<?php if ($comments) : ?>
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist" >

	<?php foreach ($comments as $comment) : ?>

		<li <?php if ($comment->user_id === $post->post_author) echo 'class="hilight"'; else echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">
        <div class="vcard">
<?php if(function_exists('get_avatar')){ ?> <?php echo get_avatar($comment, '33'); } ?>
			<cite><span class="fn n"><?php comment_author_link() ?></span></cite> Says:
			<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
			<?php endif; ?>
			<br />

			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></small>

			<?php comment_text() ?>
        </div><!-- End vcard -->
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

        <p class="nocomments">No comments yet</p>

	 <?php else : // comments are closed ?>
		<!-- If comments are closed and also there are no comments -->
		<!-- Do nothing! <p class="nocomments">Comments are closed.</p> -->

	<?php endif; ?>
<?php endif; ?>



<?php if ('open' == $post->comment_status) : ?>
<div id="response">
<h3 id="respond">Leave a Reply</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Logout &raquo;</a>

<?php else : ?>
<div class="input">
<label for="author">Name <?php if ($req) echo "(required)"; ?></label>
<input type="text" class="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />

<label for="email">Mail (will not be published) <?php if ($req) echo "(required)"; ?></label>
<input type="text" class="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />

<label for="url">Website</label>
<input type="text" class="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
</div>
<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
<div class="message">
<label for="comment">Comment</label>
<textarea name="comment" id="comment" rows="8" cols="30" tabindex="4"></textarea>
</div> 

<div id="submitButton">
<input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</div>
<?php do_action('comment_form', $post->ID); ?>

</form>
</div>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>