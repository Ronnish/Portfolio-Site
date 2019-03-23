<?php
/**
 * General Theme-Specific Functions.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0
 * @since       1.0.0
 */

add_action( 'init', 'creativepress_register_image_sizes', 5 );
/**
 * Register custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function creativepress_register_image_sizes() {
	// Set the 'post-thumbnail' size.
	set_post_thumbnail_size( 175, 130, true );

	// Add the image sizes.
	add_image_size( 'creativepress-full', 1025, 500, true );
	add_image_size( 'creativepress-slider', 700, 450, true );
	add_image_size( 'creativepress-medium', 350, 250, true );
	add_image_size( 'creativepress-grid', '450', '300', true );

}

add_filter( 'excerpt_length', 'creativepress_excerpt_length' );
/**
 * Add a custom excerpt length.
 *
 * @since  1.0.0
 * @access public
 * @param  integer $length
 * @return integer
 */
function creativepress_excerpt_length( $length ) {
	if( !is_admin() ) {
		return 60;
	}
	return $length;
}

add_action( 'tha_entry_top', 'creativepress_do_sticky_banner' );
/**
 * Add markup for a sticky ribbon on sticky posts in archive views.
 *
 * @since   1.0.0
 * @return  void
 */
function creativepress_do_sticky_banner() {
	if ( is_singular() || ! is_sticky() ) {
		return;
	}
	?>
	<div class="corner-ribbon sticky">
		<p class="ribbon-content"><?php esc_html_e( 'Sticky', 'creativepress' ); ?></p>
	</div>
	<?php
}

add_action( 'hybrid_register_layouts', 'creativepress_register_layouts' );
/*
 * Registers layouts.
 *
 * @since  1.0.0
 * @access public
 * @return void
*/
function creativepress_register_layouts() {

	hybrid_register_layout( '1c',	 	array( 'label' => esc_html__( '1 Column',                     'creativepress' ), 'image' => '%s/assets/images/one-column.svg'   ) );
	hybrid_register_layout( '1c-narrow',array( 'label' => esc_html__( '1 Column: Narrow',             'creativepress' ), 'image' => '%s/assets/images/one-column-narrow.svg'   ) );
	hybrid_register_layout( '2c-l', 	array( 'label' => esc_html__( '2 Columns: Content / Sidebar', 'creativepress' ), 'image' => '%s/assets/images/sidebar-left.svg' ) );
	hybrid_register_layout( '2c-r', 	array( 'label' => esc_html__( '2 Columns: Sidebar / Content', 'creativepress' ), 'image' => '%s/assets/images/sidebar-right.svg' ) );
}

if( !function_exists( 'creativepress_frontpage_slider' ) ) :
/**
 * Frontpage Slider
 *
 * @since  1.0.0
 * @access public
 */
function creativepress_frontpage_slider() {
	$source   = get_theme_mod( 'creativepress_slider_source', 'latest' );
	$number   = get_theme_mod( 'creativepress_slider_number', 5 );
	$category = get_theme_mod( 'creativepress_slider_category' );
	$tag      = get_theme_mod( 'creativepress_slider_tag' );

	if($source == 'category' ) {
		$get_slider_posts = new WP_Query(
			array(
				'posts_per_page'        => absint( $number ),
				'post_type'             => 'post',
				'category__in'          => $category,
				'ignore_sticky_posts'   => true
			)
		);
	}
	elseif($source == 'tag' ) {
		$get_slider_posts = new WP_Query(
			array(
				'posts_per_page'        => absint( $number ),
				'post_type'             => 'post',
				'tag__in'               => $tag,
				'ignore_sticky_posts'   => true
			)
		);
	}
	else {
		$get_slider_posts = new WP_Query(
			array(
				'posts_per_page'        => absint( $number ),
				'post_type'             => 'post',
				'ignore_sticky_posts'   => true
			)
		);
	}
	?>
	<ul class="bxslider">
	<?php
	while( $get_slider_posts->have_posts() ): $get_slider_posts->the_post(); ?>
		<li>
			<?php if( has_post_thumbnail() ) {
				the_post_thumbnail('creativepress-slider' );
			}
			?>
			<div class="slider-caption clearfix">
				<h3 class="slider-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
				<?php creativepress_colored_category(); ?>
				<div class="entry-meta">
					<?php creativepress_entry_author(); ?>
					<?php creativepress_entry_published(); ?>
					<?php creativepress_entry_comments_link(); ?>
					<?php edit_post_link(); ?>
				</div><!-- .entry-meta -->
			</div>
		</li>
	<?php
	endwhile;
	wp_reset_postdata();
	?>
	</ul>
	<?php
}

endif;

if( !function_exists( 'creativepress_frontpage_beside_slider' ) ) :
/**
 * Frontpage Besider Slider Section
 *
 * @since  1.0.0
 * @access public
 */
function creativepress_frontpage_beside_slider() {
	$source   = get_theme_mod( 'creativepress_beside_slider_source', 'category' );
	$number   = get_theme_mod( 'creativepress_beside_slider_number', '5' );
	$category = get_theme_mod( 'creativepress_beside_slider_category' );
	$tag      = get_theme_mod( 'creativepress_beside_slider_tag' );

	if($source == 'category' ) {
		$get_slider_posts = new WP_Query(
			array(
				'posts_per_page'        => $number,
				'post_type'             => 'post',
				'category__in'          => $category,
				'ignore_sticky_posts'   => true
			)
		);
		$widget_title = get_cat_name( $category );
		$widget_link  = get_category_link( $category );
	}
	else {
		$get_slider_posts = new WP_Query(
			array(
				'posts_per_page'        => $number,
				'post_type'             => 'post',
				'tag__in'               => $tag,
				'ignore_sticky_posts'   => true
			)
		);
		$widget_title = get_cat_name( $tag );
		$widget_link  = get_category_link( $tag );
	}
	?>
	<h3 class="widget-title">
		<a href="<?php echo esc_url( $widget_link ); ?>"><?php echo esc_html( $widget_title ); ?></a>
	</h3>

	<div class="featured-post-wrapper clearfix">
	<?php
	$count = 1;
	while( $get_slider_posts->have_posts() ): $get_slider_posts->the_post();
		if($count == 1) { echo "<div class='large-post-block'>"; }
		if($count < 3) { ?>
			<div class="single-article clearfix">
				<figure>
					<a href="<?php the_permalink(); ?>">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'creativepress-medium' );
					}
					?>
					</a>
				</figure>
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php creativepress_colored_category(); ?>
				<div class="entry-meta">
					<?php creativepress_entry_published(); ?>
				</div>
			</div>
		<?php
		}
		if($count == 2) { echo "</div>"; }
		// Blocks without images
		if($count == 2) { echo "<div class='list-post-block'>"; }
		if($count > 2) { ?>
			<div class="single-article clearfix">
				<?php $cat = get_the_category();
				$first_cat = $cat[0];
				$cat_id = $first_cat->term_id;
				?>
				<div class="category" style="color:<?php echo creativepress_category_color($cat_id); ?>"><?php echo $first_cat->name; ?></div>
				<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="entry-meta">
					<?php creativepress_entry_published(); ?>
				</div>
			</div>
		<?php
		}
		if($count == $number) { echo "</div>"; }
	$count++;
	endwhile;
	wp_reset_postdata();
	?>
	</div>
	<?php
}

endif;

/**
 * Get color from theme customizer for colored category
 *
 * @since  1.0.1
 */
if ( ! function_exists( 'creativepress_category_color' ) ) :
function creativepress_category_color( $category_id ) {
	$color = esc_attr( get_theme_mod('creativepress_category_color_'.$category_id) );
	return $color;
}
endif;

/**
 * Uses theme customizer to generate colored category
 *
 * @since  1.01
 */
if ( ! function_exists( 'creativepress_colored_category' ) ) :
function creativepress_colored_category() {
	global $post;

	$output      = '';
	$categories1 = get_the_category();

	if( $categories1 ) {
		$category    = $categories1[0];
		$color_code  = creativepress_category_color(get_cat_id($category->cat_name));

		if (!empty($color_code)) {
			$output .= '<div class="category" style="background:' . $color_code . '" rel="category tag">';
			$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.$category->cat_name.'</a>';
			$output .= '</div>';
		} else {
			$output .= '<div class="category">';
			$output .= '<a href="'.esc_url( get_category_link( $category->term_id ) ).'"  rel="category tag">'.$category->cat_name.'</a>';
			$output .= '</div>';
		}
	}

	echo trim($output);
}
endif;

/**
 * Removes the [..] sign/symbol for excerpt.
 *
 * @since  1.0.0
 * @access public
 * @param  string     $text
 * @return string
 */
function creativepress_excerpt_more($text) {
  return '';
}
add_filter('excerpt_more', 'creativepress_excerpt_more');

/**
 * Adds class on body based on theme layout.
 *
 * @since  1.0.0
 * @access public
 * @param  string     $text
 * @return string
 */

function creativepress_class_names( $classes ) {
	// add 'both-sidebar' to the $classes array
	if( hybrid_get_theme_layout() == '3c') {
		$classes[] = 'both-sidebar';
	}
	$webpagelayout = get_theme_mod( 'creativepress_webpage_layout', 'wide' );
	if($webpagelayout == 'wide' ) {
		$classes[] = 'wide';
	} else {
		$classes[] = 'boxed';
	}
	// return the $classes array
	return $classes;
}

add_filter( 'body_class', 'creativepress_class_names' );

/**
 * Change hex code to RGB
 * Source: https://css-tricks.com/snippets/php/convert-hex-to-rgb/#comment-1052011
 */
function creativepress_hex2rgb($hexstr) {
    $int = hexdec($hexstr);
    $rgb = array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
    $r = $rgb['red'];
    $g = $rgb['green'];
    $b = $rgb['blue'];

    return "rgba($r,$g,$b, 0.85)";
}

/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function creativepress_darkcolor($hex, $steps) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter
	$steps = max(-255, min(255, $steps));

	// Normalize into a six character long hex string
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) {
		$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	}

	// Split into three parts: R, G and B
	$color_parts = str_split($hex, 2);
	$return = '#';

	foreach ($color_parts as $color) {
		$color   = hexdec($color); // Convert to decimal
		$color   = max(0,min(255,$color + $steps)); // Adjust color
		$return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
	}

	return $return;
}

add_action( 'wp_head', 'creativepress_custom_css' );
/**
 * Hooks the Custom Internal CSS to head section
 */
function creativepress_custom_css() {

	$primary_color   = esc_attr( get_theme_mod( 'creativepress_primary_color', '#32c4d1' ) );
	$primary_opacity = creativepress_hex2rgb($primary_color);
	$primary_dark    = creativepress_darkcolor($primary_color, -20);

	$creativepress_internal_css = '';
	if( $primary_color != '#32c4d1' ) {
		$creativepress_internal_css = '
	.slider-feature-widget .large-post-block .category, .widget-recent-post .category, .widget-stories-post .category, .widget-featured-posts .category, .figure-wrap .category, .single .category, .container.blog .category {
		background-color:'.$primary_color.'
	}
	';
	}

	if( !empty( $creativepress_internal_css ) ) {
	?>
		<style type="text/css"><?php echo $creativepress_internal_css; ?></style>
	<?php
	}
}

if ( ! function_exists( 'creativepress_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 */
function creativepress_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;