<?php
/**
 * The template for displaying single portfolio items
 * 
 * @package SafePilot
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-single' ); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>
				
				<?php if ( has_post_thumbnail() ) : ?>
				<div class="post-thumbnail portfolio-featured-image">
					<?php the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
				</div>
				<?php endif; ?>
				
				<div class="entry-content portfolio-content">
					<?php
					the_content();
					
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'safepilot' ),
						'after'  => '</div>',
					) );
					?>
				</div>
				
				<?php
				// Portfolio meta information
				$portfolio_meta = array(
					'client'      => get_post_meta( get_the_ID(), '_safepilot_portfolio_client', true ),
					'date'        => get_post_meta( get_the_ID(), '_safepilot_portfolio_date', true ),
					'category'    => get_post_meta( get_the_ID(), '_safepilot_portfolio_category', true ),
					'url'         => get_post_meta( get_the_ID(), '_safepilot_portfolio_url', true ),
				);
				
				if ( array_filter( $portfolio_meta ) ) :
				?>
				<div class="portfolio-meta">
					<h3><?php esc_html_e( 'Project Details', 'safepilot' ); ?></h3>
					<ul>
						<?php if ( ! empty( $portfolio_meta['client'] ) ) : ?>
						<li>
							<strong><?php esc_html_e( 'Client:', 'safepilot' ); ?></strong>
							<?php echo esc_html( $portfolio_meta['client'] ); ?>
						</li>
						<?php endif; ?>
						
						<?php if ( ! empty( $portfolio_meta['date'] ) ) : ?>
						<li>
							<strong><?php esc_html_e( 'Date:', 'safepilot' ); ?></strong>
							<?php echo esc_html( $portfolio_meta['date'] ); ?>
						</li>
						<?php endif; ?>
						
						<?php if ( ! empty( $portfolio_meta['category'] ) ) : ?>
						<li>
							<strong><?php esc_html_e( 'Category:', 'safepilot' ); ?></strong>
							<?php echo esc_html( $portfolio_meta['category'] ); ?>
						</li>
						<?php endif; ?>
						
						<?php if ( ! empty( $portfolio_meta['url'] ) ) : ?>
						<li>
							<strong><?php esc_html_e( 'Website:', 'safepilot' ); ?></strong>
							<a href="<?php echo esc_url( $portfolio_meta['url'] ); ?>" target="_blank" rel="noopener noreferrer">
								<?php echo esc_html( $portfolio_meta['url'] ); ?>
							</a>
						</li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
				
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Post title */
							esc_html__( 'Edit %s', 'safepilot' ),
							'<span class="screen-reader-text">' . get_the_title() . '</span>'
						),
						'<span class="edit-link"><i class="far fa-edit"></i> ',
						'</span>'
					);
					?>
				</footer>
			</article>
			
			<?php
			// Portfolio navigation
			the_post_navigation( array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous Project:', 'safepilot' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next Project:', 'safepilot' ) . '</span> <span class="nav-title">%title</span>',
			) );
			
		endwhile;
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
