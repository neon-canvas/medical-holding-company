<?php
/**
* @package Canvas
**/
?>

</div>

<footer>
	<div class="footer-top">
		<div class="row">
			<div class="col-xs-12 col-sm-6 consult-cta">
				<div class="consult-wrapper">
					<h3>Schedule a Free Consult</h3>
					<?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6 contact-col">
				<div class="contact-info">
					<div class="row">
						<div class="col-xs-12 col-sm-5">
							<a href="/" class="logo">
								<img src="/wp-content/themes/easel-v4/img/logo.png" alt="logo">
							</a>
						</div>
						<div class="col-xs-12 col-sm-4">
							<h5>Our Location</h5>
							<ul>
								<li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> 111 Address Way <br/>Memphis, TN 38138</a></li>
								<li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> 111-222-3333</a></li>
							</ul>
						</div>
						<div class="col-xs-12 col-sm-3 sm-col">
							<h5>Follow Us</h5>
							<ul>
								<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i> <em>facebook</em></a></li>
								<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i> <em>instagram</em></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="credits">
		<p class="copy">&copy; <span class="year"></span> <?php echo get_bloginfo('name'); ?>. All Rights Reserved. &nbsp; | &nbsp; <a href="/privacy-policy">Privacy Policy</a> &nbsp; | &nbsp; Site by <a href="https://neoncanvas.com">Neon Canvas</a></p>
	</div>
</footer>

<div class="theme-picker">
	<span class="cta-text">Choose a Look</span>
	<ul class="options">
		<li><a href="http://neonnow4.wpengine.com/">Madison</a></li>
		<li><a href="https://neonnow5.wpengine.com/">Yates</a></li>
		<li><a href="https://neonnow6.wpengine.com/">McLean</a></li>
		<li><a href="https://neonnow7.wpengine.com/">Paxton</a></li>
		<li><a href="http://neonnowtheme3.wpengine.com/">Union</a></li>
		<li><a href="http://neonnowtheme2.wpengine.com/">Cooper</a></li>
		<li><a href="http://neonnowtheme1.wpengine.com/">Walnut Grove</a></li>
	</ul>
</div>

<?php // Mobile bar (if you want a convenient way for users to navigate on smaller devices) ?>
<div class="mobile-bar">
	<?php wp_nav_menu( array( 'theme_location' => 'mobile-bar', 'menu_id' => 'mobile-bar' ) ); ?>
</div>

<?php wp_footer(); ?>

</body>
</html>