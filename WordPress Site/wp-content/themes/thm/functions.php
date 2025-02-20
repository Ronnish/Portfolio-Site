<?php
/**
 * Mindset Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mindset_Starter
 */

if ( ! function_exists( 'mindset_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mindset_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Mindset Starter, use a find and replace
		 * to change 'mindset' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mindset', get_template_directory() . '/languages' );

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
		add_image_size( 'square', 300, 300 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'mindset' ),
			'footer'=> esc_html__( 'Footer Menu Location', 'mindset'),
			'social'=> esc_html__( 'Social Menu Location', 'mindset'),
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

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
endif;
add_action( 'after_setup_theme', 'mindset_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mindset_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mindset_content_width', 1000 );
}
add_action( 'after_setup_theme', 'mindset_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mindset_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mindset' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mindset' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Contact Page Sidebar', 'mindset' ),
		'id'            => 'contact-widget-area',
		'description'   => esc_html__( 'Add widgets here.', 'mindset' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mindset_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mindset_scripts() {
    wp_enqueue_style( 'mindset-googlefonts', 'https://fonts.googleapis.com/css?family=Open+Sans');

	wp_enqueue_style( 'mindset-style', get_stylesheet_uri() );

	wp_enqueue_script( 'mindset-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mindset-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    wp_enqueue_script( 
        'mindset-font-awesome',
        get_template_directory_uri() .'/fonts/fontawesome/js/fontawesome-all.min.js',
        array(),
        '20190122',
        true
    );

    //Run slick slider only on homepage
    if ( is_front_page()){
        wp_enqueue_script( 
            'jquery-slickslider',
            get_template_directory_uri() .'/js/slick.min.js',
            array('jquery'),
            '20190122',
            true
        );
        wp_enqueue_script( 
            'jquery-slickslider-settings',
            get_template_directory_uri() .'/js/slick-settings.js',
            array('jquery-slickslider'),
            '20190122',
            true
        );
        wp_enqueue_style(
            'mindset-slicktheme',
            get_template_directory_uri() . '/css/slick-theme.css'
        );
        wp_enqueue_style(
            'mindset-slick',
            get_template_directory_uri() . '/css/slick.css'
        );
    }

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'mindset_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

//AdD Theme Color Meta Tag
function mindset_theme_color(){
	echo '<meta name="theme-color" content="#fff200">';
}
add_action('wp_head', 'mindset_theme_color');


//CPT & Taxonomy Registration

require get_template_directory() . '/inc/cpt-taxonomy.php';


 function custom_excerpt_length( $length ) {
	if(is_post_type_archive( 'student' )){
		return 25;
	}else{
		return 50;
	}
	
	 


}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


function mindset_excerpt_more( $more ) {
    return '... <a class="read-more" href="' . get_permalink() . '">Continue Reading</a>';
}
add_filter( 'excerpt_more', 'mindset_excerpt_more' );


function new_excerpt_more($more) {
	global $post;
 return '<a class="moretag" href="'. get_permalink($post->ID) . '"> Read more about the student...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

 
			   