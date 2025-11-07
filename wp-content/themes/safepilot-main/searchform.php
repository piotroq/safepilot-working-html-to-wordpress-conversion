<?php
/**
 * The template for displaying search forms
 * 
 * @package SafePilot
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="search-input">
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'safepilot' ); ?></span>
	</label>
	<div class="search-form-wrapper">
		<input type="search" id="search-input" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'safepilot' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="search-submit">
			<i class="fas fa-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'safepilot' ); ?></span>
		</button>
	</div>
</form>
