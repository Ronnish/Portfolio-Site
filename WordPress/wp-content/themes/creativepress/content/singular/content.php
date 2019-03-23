<?php
/**
 * A template part for displaying single entries.
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

	<div class="single-article clearfix column-1 first-post">

		<div class="figure-wrap">
			<figure>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'creativepress-full'); ?>
				</a>
			</figure>
			<?php creativepress_colored_category(); ?>
		</div>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<p class="entry-meta">
				<?php creativepress_entry_author(); ?>
				<?php creativepress_entry_published(); ?>
				<?php creativepress_entry_comments_link(); ?>
				<?php edit_post_link(); ?>
			</p><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<?php get_template_part( 'content/parts/entry-footer' ); ?>

	</div>

	<?php tha_entry_bottom(); ?>

</article><!-- .entry -->
