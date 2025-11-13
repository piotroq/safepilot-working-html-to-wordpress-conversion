<?php
/**
 * The template for displaying Product Quick Views Title
 *
 * @package WordPress
 * @subpackage Organiz
 * @since organiz 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<h3 itemprop="name" class="product_title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
