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
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="p-post-title">
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
				<ul class="p-post-meta">
					<li class="p-post-meta__item">
						date: <?php the_time( get_option( 'data_format' ) ); ?>
					</li>
					<li class="p-post-meta__item">
						category: <?php the_category( ', ' ); ?>
					</li>
					<li class="p-post-meta__item">
						tag: <?php the_tags( '', ', ', '' ); ?>
					</li>
					<?php
					/*
					 *
					 */
					?>
				</ul>
				<?php the_post_thumbnail(); ?>
				<div class="p-post-content">
					<?php the_content(); ?>
				</div>

			</article>

		<?php endwhile; ?>

			<?php the_posts_pagination(); ?>
		<?php
		/*
		 * Plugin: WP-Pagenaviを利用する場合は
		 * <div class="p-pagenavi">
		   <?php wp_pagenavi(); ?>
           </div>
		 *
		 *
		 */
			?>

		<?php else : ?>

			<p>記事がありません</p>

		<?php endif; ?>

	</main>
</div>

<?php
get_sidebar();
get_footer();
