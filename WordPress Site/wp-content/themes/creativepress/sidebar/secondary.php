<?php
/**
 * secondary Sidebar Template
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( hybrid_get_theme_layout() == '3c' ) : // If both sidebar layout. ?>

	<?php tha_sidebars_before(); ?>

	<aside <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>

		<?php tha_sidebar_top(); ?>

		<span id="sidebar-secondary-title" class="screen-reader-text"><?php
			// Translators: %s is the sidebar name. This is the sidebar title shown to screen readers.
			printf( esc_html( '%s', 'creativepress' ), hybrid_get_sidebar_name( 'secondary' ) );
		?></span>

		<?php if ( is_active_sidebar( 'secondary' ) ) : ?>

			<?php dynamic_sidebar( 'secondary' ); ?>

		<?php elseif ( current_user_can( 'edit_theme_options' ) ) : ?>

			<?php
			the_widget(
				'WP_Widget_Text',
				array(
					'title'  => esc_html__( 'Example Widget', 'creativepress' ),
					// Translators: The %s are placeholders for HTML, so the order can't be changed.
					'text'   => sprintf( esc_html__( 'This is an example widget to show how the secondary sidebar looks by default. You can add custom widgets from the %1$swidgets screen%2$s in the admin.', 'creativepress' ), current_user_can( 'edit_theme_options' ) ? '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '">' : '', current_user_can( 'edit_theme_options' ) ? '</a>' : '' ),
					'filter' => true,
				),
				array(
					'before_widget' => '<section class="widget widget_text">',
					'after_widget'  => '</section>',
					'before_title'  => '<h3 class="widget-title">',
					'after_title'   => '</h3>',
				)
			);
			?>

		<?php endif; // End widgets check. ?>

		<?php tha_sidebar_bottom(); ?>

	</aside><!-- #sidebar-secondary -->

	<?php tha_sidebars_after();

endif; // End layout check.
