<?php
/**
 * Template part for displaying top bar
 * 
 * @package SafePilot
 * @since 1.0.0
 */

// Get theme options
$email = get_theme_mod( 'safepilot_top_bar_email', safepilot_get_option( 'email', 'info@safepilot.pl' ) );
$phone = get_theme_mod( 'safepilot_top_bar_phone', safepilot_get_option( 'phone', '+48 123 456 789' ) );

// Get social media links
$facebook = get_theme_mod( 'safepilot_social_facebook', safepilot_get_option( 'social.facebook', '' ) );
$twitter = get_theme_mod( 'safepilot_social_twitter', safepilot_get_option( 'social.twitter', '' ) );
$linkedin = get_theme_mod( 'safepilot_social_linkedin', safepilot_get_option( 'social.linkedin', '' ) );
$youtube = get_theme_mod( 'safepilot_social_youtube', safepilot_get_option( 'social.youtube', '' ) );
?>

<div class="header-top-section top-style-3">
	<div class="container">
		<div class="header-top-wrapper">
			<ul class="contact-list">
				<?php if ( ! empty( $email ) ) : ?>
				<li>
					<i class="far fa-envelope"></i>
					<a href="mailto:<?php echo esc_attr( $email ); ?>" class="link"><?php echo esc_html( $email ); ?></a>
				</li>
				<?php endif; ?>
				
				<?php if ( ! empty( $phone ) ) : ?>
				<li>
					<i class="fa-solid fa-phone-volume"></i>
					<a href="tel:<?php echo esc_attr( str_replace( array( ' ', '-', '(', ')' ), '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
				</li>
				<?php endif; ?>
			</ul>
			
			<div class="top-right">
				<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
				<div class="flag-wrap">
					<div class="flag">
						<img src="<?php echo esc_url( SAFEPILOT_THEME_URI . '/assets/img/flag.png' ); ?>" alt="<?php esc_attr_e( 'Flag', 'safepilot' ); ?>">
					</div>
					<div class="nice-select" tabindex="0">
						<?php
						pll_the_languages( array(
							'dropdown' => 1,
							'show_names' => 1,
							'display_names_as' => 'name',
							'hide_current' => 0,
						) );
						?>
					</div>
				</div>
				<?php endif; ?>
				
				<?php if ( $facebook || $twitter || $linkedin || $youtube ) : ?>
				<div class="social-icon d-flex align-items-center">
					<span><?php esc_html_e( 'Follow Us:', 'safepilot' ); ?></span>
					
					<?php if ( $facebook ) : ?>
					<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'safepilot' ); ?>">
						<i class="fab fa-facebook-f"></i>
					</a>
					<?php endif; ?>
					
					<?php if ( $twitter ) : ?>
					<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Twitter', 'safepilot' ); ?>">
						<i class="fab fa-twitter"></i>
					</a>
					<?php endif; ?>
					
					<?php if ( $linkedin ) : ?>
					<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'LinkedIn', 'safepilot' ); ?>">
						<i class="fa-brands fa-linkedin-in"></i>
					</a>
					<?php endif; ?>
					
					<?php if ( $youtube ) : ?>
					<a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'YouTube', 'safepilot' ); ?>">
						<i class="fa-brands fa-youtube"></i>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
