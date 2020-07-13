<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package clientcanvas
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
	<section class="content article">
		<div class="container">
			<div class="featured-image">
				<?php the_post_thumbnail(); ?>
			</div>
			<h1 class="post-title"><?php the_title(); ?></h1>
			<span class="post-date"><?php echo get_the_date(); ?></span>			
			<div class="entry-content">
				<?php the_content(); ?>				
			</div>
			<div class="related-posts">
				<?php $orig_post = $post;
				global $post;
				$categories = get_the_category($post->ID);
				if ($categories) {
				$category_ids = array();
				foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

				$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> 3, // Number of related posts that will be shown.
				'caller_get_posts'=>1
				);

				$my_query = new wp_query( $args );
				if( $my_query->have_posts() ) {
				echo '<div id="related_posts"><h3>Also Worth Checking Out</h3><ul class="row">';
				while( $my_query->have_posts() ) {
				$my_query->the_post();?>

				<li class="col-xs-12 col-sm-4"><div class="relatedthumb"><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a></div>
				<div class="relatedcontent">
					<span class="post-date"><?php the_time('M j, Y') ?></span>
					<h3><a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				</div>
				</li>
				<?
				}
				echo '</ul></div>';
				}
				}
				$post = $orig_post;
				wp_reset_query(); ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();