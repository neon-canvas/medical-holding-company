<?php
/**
* Canvas functions and definitions.
* @package Canvas
**/

if ( ! function_exists( 'canvas_setup' ) ) :

function canvas_setup() {

	// Make theme available for translation
	load_theme_textdomain( 'canvas', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	//Enable support for Post Thumbnails on posts and pages
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'canvas' ),
		'mobile-bar' => esc_html__( 'Mobile Bar', 'clientcanvas' ),
		'social' => esc_html__( 'Social', 'clientcanvas' )
	) );

	// Switch default core markup for search form, comment form, and comments to output valid HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature
	add_theme_support( 'custom-background', apply_filters( 'canvas_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'canvas_setup' );

// Allow SVG
add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
	global $wp_version;
	if ($wp_version == '4.7' || ((float) $wp_version < 4.7)) {
		return $data;
	}
	$filetype = wp_check_filetype($filename, $mimes);
	return ['ext' => $filetype['ext'], 'type' => $filetype['type'], 'proper_filename' => $data['proper_filename']];
}, 10, 4);

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml'; return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg() {
	echo ' <style type="text/css">.attachment-266x266, .thumbnail img { height: auto !important; width: auto !important; } </style>';
}
add_action('admin_head', 'fix_svg');

// Allow shortcodes in text widget
add_filter('widget_text', 'do_shortcode');

// Register widget area
function canvas_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'canvas' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'canvas' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'canvas_widgets_init' );

// Add page name to body class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

// Allow font size adjustments within the text editor
function wp_editor_fontsize_filter($buttons) {
        array_shift($buttons);
        array_unshift($buttons, 'fontsizeselect');
        array_unshift($buttons, 'formatselect');
        return $buttons;
}    
add_filter('mce_buttons_2', 'wp_editor_fontsize_filter');

// Load jQuery from Google
// function get_jquery() {
// 	if (!is_admin()) {
// 		wp_deregister_script('jquery');
// 		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '2.2.4');
// 		wp_enqueue_script('jquery');
// 		wp_deregister_script('jquery-ui-core');
// 		wp_register_script('jquery-ui-core', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', false, '1.12.1');
// 		wp_enqueue_script('jquery-ui-core');
// 	}
// }
// add_action('init', 'get_jquery');

// Enqueue scripts and styles
function canvas_scripts() {
	wp_enqueue_style( 'canvas-style', get_stylesheet_uri() );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/libs/jquery.js', array('jquery'), '', true);
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'scripts', get_template_directory_uri() . '/js/min/scripts.js', array('jquery'), '', true);
	wp_enqueue_script( 'scripts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'canvas_scripts' );

// Version CSS file in a theme
//wp_enqueue_style( 'canvas-style', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' ) );

// Version JS file in a theme
//wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/min/scripts.js', array(), filemtime( get_stylesheet_directory() . '/js/min/scripts.js' ) );

// Implement the Custom Header feature
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates
require get_template_directory() . '/inc/extras.php';

// Customizer additions
require get_template_directory() . '/inc/customizer.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );