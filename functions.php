<?php
/**
 * @package oleinstrap
 * @author Olein-jp
 * @license GPL-2.0+
 */

/**
 * sets up theme defaults and registers support for various WordPress features.
 */
function oleinstrap_theme_support() {
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

//	set_post_thumbnail( 1200, 9999 );
//	add_image_size( 'oleinpress-fullscreen', 1980, 9999 );

	add_theme_support( 'title-tag' );

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	add_theme_support( 'align-wide' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 640;
	}
}
add_action( 'after_setup_theme', 'oleinstrap_theme_support' );

/**
 * Register and Enqueue Styles.
 */
function oleinstrap_register_styles() {
	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'oleinstrap-style', get_stylesheet_uri(), array(), $theme_version );

}
add_action( 'wp_enqueue_scripts', 'oleinstrap_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function oleinstrap_register_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

//	wp_enqueue_script( 'oleinstrap-js', get_template_directory_uri() . '/assets/js/index.js', array( jquery ), $theme_version, true );
//	wp_script_add_data( 'oleinstrap-js', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'oleinstrap_register_scripts' );

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
 * Register menu
 */
function oleinstrap_menus() {
	$locations = array(
		'primary'  => 'Global Menu',
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'oleinstrap_menus' );

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
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function oleinstrap_sidebar_registration() {
	$shared_args = array(
		'before_title'  => '<h2 class="c-widget-title">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="c-widget %2$s"><div class="c-widget__content">',
		'after_widget'  => '</div></div>',
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => 'Sidebar',
				'id'          => 'sidebar-1',
				'description' => 'Widgets in this area will be displayed in the sidebar may be.',
			)
		)
	);
}
add_action( 'widgets_init', 'oleinstrap_sidebar_registration' );

/**
 * Enqueue classic editor styles.
 */
function oleinstrap_classic_editor_styles() {
	$classic_editor_styles = array(
		'/assets/css/editor-style-classic.css',
	);
	add_editor_style( $classic_editor_styles );
}
add_action( 'init', 'oleinstrap_classic_editor_styles' );

/**
 * including files
 */
//require get_template_directory() . '';