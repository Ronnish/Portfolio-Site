<?php
/**
 * The secondary nav menu template.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( has_nav_menu( 'secondary' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'secondary' ); ?>>

		<span id="menu-secondary-title" class="screen-reader-text">
			<?php
			// Translators: %s is the nav menu name. This is the nav menu title shown to screen readers.
			printf( esc_html( '%s', 'creativepress' ), hybrid_get_menu_location_name( 'secondary' ) );
			?>
		</span>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'secondary',
				'container'       => '',
				'menu_id'         => 'top-left',
				'menu_class'      => 'nav-menu secondary',
				'fallback_cb'     => 'false',
				'items_wrap'      => '<div ' . hybrid_get_attr( 'top-left-menu', 'secondary-menu' ) . '><ul id="%s" class="%s">%s</ul></div>',
				'depth'           => 1,
			)
		);
		?>

	</nav><!-- #menu-secondary -->

	<?php

endif;
