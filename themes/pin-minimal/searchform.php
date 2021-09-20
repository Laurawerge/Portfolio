<?php
/**
 * The template for displaying search forms in Pin Minimal
 *
 * @package Pin Minimal
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'pin-minimal' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'pin-minimal' ); ?>">
</form>