<?php
/**
* 404 error page
* @package Canvas
**/
get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<section class="not-found">
			<div class="section-wrap center">
				<h2 class="page-title"><?php esc_html_e( 'Oops! Looks like you&rsquo;ve gotten off track.', 'clientcanvas' ); ?></h2>
				<a class="btn" href="/">Go Home</a>
			</div>
		</section><!-- .error-404 -->

	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>