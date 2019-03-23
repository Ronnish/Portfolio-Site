<?php
/**
 * A template part to display meta data for an archive page.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<div <?php hybrid_attr( 'archive-header' ); ?>>

	<div <?php hybrid_attr( 'wrap', 'archive-header' ); ?>>

		<h1 <?php hybrid_attr( 'loop-title' ); ?>><?php the_archive_title(); ?></h1>

		<?php if ( is_category() || is_tax() ) : ?>

			<?php hybrid_get_menu( 'sub-terms' ); ?>

		<?php endif; ?>

		<?php if ( ! is_paged() && $desc = the_archive_description() ) : ?>

			<div <?php hybrid_attr( 'loop-description' ); ?>>
				<?php echo $desc; ?>
			</div><!-- .loop-description -->

		<?php endif; ?>

	</div>

</div><!-- .archive-header -->
