<?php
/**
* @package Canvas
**/
if (! is_active_sidebar( 'sidebar' ) ) {
	return;
} ?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside>