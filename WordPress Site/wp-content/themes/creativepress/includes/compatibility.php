<?php
/**
 * Plugin Compatibility File
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */

add_action( 'after_setup_theme', 'creativepress_jetpack_setup', 12 );
/**
 * Make adjustments to the theme when Jetpack is installed and activated.
 *
 * @since  1.0.0
 * @return void
 */
function creativepress_jetpack_setup() {
	// Return early if Jetpack isn't activated.
	if ( ! class_exists( 'Jetpack' ) ) {
		return;
	}

	// Add support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
