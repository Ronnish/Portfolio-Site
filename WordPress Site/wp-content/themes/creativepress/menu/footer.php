<?php
/**
 * The footer nav menu template.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( has_nav_menu( 'footer' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'footer' ); ?>>

		<span id="menu-footer-title" class="screen-reader-text">
			<?php
			// Translators: %s is the nav menu name. This is the nav menu title shown to screen readers.
			printf( esc_html( '%s', 'creativepress' ), hybrid_get_menu_location_name( 'footer' ) );
			?>
		</span>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'footer',
				'container'       => '',
				'menu_class'      => 'nav-menu footer',
				'fallback_cb'     => 'false',
				'items_wrap'      => '<div class="footer-menu" ' . hybrid_get_attr( 'top-left-menu', 'footer-menu' ) . '><ul id="%s" class="%s">%s</ul></div>',
				'depth'           => 1,
			)
		);
		?>

	</nav><!-- #menu-footer -->

	<?php

endif;
