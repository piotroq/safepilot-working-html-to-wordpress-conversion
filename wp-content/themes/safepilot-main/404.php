<?php
/**
 * The template for displaying 404 pages (not found)
 * 
 * @package SafePilot
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<section class="Error-section section-padding fix">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="error-content text-center">
						<div class="error-image mb-5">
							<?php
							$error_image = apply_filters( 'safepilot_404_image', SAFEPILOT_THEME_URI . '/assets/img/404.png' );
							if ( file_exists( str_replace( SAFEPILOT_THEME_URI, SAFEPILOT_THEME_DIR, $error_image ) ) ) :
							?>
							<img src="<?php echo esc_url( $error_image ); ?>" alt="<?php esc_attr_e( '404 Error', 'safepilot' ); ?>">
							<?php else : ?>
							<h1 class="error-title">404</h1>
							<?php endif; ?>
						</div>
						
						<h2 class="error-heading">
							<?php esc_html_e( 'Oops! Page Not Found', 'safepilot' ); ?>
						</h2>
						
						<p class="error-text">
							<?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'safepilot' ); ?>
						</p>
						
						<div class="error-actions mt-4">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
								<i class="fas fa-home"></i>
								<?php esc_html_e( 'Back to Homepage', 'safepilot' ); ?>
							</a>
							<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn-outline-primary">
								<i class="fas fa-envelope"></i>
								<?php esc_html_e( 'Contact Us', 'safepilot' ); ?>
							</a>
						</div>
						
						<!-- Search Form -->
						<div class="error-search mt-5">
							<h4><?php esc_html_e( 'Try Searching', 'safepilot' ); ?></h4>
							<div class="search-form-wrapper">
								<?php get_search_form(); ?>
							</div>
						</div>
						
						<!-- Popular Links -->
						<div class="popular-links mt-5">
							<h4><?php esc_html_e( 'Popular Links', 'safepilot' ); ?></h4>
							<ul class="list-unstyled">
								<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'safepilot' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>"><?php esc_html_e( 'About Us', 'safepilot' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>"><?php esc_html_e( 'Our Services', 'safepilot' ); ?></a></li>
								<li><a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>"><?php esc_html_e( 'Blog', 'safepilot' ); ?></a></li>
								<li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>"><?php esc_html_e( 'Contact', 'safepilot' ); ?></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();
