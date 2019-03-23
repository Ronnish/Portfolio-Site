<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
		<?php tha_footer_before(); ?>

		<footer id="site-footer">

			<?php tha_footer_top(); ?>

			<div id="top-footer">

				<div class="top-footer-wrapper clearfix">

					<div <?php hybrid_attr( 'container', 'footer' ); ?>>

						<div class="column-wrapper">

							<?php
							$footer_sidebar_count = get_theme_mod( 'creativepress_footer_widgets', '4');
							$footer_sidebar_class = 'footer-widgets first-footer-widgets column-'. $footer_sidebar_count;

							for ( $i = 1; $i <= $footer_sidebar_count; $i++ ) {
								?>
								<div class="<?php echo esc_attr( $footer_sidebar_class ); ?> footer-block">

								<?php
								if ( is_active_sidebar( 'tertiary'.$i ) ) {
									dynamic_sidebar( 'tertiary'.$i );
								}
								?>
								</div>

					<?php 	} ?>

						</div>

					</div>

				</div>

			</div>

			<div id="bottom-footer">

				<div <?php hybrid_attr( 'container', 'footer' ); ?>>

					<div class="copyright">
						<?php
						printf(
							// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link.
							esc_html__( 'Copyright &#169; %1$s %2$s. Powered by %3$s.', 'creativepress' ),
							date_i18n( 'Y' ),
							hybrid_get_site_link(),
							hybrid_get_wp_link()
						);
						?>
					</div><!-- .copyright -->

					<?php hybrid_get_menu( 'footer' ); ?>

				</div><!-- .wrap -->

			</div>

			<?php tha_footer_bottom(); ?>

		</footer><!-- .footer -->

		<?php tha_footer_after(); ?>

	<?php tha_body_bottom(); ?>
	<?php wp_footer(); ?>

</body>
</html>
