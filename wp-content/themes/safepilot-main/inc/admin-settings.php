<?php
/**
 * SafePilot Admin Settings Page
 * 
 * @package SafePilot
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add admin menu page
 */
function safepilot_add_admin_menu() {
	add_menu_page(
		__( 'SafePilot Settings', 'safepilot' ),
		__( 'SafePilot', 'safepilot' ),
		'manage_options',
		'safepilot-settings',
		'safepilot_settings_page',
		'dashicons-shield-alt',
		60
	);
}
add_action( 'admin_menu', 'safepilot_add_admin_menu' );

/**
 * Settings page callback
 */
function safepilot_settings_page() {
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		
		<form method="post" action="options.php">
			<?php
			settings_fields( 'safepilot_settings' );
			do_settings_sections( 'safepilot-settings' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/**
 * Initialize settings
 */
function safepilot_settings_init() {
	// Register settings
	register_setting( 'safepilot_settings', 'safepilot_options', 'safepilot_sanitize_options' );
	
	// Top Bar Settings Section
	add_settings_section(
		'safepilot_top_bar_section',
		__( 'Top Bar Settings', 'safepilot' ),
		'safepilot_top_bar_section_callback',
		'safepilot-settings'
	);
	
	// Email field
	add_settings_field(
		'safepilot_email',
		__( 'Email Address', 'safepilot' ),
		'safepilot_email_render',
		'safepilot-settings',
		'safepilot_top_bar_section'
	);
	
	// Phone field
	add_settings_field(
		'safepilot_phone',
		__( 'Phone Number', 'safepilot' ),
		'safepilot_phone_render',
		'safepilot-settings',
		'safepilot_top_bar_section'
	);
	
	// Social Media Settings Section
	add_settings_section(
		'safepilot_social_section',
		__( 'Social Media Links', 'safepilot' ),
		'safepilot_social_section_callback',
		'safepilot-settings'
	);
	
	// Social media fields
	$social_networks = array(
		'facebook' => 'Facebook',
		'twitter'  => 'Twitter',
		'linkedin' => 'LinkedIn',
		'youtube'  => 'YouTube',
	);
	
	foreach ( $social_networks as $network => $label ) {
		add_settings_field(
			"safepilot_social_{$network}",
			sprintf( __( '%s URL', 'safepilot' ), $label ),
			'safepilot_social_render',
			'safepilot-settings',
			'safepilot_social_section',
			array( 'network' => $network )
		);
	}
}
add_action( 'admin_init', 'safepilot_settings_init' );

/**
 * Section callbacks
 */
function safepilot_top_bar_section_callback() {
	echo '<p>' . __( 'Configure the contact information displayed in the top bar.', 'safepilot' ) . '</p>';
}

function safepilot_social_section_callback() {
	echo '<p>' . __( 'Add your social media profile URLs.', 'safepilot' ) . '</p>';
}

/**
 * Field render functions
 */
function safepilot_email_render() {
	$options = get_option( 'safepilot_options' );
	$email = isset( $options['email'] ) ? $options['email'] : 'info@safepilot.pl';
	?>
	<input type="email" name="safepilot_options[email]" value="<?php echo esc_attr( $email ); ?>" class="regular-text">
	<p class="description"><?php _e( 'Enter the email address to display in the top bar.', 'safepilot' ); ?></p>
	<?php
}

function safepilot_phone_render() {
	$options = get_option( 'safepilot_options' );
	$phone = isset( $options['phone'] ) ? $options['phone'] : '+48 123 456 789';
	?>
	<input type="text" name="safepilot_options[phone]" value="<?php echo esc_attr( $phone ); ?>" class="regular-text">
	<p class="description"><?php _e( 'Enter the phone number to display in the top bar.', 'safepilot' ); ?></p>
	<?php
}

function safepilot_social_render( $args ) {
	$options = get_option( 'safepilot_options' );
	$network = $args['network'];
	$value = isset( $options['social'][ $network ] ) ? $options['social'][ $network ] : '';
	?>
	<input type="url" name="safepilot_options[social][<?php echo esc_attr( $network ); ?>]" value="<?php echo esc_url( $value ); ?>" class="regular-text">
	<?php
}

/**
 * Sanitize settings
 */
function safepilot_sanitize_options( $input ) {
	$sanitized = array();
	
	if ( isset( $input['email'] ) ) {
		$sanitized['email'] = sanitize_email( $input['email'] );
	}
	
	if ( isset( $input['phone'] ) ) {
		$sanitized['phone'] = sanitize_text_field( $input['phone'] );
	}
	
	if ( isset( $input['social'] ) && is_array( $input['social'] ) ) {
		$sanitized['social'] = array();
		foreach ( $input['social'] as $network => $url ) {
			$sanitized['social'][ $network ] = esc_url_raw( $url );
		}
	}
	
	return $sanitized;
}

/**
 * Helper function to get theme option
 */
function safepilot_get_option( $key, $default = '' ) {
	$options = get_option( 'safepilot_options' );
	
	if ( strpos( $key, 'social.' ) === 0 ) {
		$network = str_replace( 'social.', '', $key );
		return isset( $options['social'][ $network ] ) ? $options['social'][ $network ] : $default;
	}
	
	return isset( $options[ $key ] ) ? $options[ $key ] : $default;
}
