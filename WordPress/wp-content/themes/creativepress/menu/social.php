<?php
/**
 * The social nav menu template.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( has_nav_menu( 'social' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'social' ); ?>>

		<span id="menu-social-title" class="screen-reader-text">
			<?php
			// Translators: %s is the nav menu name. This is the nav menu title shown to screen readers.
			printf( esc_html( '%s', 'creativepress' ), hybrid_get_menu_location_name( 'social' ) );
			?>
		</span>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container'       => '',
				'menu_id'         => 'top-social-icon',
				'menu_class'      => 'nav-menu social',
				'fallback_cb'     => 'false',
				'items_wrap'      => '<div ' . hybrid_get_attr( 'top-social-icon', 'social-menu' ) . '><ul id="%s" class="%s">%s</ul></div>',
				'depth'           => 1,
			)
		);
		?>

	</nav><!-- #menu-social -->

	<?php

endif;
