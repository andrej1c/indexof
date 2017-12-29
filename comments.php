<div id="comments">

<?php
	if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) )
		die ('Please do not load this page directly. Thanks!');
        if (!empty($post->post_password)) {
            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
				?>
				<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
				<?php
				return;
            }
        }
		$oddcomment = 'alt';
?>

<?php if ($comments) : ?>

	<h4 id="comment-count">Comments <?php comments_number('(0)', '(1)', '(%)' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>

	<ol class="commentlist">
		<?php foreach ($comments as $comment) : ?>
		<li id="comment-<?php comment_ID() ?>" class="commentlist-comment <?php echo $oddcomment; ?>">
			<p class="comment-byline"><?php comment_author_link() ?> wrote:</p>
<?php if ($comment->comment_approved == '0') : ?>
			<em>Your comment is awaiting moderation.</em>
<?php endif; ?>
			<?php comment_text() ?>
			<p class="comment-metadata">Posted on <?php comment_date('d-M-y') ?> at <?php comment_time('g:i a') ?> <strong>|</strong> <a href="#comment-<?php comment_ID() ?>" title="Permalink to this comment" rel="permalink">Permalink</a> <?php edit_comment_link('Revise', ' <strong>|</strong> ', ''); ?></p>
		</li>

<?php
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'alt';
?>

<?php endforeach; ?>
	</ol>

<?php else : ?>

<?php if ('open' == $post->comment_status) : ?>
<?php else : ?>

	<p class="nocomments"></p>

<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>
	<h5 id="respond">Leave a Comment</h5>
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>" title="Log in">logged in</a> to post a comment.</p>
<?php else : ?>

	<div id="comment-formcontainer" class="formcontainer">
		<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" >

<?php if ( $user_ID ) : ?>

		<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" title="Logged in as <?php echo $user_identity; ?>"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log off as <?php echo $user_identity; ?>">Log off &raquo;</a></p>

<?php else : ?>

		<div class="formleft"><label for="author">Name:</label></div>
		<div class="formright"><input id="author" name="author" type="text" value="<?php echo $comment_author; ?>" tabindex="3" size="20" maxlength="20" /> <?php if ($req) echo "*Required"; ?></div>

		<div class="formleft"><label for="email">Email:</label></div>
		<div class="formright"><input id="email" name="email" type="text" value="<?php echo $comment_author_email; ?>" tabindex="4" size="20" maxlength="50" /> <?php if ($req) echo "*Required"; ?> (Never published)</div>

		<div class="formleft"><label for="url">Website:</label></div>
		<div class="formright"><input id="url" name="url" type="text" value="<?php echo $comment_author_url; ?>" tabindex="5" size="20" maxlength="50" /></div>

<?php endif; ?>

		<div class="formleft"><label for="comment">Message:</label></div>
		<div class="formright"><textarea id="comment" name="comment" tabindex="6" cols="45" rows="8"></textarea></div>

		<div class="formleft">&nbsp;</div>
		<div class="formright"><input id="submit" name="submit" type="submit" value="Submit" tabindex="7" /><input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" /></div>

		<?php do_action('comment_form', $post->ID); ?>

		</form>
	</div><!-- END FORMCONTAINER -->

<?php endif; ?>
<?php endif; ?>

</div><!-- END COMMENTS -->
