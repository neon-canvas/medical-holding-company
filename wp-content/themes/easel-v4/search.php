<?php
/**
* Search results pages.
* @package Canvas
**/
get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	if ( have_posts() ) : ?>

		<?php

		// Start the Loop
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'search' );

		endwhile;

		wp_pagenavi();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>