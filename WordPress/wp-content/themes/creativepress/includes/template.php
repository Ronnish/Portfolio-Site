<?php
/**
 * Helper functions for templates.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015
 * @license     GPL-2.0+
 * @link        https://rajeebbanstola.com.np/
 * @since       1.0.0
 */

add_filter( 'hybrid_content_template_hierarchy', 'creativepress_content_template_hierarchy' );
/**
 * Search the template paths and replace them with singular and archive versions.
 *
 * By default, the content template hierarchy forces you to add logic for single
 * and archive content within the templates themselves. This makes the templates
 * overly complex and I would prefer to separate them into individual files.
 *
 * @since  1.0.0
 * @access public
 * @param  array $templates
 * @return array $templates
 */
function creativepress_content_template_hierarchy( $templates ) {
	if ( is_singular() || is_attachment() ) {
		$templates = str_replace( 'content/', 'content/singular/', $templates );
	} else {
		$templates = str_replace( 'content/', 'content/archive/', $templates );
	}
	return $templates;
}

/**
 * Outputs an entry's author.
 *
 * @since  1.1.0
 * @access public
 * @param  $args array
 * @return void
 */
function creativepress_entry_author( $args = array() ) {
	echo creativepress_get_entry_author( $args );
}

/**
 * This is simply a wrapper function for hybrid_get_post_author which adds a few
 * filters to make the function a bit more flexible. This will allow us to avoid
 * passing args into the function by default in our templates. Instead, we can
 * filter the defaults globally which gives us a cleaner template file.
 *
 * @since  1.1.0
 * @access public
 * @param  $args array
 * @return string
 */
function creativepress_get_entry_author( $args = array() ) {
	$defaults = apply_filters( 'creativepress_entry_author_defaults',
		array(
			'text'   => '<i class="fa fa-user"></i>%s',
			'before' => '',
			'after'  => '',
			'wrap'   => '<span class="byline author" %s>%s</span>',
		)
	);

	$args = wp_parse_args( $args, $defaults );

	return apply_filters( 'creativepress_entry_author', hybrid_get_post_author( $args ), $args );
}

/**
 * Outputs a post's published date.
 *
 * @since  1.1.0
 * @access public
 * @param  $args array
 * @return void
 */
function creativepress_entry_published( $args = array() ) {
	echo creativepress_get_entry_published( $args );
}

/**
 * Helper function for getting a post's published date and formatting it to be
 * displayed in a template.
 *
 * @since  1.1.0
 * @access public
 * @param  $args array
 * @return string
 */
function creativepress_get_entry_published( $args = array() ) {
	$output = '';

	$defaults = apply_filters( 'creativepress_entry_published_defaults',
		array(
			'before' => '',
			'after'  => '',
			'attr'   => 'entry-published',
			'date'   => get_the_date(),
			'wrap'   => '<span class="posted-on"><i class="fa fa-calendar"></i><time %s>%s</time></span>',
		)
	);

	$args = wp_parse_args( $args, $defaults );

	$output .= $args['before'];
	$output .= sprintf( $args['wrap'], hybrid_get_attr( $args['attr'] ), $args['date'] );
	$output .= $args['after'];

	return apply_filters( 'creativepress_entry_published', $output, $args );
}

/**
 * Displays a formatted link to the current entry comments.
 *
 * @since  1.1.0
 * @access public
 * @param  $args array
 * @return void
 */
function creativepress_entry_comments_link( $args = array() ) {
	echo creativepress_get_entry_comments_link( $args );
}

/**
 * Produces a formatted link to the current entry comments.
 *
 * Supported arguments are:
 * - after (output after link, default is empty string),
 * - before (output before link, default is empty string),
 * - hide_if_off (hide link if comments are off, default is 'enabled' (true)),
 * - more (text when there is more than 1 comment, use % character as placeholder
 *   for actual number, default is '% Comments')
 * - one (text when there is exactly one comment, default is '1 Comment'),
 * - zero (text when there are no comments, default is 'Leave a Comment').
 *
 * Output passes through 'creativepress_get_entry_comments_link' filter before returning.
 *
 * @since  1.1.0
 * @param  $args array Empty array if no arguments.
 * @return string output
 */
function creativepress_get_entry_comments_link( $args = array() ) {
	$defaults = apply_filters( 'creativepress_entry_comments_link_defaults',
		array(
			'after'       => '',
			'before'      => '',
			'hide_if_off' => 'enabled',
			'more'        => esc_html__( 'Comments (%)', 'creativepress' ),
			'one'         => esc_html__( 'Comment (1)', 'creativepress' ),
			'zero'        => esc_html__( 'Leave a Comment', 'creativepress' ),
		)
	);
	$args = wp_parse_args( $args, $defaults );

	if ( ! comments_open() && 'enabled' === $args['hide_if_off'] ) {
		return;
	}

	// I really would rather not do this, but WordPress is forcing me to.
	ob_start();
	comments_number( $args['zero'], $args['one'], $args['more'] );
	$comments = ob_get_clean();

	$comments = sprintf( '<i class="fa fa-comment"></i><a rel="nofollow" href="%s">%s</a>', get_comments_link(), $comments );

	$output = '<span class="comment">' . $args['before'] . $comments . $args['after'] . '</span>';

	return apply_filters( 'creativepress_entry_comments_link', $output, $args );
}
