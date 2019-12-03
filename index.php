<?php
/**
 * index.php
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
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			?>
			<h2 class="p-post-title"><?php the_title(); ?></h2>

		<?php endwhile; ?>

			<?php the_posts_pagination(); ?>

		<?php else : ?>

			<p>記事がありません</p>

		<?php endif; ?>

	</main>
</div>

<?php
get_sidebar();
get_footer();
