<?php
/**
 * Theme-Specific Customizer Settings.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0
 * @since       1.0.0
 */

/* Custom Controls */
add_action( 'customize_register', 'creativepress_custom_controls' );

/**
 * Adds custom control required for settings.
 *
 * @since  1.0.0
 * @access public
 * @return void
 *
 **/
function creativepress_custom_controls() {

	require_once get_template_directory() . '/includes/class-customizer-control-category-dropdown.php';
	require_once get_template_directory() . '/includes/class-customizer-control-tag-dropdown.php';

}

add_action( 'customize_register', 'creativepress_customize_register' );
/**
 * Register settings for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function creativepress_customize_register($wp_customize) {
	// Slider Options
	$wp_customize->add_panel( 'creativepress_frontpage_panel',
		array(
			'title'       => esc_html__( 'Homepage Settings', 'creativepress' ),
			'capability'  => 'edit_theme_options',
			'description' => esc_html__( 'Configure the front page sections.', 'creativepress' ),
			'priority'    => 100,
		)
	);

	$wp_customize->add_section( 'creativepress_slider_section',
		array(
			'title'    => esc_html__( 'Frontpage Slider Section', 'creativepress'),
			'panel'    => 'creativepress_frontpage_panel',
			'priority' => 100,
		)
	);

	$wp_customize->add_setting( 'creativepress_slider',
		array(
			'default'              => '0',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'creativepress_slider',
		array(
			'label'    => esc_html__( 'Activate Frontpage Slider', 'creativepress' ),
			'type'     => 'checkbox',
			'section'  => 'creativepress_slider_section',
			'settings' => 'creativepress_slider',
			'priority' => 100
		)
	);

	$wp_customize->add_setting( 'creativepress_slider_source',
		array(
			'default'              => 'latest',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_slider_source',
		)
	);

	$wp_customize->add_control( 'creativepress_slider_source',
		array(
			'label'    => esc_html__( 'Slider Posts Source', 'creativepress' ),
			'type'     => 'radio',
			'choices'  => array(
				'latest'   => esc_html__( 'Latest Posts', 'creativepress' ),
				'category' => esc_html__( 'Specific Category', 'creativepress' ),
				'tag'      => esc_html__( 'Specific Tag', 'creativepress' )
			),
			'section'  => 'creativepress_slider_section',
			'settings' => 'creativepress_slider_source',
			'priority' => 200
		)
	);

	$wp_customize->add_setting( 'creativepress_slider_category',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control(
		new creativepress_Customize_Categories_Dropdown( $wp_customize,
			'creativepress_slider_category',
			array(
				'label'           => esc_html__( 'Select Category', 'creativepress' ),
				'type'            => 'dropdown-categories',
				'section'         => 'creativepress_slider_section',
				'settings'        => 'creativepress_slider_category',
				'priority'        => 300,
				'active_callback' => 'creativepress_maybe_category_slider',
			)
		)
	);

	$wp_customize->add_setting( 'creativepress_slider_tag',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control(
		new creativepress_Customize_Tags_Dropdown( $wp_customize,
			'creativepress_slider_tag',
			array(
				'label'           => esc_html__( 'Select Tag', 'creativepress' ),
				'type'            => 'dropdown-tags',
				'section'         => 'creativepress_slider_section',
				'settings'        => 'creativepress_slider_tag',
				'priority'        => 400,
				'active_callback' => 'creativepress_maybe_tag_slider',
			)
		)
	);

	$wp_customize->add_setting( 'creativepress_slider_number',
		array(
			'default'              => '5',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control( 'creativepress_slider_number',
		array(
			'label'    => esc_html__( 'Number of Slides', 'creativepress' ),
			'type'     => 'number',
			'section'  => 'creativepress_slider_section',
			'settings' => 'creativepress_slider_number',
			'priority' => 500
		)
	);

	// Beside Slider Section
	$wp_customize->add_section( 'creativepress_beside_slider_section',
		array(
			'title'    => esc_html__( 'Frontpage Beside Slider Section', 'creativepress'),
			'panel'    => 'creativepress_frontpage_panel',
			'priority' => 200,
		)
	);

	$wp_customize->add_setting( 'creativepress_beside_slider',
		array(
			'default'              => '0',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_checkbox',
		)
	);

	$wp_customize->add_control( 'creativepress_beside_slider',
		array(
			'label'    => esc_html__( 'Activate Frontpage Besider Slider Section', 'creativepress' ),
			'type'     => 'checkbox',
			'section'  => 'creativepress_beside_slider_section',
			'settings' => 'creativepress_beside_slider',
			'priority' => 100
		)
	);

	$wp_customize->add_setting( 'creativepress_beside_slider_source',
		array(
			'default'              => 'latest',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_slider_source',
		)
	);

	$wp_customize->add_control( 'creativepress_beside_slider_source',
		array(
			'label'    => esc_html__( 'Slider Posts Source', 'creativepress' ),
			'type'     => 'radio',
			'choices'  => array(
				'category' => esc_html__( 'Specific Category', 'creativepress' ),
				'tag'      => esc_html__( 'Specific Tag', 'creativepress' )
			),
			'section'  => 'creativepress_beside_slider_section',
			'settings' => 'creativepress_beside_slider_source',
			'priority' => 200
		)
	);

	$wp_customize->add_setting( 'creativepress_beside_slider_category',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control(
		new creativepress_Customize_Categories_Dropdown( $wp_customize,
			'creativepress_beside_slider_category',
			array(
				'label'           => esc_html__( 'Select Category', 'creativepress' ),
				'type'            => 'dropdown-categories',
				'section'         => 'creativepress_beside_slider_section',
				'settings'        => 'creativepress_beside_slider_category',
				'priority'        => 300,
				'active_callback' => 'creativepress_maybe_category_beside_slider',
			)
		)
	);

	$wp_customize->add_setting( 'creativepress_beside_slider_tag',
		array(
			'default'              => '',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control(
		new creativepress_Customize_Tags_Dropdown( $wp_customize,
			'creativepress_beside_slider_tag',
			array(
				'label'           => esc_html__( 'Select Tag', 'creativepress' ),
				'type'            => 'dropdown-tags',
				'section'         => 'creativepress_beside_slider_section',
				'settings'        => 'creativepress_beside_slider_tag',
				'priority'        => 400,
				'active_callback' => 'creativepress_maybe_tag_beside_slider',
			)
		)
	);

	$wp_customize->add_setting( 'creativepress_beside_slider_number',
		array(
			'default'              => '5',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'creativepress_sanitize_integer',
		)
	);

	$wp_customize->add_control( 'creativepress_beside_slider_number',
		array(
			'label'    => esc_html__( 'Number of Slides', 'creativepress' ),
			'type'     => 'number',
			'section'  => 'creativepress_beside_slider_section',
			'settings' => 'creativepress_beside_slider_number',
			'priority' => 500
		)
	);

	// Category Color Options
	$wp_customize->add_panel( 'creativepress_category_color_panel',
		array(
			'title'       => esc_html__( 'Category Color Options', 'creativepress' ),
			'capability'  => 'edit_theme_options',
			'description' => esc_html__( 'Change the color of each category items as you want.', 'creativepress' ),
			'priority'    => 200,
		)
	);

	$wp_customize->add_section( 'creativepress_category_color_section',
		array(
			'title'    => esc_html__('Category Color Settings', 'creativepress'),
			'panel'    => 'creativepress_category_color_panel',
			'priority' => 100,
		)
	);

	$priority = 1;
	$args     = array(
		'orderby' => 'id',
		'hide_empty' => 0
	);

	$categories = get_categories( $args );
	foreach ($categories as $singlecategory ) {

		$catID   = $singlecategory->term_id;
		$catName = $singlecategory->name;

		$wp_customize->add_setting( 'creativepress_category_color_'.$catID,
			array(
				'default'              => '',
				'capability'           => 'edit_theme_options',
				'sanitize_callback'    => 'creativepress_sanitize_hex',
				'sanitize_js_callback' => 'creativepress_escape_color'
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize, 'creativepress_category_color_'.$catID,
				array(
					'label'    => sprintf(esc_html('%s'), $catName ),
					'section'  => 'creativepress_category_color_section',
					'settings' => 'creativepress_category_color_'.$catID,
					'priority' => $priority
				)
			)
		);
		$priority++;
	}

	$wp_customize->add_panel(
		'creativepress_design_panel',
		array(
			'priority'  => 300,
			'title'     => esc_html__( 'Design Options', 'creativepress' )
		)
	);

	// Webpage Layout Section
	$wp_customize->add_section(
		'creativepress_webpage_layout_section',
		array(
			'priority'   => 100,
			'title'      => esc_html__( 'WebPage Layout', 'creativepress' ),
			'panel'      => 'creativepress_design_panel'
		)
	);

	$wp_customize->add_setting(
		'creativepress_webpage_layout',
		array(
			'default'            => 'wide',
			'capability'         => 'edit_theme_options',
			'sanitize_callback'  => 'creativepress_sanitize_layout_style'
		)
	);

	$wp_customize->add_control(
		'creativepress_webpage_layout',
		array(
			'label'    => esc_html__( 'Choose the layout for your site.', 'creativepress' ),
			'section'  => 'creativepress_webpage_layout_section',
			'type'     => 'select',
			'choices'    => array(
            	'boxed' => esc_html__('Boxed Layout', 'creativepress'),
            	'wide'  => esc_html__('Wide Layout', 'creativepress'),
        	),
 		)
	);
	$wp_customize->add_section(
		'creativepress_primary_color_section',
		array(
			'priority'   => 300,
			'title'      => esc_html__( 'Primary Color', 'creativepress' ),
			'panel'      => 'creativepress_design_panel'
		)
	);
	// Primary Color Option
	$wp_customize->add_setting(
		'creativepress_primary_color',
		array(
			'default'              => '#a8c54c',
			'capability'           => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color',
			'sanitize_js_callback' => 'creativepress_escape_color'
		)
	);

	$wp_customize->add_control(
		'creativepress_primary_color',
		array(
			'label'    => esc_html__( 'Choose the primary color for your site.', 'creativepress' ),
			'section'  => 'creativepress_primary_color_section',
			'type'     => 'color'
 		)
	);
	// Footer Widget Section
	$wp_customize->add_section(
		'creativepress_footer_widget_section',
		array(
			'priority'   => 100,
			'title'      => esc_html__( 'Footer Widgets', 'creativepress' ),
			'panel'      => 'creativepress_design_panel'
		)
	);

	$wp_customize->add_setting(
		'creativepress_footer_widgets',
		array(
			'default'            => 4,
			'capability'         => 'edit_theme_options',
			'sanitize_callback'  => 'creativepress_sanitize_integer'
		)
	);

	$wp_customize->add_control(
		'creativepress_footer_widgets',
		array(
			'label'    => esc_html__( 'Choose the number of widget area you want in footer', 'creativepress' ),
			'section'  => 'creativepress_footer_widget_section',
			'type'     => 'select',
			'choices'    => array(
            	'1' => esc_html__('1 Footer Widget Area', 'creativepress'),
            	'2' => esc_html__('2 Footer Widget Area', 'creativepress'),
            	'3' => esc_html__('3 Footer Widget Area', 'creativepress'),
            	'4' => esc_html__('4 Footer Widget Area', 'creativepress')
        	),
 		)
	);

	function creativepress_maybe_category_slider(){
		$source = get_theme_mod( 'creativepress_slider_source', 'latest' );
		if($source == 'category' ) {
			return true;
		} else {
			return false;
		}
	}

	function creativepress_maybe_tag_slider(){
		$source = get_theme_mod( 'creativepress_slider_source', 'latest' );
		if($source == 'tag' ) {
			return true;
		} else {
			return false;
		}
	}

	// Active Callback for Beside Slider Section
	function creativepress_maybe_category_beside_slider(){
		$source = get_theme_mod( 'creativepress_beside_slider_source', 'category' );
		if($source == 'category' ) {
			return true;
		} else {
			return false;
		}
	}

	function creativepress_maybe_tag_beside_slider(){
		$source = get_theme_mod( 'creativepress_beside_slider_source', 'category' );
		if($source == 'tag' ) {
			return true;
		} else {
			return false;
		}
	}


	// Sanitize the slider source selection
	function creativepress_sanitize_slider_source( $source ) {
		$valid = array(
			'latest'        => 'latest',
			'category' 	    => 'category',
			'tag'           => 'tag',
		);

		if ( array_key_exists( $source, $valid ) ) {
			return $source;
		} else {
			return '';
		}
	}

	// Sanitize integer
	function creativepress_sanitize_integer( $int ) {
		if( is_numeric( $int ) ) {
			return intval( $int );
		}
	}

	// Sanitize Hex
	function creativepress_sanitize_hex($color) {
		if ($unhashed = sanitize_hex_color_no_hash($color))
			return '#' . $unhashed;
		return $color;
	}

	// Escape color
	function creativepress_escape_color($input) {
		$input = esc_attr($input);
		return $input;
	}

	// Sanitize Checkbox
	function creativepress_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}

	function creativepress_sanitize_layout_style( $layout_style ) {
	    $valid = array(
	        'wide' 		=> 'Wide Layout',
			'boxed' 	=> 'Boxed Layout',
	    );

	    if ( array_key_exists( $layout_style, $valid ) ) {
	        return $layout_style;
	    } else {
	        return '';
	    }
	}
}