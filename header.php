<?php
/**
 * header.php
 *
 * @package oleinstrap
 * @author Olein-jp
 * @license GPL-2.0+
 */
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header id="site-header" class="l-site-header" role="banner">
		<?php
		if ( is_front_page() && is_home() ) :
		?>
		<h1 class="p-site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>
		<?php else : ?>
		<p class="p-site-title">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php bloginfo( 'name' ); ?>
			</a>
		</p>
		<?php endif; ?>
	</header>

	<!--
	if you use Hamburgers, control package on npm. check package.json
	@link https://jonsuh.com/hamburgers/
	@link https://www.npmjs.com/package/hamburgers
	-->
	<button
		class="hamburger hamburger--elastic"
		type="button"
		aria-label="Menu"
		aria-controls="navigation">
		<span class="hamburger-box">
			<span class="hamburger-inner"></span>
		</span>
	</button>
	<?php
	wp_nav_menu( array(
		'theme_location' => 'menu-1',
		'menu_id'        => 'primary-menu',
		'container'      => 'nav',
		'container_id'   => 'navigation',
		'container_class' => 'p-global-menu'
	) );
	?>

	<div id="content" class="l-site-content">