<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mindset_Starter
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">

		<nav id="footer-navigation" class="footer-navigation">
				
			

			<div class="site-info">
				<a href="<?php echo esc_url( __( 'http://rbahadoor.bcitwebdeveloper.ca/', 'mindset' ) ); ?>"><?php printf( __( 'Created by %s'), 'Ronnish Bahadoor, TWD Program' ); ?></a>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
