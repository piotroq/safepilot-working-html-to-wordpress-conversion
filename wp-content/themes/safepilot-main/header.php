<?php
/**
 * The header for our theme
 * 
 * @package SafePilot
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'safepilot' ); ?></a>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<?php get_template_part( 'template-parts/top-bar' ); ?>
		<?php get_template_part( 'template-parts/menu-main' ); ?>
	</header>

	<div id="content" class="site-content">
