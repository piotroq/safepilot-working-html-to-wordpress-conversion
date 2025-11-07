<?php
/**
 * The template for displaying archive pages
 * 
 * @package SafePilot
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			
			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header>
			
			<div class="blog-grid-layout">
				<div class="row">
					<?php
					// Start the Loop
					while ( have_posts() ) :
						the_post();
						?>
						
						<div class="col-xl-4 col-lg-6 col-md-6">
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-card' ); ?>>
								<?php if ( has_post_thumbnail() ) : ?>
								<div class="post-thumbnail">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'safepilot-medium', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
									</a>
								</div>
								<?php endif; ?>
								
								<div class="post-content">
									<div class="entry-meta">
										<span class="posted-on">
											<i class="far fa-calendar"></i>
											<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
												<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
													<?php echo esc_html( get_the_date() ); ?>
												</time>
											</a>
										</span>
										
										<?php if ( has_category() ) : ?>
										<span class="cat-links">
											<i class="far fa-folder"></i>
											<?php the_category( ', ' ); ?>
										</span>
										<?php endif; ?>
									</div>
									
									<header class="entry-header">
										<?php
										the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
										?>
									</header>
									
									<div class="entry-excerpt">
										<?php the_excerpt(); ?>
									</div>
									
									<a href="<?php the_permalink(); ?>" class="read-more-btn">
										<?php esc_html_e( 'Read More', 'safepilot' ); ?>
										<i class="fa-solid fa-arrow-right-long"></i>
									</a>
								</div>
							</article>
						</div>
						
						<?php
					endwhile;
					?>
				</div>
			</div>
			
			<?php
			// Pagination
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => '<i class="fas fa-arrow-left"></i> ' . __( 'Previous', 'safepilot' ),
				'next_text' => __( 'Next', 'safepilot' ) . ' <i class="fas fa-arrow-right"></i>',
			) );
			
		else :
			
			get_template_part( 'template-parts/content', 'none' );
			
		endif;
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
