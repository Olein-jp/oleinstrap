<?php
/**
 * Setting for comment
 */
function oleinstrap_comment_format( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment;
	extract( $args, EXTR_SKIP );
	?>
<li <?php comment_class( empty( $args[ 'has_children' ] ) ? 'comment-item' : 'comment-item comment-item_parent' ); ?> id="comment-id-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment">
	<header class="comment-item__header">
		<figure class="comment-item__gravatar">
			<?php echo get_avatar( $comment, 75 ); ?>
		</figure>
		<div class="comment-item__meta">
			<p class="comment-item__author">
				<?php comment_author(); ?>
				<?php if ( get_comment_author_url() ) : ?>
					<a href="<?php comment_author_url(); ?>" class="comment-item__author-link" itemprop="author"></a>
				<?php endif; ?>
			</p>
			<time class="comment-item__time" data-time="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date() ?> <?php comment_time() ?></time>
		</div>
	</header>
	<?php edit_comment_link('edit comment','',''); ?>
	<?php if ($comment->comment_approved == '0') : ?>
		<p class="comment-item__message">Your comment is awaiting moderation.</p>
	<?php endif; ?>
	<div class="comment-item__content" itemprop="text">
		<?php comment_text(); ?>
	</div>
	<div class="comment-item__reply-area">
		<?php comment_reply_link( array_merge( $args, array(
			'reply_text' => 'Reply',
			'add_below' => $add_below,
			'depth' => $depth,
			'max_depth' => $args['max_depth']
		) ) ); ?>
	</div>
<?php }
/**
 * replace reply link class
 */
add_filter('comment_reply_link', 'oleinstrap_replace_reply_link_class');
function oleinstrap_replace_reply_link_class( $class ){
	$class = str_replace("class='comment-reply-link", "class='comment-item__reply", $class);
	return $class;
}
/**
 * custom edit button for comment
 */
add_filter( 'edit_comment_link', 'oleinstrap_edit_comment_link' );
function oleinstrap_edit_comment_link( $link ) {
	$link = '<a class="comment-item__edit-button" href="' . esc_url( get_edit_comment_link( $comment ) ) . '">' . __( 'Edit comment', 'oleinstrap' ) . '</a>';
	return $link;
}
/**
 * custom comment form field
 */
add_filter( 'comment_form_default_fields', 'oleinstrap_comment_form_fields' );
function oleinstrap_comment_form_fields( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$fields    = array(
		'author' =>
			'<div class="form-group">' .
			'<label for="author" class="">' . __( 'Name', 'oleinstrap' ) . ( $req ? '<span class="u-text-danger">*</span>' : '' ) . '</label> ' .
			'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30"' . $aria_req . ' />' .
			'</div>',
		'email' =>
			'<div class="form-group">' .
			'<label for="email" class="">' . __( 'Email', 'oleinstrap' ) . ( $req ? '<span class="u-text-danger">*</span>' : '' ) . '</label> ' .
			'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			'" size="30"' . $aria_req . ' />' .
			'</div>',
		'url' =>
			'<div class="form-group">' .
			'<label for="url">' .
			__( 'Website', 'oleinstrap' ) . '</label>' .
			'<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" />' .
			'</div>',
	);
	return $fields;
}
/**
 * custom comment form
 */
add_filter( 'comment_form_defaults', 'oleinstrap_comment_form' );
function oleinstrap_comment_form( $args ) {
	$args[ 'title_reply' ]          = __( 'Leave a reply', 'oleinstrap' );
	$args[ 'title_reply_before' ]   = '<h3 id="reply-title" class="comment-respond__title">';
	$args[ 'title_reply_to' ]       = __( 'Leave a reply to %s', 'oleinstrap' );
	$args[ 'comment_notes_before' ] = '<p class="comment-respond__note"><span class="comment-respond__note__mail">' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>';
	$args[ 'comment_notes_after' ]  = __( '', 'oleinstrap' );
	$args[ 'label_submit' ]         = __( 'send', 'oleinstrap' );
	$args[ 'comment_field' ]        = '<div class="form-group">' .
	                                  '<label for="comment">' . __( 'Comment', 'oleinpressMedia' ) .
	                                  '</label>' .
	                                  '<textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true">' .
	                                  '</textarea>' .
	                                  '</div>';
	$args[ 'submit_field' ]         = '<div class="form-group_submit">%1$s %2$s</div>';
	$args[ 'submit_button' ]        = '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />';
	$args[ 'class_submit' ]         = 'form-control_submit';
	return $args;
}