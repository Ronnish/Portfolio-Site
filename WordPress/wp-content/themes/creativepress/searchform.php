<?php
/**
 * Displays the searchform of the theme.
 *
 * @package     creativepress
 * @subpackage  HybridCore
 * @license     GPL-2.0+
 * @since       1.0.0
 */
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform clearfix" method="get">
		<input type="text" placeholder="<?php esc_attr_e( 'Search', 'creativepress' ); ?>" class="search-field" name="s">
	<button class="search-icon" type="submit"><i class="fa fa-search"></i></button>
</form><!-- .searchform -->