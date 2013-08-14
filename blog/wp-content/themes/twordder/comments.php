<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if ( post_password_required() ) { ?>
	<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
<?php
	return;
}

// add a microid to all the comments
function comment_add_microid($classes) {
	$c_email=get_comment_author_email();
	$c_url=get_comment_author_url();
	if (!empty($c_email) && !empty($c_url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
		$classes[] = $microid;
	}
	return $classes;	
}
add_filter('comment_class','comment_add_microid');

// show the comments
if ( have_comments() ) : ?>
	<div class="yui-g"> 
		<div class="yui-u first">
			<h2 id="comments">Comments</h2><a href="<?php the_permalink(); ?>feed"><img class="comment-rss" src="<?php bloginfo('template_url'); ?>/images/Feed_16x16.png" alt="Feed" /></a>
		</div>
		<div class="yui-u a-right trackback-wrapper">
			<span class="trackback">Trackback URL <input type="text" value="<?php trackback_url(); ?>"/></span>
		</div>
	</div>
	<ul class="commentlist" id="singlecomments">
	<?php wp_list_comments(array('callback'=>'twordder_comment')); ?>
	</ul>
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) :
		// If comments are open, but there are no comments.
	else : 
		// comments are closed 
	endif;
endif; 

if ('open' == $post-> comment_status) : 

// show the form
?>
<div class="clear"></div>
<div id="respond"><h3><?php comment_form_title('Leave Comment'); ?></h3>

<div id="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
<a href="<?php echo wp_logout_url(); ?>" title="Log out of this account">Logout &raquo;</a></p>

<?php else : ?>

<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
<label for="author"><small>Name <?php if ($req) echo "(required)"; ?></small></label></p>
<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
<label for="email"><small>Email <?php if ($req) echo "(required)"; ?></small></label></p>
<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
<label for="url"><small>Website</small></label></p>

<?php endif; ?>
<?php comment_id_fields(); ?>
<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
	<div class="yui-g">
    	<div class="yui-u first">

<p><textarea name="comment" id="comment" cols="10" rows="10" tabindex="4"></textarea></p>

</div>
 <div class="yui-u">
 	<h3 id="co-title">Commenting Options</h3>

<?php do_action('fbc_display_login_button') ?>

  
<div id="get-avatar">Alternatively, you can <a href="http://en.gravatar.com/">create an avatar</a> that will appear whenever you leave a comment on a Gravatar-enabled blog.
</div>
	</div>
	</div>


<?php if (get_option("comment_moderation") == "1") { ?>
 <p><small><strong>Please note:</strong> Comment moderation is enabled and may delay your comment. There is no need to resubmit your comment.</small></p>
<?php } ?>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>
<?php do_action('comment_form', $post->ID); ?>

</form>
<?php endif; ?>
</div>
<?php 
endif;
