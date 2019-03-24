<?php
/**
 * A template to display when a 404 error occurs.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<article class="entry not-found clearfix">

	<?php tha_entry_top(); ?>

	<div class="entry-content error-wrap column-2">

		<span class="num-404"><?php esc_html_e( '404', 'creativepress' ); ?></span>



	</div><!-- .entry-content -->
	<header class="entry-header column-2">
		<h1 class="entry-title"><span class="Oops"><?php esc_html_e( 'Oops!', 'creativepress' ); ?></span><?php esc_html_e( 'That page can&rsquo;t be found.', 'creativepress' ); ?></h1>
	</header><!-- .page-header -->
	<div class="page-content">
		<div class="search-wrapper">
			<?php get_search_form(); ?>
		</div>
	</div>

	<?php tha_entry_bottom(); ?>

</article><!-- .error-404 -->
