<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package clientcanvas
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-sm-4">
	<div class="post-wrap">
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );?>
		<div class="post-image" style="background-image: url('<?php echo $image[0]; ?>');"></div>
		<div class="entry-footer">
			<span class="date"><?php the_date(); ?></span>
			<?php the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
			if ( 'post' === get_post_type() ) : ?>
			<?php endif; ?>
		</div>
	</div>
</article>
