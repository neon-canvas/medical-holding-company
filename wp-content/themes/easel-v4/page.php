<?php
/**
 * @package clientcanvas
 */

get_header(); ?>

<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<main id="main" class="site-main" role="main">
	<section class="banner default-banner" style="background-image: url('<?php echo $image[0]; ?>');">
		<div class="default-banner-wrapper">
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<section class="content">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>
	</section>

</main>

<?php get_footer(); ?>
