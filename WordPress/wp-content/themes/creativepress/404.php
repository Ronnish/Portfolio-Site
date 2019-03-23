<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php get_header(); ?>

<div <?php hybrid_attr( 'container  site-inner clearfix' ); ?>>

	<?php tha_content_before(); ?>

	<div id="secondary" class="left-sidebar">

		<?php hybrid_get_sidebar( 'secondary' ); ?>

	</div>

	<div id="primary">

		<main <?php hybrid_attr( 'content' ); ?>>

			<?php tha_content_top(); ?>

			<?php hybrid_get_menu( 'breadcrumbs' ); ?>

			<?php tha_entry_before(); ?>

			<?php get_template_part( 'content/error', '404' ); ?>

			<?php tha_entry_after(); ?>

			<?php tha_content_bottom(); ?>

		</main><!-- #content -->

	</div>

	<?php tha_content_after(); ?>

	<div id="secondary" class="right-sidebar">

		<?php hybrid_get_sidebar( 'primary' ); ?>

	</div>

</div><!-- #site-inner -->

<?php
get_footer();
