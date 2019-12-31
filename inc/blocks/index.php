<?php
/**
 * Setting for extend and original blocks.
 *
 * @package oleinstrap
 */

function oleinstrap_blocks_enqueue() {
	wp_enqueue_script( 'oleinstrap-blocks-script',
		get_template_directory_uri() . '/inc/blocks/build/index.js',
		array( 'wp-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'oleinstrap_blocks_enqueue' );

function oleinstrap_blocks_styles() {
	wp_enqueue_style( 'oleinstrap-blocks-style',
		get_template_directory_uri() . '/inc/blocks/build/style.css' );
}
add_action( 'enqueue_block_assets', 'oleinstrap_blocks_styles' );