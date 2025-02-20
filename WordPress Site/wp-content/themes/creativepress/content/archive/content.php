<?php
/**
 * A template part for displaying an entry within an archive.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php tha_entry_top(); ?>

	<div class="column-wrapper">

		<div class="single-article clearfix column-1 first-post">

			<?php
			// Display a featured image if we can find something to display.
			get_the_image(
				array(
					'size'   => 'creativepress-full',
					'order'  => array( 'featured', 'attachment' ),
					'before' => '<div class="figure-wrap">',
					'after'  => '</div>',
				)
			);
			?>

			<?php creativepress_colored_category(); ?>

			<header class="entry-header">

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

				<p class="entry-meta">
					<?php creativepress_entry_author(); ?>
					<?php creativepress_entry_published(); ?>
					<?php creativepress_entry_comments_link(); ?>
					<?php edit_post_link(); ?>
				</p><!-- .entry-meta -->

			</header><!-- .entry-header -->

			<div <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<div class="readmore">
				<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More', 'creativepress' ); ?></a>
			</div>

		</div>

	</div>

	<?php tha_entry_bottom(); ?>

</article><!-- .entry -->
