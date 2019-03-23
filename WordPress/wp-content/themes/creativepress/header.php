<?php
/**
 * The Header for our theme.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<!DOCTYPE html>
<?php tha_html_before(); ?>
<html <?php language_attributes( 'html' ); ?>>

<head>
<?php tha_head_top(); ?>
<?php wp_head(); ?>
<?php tha_head_bottom(); ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<?php tha_body_top(); ?>

	<div id="page">

		<div class="skip-link">
			<a href="#content" class="button screen-reader-text">
				<?php esc_html_e( 'Skip to content (Press enter)', 'creativepress' ); ?>
			</a>
		</div><!-- .skip-link -->

		<?php tha_header_before(); ?>

		<header <?php hybrid_attr( 'header' ); ?>>

			<?php tha_header_top(); ?>

			<div class="top-header clearfix">

				<div <?php hybrid_attr( 'container', 'header' ); ?>>

					<?php hybrid_get_menu( 'secondary' ); ?>

					<?php hybrid_get_menu( 'social' ); ?>

				</div>

			</div>

			<div class="middle-header">

				<div <?php hybrid_attr( 'container', 'header' ); ?>>
					<?php
					if( function_exists('has_custom_logo') && has_custom_logo() ) : ?>
					<div class="header-logo">
						<?php creativepress_the_custom_logo(); ?>
					</div>
					<?php endif; ?>
					<div <?php hybrid_attr( 'branding' ); ?>>
						<?php //creativepress_the_logo(); ?>
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->

					<?php hybrid_get_sidebar( 'header-right' ); ?>

				</div>

			</div>

			<div class="bottom-header clearfix">

				<div <?php hybrid_attr( 'container', 'header' ); ?>>

					<?php hybrid_get_menu( 'primary' ); ?>

					<div class="search-wrapper">
						<div class="search-icon">
							<i class="fa fa-search"></i>
						</div>

						<div class="header-search-box">
							<div class="close"> × </div>
							<?php get_search_form(); ?>
						</div>
					</div>

				</div>

			</div>

			<?php tha_header_bottom(); ?>

		</header><!-- #header -->

		<?php tha_header_after(); ?>