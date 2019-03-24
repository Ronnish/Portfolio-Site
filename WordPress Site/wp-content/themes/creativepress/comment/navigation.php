<?php
/**
 * A template part to display comment pagination.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php if ( get_option( 'page_comments' ) && 1 < get_comment_pages_count() ) : ?>

	<nav id="comments-nav" class="comments-nav pagination" role="navigation" aria-labelledby="comments-nav-title">

		<h3 id="comments-nav-title" class="screen-reader-text"><?php esc_html_e( 'Comments Navigation', 'creativepress' ); ?></h3>

		<?php
		paginate_comments_links(
			array(
				'prev_text' => sprintf( '<span class="screen-reader-text">%s</span>' , esc_html__( 'Previous Comment Page', 'creativepress' ) ),
				'next_text' => sprintf( '<span class="screen-reader-text">%s</span>', esc_html__( 'Next Comment Page', 'creativepress' ) ),
			)
		);
		?>

	</nav><!-- .comments-nav -->

	<?php

endif;
