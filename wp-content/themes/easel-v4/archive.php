<?php
/**
* Archive pages
* @package Canvas
**/
get_header(); ?>

<main id="main" class="site-main" role="main">

	<?php
	if ( have_posts() ) : ?>

		<?php

		// Start the Loop
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>

</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>