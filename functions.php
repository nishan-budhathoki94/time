<?php
/**
 * Time functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Time
 */

if ( ! function_exists( 'time_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function time_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Time, use a find and replace
	 * to change 'time' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'time', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'time' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'time_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'time_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function time_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'time_content_width', 640 );
}
add_action( 'after_setup_theme', 'time_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function time_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Sidebar', 'time' ),
		'id'            => 'sidebar_1',
		'description'   => esc_html__( 'Add widgets here.', 'time' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4><span>',
		'after_title'   => '</span></h4>',
	) );

}

add_action( 'widgets_init', 'time_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function time_scripts() {

	wp_enqueue_style( 'time-style', get_stylesheet_uri() );

	wp_enqueue_style( 'time-custom-style', get_template_directory_uri() .'/css/custom-style.css', array(), '20160831', true );

	wp_enqueue_style( 'time-google-font', 'https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700', false );

	wp_enqueue_style( 'time-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false );

	wp_enqueue_script( 'time-jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', array(), '1.8.2', true );

	/* bxSlider Javascript file */
	wp_enqueue_script( 'time-bxslider', get_template_directory_uri() .'/js/jquery.bxslider.min.js', array(), '20160831', true );

	wp_enqueue_script( 'time-navigation', get_template_directory_uri() . '/js/jquery-nav.js', array(), '20160831', true );

	wp_enqueue_script( 'time-parallax', get_template_directory_uri() . '/js/jquery.parallax-1.1.3.js', array(), '1.1.3', true );

	wp_enqueue_script( 'time-main-js', get_template_directory_uri() . '/js/main.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Enqueue syle for custom color
	$time_custom_css = '';
	$time_custom_color_css = '';
	$time_primary_color = esc_attr(get_theme_mod('time_primary_color', '#c83434' ));
	$time_hover_color = esc_attr(get_theme_mod('time_hover_color', '#c83434' ));
	$time_custom_css = get_theme_mod('time_custom_css_text','');
	$time_custom_color_css = '

				a {
			    	color: '.$time_primary_color.';
				}

				a:hover {
    				color: '.$time_hover_color.';
				}

				#site-navigation ul li a:hover {
					color: '.$time_hover_color.';
				}

				#site-navigation ul.sub-menu > li:hover > a {
     				color: '.$time_hover_color.';
				}

				.btn-wrapper a:hover{
     				background-color: '.$time_hover_color.';
 				}

 				.service-inner-part .entry-content .btn-wrapper a:hover {
    				 background-color: '.$time_hover_color.';
 				}

 				.feature-part .entry-content .btn-wrapper a:hover {
     				background-color: '.$time_hover_color.';
 				    border-color: '.$time_primary_color.';
				}

				.blog-inner-content .entry-content .btn-wrapper a:hover {
    			 	color: '.$time_hover_color.';
				}

				.copyright p span a:hover {
     				color: '.$time_hover_color.';
				}

				#site-navigation .menu-toggle:hover:before {
        			color: '.$time_hover_color.';
     			}

		        #site-navigation ul.sub-menu li > ul.sub-menu li a:hover {
         			color: '.$time_hover_color.';
 				}

 				.btn-wrapper a {
    				border-color: '.$time_primary_color.';
				}

 				.service-inner-part .entry-content .btn-wrapper a {
    				color:'.$time_primary_color.';
				}

 				.clients-name span {
     				color:'.$time_primary_color.';
 				}

 				form .contact-content-wrap .btn-wrapper input {
     				background-color: '.$time_primary_color.';
				}
 	';

 	wp_add_inline_style( 'time-custom-style', $time_custom_color_css );

 	wp_add_inline_style( 'time-style', $time_custom_css );
	
}
add_action( 'wp_enqueue_scripts', 'time_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load the widgets file
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Load the widgets file
 */
require get_template_directory() . '/inc/aq_resizer.php';

//registering image size
add_image_size( 'post', '373', '265', true);

add_image_size( 'feature', '232', '232',true);

add_image_size( 'service', '172', '115',true);

//Maintaining the excerpt
function time_custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'time_custom_excerpt_length', 999 );


