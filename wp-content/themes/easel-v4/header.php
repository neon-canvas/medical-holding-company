<?php
/**
* @package Canvas
**/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php // Favicons/application icons ?>
	<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#0e958b">

	<!-- Font Scripts -->
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,700;1,400&family=Roboto:wght@400;700&display=swap" rel="stylesheet">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>

	<?php // Logo ?>
	<a href="/" class="logo">
		<img src="/wp-content/themes/easel-v4/img/moga-quad-logos-v2.jpg" alt="logo">
	</a>

	<?php // Mobile menu ?>
	<!-- <a class="menu-toggle">
		<div class="menu-text">Menu</div>
		<span></span>
	</a> -->

	<?php // On smaller devices, the main menu will appear here ?>

	<!-- <nav id="side-menu">
		<?php // wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		<div class="contact-info">
			<a href="/free-consult" class="btn">Free Consult</a>
			<h5>Contact Us</h5>
			<p><a href="#" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i> 111 Address Way<br/>
			Memphis, TN 38138</a></p>
			<p><a href="#"><i class="fa fa-phone" aria-hidden="true"></i> 111-222-3333</a></p>
		</div>
	</nav> -->

	<!-- <a href="#" class="phone-cta"><i class="fa fa-phone" aria-hidden="true"></i> 111-222-3333</a>

	<a href="/free-consult" class="btn cta-btn">Free Consult</a> -->

</header>

<div id="page" class="site">