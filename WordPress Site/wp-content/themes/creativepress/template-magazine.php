<?php
/**
 * Template Name: Magazine
 *
 * @since  1.0.0
 */
get_header();
?>
	<section class="home-slider-wrapper">

		<div <?php hybrid_attr( 'container single' ); ?>>

		<?php if(get_theme_mod( 'creativepress_slider', '0' == 1)) : ?>

			<div class="slider-block">

				<?php creativepress_frontpage_slider(); ?>

			</div>

		<?php endif; ?>

		<?php if(get_theme_mod( 'creativepress_beside_slider', '0' == 1)) : ?>

			<div class="slider-feature-widget clearfix">

				<?php creativepress_frontpage_beside_slider(); ?>

			</div>

		<?php endif; ?>

		</div>

	</section>

	<div class="main-content-section">

		<div <?php hybrid_attr( 'container' ); ?>>

			<div id="secondary" class="right-sidebar">

				<?php hybrid_get_sidebar( 'secondary' ); ?>

			</div>

			<div id="primary">

				<?php hybrid_get_sidebar( 'frontpage' ); ?>

			</div>

			<div id="secondary" class="left-sidebar">

				<?php hybrid_get_sidebar( 'primary' ); ?>

			</div>

		</div>

	</div>
<?php get_footer(); ?>