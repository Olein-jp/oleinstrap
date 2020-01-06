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
		<main id="site-content" class="container" role="main">
		<?php
		while ( have_posts() ) :
			the_post();
		?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="p-post-title"><?php the_title(); ?></h2>
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
				</ul>
				<?php the_post_thumbnail(); ?>
				<div class="p-post-content">
					<?php the_content(); ?>
				</div>
				<?php
				$prev_post = get_previous_post();
				$next_post = get_next_post();
				/*
				同じカテゴリーに属する記事だけをナビゲートしたい場合には、
				previous_post_link('<div class="p-posts-navigation__item previous">%link</div>','%title', true );
				第３引数にtrueを入れる
				参照：https://www.nxworld.net/wordpress/wp-navigation-in-same-term.html
				*/
				if( $next_post || $prev_post ) :
					?>
					<div class="p-posts-navigation">
						<h2 class="screen-reader-text">Posts navigation</h2>
						<?php previous_post_link('<div class="p-posts-navigation__item previous">%link</div>','%title'); ?>
						<?php next_post_link('<div class="p-posts-navigation__item next">%link</div>','%title'); ?>
					</div>
				<?php endif; ?>
			</article>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		<?php endwhile; ?>
		</main>
	</div>

<?php
get_sidebar();
get_footer();
