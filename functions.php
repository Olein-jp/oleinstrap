<?php
/**
 * @package oleinstrap
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * sets up theme support.
 *
 * @link   https://developer.wordpress.org/reference/functions/add_theme_support/
 * @link   https://developer.wordpress.org/themes/basics/theme-functions/
 * @link   https://developer.wordpress.org/reference/functions/load_theme_textdomain/
 * @link   https://github.com/WordPress/gutenberg/blob/master/docs/extensibility/theme-support.md
 */
add_action( 'after_setup_theme', function() {

	$GLOBALS['content_width'] = 640;

	add_theme_support( 'title-tag' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support( 'align-wide' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.min.css' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		)
	);

	add_theme_support( 'editor-color-palette', [
		[
			'name'  => __( 'Gray' ),
			'slug'  => 'gray',
			'color' => '#555555'
		],
		[
			'name'  => __( 'Red' ),
			'slug'  => 'red',
			'color' => 'red'
		]
	] );

	add_theme_support( 'editor-font-sizes', [
		[
			'name'      => __( 'Small' ),
			'shortName' => __( 'S' ),
			'size'      => 12,
			'slug'      => 'small'
		]
	] );

});

/**
 * Enqueue scripts/styles for the front end.
 */
add_action( 'wp_enqueue_scripts', function() {

	// Load WordPress' comment-reply script where appropriate.
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue main css style.
	wp_enqueue_style( 'oleinstrap-front-style', get_template_directory_uri() . '/assets/css/front-style.min.css', null, null );

	// Enqueue main JavaScript.
	wp_enqueue_script( 'oleinstrap-js', get_template_directory_uri() . '/assets/js/index.js', array( jquery ), null, true );

});

/**
 * Enqueue scripts/styles for the editor.
 */
//add_action( 'enqueue_block_editor_assets', function() {

	// Enqueue theme editor styles.
	// wp_enqueue_style( 'oleinstrap-editor-style', get_template_directory_uri() . '/assets/css/editor-block.min.css', null, null );

	// Unregister core block and theme styles.
	//	wp_deregister_style( 'wp-block-library' );
	//	wp_deregister_style( 'wp-block-library-theme' );

	// Re-register core block and theme styles with an empty string. This is
	// necessary to get styles set up correctly.
	//	wp_register_style( 'wp-block-library', '' );
	//	wp_register_style( 'wp-block-library-theme', '' );

//});


/**
 * Register menus.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
add_action( 'init', function() {
	$locations = array(
		'primary'  => 'Global Menu',
	);
	register_nav_menus( [
		'primary'  => esc_html_x( 'Global Menu', 'nav menu location' )
	] );
}, 5 );

/**
 * Register image sizes.
 *
 * @link   https://developer.wordpress.org/reference/functions/set_post_thumbnail_size/
 * @link   https://developer.wordpress.org/reference/functions/add_image_size/
 */
add_action( 'init', function() {

//	Set the 'post thumbnail' size
//	set_post_thumbnail_size( 200, 100, true );

//	Register custom image sizes.
//	add_image_size( 'oleinstrap-medium', 750, 422, true );
});

/**
 * Fix skip link focus in IE11
 */
function oleinstrap_skip_link_focus_fix() {
	?>
	<script>
        /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'oleinstrap_skip_link_focus_fix' );

/**
 * about wp_body_open
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Shim for wp_body_open, ensuring backwards compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function oleinstrap_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#site-content">' . __( 'Skip to the content', 'oleinstrap' ) . '</a>';
}
add_action( 'wp_body_open', 'oleinstrap_skip_link', 5 );

/**
 * Register sidebars.
 *
 * @link   https://developer.wordpress.org/reference/functions/register_sidebar/
 * @link   https://developer.wordpress.org/reference/functions/register_sidebars/
 */
add_action( 'widgets_init', function() {
	$args = [
		'before_title'  => '<h3 class="c-widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<section class="c-widget %2$s"><div class="c-widget__content">',
		'after_widget'  => '</div></section>',
	];

	register_sidebar( [
		'id' => 'primary',
		'name' => esc_html_x( 'Primary', 'sidebar' )
	] + $args );
} );

/**
 * including files
 */
//require get_template_directory() . '';