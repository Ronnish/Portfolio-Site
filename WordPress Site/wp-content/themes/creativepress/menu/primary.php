<?php
/**
 * The primary nav menu template.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( has_nav_menu( 'primary' ) ) : ?>

	<nav <?php hybrid_attr( 'menu', 'primary' ); ?> id="site-navigation">

		<div class="menu-toggle"><?php esc_html_e( 'Menu', 'creativepress' ); ?></div>
		<span id="menu-primary-title" class="screen-reader-text">
			<?php
			// Translators: %s is the nav menu name. This is the nav menu title shown to screen readers.
			printf( esc_html( '%s', 'creativepress' ), hybrid_get_menu_location_name( 'primary' ) );
			?>
		</span>

		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container'       => 'div',
				'container_id'    => 'site-navigation',
				'menu_id'         => 'menu',
				'menu_class'      => 'main-navigation',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>',
			)
		);
		?>

	</nav><!-- #menu-primary -->

<?php elseif ( current_user_can( 'edit_theme_options' ) && ! has_nav_menu( 'secondary' ) ) : ?>

	<div class="header-right">
		<p class="no-menu">

			<?php esc_html__( "Ready to add your primary menu? Let's get started!", 'creativepress' ); ?>

		</p>
	</div><!-- .header-right -->

	<?php

endif;
