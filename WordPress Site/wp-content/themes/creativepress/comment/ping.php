<?php
/**
 * A template part for displaying a ping.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<li <?php hybrid_attr( 'comment' ); ?>>

	<article>

		<header class="comment-meta">
			<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite>
			<a <?php hybrid_attr( 'comment-permalink' ); ?>>
				<time <?php hybrid_attr( 'comment-published' ); ?>>
					<?php
					printf(
						esc_html__( '%s ago', 'creativepress' ),
						human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) )
					);
					?>
				</time>
			</a>
			<?php edit_comment_link(); ?>
		</header><!-- .comment-meta -->

	</article>
