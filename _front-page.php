<?php
/**
 * front-page.php
 *
 * @package oleinstrap
 * @author Olein-jp
 * @license GPL-2.0+
 */

get_header();
?>
<div id="primary" class="l-content-area">
	<main id="site-content" role="main">
		<?php
		/**
		 * @link http://wpdocs.osdn.jp/%E9%96%A2%E6%95%B0%E3%83%AA%E3%83%95%E3%82%A1%E3%83%AC%E3%83%B3%E3%82%B9/WP_Query
		 */
		$args = array(
//			'category_name' => '',
//			'posts_per_page' => 10,
//			'ignore_sticky_posts' => false,
		);
		$the_query = new WP_Query( $args );
		?>
		<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		<?php endwhile; endif; wp_reset_postdata(); ?>
	</main>
</div>

<?php
get_sidebar();
get_footer();
