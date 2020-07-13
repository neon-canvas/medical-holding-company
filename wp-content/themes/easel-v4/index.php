<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package clientcanvas
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section class="banner">
		<div class="container-fluid">
			<div class="message-wrap">
				<div class="message-content">
					<h1>Our Blog</h1>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row top-xs">
				<div class="col-xs-12">
					<div class="row">
						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) : ?>

							<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
					<?php wp_pagenavi(); ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>