<?php
/**
 * Theme Setup Functions and Definitions.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */

// Include Hybrid Core.
require_once( trailingslashit( get_template_directory() ) . 'hybrid-core/hybrid.php' );

add_action( 'after_setup_theme', 'creativepress_setup', 10 );
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since   1.0.0
 * @return  void
 */
function creativepress_setup() {
	// http://themehybrid.com/docs/theme-layouts
	add_theme_support(
		'theme-layouts',
		array( 'default' => is_rtl() ? '2c-r' :'2c-l' )
	);

	// http://themehybrid.com/docs/hybrid_set_content_width
	hybrid_set_content_width( 1140 );

	// http://codex.wordpress.org/Automatic_Feed_Links
	add_theme_support( 'automatic-feed-links' );

	// http://themehybrid.com/docs/hybrid-core-styles
	add_theme_support( 'hybrid-core-styles', array( 'style', 'google-fonts', ) );

	// https://developer.wordpress.org/themes/functionality/navigation-menus/
	register_nav_menus( array(
		'primary'   => _x( 'Primary Menu', 'nav menu location', 'creativepress' ),
		'secondary' => _x( 'Secondary Menu', 'nav menu location', 'creativepress' ),
		'social'    => _x( 'Social Menu', 'nav menu location', 'creativepress' ),
		'footer'    => _x( 'Footer Menu', 'nav menu location', 'creativepress' ),
	) );

	// https://developer.wordpress.org/themes/functionality/post-formats/
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat',
	) );

	// https://github.com/justintadlock/breadcrumb-trail
	add_theme_support( 'breadcrumb-trail' );

	// https://github.com/justintadlock/get-the-image
	add_theme_support( 'get-the-image' );

	// http://themehybrid.com/docs/template-hierarchy
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

}

add_action( 'after_setup_theme', 'creativepress_includes', 10 );
/**
 * Load all required theme files.
 *
 * @since   1.0.0
 * @return  void
 */
function creativepress_includes() {
	// Set the includes directories.
	$includes_dir = trailingslashit( get_template_directory() ) . 'includes/';

	// Load all PHP files in the vendor directory.
	require_once $includes_dir . 'vendor/tha-theme-hooks.php';

	// Load all PHP files in the includes directory.
	require_once $includes_dir . 'compatibility.php';
	require_once $includes_dir . 'general.php';
	require_once $includes_dir . 'scripts.php';
	require_once $includes_dir . 'widgets.php';
	require_once $includes_dir . 'template.php';
	require_once $includes_dir . 'customize.php';
}

// Add a hook for child themes to execute code.
do_action( 'creativepress_after_setup_parent' );
