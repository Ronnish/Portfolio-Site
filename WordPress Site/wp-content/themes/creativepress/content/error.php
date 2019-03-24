<?php
/**
 * A template to display when no contet can be found.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @copyright   Copyright (c) 2015
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<?php tha_entry_before(); ?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php tha_entry_top(); ?>

	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'creativepress' ); ?></h1>
	</header><!-- .entry-header -->

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<p><?php esc_html_e( 'Apologies, but no entries were found.', 'creativepress' ); ?></p>
	</div><!-- .entry-content -->

	<?php tha_entry_bottom(); ?>

</article><!-- .entry -->

<?php
tha_entry_after();
