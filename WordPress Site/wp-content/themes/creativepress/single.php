<?php
/**
 * The primary template for all single entries.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php get_header(); ?>

<div <?php hybrid_attr( 'container single' ); ?>>

	<div id="primary">

		<?php tha_content_before(); ?>

		<main <?php hybrid_attr( 'content' ); ?>>

			<?php tha_content_top(); ?>

			<?php hybrid_get_menu( 'breadcrumbs' ); ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php tha_entry_before(); ?>

					<?php hybrid_get_content_template(); ?>

					<?php tha_entry_after(); ?>

					<?php the_posts_pagination(); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'content/error' ); ?>

			<?php endif; ?>

			<?php tha_content_bottom(); ?>

		</main><!-- #content -->

		<?php tha_content_after(); ?>

	</div>

	<div id="secondary">

		<?php hybrid_get_sidebar( 'primary' ); ?>

	</div>

</div><!-- .container -->

<?php
get_footer();
