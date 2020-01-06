<?php
/**
 * The template for displaying comments
 *
 * @package Oleinstrap
 */

/*
 * If the current post is protected by a password and visitor has not yet entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
	<h4 class="comments-title">この投稿にはコメントがあります</h4>
	<?php the_comments_navigation(); ?>

	<ol class="comments-list">
		<?php wp_list_comments( array(
			'callback' => 'oleinstrap_comment_format',
		) ); ?>
	</ol>

	<?php
		the_comments_navigation();

		if ( ! comments_open() ) : ?>
		<p class="comments-title_no-comments">コメントはできません</p>
		<?php
		endif;
	endif;

	comment_form();
	?>
</div>
