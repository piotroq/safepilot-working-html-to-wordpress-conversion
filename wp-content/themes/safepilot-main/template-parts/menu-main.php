<?php
/**
 * Template part for displaying main navigation menu
 * 
 * @package SafePilot
 * @since 1.0.0
 */
?>

<div id="header-sticky" class="header-1">
	<div class="container">
		<div class="mega-menu-wrapper">
			<div class="header-main style-2">
				<div class="header-left">
					<div class="logo">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo" rel="home">
								<img src="<?php echo esc_url( SAFEPILOT_THEME_URI . '/assets/img/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
							</a>
							<?php
						}
						?>
					</div>
				</div>
				
				<div class="header-middle">
					<div class="mean__menu-wrapper">
						<div class="main-menu">
							<nav id="mobile-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'safepilot' ); ?>">
								<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'menu_class'     => '',
									'container'      => false,
									'fallback_cb'    => 'safepilot_default_menu',
									'walker'         => has_nav_menu( 'primary' ) ? new SafePilot_Walker_Nav_Menu() : null,
								) );
								?>
							</nav>
						</div>
					</div>
				</div>
				
				<div class="header-right d-flex justify-content-end align-items-center">
					<a href="#" class="search-trigger search-icon" role="button" aria-label="<?php esc_attr_e( 'Search', 'safepilot' ); ?>">
						<i class="fal fa-search"></i>
					</a>
					
					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Shopping Cart', 'safepilot' ); ?>">
						<i class="fa-solid fa-cart-shopping"></i>
					</a>
					<?php endif; ?>
					
					<div class="header-button ms-4">
						<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="gt-btn">
							<span>
								<?php esc_html_e( 'Get A Quote', 'safepilot' ); ?>
								<i class="fa-solid fa-arrow-right-long"></i>
							</span>
						</a>
					</div>
					
					<div class="header__hamburger d-block d-xl-none my-auto">
						<div class="sidebar__toggle">
							<i class="fas fa-bars"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
/**
 * Default menu fallback
 */
function safepilot_default_menu() {
	?>
	<ul>
		<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'safepilot' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About', 'safepilot' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Services', 'safepilot' ); ?></a></li>
		<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'safepilot' ); ?></a></li>
	</ul>
	<?php
}

/**
 * Custom Walker for navigation menu
 */
class SafePilot_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Start the element output
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// Add has-dropdown class if item has children
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$classes[] = 'has-dropdown';
		}
		
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $class_names .'>';
		
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		
		// Add dropdown icon if item has children
		if ( in_array( 'menu-item-has-children', $classes ) ) {
			$item_output .= '<i class="fas fa-angle-down"></i>';
		}
		
		$item_output .= '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
	/**
	 * Start the sub menu output
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"submenu\">\n";
	}
}
?>
