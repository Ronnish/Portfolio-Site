<?php
/**
 * Header Right Sidebar Template
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */

if ( is_active_sidebar( 'header-right' ) ) : ?>

	<div <?php hybrid_attr( 'header-right' ); ?>>

		<?php dynamic_sidebar( 'header-right' ); ?>

	</div><!-- .header-right -->

<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>

	<div <?php hybrid_attr( 'header-right' ); ?>>

		<p class="no-menu">
			<?php esc_html__( 'This is a widget area! It\'s perfect for a custom menu.', 'creativepress' ); ?>

			<?php
			printf(	'<a class="button" href="%1$s">%2$s</a>',
				esc_url( admin_url( 'customize.php' ) ),
				esc_html__( 'Customize Now', 'creativepress' )
			);
			?>
		</p>

	</div><!-- .header-right -->

	<?php

endif;
